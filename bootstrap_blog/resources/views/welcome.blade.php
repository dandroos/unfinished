@extends('layouts/app')

@section('content')
    <div class="jumbotron text-center">
        <h1 class="display-2">Welcome!</h1>
        <p class="lead">
            Hello and welcome to Bardino Web Development (BWD for short)!  Here you will find articles about web development and details about hiring me for your next project.
        </p>
    
        <h2>Where to begin?</h2>
        <a href="{{ route('get_articles') }}" class="btn btn-lg btn-primary">Take me to articles</a>
        <a href="{{ route('get_hiring') }}" class="btn btn-lg btn-primary">I'd like to hire you</a>
    </div>


@endsection