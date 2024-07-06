@if ($relatedImages->count())
    <h3 class="mt-5">Related Photos</h3>
        <div class="row mt-3">
        @foreach ( $relatedImages as $relatedImage )
            <div class="col">
                <a href="{{$relatedImage->thePermalink()}}"><img src="{{ $relatedImage->fileUrl() }}" class="img-fluid" /></a>
            </div>
        @endforeach
        </div>
@else
    <h3 class="mt-5">Ther isn't Related Photo for this post</h3>
@endif

