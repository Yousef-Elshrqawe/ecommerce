@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Slider</h6>
            <div class="ml-auto">


            </div>
        </div>



        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Inspiration</th>
                    <th>Offer </th>
                    <th>Link</th>
                </tr>
                </thead>
                <tbody>
                @forelse($sliders as $slider )

                    <tr>
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{asset('assets/slider/' . $slider->Covers)}}" class="d-block w-100" alt="{{ $slider->offer }}">
                                </div>
                            </div>
                        </div>
                    </tr>
                    <tr>
                        <td>{{ $slider->Inspiration }}</td>
                        <td>{{ $slider->offer }}</td>
                        <td>{{ $slider->link }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">

                                <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                   class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No categories found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="9">

                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection
