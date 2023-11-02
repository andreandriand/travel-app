@extends('layouts.admin')

@section('title', 'Edit Gallery')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Gallery</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('gallery.index') }}">Gallery</a></div>
                <div class="breadcrumb-item">Edit Gallery</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Gallery</h2>
            <p class="section-lead">
                Please fill this form below correctly to edit image on gallery.
            </p>

            <div class="container">
                <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            @csrf
                            <div class="form-group">
                                <label for="travel_package_id">Travel Package</label>
                                <select class="form-control selectric @if ($errors->has('travel_package_id')) is-invalid @endif"
                                    name="travel_package_id" id="travel_package_id" required>
                                    <option selected value="{{ $gallery->travel_package_id }}">
                                        {{ $gallery->travel_package->title }}
                                    </option>
                                    @forelse ($packages as $pack)
                                        @if ($pack->id != $gallery->travel_package_id)
                                            <option value="{{ $pack->id }}">{{ $pack->title }}</option>
                                        @endif
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
                                <img src="{{ Storage::url($gallery->image) }}"
                                    alt="Image {{ $gallery->travel_package->title }}" class="img-thumbnail" width="300">
                            </div>
                            <div class="form-group mb-5">
                                <label for="image">Change Image</label>
                                <p class="my-1">If you don't want to change the image, please leave this field empty.</p>
                                <input type="file"
                                    class="form-control @if ($errors->has('image')) is-invalid @endif" name="image"
                                    id="image" value="{{ old('image', $gallery->image) }}">
                                @if ($errors->has('image'))
                                    <div class="invalid-feedback">
                                        Invalid Image Input
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Edit Gallery</button>
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
