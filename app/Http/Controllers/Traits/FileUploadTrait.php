<?php
namespace App\Http\Controllers\Traits;

use Str,Storage;
use Illuminate\Support\Facades\File;

 trait FileUploadTrait{

    public function uploadFile($file,$folder="files")
    {
        // $file_name=\Str::random(10).'-'.time();
        $file_name=rand(10000,100000).time();

        $ext=strtolower($file->getClientOriginalExtension());
        $file_full_name = $file_name . '.' . $ext;
        $upload_path = 'uploads/'.$folder . '/';
        $file_path = $upload_path . $file_full_name;
        $file->move($upload_path,$file_full_name);
        return $file_path;
    }

    public function removeFile($file)
    {
        if(File::exists(public_path($file))){
            File::delete(public_path($file));
        }
    }
}
