<?php
namespace App\Repositories\Admin;

use App\Models\Color;

class ColorRepository implements ColorRepositoryInterface{
    public function store_or_update_color($request, $id = '')
    {
        try {
            $request['name'] = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $data = $request->except(['_token', 'name_en', 'name_ar']);
            if ($id === '') {
                Color::create($data);
                $success_msg = 'Record added successfully';
            } else {
                Color::find($id)->update($data);
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
            Color::destroy($request->color);
            return back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
