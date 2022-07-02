@extends('layouts.app')
@section('content')

    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">{{ auth()->user()->full_name }} Profile</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customer.profile') }}">Profile</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">

        <div class="row">
            <div class="col-lg-8">
                <h2 class="h5 text-uppercase mb-4">General Information</h2>

                INDEX
            </div>


            <!-- SIDEBAR -->
            <div class="col-lg-4">
                <div class="card border-0 rounded-0 p-lg-4 bg-light">
                    <div class="card-body">
                        <h5 class="text-uppercase mb-4">Navigation</h5>
                        <div
                            class="py-2 px-4 mb-3 {{ Route::currentRouteName() == 'customer.dashboard' ? 'bg-dark text-white' : 'bg-light' }}">
                            <a href="{{ route('customer.dashboard') }}">
                                <strong class="small text-uppercase font-weight-bold">Dashboard</strong>
                            </a>
                        </div>
                        <div
                            class="py-2 px-4 mb-3 {{ Route::currentRouteName() == 'customer.profile' ? 'bg-dark text-white' : 'bg-light' }}">
                            <a href="{{ route('customer.profile') }}">
                                <strong class="small text-uppercase font-weight-bold">Profile</strong>
                            </a>
                        </div>
                        <div
                            class="py-2 px-4 mb-3 {{ Route::currentRouteName() == 'customer.addresses' ? 'bg-dark text-white' : 'bg-light' }}">
                            <a href="{{ route('customer.addresses') }}">
                                <strong class="small text-uppercase font-weight-bold">Addresses</strong>
                            </a>
                        </div>


                            <div
                                class="py-2 px-4 mb-3 {{ Route::currentRouteName() == 'customer.orders' ? 'bg-dark text-white' : 'bg-light' }}">
                                <a href="{{ route('customer.orders') }}">
                                    <strong class="small text-uppercase font-weight-bold">Orders</strong>
                                </a>
                            </div>



                        <div class="py-2 px-4 mb-3 bg-light">
                            <a href="javascript:void(0);"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <strong class="small text-uppercase font-weight-bold">Logout</strong>
                            </a>
                            <form action="{{ route('logout') }}" method="post" id="logout-form" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </section>

@endsection
