<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    public static function makeDirectory($subFolder){
        $subFolder = 'images/' . date('y/m/d');
        Storage::makeDirectory($subFolder);
        return $subFolder;
    }
    public static function getDimension($image){
        [$width,$height] = getimagesize(Storage::path($image));
        return $width."x".$height;
    }
}
