{{--<div class="alert alert-{{ $validType }}" {{$attributes}}>--}}
{{--    alert--}}
{{--</div>--}}

<div {{ $attributes
->class(['alert-dismissible fade show' => $dismissible ])
->merge([
    'class' => "alert alert-{$validType}" ,
    'role' => $attributes->prepends("action"),
    ])}}>
    @isset($title)
        <h1 class="alert-heading">{{$title}}</h1>
    @endisset
    <p class="mb-0">{{$message}}</p>
@if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
