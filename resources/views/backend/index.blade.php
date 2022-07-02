@extends('layouts.admin')
@section('content')




                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard : {{ config('app.name') }}</h1>
                    </div>

                    <livewire:backend.dashboard.statics-component/>

                    <!-- Content Row -->

                    <livewire:backend.dashboard.chart-component/>
@endsection


