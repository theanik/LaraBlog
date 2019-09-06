@extends('layouts.backend.app')

@section('title','Update Tag')

@section('content')
<div class="container-fluid">
    
    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                       Update Tag
                    </h2>
                    {{-- <ul class="header-dropdown m-r--5">
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
                    </ul> --}}
                </div>
                <div class="body">
                <form action="{{ route('admin.tag.update',$tag->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <label for="email_address">Tag Name</label>
                        <div class="form-group">
                            <div class="form-line">
                            <input type="text" value="{{ $tag->name }}" name="tag_name" id="tag" class="form-control" placeholder="Tag Name">
                            </div>
                        </div>
                       
                        <br>
                    <a href="{{ route('admin.tag.index') }}" class="btn btn-primary m-t-15 waves-effect"><- Back</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
    
@endsection