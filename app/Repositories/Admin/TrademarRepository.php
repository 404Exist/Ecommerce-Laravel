<?php
namespace App\Repositories\Admin;

use App\Models\Trademark;
use Illuminate\Support\Facades\Storage;

class TrademarRepository implements TrademarRepositoryInterface{
    public function store_or_update_trademark($request, $id = '')
    {
        try {
            $request['name'] = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $data = $request->except(['_token', 'name_en', 'name_ar']);
            if ($request->hasFile('logo')) {
                $data['logo'] = custom_upload()->upload([
                    'file_request_name' => 'logo',
                    'folder_name' => 'trademarks',
                    'delete_file' => $id != '' ? Trademark::find($id)->logo : '',
                ]);
            }
            if ($id === '') {
                Trademark::create($data);
                $success_msg = 'Record added successfully';
            } else {
                Trademark::find($id)->update($data);
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
            if(is_array($request->trademark)) {
                foreach ($request->trademark as $id) {
                    Storage::delete('public/'.Trademark::find($id)->first()->logo);
                }
                Trademark::destroy($request->trademark);
            }else {
                Trademark::find($request->trademark)->delete();
                Storage::delete('public/'.Trademark::find($request->trademark)->first()->logo);
            }
            return back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
