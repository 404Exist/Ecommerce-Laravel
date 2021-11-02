<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDepartmentRequest;
use App\Http\Requests\Admin\UpdateDepartmentRequest;
use App\Models\Department;
use App\Repositories\Admin\DepartmentRepositoryInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public $departmentRepo;
    public function __construct(DepartmentRepositoryInterface $departmentRepo)
    {
        $this->middleware('permission:Show Departments', ['only' => ['index']]);
        $this->middleware('permission:Add Departments', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Departments', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Departments', ['only' => ['destroy']]);
        $this->departmentRepo = $departmentRepo;
    }
    public function index()
    {
        return view('admin.departments.index', ['title' => 'Departments']);
    }

    public function create()
    {
        return view('admin.departments.create', ['title' => 'Add Department']);
    }

    public function store(StoreDepartmentRequest $request)
    {
        $request->validated();
        return $this->departmentRepo->store_or_update_department($request, '');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $title = 'Edit Department';
        return view('admin.departments.edit', compact('department', 'title'));
    }

    public function update(UpdateDepartmentRequest $request, $id)
    {
        return $this->departmentRepo->store_or_update_department($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->departmentRepo->multi_delete($request);
    }
}
