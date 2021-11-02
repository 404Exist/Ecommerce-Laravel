<?php

if (!function_exists('admin_url'))
{
    function admin_url($url = '')
    {
        return url('admin/'.$url);
    }
}

if (!function_exists('admin_auth'))
{
    function admin_auth()
    {
        return auth()->guard('admin');
    }
}

if (!function_exists('lang'))
{
    function lang()
    {
        return session()->has('lang') ? session('lang') : website_setting()->main_lang;
    }
}

if (!function_exists('active_menu'))
{
    function active_menu($link, $segment_num)
    {
        return preg_match('/'.$link.'/', request()->segment($segment_num)) ? ['menu-open', 'active'] : ['', ''];
    }
}

if (!function_exists('website_setting'))
{
    function website_setting()
    {
        return \App\Models\Setting::orderBy('id', 'desc')->first();
    }
}

if (!function_exists('img_types'))
{
    function img_types($ext = '')
    {
        return 'png,jpg,jpeg,gif,bmp'.$ext;
    }
}

if (!function_exists('custom_upload'))
{
    function custom_upload()
    {
        return new \App\Http\Controllers\UploadController;
    }
}

if (!function_exists('load_department'))
{
    function load_department($dep_parentID = null, $dep_id = null)
    {
        $dep_parentID = intval($dep_parentID);
        $departments = \App\Models\Department::get();
        $department_arr = [];
        foreach($departments as $index => $department) {
            // if ($select == $department->id ) {
                $list_arr['icon'] = '';
                $list_arr['li_attr'] = '';
                $list_arr['a_attr'] = '';
                $list_arr['children'] = [];
                $list_arr['state'] = [
                    'opened' => $dep_parentID == $department->id ? true : false ,
                    'selected' => $dep_parentID == $department->id ? true : false,
                    'disabled' => $dep_id == $department->id ? true : false,
                    // 'hidden' => $dep_id == $department->id ? true : false,
                ];
            // }
            $list_arr['id'] = $department->id;
            $list_arr['parent'] = $department->parent_id !== null ? $department->parent_id : '#';
            $list_arr['text'] = $department->getTranslation('name', lang());
            array_push($department_arr, $list_arr);
        }
        return json_encode($department_arr, JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('get_dep_parent'))
{
    function get_dep_parent($dep_id)
    {
        $department = \App\Models\Department::find($dep_id);
        return ($department->parent_id !== null && $department->parent_id > 0) ? (get_dep_parent($department->parent_id) . ','. $dep_id) : $dep_id;
    }
}
