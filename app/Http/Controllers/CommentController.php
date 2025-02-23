<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use App\Http\Requests\CreatCommentRequest;
use App\Models\Comment;
use App\Models\Image;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

// use Illuminate\Http\Request;

class CommentController extends Controller
{

    protected $perPaige = 6;

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() : View
    {
        $comments = Comment::forUser(auth()->user())->latest()->paginate($this->perPaige);
        return view('comments.index', compact('comments'));
    }

    public function update(Comment $comment, Request $request) : RedirectResponse
    {
        $comment->approved = $request->approve ;
        $comment->update();
        $message = 'Comment has been'.
         ($request->approve ? 'approved' : 'unapproved');
        return back()->with('message', $message );
    }

    public function destroy(Comment $comment) : RedirectResponse
    {
        $comment->delete();
        return back()->with('message', 'Comment has been removed' );
    }

    public function store(Image $image, CreatCommentRequest $request) : RedirectResponse
    {
        $image->comments()->create($request->getData());
        if ($image->user->setting->moderate_comments) {
            $message = "Your Comment is waiting for modderation. It will be visible after it has been approved!";
        }else{
            $message = "Your Comment has been successfully sent";
        }
        return back()->with('message', $message );
    }
}
