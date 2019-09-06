@extends('layouts.backend.app')

@section('title','Update category')

@section('content')
<div class="container-fluid">
    
    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                       Update category
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
                <form action="{{ route('admin.category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="email_address">Category Name</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input value="{{ $category->name }}" type="text" name="name" id="tag" class="form-control" placeholder="Category Name">
                        </div>
                    </div>

                    <label for="image">Image</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="file" name="image" id="tag" class="form-control" placeholder="Image">
                        </div>
                    </div>
                       
                        <br>
                    <a href="{{ route('admin.category.index') }}" class="btn btn-primary m-t-15 waves-effect"><- Back</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
    
@endsection