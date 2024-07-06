<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Http\Controllers\ImageController;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __construct(protected $perPage = 15){
        $this->middleware(['auth']);
        $this->authorizeResource(Image::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images =
            Image::visibleFor(request()->user())
            ->latest()
            ->paginate($this->perPage)
            -> WithQueryString();
        return view('image.index',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('image.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request)
    {
        $image = Image::create($data = $request->getData());
        $image->syncTags($data['tags']);
        return to_route('images.index')->with('message','Image has been uploaded Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        // return view('image.show',compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        if(!Gate::allows('update-image', $image)){
            return back()->with('message','Access Denied!');
            // abort(403,'Access Denied!');
        }
        return view('image.edit',compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImageRequest $request, Image $image)
    {
        $image->update($data = $request->getData());
        $image->syncTags($data['tags']);
        return to_route('images.index')->with('message','Image has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        // if(Gate::denies('delete-image', $image)){
        //     return back()->with('message','Access Denied!');
        //     // abort(403,'Access Denied!');
        // }

        // $this->authorize('delete-image', $image);
        Gate::authorize('delete', $image);
        $image->delete();
        return to_route('images.index')->with('message','Image has been deleted successfully!');
    }
}
