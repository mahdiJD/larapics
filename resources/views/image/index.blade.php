<h1>All images</h1>
<a href="{{route('images.create')}}">Upload Image</a>
@if($message = session('message'))
    <div>{{$message}}</div>
@endif
@foreach($images as $image )
    <div>
        <a href="{{$image->thePermalink()}}">
            <img src="{{$image->fileURL()}}" alt="{{$image->title}}" width="300">
        </a>
    </div>
    <div><a href="{{ $image->route('edit') }}">edit</a></div>
@endforeach
