@extends('layouts.admin')

@section('title', 'Add New Image')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add New Image</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('gallery.index') }}">Gallery</a></div>
                <div class="breadcrumb-item">Add New Image</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Add New Images</h2>
            <p class="section-lead">
                Please fill this form below correctly to add new image to gallery.
            </p>

            <div class="container">
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            @csrf
                            <div class="form-group">
                                <label for="travel_package_id">Choose Travel Package</label>
                                <select class="form-control selectric @if ($errors->has('travel_package_id')) is-invalid @endif"
                                    name="travel_package_id" id="travel_package_id" required>
                                    @forelse ($packages as $pack)
                                        <option value="{{ $pack->id }}">{{ $pack->title }}</option>
                                    @empty
                                        <option disabled>No Travel Package Found</option>
                                    @endforelse
                                </select>
                                @if ($errors->has('travel_package_id'))
                                    <div class="invalid-feedback">
                                        Invalid Travel Package Input
                                @endif
                            </div>
                            <div class="form-group mb-5">
                                <label for="image">Image</label>
                                <input type="file"
                                    class="form-control @if ($errors->has('image')) is-invalid @endif" name="image"
                                    id="image" value="{{ old('image') }}" required>
                                @if ($errors->has('image'))
                                    <div class="invalid-feedback">
                                        Invalid Image Input
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Add Gallery</button>
                            <a href="{{ route('gallery.index') }}" class="btn btn-danger ml-3">Back</a>
                        </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('assets/admin/modules/jquery-selectric/selectric.css') }}">
@endpush

@push('addon-script')
    <script src="{{ asset('assets/admin/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
@endpush
