<?php
namespace App\Repositories\Admin;

use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CountryRepository implements CountryRepositoryInterface{
    public function store_or_update_country($request, $id = '')
    {
        try {
            $request['name'] = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $request['currency'] = ['en' => $request->currency_en, 'ar' => $request->currency_ar];
            $data = $request->except(['_token', 'name_en', 'name_ar', 'currency_en', 'currency_ar']);
            if ($request->hasFile('flag')) {
                $data['flag'] = custom_upload()->upload([
                    'file_request_name' => 'flag',
                    'folder_name' => 'countries',
                    'delete_file' => $id != '' ? Country::find($id)->flag : '',
                ]);
            }
            if ($id === '') {
                Country::create($data);
                $success_msg = 'Record added successfully';
            } else {
                Country::find($id)->update($data);
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
            if(is_array($request->country)) {
                foreach ($request->country as $id) {
                    Storage::delete('public/'.Country::find($id)->first()->flag);
                }
                Country::destroy($request->country);
            }else {
                Country::find($request->country)->delete();
                Storage::delete('public/'.Country::find($request->country)->first()->flag);
            }
            return back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
