<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ShippingDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreShippingRequest;
use App\Http\Requests\Admin\UpdateShippingRequest;
use App\Models\Shipping;
use App\Repositories\Admin\ShippingRepositoryInterface;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public $shippingRepo;
    public function __construct(ShippingRepositoryInterface $shippingRepo)
    {
        $this->middleware('permission:Show Shipping Companies', ['only' => ['index']]);
        $this->middleware('permission:Add Shipping Companies', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Shipping Companies', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Shipping Companies', ['only' => ['destroy']]);
        $this->shippingRepo = $shippingRepo;
    }
    public function index(ShippingDatatable $admin)
    {
        return $admin->render('admin.shippings.index', ['title' => 'Shipping']);
    }

    public function create()
    {
        return view('admin.shippings.create', ['title' => 'Add Shipping Company']);
    }

    public function store(StoreShippingRequest $request)
    {
        $request->validated();
        return $this->shippingRepo->store_or_update_shipping($request, '');
    }

    public function edit($id)
    {
        $shipping = Shipping::findOrFail($id);
        $title = 'Edit Shipping Company';
        return view('admin.shippings.edit', compact('shipping', 'title'));
    }

    public function update(UpdateShippingRequest $request, $id)
    {
        return $this->shippingRepo->store_or_update_shipping($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->shippingRepo->multi_delete($request);
    }
}
