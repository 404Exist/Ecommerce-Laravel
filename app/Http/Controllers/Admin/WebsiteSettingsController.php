<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebsiteSettingsRequest;
use App\Models\Setting;

class WebsiteSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Website Settings', ['only' => ['index']]);
        $this->middleware('permission:Add Website Settings', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Website Settings', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Website Settings', ['only' => ['destroy']]);
    }
    public function settings()
    {
        return view('admin.website-settings', ['title' => 'Website Settings']);
    }

    public function update_settings(WebsiteSettingsRequest $request)
    {
        try {
            $request->validated();
            $request['sitename'] = ['en' => $request->sitename_en, 'ar' => $request->sitename_ar];
            $request['message_maintenance'] = ['en' => $request->message_maintenance_en, 'ar' => $request->message_maintenance_ar];
            $data = $request->except(['_token', 'sitename_ar', 'sitename_en', 'message_maintenance_ar', 'message_maintenance_en']);

            $request->hasFile('logo') ? ($data['logo'] = custom_upload()->upload(['file_request_name' => 'logo', 'folder_name' => 'settings', 'delete_file' => website_setting()->logo])) : '' ;
            $request->hasFile('icon') ? ($data['icon'] = custom_upload()->upload(['file_request_name' => 'icon', 'folder_name' => 'settings', 'delete_file' => website_setting()->icon])) : '' ;
            Setting::orderBy('id', 'desc')->update($data);
            return back()->with(['success' => 'Website settings updated successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
