<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Image $image, Request $request)
    {
        $image->increment('downloads_count');
        return Storage::download($image->file);
    }
}
