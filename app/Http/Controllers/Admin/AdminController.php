<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use App\Repositories\Admin\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public $adminRepo;
    public function __construct(AdminRepositoryInterface $adminRepo)
    {
        $this->middleware('permission:Show Admin Account', ['only' => ['index']]);
        $this->middleware('permission:Add Admin Account', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Admin Account', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Admin Account', ['only' => ['destroy']]);
        $this->adminRepo = $adminRepo;
    }

    public function index(Request $request)
    {
        $admins = Admin::all();
        $title = 'Admins';
        return view('admin.accounts.admins.index',compact('admins', 'title'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.accounts.admins.create', ['title' => 'Create Admin', 'roles' => $roles]);
    }

    public function store(CreateAdminRequest $request)
    {
        $request->validated();
        return $this->adminRepo->store_admin($request);
    }

    public function edit($id)
    {
        $title = 'Edit Admin';
        $roles = Role::pluck('name','name')->all();
        $admin = Admin::find($id);
        return view('admin.accounts.admins.edit', compact('admin', 'roles', 'title'));
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        return $this->adminRepo->update_admin($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->adminRepo->multi_delete($request);
    }
}
