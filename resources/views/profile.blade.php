@extends('layouts.frontend.app')
@section('title'){{ $author->username }}
@endsection
@push('css')
<link href="{{ asset('assets/frontend/css/profile/styles.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/profile/responsive.css')}}" rel="stylesheet">
    
@endpush
@section('content')

<section class="blog-area section">
    <div class="container">
        <div class="display-table center-text">
             <h2 class="title display-table-cell text-info"> {{ $author->name }}</h2>
        </div><!-- slider -->
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="row">
        @if ($posts->count() > 0)
            @foreach ($posts as $post)
            <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
    
                        <div class="blog-image"><img src=" {{ url('storage/post/'.$post->image) }}" alt="Blog Image"></div>
    
                            <a class="avatar" href="#">
                                @if ($post->user->image == "default.png")
                                    <img src="/img/default.png" width="48" height="48" alt="User" />
                                @else 
                                     <img src="{{ url('storage/profileImg/'.$post->user->image) }}" alt="Profile Image">
                                @endif
                            </a>
    
                            <div class="blog-info">
    
                            <h4 class="title"><a href="{{ route('post.details',$post->slug) }}"><b> {{ $post->title }}</b></a></h4>
    
                                <ul class="post-footer">
                                    <li>
                                    @guest
                                        <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                            closeButton: true,
                                            progressBar: true,
                                        })"><i class="ion-heart"></i>{{ $post->favorite_to_user->count() }}</a>
                                    @else
                                        <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                                        class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count() == 0 ? 'text-primary' : '' }}"><i class="ion-heart"></i>{{ $post->favorite_to_user->count() }}</a>

                                        <form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favorite',$post->id) }}" style="display: none;">
                                            @csrf
                                        </form>
                                    @endguest
                                    </li>
                                    {{-- <li><a href="{{ route(post.favorite)}}"><i class="ion-heart"></i>57</a></li> --}}
                                    <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments()->count() }}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                </ul>
    
                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
                @endforeach
            @else
                <div class="col-lg-12 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-1 p-2">
                        <strong>No Post Found :(</strong>
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
            @endif

            </div><!-- row -->
            {{-- {{ $posts->links() }} --}}

            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12 ">

                <div class="single-post info-area ">

                    <div class="about-area">
                        <h4 class="title"><b>ABOUT {{$author->name }}</b></h4>
                        <p><strong>Name : </strong>{{ $author->name }}</p>
                        <p><strong>Email : </strong>{{ $author->email }}</p>
                        <p><strong>Created at : </strong>{{ $author->created_at ? $author->created_at->diffForHumans() : "" }}</p>
                        <p><strong>About :</strong>{{ $author->apout ? $author->apout : "Nouthing to show :(" }}</p>
                        <strong>Total Post : {{ $author->posts()->count() }}</strong>
                       
                    </div>

                    

                    

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->


        
        {{-- <a class="load-more-btn" href="#"><b>LOAD MORE</b></a> --}}

    </div><!-- container -->
</section><!-- section -->

@push('js')

	
@endpush
@endsection