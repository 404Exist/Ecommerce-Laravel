<?php
namespace App\Repositories\Admin;

use App\Models\Manufacturer;
use Illuminate\Support\Facades\Storage;

class ManufactRepository implements ManufactRepositoryInterface{
    public function store_or_update_manufacturer($request, $id = '')
    {
        try {
            $request['name'] = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $data = $request->except(['_token', 'name_en', 'name_ar']);
            if ($request->hasFile('logo')) {
                $data['logo'] = custom_upload()->upload([
                    'file_request_name' => 'logo',
                    'folder_name' => 'manufacturers',
                    'delete_file' => $id != '' ? Manufacturer::find($id)->logo : '',
                ]);
            }
            if ($id === '') {
                Manufacturer::create($data);
                $success_msg = 'Record added successfully';
            } else {
                Manufacturer::find($id)->update($data);
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
            if(is_array($request->manufacturer)) {
                foreach ($request->manufacturer as $id) {
                    Storage::delete('public/'.Manufacturer::find($id)->first()->logo);
                }
                Manufacturer::destroy($request->manufacturer);
            }else {
                Manufacturer::find($request->manufacturer)->delete();
                Storage::delete('public/'.Manufacturer::find($request->manufacturer)->first()->logo);
            }
            return back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
