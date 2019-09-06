@extends('layouts.backend.app')

@section('title','Create Post')
@push('css')
 
<link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />   
@endpush
@section('content')
<div class="container-fluid">
    
    <!-- Vertical Layout -->

    <form action="{{ route('admin.post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
       
    <div class="row clearfix">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Edit Post
                    </h2>
                </div>
                <div class="body">
               
                        <label for="email_address">Post title</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="title" value="{{ $post->title }}" class="form-control" placeholder="Tag Name">
                            </div>
                        </div>

                        <label for="image">Image</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="file" name="image" id="tag" class="form-control" placeholder="Tag Name">
                            </div>
                        </div>
                        
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Category and Tag
                    </h2>
                    
                </div>
                <div class="body">
               
                        <label for="email_address">Category Name</label>
                        <div class="form-group">
                            <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                <select name="categories[]" id="category" class="form-control show-tick"
                                data-live-search="true" multiple>
                                    @foreach ($categories as $category)
                                        <option 
                                            @foreach ($post->categories as $postCat)
                                                {{$postCat->id == $category->id ? 'selected' : ''}}
                                            @endforeach
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                <select name="tags[]" id="tag" class="form-control show-tick"
                                data-live-search="true" multiple>
                                    @foreach ($tags as $tag)
                                        <option
                                            @foreach ($post->tags as $postTag)
                                                {{ $postTag->id == $tag->id ? 'selected' : ''}}
                                            @endforeach
                                        value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                       
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Body
                    </h2>
                    
                </div>
                <div class="body">
                
                <textarea id="tinymce" name="body">{{ $post->body }}</textarea>
                
                    <a href="{{ route('admin.post.index') }}" class="btn btn-primary m-t-15 waves-effect"><- Back</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">Submit</button>
                    
                </div>
            </div>
        </div>
    </div>
    </form>
    <div class="form-group">
            <form action="{{ route('admin.post.published',$post->id) }}" id="approve-form" 
                     method="POST">
                     @csrf
                    @method('PUT')
            @if ($post->status == true)
                <button class="btn btn-success" onclick="publisedPost({{$post->id}})">
                    <i class="material-icons">done</i> Published
                </button>
                @else
                <button class="btn btn-success " onclick="publisedPost({{$post->id}})">
                    <i class="material-icons"></i> Publishe ?
                </button>
                
                    
                
            @endif
            </form>
        </div>
</div>

@push('js')
<script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>

<script>
    $(function () {
        //TinyMCE
        tinymce.init({
            selector: "textarea#tinymce",
            theme: "modern",
            height: 300,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true
        });
        tinymce.suffix = ".min";
        tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
    });

    
</script>
<script>

    function publisedPost(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false,
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Approve it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
           event.preventDefault();
           document.getElementById('approve-form').submit();
        } else if (
            // Read more about handling dismissals
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelled',
            'post are not approve :)',
            'error'
            )
        }
        })
    }
   

</script>
@endpush
    
@endsection