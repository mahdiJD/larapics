<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

class ShowImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Image $image ,Request $request)
    {
        $relatedImages = $image->relatedImages();
        $disableComment = $image->user->setting->disable_comments;
        $comments = $disableComment ? [] : $image->comments()->with('user')->approved()->latest()->get();
        return view('image-show',
            compact('image','comments','disableComment','relatedImages'));
    }
}
