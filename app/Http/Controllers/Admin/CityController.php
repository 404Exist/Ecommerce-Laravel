<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CityDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCityRequest;
use App\Http\Requests\Admin\UpdateCityRequest;
use App\Models\City;
use App\Repositories\Admin\CityRepositoryInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public $cityRepo;
    public function __construct(CityRepositoryInterface $cityRepo)
    {
        $this->middleware('permission:Show Cities', ['only' => ['index']]);
        $this->middleware('permission:Add Cities', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Cities', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Cities', ['only' => ['destroy']]);
        $this->cityRepo = $cityRepo;
    }
    public function index(CityDatatable $admin)
    {
        return $admin->render('admin.cities.index', ['title' => 'Cities']);
    }

    public function create()
    {
        return view('admin.cities.create', ['title' => 'Add City']);
    }

    public function store(StoreCityRequest $request)
    {
        $request->validated();
        return $this->cityRepo->store_or_update_city($request, '');
    }

    public function edit($id)
    {
        $city = City::find($id);
        $title = 'Edit Country';
        return view('admin.cities.edit', compact('city', 'title'));
    }

    public function update(UpdateCityRequest $request, $id)
    {
        return $this->cityRepo->store_or_update_city($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->cityRepo->multi_delete($request);
    }
}
