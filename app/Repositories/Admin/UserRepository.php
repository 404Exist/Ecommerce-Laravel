<?php
namespace App\Repositories\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface{
    public function store_user($request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'level' => $request->level,
                'password' => Hash::make($request->password),
            ]);
            return back()->with(['success' => 'Record added successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function update_user($request, $id)
    {
        try {
            $request->has('password') ?
                User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'level' => $request->level,
                    'password' => Hash::make($request->password),
                ])
            :
                User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'level' => $request->level,
                ]);
            ;
            return back()->with(['success' => 'Record updated successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function multi_delete($request)
    {
        try {
            is_array($request->item) ? User::destroy($request->item) : User::find($request->item)->delete();
            return back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
