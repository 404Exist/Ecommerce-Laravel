<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload($data = [])
    {
        $data['disk'] = isset($data['disk']) && !empty($data['disk']) ? $data['disk'] : 'public';
        $data['upload_type'] = isset($data['upload_type']) && !empty($data['upload_type']) ? $data['upload_type'] : 'single';
        isset($data['new_name']) ? ($new_name = $data['new_name'] === null ? time() : $data['new_name']) : '';
        if (request()->hasFile($data['file_request_name']) && $data['upload_type'] == 'single' ) {
            isset($data['delete_file']) && Storage::has($data['disk'].'/'.$data['delete_file']) ? Storage::delete($data['disk'].'/'.$data['delete_file']) : '';
            return (request()->file($data['file_request_name'])->store($data['folder_name'], ['disk' => $data['disk']]));
        } elseif (request()->hasFile($data['file_request_name']) && $data['upload_type'] == 'multiple' ) {
            $file = request()->file($data['file_request_name']);
            if (is_array($file)) {
                foreach ($file as $f) {
                    $size = $f->getSize();
                    $mime_type = $f->getMimeType();
                    $name = $f->getClientOriginalName();
                    $hash_name = $f->hashName();

                    $f->store($data['folder_name'], ['disk' => $data['disk']]);
                    File::create([
                        'name' => $name,
                        'size' => $size,
                        'file' => $hash_name,
                        'path' => $data['folder_name'],
                        'full_file' => $data['folder_name'].'/'.$hash_name,
                        'mime_type' => $mime_type,
                        'file_for' => $data['file_for'],
                        'relation_id' => $data['relation_id'],
                    ]);
                }
            } else {
                $size = $file->getSize();
                $mime_type = $file->getMimeType();
                $name = $file->getClientOriginalName();
                $hash_name = $file->hashName();

                $file->store($data['folder_name'], ['disk' => $data['disk']]);
                File::create([
                    'name' => $name,
                    'size' => $size,
                    'file' => $hash_name,
                    'path' => $data['folder_name'],
                    'full_file' => $data['folder_name'].'/'.$hash_name,
                    'mime_type' => $mime_type,
                    'file_for' => $data['file_for'],
                    'relation_id' => $data['relation_id'],
                ]);
            }



            return $data['folder_name'].'/'.$hash_name;
        }
    }

    public function delete($id)
    {
        $file = File::find($id);
        if(!empty($file)) {
            Storage::has('public/'.$file->full_file) ? Storage::delete('public/'.$file->full_file) : '';
            $file->delete();
        }
    }
}
