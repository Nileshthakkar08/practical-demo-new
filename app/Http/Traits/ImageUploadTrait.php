<?php

namespace App\Http\Traits;

trait ImageUploadTrait
{
    public function uploadImage($file, $pathName)
    {
        $imageName = time() . '_' . rand(111, 999) . '.' . $file->getClientOriginalExtension();
        $path =  'uploads/' . $pathName . '/';
        $ext = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();
        $file->move(public_path($path), $imageName);
        $origionalName = $file->getClientOriginalName();
        return asset($path) . '/' . $imageName;
    }

}
