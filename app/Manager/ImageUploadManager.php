<?php

namespace App\Manager;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUploadManager {
    final public static function uploadImage ($name, $width, $height, $path, $file)
    {
        $manager = new ImageManager(new Driver());
        // ইমেজ তৈরি করুন
        $image_file_name = $name . '.webp';
        $img = $manager->read($file);
        $img = $img->resize($width, $height);
        $img->toWebp()->save(public_path($path) . $image_file_name);
        return $image_file_name;
    }

    final public static function deletePhoto ($path, $img):void
    {
        $path = public_path($path).$img;
        if ($img != '' && file_exists($path)) {
            unlink($path);
        }
    }
}
