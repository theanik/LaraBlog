@extends('layouts.frontend.app')
@section('title','Something Good for you')
@push('css')
<link href="{{ asset('assets/frontend/css/single-post/styles.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/single-post/responsive.css')}}" rel="stylesheet">
    
@endpush
@section('content')

<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="{{ route('author.profile',$post->user->username) }}">
											@if ($post->user->image == "default.png")
											<img src="/img/default.png" width="48" height="48" alt="User" />
										@else 
											 <img src="{{ url('storage/profileImg/'.$post->user->image) }}" alt="Profile Image">
										@endif
									</a>
								</div>

								<div class="middle-area">
								<a class="name" href="#"><b>{{ $post->user->name }}</b></a>
									<h6 class="date">{{ $post->created_at->diffForHumans()}}</h6>
								</div>

							</div><!-- post-info -->

                        <h3 class="title"><a href="#"><b>{{ $post->title }}</b></a></h3>

							<p class="para"></p>

							<div class="post-image"><img src="{{ url('storage/post/'.$post->image) }}" alt="Blog Image"></div>

						<p class="para">{!! html_entity_decode($post->body) !!}</p>

							<ul class="tags">
									@foreach ($post->tags as $tag)
										<li><a href="#">{{ $tag->name }}</a></li>
									@endforeach
									@foreach ($post->categories as $cat)
                            			<li><a href="#">{{ $cat->name }}</a></li>
                                	@endforeach
							</ul>
						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
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
										<li><a href="#"><i class="ion-chatbubble"></i></a>4</li>
										<li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
							</ul>

							<ul class="icons">
								<li>SHARE : </li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
							</ul>
						</div>

						


					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title"><b>ABOUT PUBLISHER</b></h4>
                        <p>{{ $post->user->apout ? $post->user->apout : "Nouthong to show :(" }}</p>
						</div>

						

						<div class="tag-area">

							<h4 class="title"><b>TAG CLOUD</b></h4>
							<ul>
                                @foreach ($post->tags as $tag)
                            <li><a href="{{ route('tag.post',$tag->slag) }}">{{ $tag->name }}</a></li>
                                @endforeach
								
							</ul>

                        </div>
                        <div class="tag-area">

                            <h4 class="title"><b>CATEGORY CLOUD</b></h4>
                            <ul>
                                @foreach ($post->categories as $cat)
                            <li><a href="{{ route('category.post',$cat->slug) }}">{{ $cat->name }}</a></li>
                                @endforeach
                                
                            </ul>
    
                            </div>
                        <!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">

				@foreach ($randomPost as $post)
				<div class="col-lg-4 col-md-6">
						<div class="card h-100">
							<div class="single-post post-style-1">
		
							<div class="blog-image"><img src=" {{ url('storage/post/'.$post->image) }}" alt="Blog Image"></div>
		
								<a class="avatar" href="{{ route('author.profile',$post->user->username) }}">
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

			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			<h4><b>POST COMMENT</b></h4>
			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="comment-form">
						@guest
							<div class="alert alert-primary" role="alert">
								To comment you need to log in frist
							  </div>
							@else
							<form method="post" action="{{ route('comment.store',$post->id) }}">
								@csrf
							<div class="row">

								<div class="col-sm-6">
									<input readonly type="text" aria-required="true" name="contact-form-name" class="form-control"
								placeholder="Enter your name" value="{{ Auth::user()->name }}" aria-invalid="true" required >
								</div><!-- col-sm-6 -->
								<div class="col-sm-6">
									<input readonly type="email" aria-required="true" name="contact-form-email" class="form-control"
										placeholder="Enter your email" value="{{ Auth::user()->email }}" aria-invalid="true" required>
								</div><!-- col-sm-6 -->

								<div class="col-sm-12">
									<textarea required name="comment" rows="2" class="text-area-messge form-control"
										placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
								</div><!-- col-sm-12 -->
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
								</div><!-- col-sm-12 -->

							</div><!-- row -->
						</form>
						@endguest
						
					</div><!-- comment-form -->

					<h4><b>COMMENTS({{$post->comments->count()}})</b></h4>

					@foreach ($post->comments as $comment)
						<div class="commnets-area ">

							<div class="comment">

								<div class="post-info">

									<div class="left-area">
									<a class="avatar" href="#"><img src="{{  url('storage/profileImg/'.$comment->user->image) }}" alt="Profile Image"></a>
									</div>

									<div class="middle-area">
										<a class="name" href="#"><b>{{$comment->user->name}}</b></a>
										<h6 class="date">{{ $comment->created_at->diffForHumans()}}</h6>
									</div>

								</div><!-- post-info -->

							<p>{{ $comment->comment }}</p>

							</div>

						</div><!-- commnets-area -->
						@endforeach
					
			

				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>

@endsection
