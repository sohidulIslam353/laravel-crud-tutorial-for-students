<?php

use Intervention\Image\ImageManager;




if (!function_exists('imageUpload')) {
    function imageUpload($file, $width = 100, $height = 100, $path = null)
    {
        if ($file) {
            $directory = public_path($path);
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // V3 Image Manager
            $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());

            $image = $manager->read($file)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $image->save($directory . '/' . $fileName);
            return url($path . '/' . $fileName);  // fullurl
        }
    }
}
