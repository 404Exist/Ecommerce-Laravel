<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountryDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCountryRequest;
use App\Http\Requests\Admin\UpdateCountryRequest;
use App\Models\Country;
use App\Repositories\Admin\CountryRepositoryInterface;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public $countryRepo;
    public function __construct(CountryRepositoryInterface $countryRepo)
    {
        $this->middleware('permission:Show Countries', ['only' => ['index']]);
        $this->middleware('permission:Add Countries', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Countries', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Countries', ['only' => ['destroy']]);
        $this->countryRepo = $countryRepo;
    }
    public function index(CountryDatatable $admin)
    {
        return $admin->render('admin.countries.index', ['title' => 'Countries']);
    }

    public function create()
    {
        return view('admin.countries.create', ['title' => 'Add Country']);
    }

    public function store(StoreCountryRequest $request)
    {
        $request->validated();
        return $this->countryRepo->store_or_update_country($request, '');
    }

    public function edit($id)
    {
        $country = Country::find($id);
        $title = 'Edit Country';
        return view('admin.countries.edit', compact('country', 'title'));
    }

    public function update(UpdateCountryRequest $request, $id)
    {
        return $this->countryRepo->store_or_update_country($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->countryRepo->multi_delete($request);
    }
}
