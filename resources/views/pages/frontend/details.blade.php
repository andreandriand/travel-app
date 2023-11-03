@extends('layouts.frontend')

@section('title', 'Details')

@section('content')
    <div class="container">
        <nav class="row navbar navbar-expand-lg navbar-light bg-white">
            <a class="navbar-brand" href="/">
                <img src="assets/frontend/images/logo.png" alt="" />
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav ml-auto mr-3">
                    <li class="nav-item mx-md-2">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a class="nav-link" href="#">Travel Package</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Services
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Link 1</a>
                            <a class="dropdown-item" href="#">Link 2</a>
                            <a class="dropdown-item" href="#">Link 3</a>
                        </div>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a class="nav-link" href="#">Testimonial</a>
                    </li>

                    @auth
                        <li class="nav-item dropdown ml-lg-5">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                Hi, {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu">
                                @if (Auth::user()->email_verified_at == null)
                                    <form action="{{ route('verification.send') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Verify Email</button>
                                    </form>
                                @endif
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt mt-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>

                @guest
                    <!-- Mobile button -->
                    <div class="form-inline d-sm-block d-md-none">
                        <a href="{{ route('login') }}" class="btn btn-login my-2 my-sm-0">
                            Login
                        </a>
                    </div>
                    <!-- Desktop Button -->
                    <div class="d-none d-md-block">
                        <a href="{{ route('login') }}" class="btn btn-login my-2 my-sm-0 px-4">
                            Login
                        </a>
                    </div>
                @endguest
            </div>
        </nav>
    </div>
    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0 pl-3 pl-lg-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">
                                    Paket Travel
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Details
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 pl-lg-0">
                        <div class="card card-details">
                            <h1>{{ $package->title }}</h1>
                            <p>
                                {{ $package->location }}
                            </p>
                            <div class="gallery">
                                <div class="xzoom-container">
                                    <img class="xzoom" id="xzoom-default"
                                        src="{{ Storage::url($package->galleries->first()->image) }}"
                                        xoriginal="{{ Storage::url($package->galleries->first()->image) }}" />
                                    <div class="xzoom-thumbs">
                                        @foreach ($package->galleries as $img)
                                            <a href="{{ Storage::url($img->image) }}"><img class="xzoom-gallery"
                                                    width="128" src="{{ Storage::url($img->image) }}"
                                                    xpreview="{{ Storage::url($img->image) }}" /></a>
                                        @endforeach
                                    </div>
                                </div>
                                <h2>Tentang Wisata</h2>
                                <p>
                                    {{ $package->about }}
                                </p>
                                <div class="features row pt-3">
                                    <div class="col-md-4">
                                        <img src="{{ asset('assets/frontend/images/ic_event.png') }}" alt=""
                                            class="features-image" />
                                        <div class="description">
                                            <h3>Featured Ticket</h3>
                                            <p>{{ $package->featured_event }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 border-left">
                                        <img src="{{ asset('assets/frontend/images/ic_bahasa.png') }}" alt=""
                                            class="features-image" />
                                        <div class="description">
                                            <h3>Language</h3>
                                            <p>Bahasa Indonesia</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 border-left">
                                        <img src="{{ asset('assets/frontend/images/ic_foods.png') }}" alt=""
                                            class="features-image" />
                                        <div class="description">
                                            <h3>Foods</h3>
                                            <p>{{ $package->foods }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-details card-right">
                            <h2>Members are going</h2>
                            <div class="members my-2">
                                <img src="{{ asset('assets/frontend/images/members.png') }}" alt=""
                                    class="w-75" />
                            </div>
                            <hr />
                            <h2>Trip Informations</h2>
                            <table class="trip-informations">
                                <tr>
                                    <th width="50%">Date of Departure</th>
                                    <td width="50%" class="text-right">
                                        {{ date_format(date_create($package->depature_date), 'd F Y') }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Duration</th>
                                    <td width="50%" class="text-right">{{ $package->duration }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Type</th>
                                    <td width="50%" class="text-right">{{ $package->type }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Price</th>
                                    <td width="50%" class="text-right">
                                        {{ number_format($package->price, 0, ',', '.') }} / pax</td>
                                </tr>
                            </table>
                        </div>
                        @auth
                            <div class="join-container">
                                <form action="{{ route('checkout.process', $package->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-block btn-join-now mt-3 py-2">Join Now</button>
                                </form>
                            </div>
                        @endauth

                        @guest
                            <div class="join-container">
                                <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">Login or
                                    Register to Join</a>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/libraries/xzoom/dist/xzoom.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/libraries/gijgo/css/gijgo.min.css') }}" />
@endpush

@push('addon-script')
    <script src="{{ asset('assets/frontend/libraries/xzoom/dist/xzoom.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.xzoom, .xzoom-gallery').xzoom({
                zoomWidth: 500,
                title: false,
                tint: '#333',
                xoffset: 15
            });

            $('.datepicker').datepicker({
                uiLibrary: 'bootstrap4',
                icons: {
                    rightIcon: '<img src="{{ asset('assets/frontend/images/ic_doe.png') }}" />'
                }
            });
        });
    </script>
@endpush
