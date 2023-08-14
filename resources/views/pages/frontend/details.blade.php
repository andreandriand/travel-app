@extends('layouts.frontend.main')

@section('title', 'Details')

@section('content')
    <div class="container">
        <nav class="row navbar navbar-expand-lg navbar-light bg-white">
            <a class="navbar-brand" href="index.html">
                <img src="assets/frontend/images/logo.png" alt="" />
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav ml-auto mr-3">
                    <li class="nav-item mx-md-2">
                        <a class="nav-link active" href="index.html">Home</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a class="nav-link" href="#">Paket Travel</a>
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
                </ul>

                <!-- Mobile button -->
                <form class="form-inline d-sm-block d-md-none">
                    <button class="btn btn-login my-2 my-sm-0">
                        Masuk
                    </button>
                </form>
                <!-- Desktop Button -->
                <form class="form-inline my-2 my-lg-0 d-none d-md-block">
                    <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">
                        Masuk
                    </button>
                </form>
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
                            <h1>Nusa Peninda</h1>
                            <p>
                                Republic of Indonesia Raya
                            </p>
                            <div class="gallery">
                                <div class="xzoom-container">
                                    <img class="xzoom" id="xzoom-default" src="assets/frontend/images/details-1.jpg"
                                        xoriginal="assets/frontend/images/details-1.jpg" />
                                    <div class="xzoom-thumbs">
                                        <a href="assets/frontend/images/details-1.jpg"><img class="xzoom-gallery"
                                                width="128" src="assets/frontend/images/details-1.jpg"
                                                xpreview="assets/frontend/images/details-1.jpg" /></a>
                                        <a href="assets/frontend/images/details-1.jpg"><img class="xzoom-gallery"
                                                width="128" src="assets/frontend/images/details-1.jpg"
                                                xpreview="assets/frontend/images/details-1.jpg" /></a>
                                        <a href="assets/frontend/images/details-1.jpg"><img class="xzoom-gallery"
                                                width="128" src="assets/frontend/images/details-1.jpg"
                                                xpreview="assets/frontend/images/details-1.jpg" /></a>
                                        <a href="assets/frontend/images/details-1.jpg"><img class="xzoom-gallery"
                                                width="128" src="assets/frontend/images/details-1.jpg"
                                                xpreview="assets/frontend/images/details-1.jpg" /></a>
                                        <a href="assets/frontend/images/details-1.jpg"><img class="xzoom-gallery"
                                                width="128" src="assets/frontend/images/details-1.jpg"
                                                xpreview="assets/frontend/images/details-1.jpg" /></a>
                                    </div>
                                </div>
                                <h2>Tentang Wisata</h2>
                                <p>
                                    Nusa Penida is an island southeast of Indonesia’s island
                                    Bali and a district of Klungkung Regency that includes the
                                    neighbouring small island of Nusa Lembongan. The Badung
                                    Strait separates the island and Bali. The interior of Nusa
                                    Penida is hilly with a maximum altitude of 524 metres. It is
                                    drier than the nearby island of Bali.
                                </p>
                                <p>
                                    Bali and a district of Klungkung Regency that includes the
                                    neighbouring small island of Nusa Lembongan. The Badung
                                    Strait separates the island and Bali.
                                </p>
                                <div class="features row pt-3">
                                    <div class="col-md-4">
                                        <img src="assets/frontend/images/ic_event.png" alt=""
                                            class="features-image" />
                                        <div class="description">
                                            <h3>Featured Ticket</h3>
                                            <p>Tari Kecak</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 border-left">
                                        <img src="assets/frontend/images/ic_bahasa.png" alt=""
                                            class="features-image" />
                                        <div class="description">
                                            <h3>Language</h3>
                                            <p>Bahasa Indonesia</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 border-left">
                                        <img src="assets/frontend/images/ic_foods.png" alt=""
                                            class="features-image" />
                                        <div class="description">
                                            <h3>Foods</h3>
                                            <p>Local Foods</p>
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
                                <img src="assets/frontend/images/members.png" alt="" class="w-75" />
                            </div>
                            <hr />
                            <h2>Trip Informations</h2>
                            <table class="trip-informations">
                                <tr>
                                    <th width="50%">Date of Departure</th>
                                    <td width="50%" class="text-right">22 Aug, 2019</td>
                                </tr>
                                <tr>
                                    <th width="50%">Duration</th>
                                    <td width="50%" class="text-right">4D 3N</td>
                                </tr>
                                <tr>
                                    <th width="50%">Type</th>
                                    <td width="50%" class="text-right">Open Trip</td>
                                </tr>
                                <tr>
                                    <th width="50%">Price</th>
                                    <td width="50%" class="text-right">$80,00 / person</td>
                                </tr>
                            </table>
                        </div>
                        <div class="join-container">
                            <a href="/co" class="btn btn-block btn-join-now mt-3 py-2">Join Now</a>
                        </div>
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
