<?php
namespace App\Repositories\Admin;

use App\Models\File;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface{
    public function store_or_update_product($request, $id = '')
    {
        try {
            $request['title'] = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $request['content'] = ['en' => $request->content_en, 'ar' => $request->content_ar];
            $request['other_data'] = is_array($request->input_key) ? array_combine($request->input_key , $request->input_value) : json_decode('{}');
            $request['mall_id'] = !is_null($request->mall_id) ? $request['mall_id'] : json_decode('{}');
            $data = $request->except(['_token', 'title_en', 'title_ar', 'content_en', 'content_ar', 'input_key', 'input_value', 'sub_files', 'removedFilesID']);
            if ($id === '') {
                $theProduct = Product::create($data);
                $success_msg = 'Record added successfully';
            } else {
                $theProduct = Product::find($id);
                $theProduct->update($data);
                $success_msg = 'Record updated successfully';
            }
            if ($request->hasFile('photo')) {
                $data['photo'] = custom_upload()->upload([
                    'file_request_name' => 'photo',
                    'folder_name' => 'products/PID_' . $theProduct->id,
                    'delete_file' => $id != '' ? $theProduct->photo : '',
                ]);
                Product::find($theProduct->id)->update($data);
            }
            if (!empty($request->removedFilesID)) {
                foreach ($request->removedFilesID as $id) {
                    $file= File::find($id);
                    Storage::delete('public/'.$file->full_file);
                    $file->delete();
                }
            }

            if (request()->hasFile('sub_files')) {
                custom_upload()->upload([
                    'file_request_name' => 'sub_files',
                    'folder_name' => 'products/PID_' . $theProduct->id,
                    'upload_type' => 'multiple',
                    'relation_id' => $theProduct->id,
                    'file_for' => 'product',
                    'delete_file' => $id != '' ? $theProduct->photo : '',
                ]);
            }
            return response(['status' => true, 'message' => $success_msg], 200);
        } catch (\Exception $e) {
            return response(['status' => true, 'errors' => [$e->getMessage()]], 422);
        }
    }


    public function multi_delete($request)
    {
        try {
            $request->product = is_array($request->product) ? $request->product : [$request->product];
            $files= File::where('file_for', 'product')->whereIn('relation_id',$request->product)->get();
            foreach($request->product  as $id) {
                Storage::deleteDirectory('public/products/PID_'.$id);
            }
            foreach($files as $file) {
                $file->delete();
            }
            Product::destroy($request->product);
            return request()->ajax() ?
                response(['status' => true, 'message' => 'Data deleted successfully'], 200)
                :
                back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return request()->ajax() ?
                response(['status' => true, 'errors' => [$e->getMessage()]], 422)
                :
                back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function product_clone($request) {
        try {
            $request['status'] = 'pending';
            $request['title'] = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $request['content'] = ['en' => $request->content_en, 'ar' => $request->content_ar];
            $request['other_data'] = is_array($request->input_key) ? array_combine($request->input_key , $request->input_value) : json_decode('{}');
            $request['mall_id'] = !is_null($request->mall_id) ? $request['mall_id'] : json_decode('{}');
            $data = $request->except(['_token', 'title_en', 'title_ar', 'content_en', 'content_ar', 'input_key', 'input_value', 'sub_files', 'removedFilesID']);
            $theProduct = Product::create($data);
            if ($request->hasFile('photo')) {
                $data['photo'] = custom_upload()->upload([
                    'file_request_name' => 'photo',
                    'folder_name' => 'products/PID_' . $theProduct->id,
                ]);
                Product::find($theProduct->id)->update($data);
            }
            return request()->ajax() ?
                response(['status' => true, 'message' => admin_url('products/'.$theProduct->id.'/edit')], 200)
                :
                redirect(admin_url('products/'.$theProduct->id.'/edit'));
        } catch (\Exception $e) {
            return request()->ajax() ?
                response(['status' => true, 'errors' => [$e->getMessage()]], 422)
                :
                back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
