<?php

namespace App\Helpers;

class Helper
{
    public static function uploadImage($image, $folder)
    {
        return $image->store("images/" . $folder);
    }
}
