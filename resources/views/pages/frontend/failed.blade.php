@extends('layouts.frontend')

@section('title', 'Success')

@section('content')

    <div class="container">
        <nav class="row navbar navbar-expand-lg navbar-light bg-white">
            <div class="navbar-nav ml-auto mr-auto mr-sm-auto mr-lg-0 mr-md-auto">
                <a class="navbar-brand" href="index.html">
                    <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="" />
                </a>
            </div>
            <ul class="navbar-nav mr-auto d-none d-lg-block">
                <li>
                    <span class="text-muted">| &nbsp; Beyond the explorer of the world</span>
                </li>
            </ul>
        </nav>
    </div>
    <main>
        <div class="section-success d-flex align-items-center">
            <div class="col text-center">
                <img src="{{ asset('assets/frontend/images/error.png') }}" alt="" width="250" class="mb-5" />
                <h1>OOPS!</h1>
                <p>
                    Your transaction is failed :( <br />
                    Please try again
                </p>
                <a href="/" class="btn btn-home-page mt-3 px-5">
                    Home Page
                </a>
            </div>
        </div>
    </main>

@endsection
