<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __construct(protected $perPage = 15){

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image:://published()->
        latest()->paginate($this->perPage);
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
        Image::create($request->getData());
        return to_route('images.index')->with('message','Image has been uploaded Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        return view('image.show',compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        return view('image.edit',compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImageRequest $request, Image $image)
    {
        $image->update($request->getData());
        return to_route('images.index')->with('message','Image has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
