<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use App\Models\Size;
use App\Models\Weight;
use App\Repositories\Admin\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public $productRepo;
    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->middleware('permission:Show Products', ['only' => ['index']]);
        $this->middleware('permission:Add Products', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Products', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Products', ['only' => ['destroy']]);
        $this->productRepo = $productRepo;
    }
    public function index(ProductDatatable $admin)
    {
        return $admin->render('admin.products.index', ['title' => 'Products']);
    }

    public function create()
    {
        return view('admin.products.create', ['title' => 'Add Product']);
    }

    public function store(StoreProductRequest $request)
    {
        $request->validated();
        return $this->productRepo->store_or_update_product($request, '');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $title = 'Edit Product';
        return view('admin.products.edit', compact('product', 'title'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $request->validated();
        return $this->productRepo->store_or_update_product($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->productRepo->multi_delete($request);
    }

    public function get_weight_size()
    {
        if (request()->has('department_id')) {
            $dep_parentsID = explode(',', get_dep_parent(request('department_id')));
            $sizes =
            Size::where('is_public', 'yes')->whereIn('department_id', $dep_parentsID)
            ->orWhere(
                function($q) {
                    return $q
                        ->where('is_public', 'no')->where('department_id', request('department_id'));
                }
            )->pluck('name', 'id')->map(function ($item, $key) {
                return  Size::find($key)->getTranslation('name', lang());
            });

            $product = Product::find(request('product_id')) ?? '';
            return view('admin.products.ajax.size-weight', compact('sizes', 'product'));

        } else {
            return 'Please choose department';
        }
    }

    public function copy(UpdateProductRequest $request) {
        $request->validated();
        return $this->productRepo->product_clone($request);
    }

    public function search(Request $request) {
        if ($request->ajax()) {
            if ($request->has('search')) {
                $products =
                Product::where('title->en', 'like' ,'%'.$request->search.'%')
                ->where('id', '!=', $request->id)
                ->orWhere('title->ar', 'like' ,'%'.$request->search.'%')
                ->where('id', '!=', $request->id)
                ->limit(10)
                ->orderBy('id', 'desc')
                ->get();
                return response(['status' => true, 'results' => $products, 'totalResults' => count($products)], 200);
            }
        }
    }
}
