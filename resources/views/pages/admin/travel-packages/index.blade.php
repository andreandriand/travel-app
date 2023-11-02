@extends('layouts.admin')

@section('title', 'Travel Packages')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Travel Packages</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">LaraVel</div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('travel-package.create') }}" class="btn btn-primary float-right">Add New Package</a>
            <h2 class="section-title">List Travel Packages</h2>
            <p class="section-lead">
                Here is our list of travel packages.
            </p>


            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="">
                                    <th class="text-center align-middle">
                                        No
                                    </th>
                                    <th class="align-middle">Title</th>
                                    <th class="align-middle">Location</th>
                                    <th class="align-middle">Depature Date</th>
                                    <th class="align-middle">Type</th>
                                    <th class="align-middle">Price</th>
                                    <th class="align-middle">Date Created</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($packages as $pack)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $pack->title }}</td>
                                        <td>{{ $pack->location }}</td>
                                        <td>{{ date_format(date_create($pack->depature_date), 'd F Y') }}</td>
                                        <td>{{ $pack->type }}</td>
                                        <td>{{ 'Rp ' . number_format($pack->price, 0, ',', '.') ?? '' }}</td>
                                        <td>{{ $pack->created_at }}</td>
                                        <td><a href="{{ route('travel-package.edit', $pack->id) }}"
                                                class="btn btn-success"><i class="fas fa-info-circle"></i></a>
                                            <form action="{{ route('travel-package.destroy', $pack->id) }}" method="post"
                                                class="d-inline ml-2" id="delete-travel-package">@csrf
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
        document.querySelector('#delete-travel-package').addEventListener('submit', function(e) {
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
