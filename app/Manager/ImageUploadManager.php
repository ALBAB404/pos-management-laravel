<?php

namespace App\Manager;

class ImageUploadManager {
    public function uploadImage ($name, $width, $height, $path, $file)
    {
        $image_file_name = $name.'.webp';
        Image::make($file)->fit($width, $height)->save(public_path($path).$image_file_name, quality: 50, 'webp');
    }
}
