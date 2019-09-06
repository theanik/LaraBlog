@extends('layouts.backend.app')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        TABS WITH ICON TITLE
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#profile_with_icon_title" data-toggle="tab">
                                <i class="material-icons">face</i> UPDATE PROFILE
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#password_with_icon_title" data-toggle="tab">
                                <i class="material-icons">face</i> PASSWORD
                            </a>
                        </li>
                        
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                     
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                                UPDATE  PROFILE
                                            </h2>
                                        </div>
                                        <div class="body">
                                        <form class="form-horizontal" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="email_address_2">Name</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="email_address_2" class="form-control" 
                                                            value="{{ Auth::user()->name }}" name="name" placeholder="Enter your Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="email_address_2">Email Address</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="email_address_2" class="form-control" 
                                                            name="email" value="{{ Auth::user()->email }}" placeholder="Enter your email address">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                            <label for="email_address_2">Image</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="file" id="email_address_2" 
                                                                    class="form-control" name="image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <div class="row clearfix">
                                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                <label for="email_address_2">About</label>
                                                            </div>
                                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                                    <div class="form-group">
                                                                        <div class="form-line">
                                                                        <textarea rows="4" class="form-control no-resize" name="about" placeholder="Please type about you...">

                                                                            {{ Auth::user()->apout}}

                                                                        </textarea>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="password_with_icon_title">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.password.update') }}">
                                    @csrf
                                    @method('PUT')
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">OLD PASSWORD</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="email_address_2" class="form-control" 
                                        name="old_password"  placeholder="Enter your old password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="password">NEW PASSWORD</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="passeord" class="form-control" 
                                        name="password" placeholder="Enter your password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="confirm_password">CONFIRM PASSWORD</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="confirm_password" class="form-control" 
                                        name="confirm_password"  placeholder="confirm password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Session::has('c_passErr'))
                            <div class="alert alert-danger" role="alert">
                                {{Session::get('c_passErr')}}
                            </div>
                            @endif
                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                </div>
                            </div>

                        </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection