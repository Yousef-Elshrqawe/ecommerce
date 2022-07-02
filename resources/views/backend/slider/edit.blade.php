@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Slider</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.slider.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Sliders</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

{{--                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">--}}
{{--                        <div class="carousel-inner">--}}
{{--                            <div class="carousel-item active">--}}
{{--                                <img src="{{asset('assets/slider/' . $slider->cover)}}" class="d-block w-100" alt="{{ $slider->offer }}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Inspiration</label>
                            <input type="text" name="Inspiration" value="{{ old('Inspiration' , $slider->Inspiration ) }}" class="form-control">
                            @error('Inspiration')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="quantity">Offer</label>
                            <input type="text" name="offer" value="{{ old('offer' , $slider->offer ) }}" class="form-control">
                            @error('offer')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="price">Link</label>
                            <input type="text" name="link" value="{{ old('link'  , $slider->link ) }}" class="form-control" placeholder="/product/iure-velit-quis = مثل   ">
                            @error('link')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="Covers"> Image</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="Covers" id="slider-image" class="file-input-overview" >
                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                            @error('Covers')<span class="text-danger">{{ $message }}</span>@enderror
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

@section('js')
    <script>
        $(function(){
            $("#slider-image").fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: false,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if($slider->Covers != '')
                        "{{ asset('assets/slider/' . $slider->Covers) }}",
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                        @if($slider->Covers != '')
                    {
                        caption: "{{ $slider->Covers }}",
                        size: '1111',
                        width: "120px",
                        key: {{ $slider->id }}
                    }
                    @endif
                ]
            });
        });
    </script>
@endsection
