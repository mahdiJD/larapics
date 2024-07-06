<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ShowAuthorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request , User $user) :View
    {
        $user->load('images');
        $images = $user->images()->paginate(10);
        return view('author-show', compact('user','images'));
    }
}
