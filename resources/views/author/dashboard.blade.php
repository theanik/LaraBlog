{{-- author --}}
@extends('layouts.backend.app')
@section('title','Author')
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
                        <div class="text">TOTAL POST</div>
                    <div class="number count-to" data-from="0" data-to="{{ $user->posts()->count() }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">restore</i>
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
                        <i class="material-icons">remove_red_eye</i>
                    </div>
                    <div class="content">
                        <div class="text">VIEW COUNT</div>
                    <div class="number count-to" data-from="0" data-to="{{ $all_viewCount }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
         
        </div>

    
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>TASK INFOS</h2>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($populer_posts as $key=>$post)
                                    <tr>
                                        <td>{{ $key + 1}}</td>
                                        <td>{{ str_limit($post->title) }}</td>
                                        <td><span class="label bg-orange">{{ $post->favorite_to_user_count }}</span></td>
                                        <td><span class="label bg-green">{{ $post->view_count }}</span></td>
                                        <td><span class="label bg-red">{{ $post->comments_count }}</span></td>
                                   
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
           
            <!-- #END# Browser Usage -->
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

@endpush
