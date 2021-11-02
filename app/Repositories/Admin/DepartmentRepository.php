<?php
namespace App\Repositories\Admin;

use App\Models\Department;
use Illuminate\Support\Facades\Storage;

class DepartmentRepository implements DepartmentRepositoryInterface{
    public function store_or_update_department($request, $id = '')
    {
        try {
            $request['name'] = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $data = $request->except(['_token', 'name_en', 'name_ar']);
            if ($request->hasFile('icon')) {
                $data['icon'] = custom_upload()->upload([
                    'file_request_name' => 'icon',
                    'folder_name' => 'departments',
                    'delete_file' => $id != '' ? Department::find($id)->icon : '',
                ]);
            }
            if ($id === '')  {
                Department::create($data);
                $success_msg = 'Record added successfully';
            }
            else{
                Department::find($id)->update($data);
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
            foreach (explode(', ',$request->id) as $id) {
                if (!empty(Department::find($id))) {
                    foreach (Department::where('parent_id', $id)->get() as $sub) {
                        Storage::delete('public/'.$sub->icon);
                    }
                    Storage::delete('public/'.Department::find($id)->icon);
                    Department::where('parent_id', $id)->delete();
                    Department::find($id)->delete();
                }
            }
            return back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
