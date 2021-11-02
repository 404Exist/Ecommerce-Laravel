<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MallDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMallRequest;
use App\Http\Requests\Admin\UpdateMallRequest;
use App\Models\Mall;
use App\Repositories\Admin\MallRepositoryInterface;
use Illuminate\Http\Request;

class MallController extends Controller
{
    public $mallRepo;
    public function __construct(MallRepositoryInterface $mallRepo)
    {
        $this->middleware('permission:Show Malls', ['only' => ['index']]);
        $this->middleware('permission:Add Malls', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Malls', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Malls', ['only' => ['destroy']]);
        $this->mallRepo = $mallRepo;
    }
    public function index(MallDatatable $admin)
    {
        return $admin->render('admin.malls.index', ['title' => 'Malls']);
    }

    public function create()
    {
        return view('admin.malls.create', ['title' => 'Add Mall']);
    }

    public function store(StoreMallRequest $request)
    {
        $request->validated();
        return $this->mallRepo->store_or_update_mall($request, '');
    }

    public function edit($id)
    {
        $mall = Mall::findOrFail($id);
        $title = 'Edit Mall';
        return view('admin.malls.edit', compact('mall', 'title'));
    }

    public function update(UpdateMallRequest $request, $id)
    {
        return $this->mallRepo->store_or_update_mall($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->mallRepo->multi_delete($request);
    }
}
