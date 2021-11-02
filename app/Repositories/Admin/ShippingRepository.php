<?php
namespace App\Repositories\Admin;

use App\Models\Shipping;
use Illuminate\Support\Facades\Storage;

class ShippingRepository implements ShippingRepositoryInterface{
    public function store_or_update_shipping($request, $id = '')
    {
        try {
            $request['name'] = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $data = $request->except(['_token', 'name_en', 'name_ar']);
            if ($request->hasFile('logo')) {
                $data['logo'] = custom_upload()->upload([
                    'file_request_name' => 'logo',
                    'folder_name' => 'shippings',
                    'delete_file' => $id != '' ? Shipping::find($id)->logo : '',
                ]);
            }
            if ($id === '') {
                Shipping::create($data);
                $success_msg = 'Record added successfully';
            } else {
                Shipping::find($id)->update($data);
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
            if(is_array($request->shipping)) {
                foreach ($request->shipping as $id) {
                    Storage::delete('public/'.Shipping::find($id)->first()->logo);
                }
                Shipping::destroy($request->shipping);
            }else {
                Shipping::find($request->shipping)->delete();
                Storage::delete('public/'.Shipping::find($request->shipping)->first()->logo);
            }
            return back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
