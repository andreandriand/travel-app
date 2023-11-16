@extends('layouts.admin')

@section('title', 'Add Travel Package')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Package</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('travel-package.index') }}">Travel Packages</a></div>
                <div class="breadcrumb-item">Detail Package</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Package</h2>
            <p class="section-lead">
                You can edit information of the package by editing this form below.
            </p>

            <div class="container">
                <form action="{{ route('travel-package.update', $package->id) }}" method="POST">
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('title')) is-invalid @endif" name="title"
                                    id="title" value="{{ old('title', $package->title) }}" required>
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        Invalid Title Input
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration</label>
                                <input type="text"
                                    class="form-control
                                    @if ($errors->has('duration')) is-invalid @endif"
                                    name="duration" id="duration" value="{{ old('duration', $package->duration) }}"
                                    required>
                                @if ($errors->has('duration'))
                                    <div class="invalid-feedback">
                                        Invalid Duration Input
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="about">About</label>
                                <textarea name="about"
                                    class="form-control
                                    @if ($errors->has('about')) is-invalid @endif"
                                    id="about">{{ old('about', $package->about) }}</textarea>
                                <div class="invalid-feedback">
                                    Oh no! You entered an inappropriate word.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foods">Foods</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('foods')) is-invalid @endif" name="foods"
                                    id="foods" value="{{ old('foods', $package->foods) }}" required>
                                @if ($errors->has('foods'))
                                    <div class="invalid-feedback">
                                        Invalid Foods Input
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="language">Language</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('language')) is-invalid @endif" name="language"
                                    id="language" value="{{ old('language', $package->language) }}" required>
                                @if ($errors->has('language'))
                                    <div class="invalid-feedback">
                                        Invalid Language Input
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('location')) is-invalid @endif" name="location"
                                    id="location" value="{{ old('location', $package->location) }}" required>
                                @if ($errors->has('location'))
                                    <div class="invalid-feedback">
                                        Invalid Location Input
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="depature_date">Departure Date</label>
                                <input type="text"
                                    class="form-control datepicker @if ($errors->has('depature_date')) is-invalid @endif"
                                    name="depature_date" id="depature_date"
                                    value="{{ old('depature_date', $package->depature_date) }}" required>
                                @if ($errors->has('depature_date'))
                                    <div class="invalid-feedback">
                                        Invalid Departure Date Input
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="featured_event">Featured Event</label>
                                <textarea name="featured_event" class="form-control @if ($errors->has('featured_event')) is-invalid @endif"
                                    id="featured_event" required>{{ old('featured_event', $package->featured_event) }}</textarea>
                                @if ($errors->has('featured_event'))
                                    <div class="invalid-feedback">
                                        Invalid Featured Event Input
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('type')) is-invalid @endif" name="type"
                                    id="type" value="{{ old('type', $package->type) }}" required>
                                @if ($errors->has('type'))
                                    <div class="invalid-feedback">
                                        Invalid Type Input
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number"
                                    class="form-control @if ($errors->has('price')) is-invalid @endif" name="price"
                                    id="price" value="{{ old('price', $package->price) }}" required>
                                @if ($errors->has('price'))
                                    <div class="invalid-feedback">
                                        Invalid Price Input
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Edit Package</button>
                        <a href="{{ route('travel-package.index') }}" class="btn btn-danger ml-3">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('addon-script')
    <script src="{{ asset('assets/admin/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush
