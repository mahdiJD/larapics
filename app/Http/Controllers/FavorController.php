<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class FavorController extends Controller
{
    public function __construct(protected $perPaige = 15)
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $userId = auth()->id();
        $images = Image::whereHas('favorites', function ($query) use ($userId){
                $query->where('user_id',$userId);
            })->latest()
            ->paginate($this->perPaige)
            ->withQueryString();
        return view('image.index', compact('images'));
    }
    public function update(Image $image, Request $request)
    {
        if ($image->hasBeenFavorites())
            $message = "You have successfully removed the image from favorites!";
        else
            $message = "You have successfully added the image to favorites!";

        auth()->user()->favorites()->toggle($image->id);
        return back()->with('message', $message);
    }
}
