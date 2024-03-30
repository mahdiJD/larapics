<h1>Edit post</h1>
<h2>{{$image->title}}</h2>
<form action="{{$image->route('update')}}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <img src="{{$image->fileURL()}}" alt="{{$image->title}}" width="300">
    </div>
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{$image->title}}">
        @error('title')
        <div> {{$message}}</div>
        @enderror
    </div>
    <button type="submit">Update</button>
</form>
