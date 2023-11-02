@extends('layouts.admin')

@section('title', 'Add Travel Package')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add New Package</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('travel-package.index') }}">Travel Packages</a></div>
                <div class="breadcrumb-item">Add New Package</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Add New Travel Package</h2>
            <p class="section-lead">
                Please fill this form below correctly to add new package.
            </p>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <form action="{{ route('travel-package.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" name="location" id="location" required>
                            </div>
                            <div class="form-group">
                                <label for="about">About</label>
                                <textarea name="about" class="form-control is-invalid" required>Hello, i'm handsome!</textarea>
                                <div class="invalid-feedback">
                                    Oh no! You entered an inappropriate word.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="featured_event">Featured Event</label>
                                <input type="text" class="form-control" name="featured_event" id="featured_event"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="language">Language</label>
                                <input type="text" class="form-control" name="language" id="language" required>
                            </div>
                            <div class="form-group">
                                <label for="foods">Foods</label>
                                <input type="text" class="form-control" name="foods" id="foods" required>
                            </div>
                            <div class="form-group">
                                <label for="depature_date">Departure Date</label>
                                <input type="date" class="form-control" name="depature_date" id="depature_date" required>
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration</label>
                                <input type="number" class="form-control" name="duration" id="duration" required>
                            </div>
                            <div class="form-group">
                                <label for="duration_type">Duration Type</label>
                                <input type="text" class="form-control" name="duration_type" id="duration_type" required>
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" name="type" id="type" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" name="price" id="price" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Package</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
