<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SizeDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSizeRequest;
use App\Http\Requests\Admin\UpdateSizeRequest;
use App\Models\Size;
use App\Repositories\Admin\SizeRepositoryInterface;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public $sizeRepo;
    public function __construct(SizeRepositoryInterface $sizeRepo)
    {
        $this->middleware('permission:Show Sizes', ['only' => ['index']]);
        $this->middleware('permission:Add Sizes', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Sizes', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Sizes', ['only' => ['destroy']]);
        $this->sizeRepo = $sizeRepo;
    }
    public function index(SizeDatatable $admin)
    {
        return $admin->render('admin.sizes.index', ['title' => 'Sizes']);
    }

    public function create()
    {
        return view('admin.sizes.create', ['title' => 'Add Size']);
    }

    public function store(StoreSizeRequest $request)
    {
        $request->validated();
        return $this->sizeRepo->store_or_update_Size($request, '');
    }

    public function edit($id)
    {
        $size = Size::findOrFail($id);
        $title = 'Edit Size';
        return view('admin.sizes.edit', compact('size', 'title'));
    }

    public function update(UpdateSizeRequest $request, $id)
    {
        return $this->sizeRepo->store_or_update_size($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->sizeRepo->multi_delete($request);
    }
}
