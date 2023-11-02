@extends('layouts.admin')

@section('title', 'Transaction')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Transaction</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">LaraVel Transaction</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mb-4">
                <div class="col-8">
                    <h2 class="section-title">Report Transactions</h2>
                    <p class="section-lead">
                        Here is our report of all transactions
                    </p>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">
                                        No
                                    </th>
                                    <th class="align-middle">Username</th>
                                    <th class="align-middle">Travel Package</th>
                                    <th class="align-middle">Visa</th>
                                    <th class="align-middle">Total Price</th>
                                    <th class="align-middle">Status</th>
                                    <th class="align-middle">Last Update</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $trx)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $trx->user->username }}</td>
                                        <td>{{ $trx->travel_package->title }}</td>
                                        <td>Rp {{ number_format($trx->additional_visa, 0, ',', '.') ?? '0' }}</td>
                                        <td>Rp {{ number_format($trx->transaction_total, 0, ',', '.') ?? '0' }}</td>
                                        <td>{{ $trx->transaction_status }}</td>
                                        <td>{{ $trx->updated_at }}</td>
                                        <td><a href="{{ route('transaction.show', $trx->id) }}" class="btn btn-success"><i
                                                    class="fas fa-info-circle"></i></a>
                                            <form action="{{ route('transaction.destroy', $trx->id) }}" method="post"
                                                class="d-inline ml-2" id="delete-transaction">@csrf
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
        document.querySelector('#delete-transaction').addEventListener('submit', function(e) {
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
