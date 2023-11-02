@extends('layouts.admin')

@section('title', 'Gallery')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Gallery</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">LaraVel Gallery</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mb-4">
                <div class="col-8">
                    <h2 class="section-title">List Gallery Travel Packages</h2>
                    <p class="section-lead">
                        Here is our list of gallery travel packages.
                    </p>
                </div>
                <div class="col-4">
                    <a href="{{ route('gallery.create') }}" class="btn btn-primary float-right mt-5">Add New
                        Image</a>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="">
                                    <th class="text-center align-middle">
                                        No
                                    </th>
                                    <th class="align-middle">Travel Packages</th>
                                    <th class="align-middle">Image</th>
                                    <th class="align-middle">Last Update</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($galleries as $img)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $img->travel_package->title }}</td>
                                        <td>
                                            <img src="{{ Storage::url($img->image) }}"
                                                alt="Image {{ $img->travel_package->title . $loop->iteration }}"
                                                class="img-thumbnail" width="100">
                                        </td>
                                        <td>{{ $img->updated_at }}</td>
                                        <td><a href="{{ route('gallery.edit', $img->id) }}" class="btn btn-success"><i
                                                    class="fas fa-info-circle"></i></a>
                                            <form action="{{ route('gallery.destroy', $img->id) }}" method="post"
                                                class="d-inline ml-2" id="delete-gallery">@csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No Data Available</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('addon-style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/admin/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endpush

@push('addon-script')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/admin/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('assets/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/admin/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/admin/modules/sweetalert/sweetalert.min.js') }}"></script>



    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/admin/js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('assets/admin/js/page/modules-sweetalert.js') }}"></script>

    <script>
        document.querySelector('#delete-gallery').addEventListener('submit', function(e) {
            var form = this;

            e.preventDefault(); // <--- prevent form from submitting

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this data!",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    swal({
                        title: 'Done!',
                        text: 'Your data has been deleted!',
                        icon: 'success'
                    }).then(function() {
                        form.submit(); // <--- submit form programmatically
                    });
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            })
        });
    </script>
@endpush
