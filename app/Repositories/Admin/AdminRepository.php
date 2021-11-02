<?php
namespace App\Repositories\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements AdminRepositoryInterface{
    public function store_admin($request)
    {
        try {
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles_name' => $request->roles_name,
            ]);
            $admin->assignRole($request->roles_name);
            return back()->with(['success' => 'Record added successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function update_admin($request, $id)
    {
        try {
            $request->has('password') ?
                Admin::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'roles_name' => $request->roles_name,
                ])
            :
                Admin::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'roles_name' => $request->roles_name,
                ]);
            ;
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            Admin::find($id)->assignRole($request->roles_name);
            return back()->with(['success' => 'Record updated successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function multi_delete($request)
    {
        try {
            is_array($request->item) ? Admin::destroy($request->item) : Admin::find($request->item)->delete();
            return back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
