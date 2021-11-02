<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Show Role', ['only' => ['index']]);
        $this->middleware('permission:Add Role', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Role', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Role', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::all();
        $title = 'Roles';
        return view('admin.roles.index',compact('roles', 'title'));
    }

    public function create()
    {
        $permissions = Permission::all();
        $title = 'Create Roles';
        return view('admin.roles.create',compact('permissions', 'title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permission);
        return redirect()->route('roles.index')->with('success','Role created successfully');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
        return view('admin.roles.show',compact('role','rolePermissions'));
    }

    public function edit($id)
    {
        $title = 'Edit Roles';
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit',compact('role','permissions','rolePermissions', 'title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'name' => 'required',
        'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permission);
        return redirect()->route('roles.index')->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')->with('success','Role deleted successfully');
    }
}
