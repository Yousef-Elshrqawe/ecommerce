@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Social Media</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.social_media.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Social Media</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.social_media.update', $Social_media->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">



                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name' , $Social_media->name ) }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="quantity">Url</label>
                            <input type="text" name="url" value="{{ old('offer' , $Social_media->url ) }}" class="form-control">
                            @error('url')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                </div>


                <div class="row pt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


