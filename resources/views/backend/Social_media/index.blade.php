@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Social Media</h6>
            <div class="ml-auto">

                <a href="{{ route('admin.social_media.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new Products</span>
                </a>

            </div>
        </div>



        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Url</th>

                </tr>
                </thead>
                <tbody>
                @forelse($Social_media as $media )

                    <tr>
                        <td>{{ $media->name }}</td>
                        <td>{{ $media->url }}</td>

                        <td>
                            <div class="btn-group btn-group-sm">

                                <a href="{{ route('admin.social_media.edit', $media->id) }}"
                                   class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                            </div>

                            <a href="javascript:void(0);"
                               onclick="if (confirm('Are you sure to delete this record?')) { document.getElementById('delete-products-{{ $media->id }}').submit(); } else { return false; }"
                               class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>


        <form action="{{ route('admin.social_media.destroy', $media->id) }}" method="post"
              id="delete-products-{{ $media->id }}" class="d-none">
            @csrf
            @method('DELETE')
        </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No Social Media found</td>
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
