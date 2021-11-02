<?php
namespace App\Repositories\Admin;

use App\Models\State;

class StateRepository implements StateRepositoryInterface{
    public function store_or_update_city($request, $id = '')
    {
        try {
            $request['name'] = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $data = $request->except(['_token', 'name_en', 'name_ar']);
            if ($id === '')  {
                State::create($data);
                $success_msg = 'Record added successfully';
            }
            else{
                State::find($id)->update($data);
                $success_msg = 'Record updated successfully';
            }
            return back()->with(['success' => $success_msg]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function multi_delete($request)
    {
        try {
            is_array($request->state) ?  State::destroy($request->state) : State::find($request->state)->delete();
            return back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
