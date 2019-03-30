@extends('layouts/app')
@section('content')
    <div>
        <h2 class="display-4 text-center">Edit article</h2>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('get_articles') }}">Back</a>
            </li>
        </ul>
        <form action="{{ route('post_articles_edit') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <div class="form-group">
                <label for="article-title">Title</label>
                <input value="{{ $article->article_title }}" type="text" class="form-control" id="article-title" name="article_title" aria-describedby="article-slug" placeholder="Enter title" value="Default">
                <small id="article-slug" class="form-text text-muted">Slug: {{ $article->article_slug }}</small>
            </div>
            <div class="form-group">
                <label for="article-body">Subject</label>
                <select type="text" class="form-control" id="article-title" name="article_subject" placeholder="Enter title">
                    <option value="0"
                    @if($article->article_subject == 0)
                     selected
                    @endif
                    >General</option>
                    <option value="1"
                    @if($article->article_subject == 1)
                     selected
                    @endif
                    >Front stack</option>
                    <option value="2"
                    @if($article->article_subject == 2)
                     selected
                    @endif
                    >Rear stack</option>
                    <option value="3"
                    @if($article->article_subject == 3)
                     selected
                    @endif
                    >Full stack</option>
                </select>
            </div>
            <div class="form-group">
            <img src="{{ asset($image->path) }}" class="img-fluid" alt="">
                <label for="article_image">Replace featured image</label>
                <input type="file" class="form-control-file" id="article-image" name="article_image">
            </div>
            <div class="form-group">
                <label for="article-body">Body</label>
                <textarea type="text" class="form-control" id="article-title" name="article_body" placeholder="Enter title">{{ $article->article_body }}</textarea>
            </div>
            <div class="clearfix">
                <button type="submit" class="btn btn-primary float-left">Update</button>
                <a href="#" class="btn btn-danger float-right">Delete</a>
            </div>
        </form>
    </div>
@endsection