@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create Social Media</h6>
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

            <form action="{{ route('admin.social_media.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Url</label>
                            <input type="text" name="url" value="{{ old('url') }}" class="form-control">
                            @error('url')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>


                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Social Media</button>
                </div>
            </form>
        </div>
    </div>

@endsection

