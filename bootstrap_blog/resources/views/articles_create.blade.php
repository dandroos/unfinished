@extends('layouts/app')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
@endpush
@section('content')
    <div>
        <h2 class="display-4 text-center">Create new article</h2>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('get_articles') }}">Back</a>
            </li>
        </ul>
        {{-- <form action="{{ route('post_upload_image') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="mydropzone">
            @csrf
            <div class="fallback">
                <input type="file" class="form-control-file" id="article-image" name="article_image">
            </div>
        </form> --}}
        {{-- <div id="test"></div> --}}
        <form action="{{ route('post_articles_create') }}" method="post" enctype="multipart/form-data" id="myForm">
            @csrf
            <div class="form-group">
                <label for="article-title">Title</label>
                <input type="text" class="form-control" id="article-title" name="article_title" aria-describedby="article-slug" placeholder="Enter title">
                <small id="article-slug" class="form-text text-muted">Slug: </small>
            </div>
            <div class="form-group">
                <label for="article-body">Subject</label>
                <select type="text" class="form-control" id="article-subject" name="article_subject" placeholder="Enter title">
                    <option value="0">General</option>
                    <option value="1">Front stack</option>
                    <option value="2">Rear stack</option>
                    <option value="3">Full stack</option>
                </select>
            </div>
            <div class="dropzone" id="article-image-dz"></div>
                {{-- <div class="form-group">
                    <label for="article_image">Featured image</label>
                    <input type="file" class="form-control-file" id="article-image" name="file">
                </div> --}}
            <div class="form-group">
                <label for="article-body">Body</label>
    
                <textarea type="text" class="form-control" id="article-body" name="article_body" placeholder="Enter title"></textarea>
            </div>
            @if($errors->any())
                <div class="alert alert-danger" id="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="btn btn-primary" id="submit-all">Post</button>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

    <script>
        Dropzone.options.articleImageDz= {
        url: '{{ route('post_articles_create') }}',
        dictDefaultMessage: 'Drop your featured image here...',
        autoProcessQueue: false,
        uploadMultiple: true,
        maxFiles: 1,
        maxFilesize: 1,
        //acceptedFiles: 'image/*',
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function() {
            dzClosure = this; // Makes sure that 'this' is understood inside the functions below.
    
            // for Dropzone to process the queue (instead of default form behavior):
            document.getElementById("submit-all").addEventListener("click", function(e) {
                // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
                if(dzClosure.getQueuedFiles().length > 0){
                    dzClosure.processQueue();
                }else {                       
                    $("#myForm").submit();
                }                      
            });
    
            //send all the form data along with the files:
            this.on("sendingmultiple", function(data, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("article_title", jQuery("#article-title").val());
                formData.append("article_subject", jQuery("#article-subject").val());
                formData.append("article_body", jQuery("#article-body").val());
            });
        },
            success: function (response) {
                    alert("You will now be redirected.");
                    window.location.href = "{{ route('get_articles') }}";
        },
            error: function (response) {
                                    $("#myForm").submit();


            },
            failure: function(response){
                console.log(response);
            }
        }
    </script>
@endpush