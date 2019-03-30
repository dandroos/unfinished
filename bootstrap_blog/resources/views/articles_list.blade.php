@extends('layouts/app')
@section('content')
    <ul class="nav justify-content-center">
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('get_articles_create') }}">Create a new article</a>
    </li>
    </ul>

    <div class="row">
        @foreach($articles as $article)
        @if($loop->index == 0)
            <div class="col-lg-12">
        @else
            <div class="col-lg-4">
        @endif
                <div class="card">
                        <a href="{{ route('get_article', [ 'slug' => $article->article_slug] )}}">
                           <img class="img-fluid" src="{{  asset($images->where('article_id', $article->id)->first()->path) }}">
                        </a>
                    <div class="card-body">
                        <h3 class="card-title">{{ $article->article_title }}</h3>
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
                        <p class="small">{{ $article->created_at->diffForHumans() }}</p>
                        <p class="card-text">{!! $article->snippet($article->article_body) !!}</p>
                        <div class="clearfix">
                            <a href="{{ route('get_article', [ 'slug' => $article->article_slug] )}}" class="float-right">Read more</a>
                            {{-- IF LOGGED IN --}}
                            <a href="{{ route('get_articles_edit', [ 'slug' => $article->article_slug] )}}" class="card-link text-secondary">Edit</a>
                            <a href="{{ route('get_articles_delete', [ 'id' => $article->id] )}}" class="card-link text-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection