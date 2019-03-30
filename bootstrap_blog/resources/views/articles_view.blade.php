@extends('layouts/app')
@section('content')
    <img src="{{ asset($image->path) }}" class="card-img-top" alt="...">
    <h2 class="display-4">{{ $article->article_title }}</h2>
    <h4 class="card-subtitle text-muted">
        @switch($article->article_subject)
            @case(0)
                General
                @break
            @case(1)
                Front stack
                @break
            @case(2)
                Rear stack
                @break
            @case(3)
                Full stack
                @break
            @default
                General
        @endswitch
    </h4>
    <p class="small">
        {{ $article->created_at->diffForHumans() }}
    </p>
    {!! nl2br($body) !!}
    
@endsection