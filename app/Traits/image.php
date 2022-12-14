<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait  image
{
    function saveImage($image, $path, $imageModel,$obj)
    {
        $file_name = str::random(10) . '_' . time() . str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->move($path, $file_name);
        $imageModel->name = $file_name;
        $imageModel->url = $path . '/' . $file_name;
        $obj->images()->save($imageModel);
    }
}
