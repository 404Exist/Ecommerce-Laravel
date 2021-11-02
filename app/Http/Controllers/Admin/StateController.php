<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StateDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStateRequest;
use App\Http\Requests\Admin\UpdateStateRequest;
use App\Models\City;
use App\Models\State;
use App\Repositories\Admin\StateRepositoryInterface;
use Illuminate\Http\Request;
use Collective\Html\FormFacade as Form;
class StateController extends Controller
{
    public $stateRepo;
    public function __construct(StateRepositoryInterface $stateRepo)
    {
        $this->middleware('permission:Show States', ['only' => ['index']]);
        $this->middleware('permission:Add States', ['only' => ['create','store']]);
        $this->middleware('permission:Edit States', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete States', ['only' => ['destroy']]);
        $this->stateRepo = $stateRepo;
    }
    public function index(StateDatatable $admin)
    {
        return $admin->render('admin.states.index', ['title' => 'States']);
    }

    public function create()
    {
        return view('admin.states.create', ['title' => 'Add State']);
    }

    public function store(StoreStateRequest $request)
    {
        $request->validated();
        return $this->stateRepo->store_or_update_city($request, '');
    }

    public function edit($id)
    {
        $state = State::find($id);
        $title = 'Edit State';
        return view('admin.states.edit', compact('state', 'title'));
    }

    public function update(UpdateStateRequest $request, $id)
    {
        return $this->stateRepo->store_or_update_city($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->stateRepo->multi_delete($request);
    }

    public function show($id)
    {
        if (!empty(City::where('country_id', $id)->first())) {
            return Form::select('city_id', City::where('country_id', $id)->pluck('name', 'id')->map(function ($item, $key) {
                return  City::find($key)->getTranslation('name', lang());
            }), old('country_id'), ['class' => 'form-control']);
        } else {
            return '<select class="form-control" name="city_id">
                        <option>This Country don\'t have cities</option>
                    </select>';
        }
    }
}
