<?php
namespace App\Repositories\Admin;

use App\Models\City;
use Illuminate\Support\Facades\Storage;

class CityRepository implements CityRepositoryInterface{
    public function store_or_update_city($request, $id = '')
    {
        try {
            $request['name'] = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $data = $request->except(['_token', 'name_en', 'name_ar']);
            if ($id === '')  {
                City::create($data);
                $success_msg = 'Record added successfully';
            }
            else{
                City::find($id)->update($data);
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
            is_array($request->city) ?  City::destroy($request->city) : City::find($request->city)->delete();
            return back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
