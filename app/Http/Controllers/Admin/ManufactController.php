<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ManufactDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreManufactRequest;
use App\Http\Requests\Admin\UpdateManufactRequest;
use App\Models\Manufacturer;
use App\Repositories\Admin\ManufactRepositoryInterface;
use Illuminate\Http\Request;

class ManufactController extends Controller
{
    public $manufactRepo;
    public function __construct(ManufactRepositoryInterface $manufactRepo)
    {
        $this->middleware('permission:Show Manufacturers', ['only' => ['index']]);
        $this->middleware('permission:Add Manufacturers', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Manufacturers', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Manufacturers', ['only' => ['destroy']]);
        $this->manufactRepo = $manufactRepo;
    }
    public function index(ManufactDatatable $admin)
    {
        return $admin->render('admin.manufacturers.index', ['title' => 'Manufacturers']);
    }

    public function create()
    {
        return view('admin.manufacturers.create', ['title' => 'Add Manufacturer']);
    }

    public function store(StoreManufactRequest $request)
    {
        $request->validated();
        return $this->manufactRepo->store_or_update_manufacturer($request, '');
    }

    public function edit($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        $title = 'Edit Manufacturer';
        return view('admin.manufacturers.edit', compact('manufacturer', 'title'));
    }

    public function update(UpdateManufactRequest $request, $id)
    {
        return $this->manufactRepo->store_or_update_manufacturer($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->manufactRepo->multi_delete($request);
    }
}
