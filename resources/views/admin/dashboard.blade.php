{{-- admin --}}
@extends('layouts.backend.app')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">reorder</i>
                </div>
                <div class="content">
                    <div class="text">MY TOTAL POST</div>
                <div class="number count-to" data-from="0" data-to="{{ $current_admin->posts()->count() }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">remove_red_eye</i>
                    </div>
                    <div class="content">
                        <div class="text">MY POST VIEW</div>
                    <div class="number count-to" data-from="0" data-to="{{ $current_admin_total_view }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">donut_large</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL PENDING POST</div>
                    <div class="number count-to" data-from="0" data-to="{{ $total_pending }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">reorder</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL POST</div>
                <div class="number count-to" data-from="0" data-to="{{ $total_post }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">loyalty</i>
                </div>
                <div class="content">
                    <div class="text">Total TAG</div>
                    <div class="number count-to" data-from="0" data-to="{{ $total_tag }}" data-speed="100" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">category</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL CATEGORY</div>
                    <div class="number count-to" data-from="0" data-to="{{ $total_category }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">whatshot</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL SUBSCRIBER</div>
                    <div class="number count-to" data-from="0" data-to="{{$total_subscriber}}" data-speed="100" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">NEW AUTHOR</div>
                    <div class="number count-to" data-from="0" data-to="{{$new_author}}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->
   

    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>HOT POST</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Rank List</th>
                                    <th>Title</th>
                                    <th>Fevorite</th>
                                    <th>View Count</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($posts as $key=>$post)
                                    <tr>
                                        <td>{{ $key + 1}}</td>
                                        <td>{{ str_limit($post->title) }}</td>
                                        <td><span class="label bg-orange">{{ $post->favorite_to_user_count }}</span></td>
                                        <td><span class="label bg-green">{{ $post->view_count }}</span></td>
                                        <td><span class="label bg-red">{{ $post->comments_count }}</span></td>
                                        <td><a href="{{ route('post.details',$post->slug) }}" class="btn btn-info sm">view</a></td>
                                    </tr>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>HOT AUTHORS</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>Rank List</th>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Post Count</th>
                                        <th>Comment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($active_user as $key=>$user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->posts_count }}</td>
                                            <td>{{ $user->comments_count }}</td>
                                            <td><a href="{{ route('author.profile',$user->username) }}" class="btn btn-info sm">view</a></td>
                                        </tr>
                                    @endforeach
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>MY HOT POST</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                        <thead>
                                                <tr>
                                                    <th>Rank List</th>
                                                    <th>Title</th>
                                                    <th>Fevorite</th>
                                                    <th>View Count</th>
                                                    <th>Comment</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($current_admin_populer as $key=>$post)
                                                    <tr>
                                                        <td>{{ $key + 1}}</td>
                                                        <td>{{ str_limit($post->title) }}</td>
                                                        <td><span class="label bg-orange">{{ $post->favorite_to_user_count }}</span></td>
                                                        <td><span class="label bg-green">{{ $post->view_count }}</span></td>
                                                        <td><span class="label bg-red">{{ $post->comments_count }}</span></td>
                                                        <td><a href="{{ route('post.details',$post->slug) }}" class="btn btn-info sm">view</a></td>
                                                    
                                                    </tr>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- #END# Task Info -->
      
    </div>
</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as <strong>{{Auth::user()->name}}</strong>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@push('js')
<script src="{{asset('assets/backend/js/pages/index.js')}}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-countto/jquery.countTo.js')}}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{asset('assets/backend/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/morrisjs/morris.js')}}"></script>

    <!-- ChartJs -->
    <script src="{{asset('assets/backend/plugins/chartjs/Chart.bundle.js')}}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.time.js')}}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>
    
    {{-- <script src="{{asset('assets/backend/js/pages/index.js')}}"></script> --}}
@endpush