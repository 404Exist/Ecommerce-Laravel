<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WeightDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWeightRequest;
use App\Http\Requests\Admin\UpdateWeightRequest;
use App\Models\Weight;
use App\Repositories\Admin\WeightRepositoryInterface;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    public $weightRepo;
    public function __construct(WeightRepositoryInterface $weightRepo)
    {
        $this->middleware('permission:Show Weights', ['only' => ['index']]);
        $this->middleware('permission:Add Weights', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Weights', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Weights', ['only' => ['destroy']]);
        $this->weightRepo = $weightRepo;
    }
    public function index(WeightDatatable $admin)
    {
        return $admin->render('admin.weights.index', ['title' => 'weights']);
    }

    public function create()
    {
        return view('admin.weights.create', ['title' => 'Add Weight']);
    }

    public function store(StoreWeightRequest $request)
    {
        $request->validated();
        return $this->weightRepo->store_or_update_weight($request, '');
    }

    public function edit($id)
    {
        $weight = Weight::findOrFail($id);
        $title = 'Edit Weight';
        return view('admin.weights.edit', compact('weight', 'title'));
    }

    public function update(UpdateWeightRequest $request, $id)
    {
        return $this->weightRepo->store_or_update_weight($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->weightRepo->multi_delete($request);
    }
}
