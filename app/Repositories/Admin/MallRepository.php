<?php
namespace App\Repositories\Admin;

use App\Models\Mall;
use Illuminate\Support\Facades\Storage;

class MallRepository implements MallRepositoryInterface{
    public function store_or_update_mall($request, $id = '')
    {
        try {
            $request['name'] = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $data = $request->except(['_token', 'name_en', 'name_ar']);
            if ($request->hasFile('logo')) {
                $data['logo'] = custom_upload()->upload([
                    'file_request_name' => 'logo',
                    'folder_name' => 'malls',
                    'delete_file' => $id != '' ? Mall::find($id)->logo : '',
                ]);
            }
            if ($id === '') {
                Mall::create($data);
                $success_msg = 'Record added successfully';
            } else {
                Mall::find($id)->update($data);
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
            if(is_array($request->mall)) {
                foreach ($request->mall as $id) {
                    Storage::delete('public/'.Mall::find($id)->first()->logo);
                }
                Mall::destroy($request->mall);
            }else {
                Mall::find($request->mall)->delete();
                Storage::delete('public/'.Mall::find($request->mall)->first()->logo);
            }
            return back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
