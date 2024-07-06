<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function __invoke(Image $image, Request $request)
    {
        if ($image->hasBeenLiked()) {
            $image->decrement('likes_count');
            $message = "You have successfully un-liked the image!";
        }
        else{
            $image->increment('likes_count');
            $message = "You have successfully liked the image!";
        }
        auth()->user()->likes()->toggle($image->id);
        return back()->with('message', $message);
    }
}

