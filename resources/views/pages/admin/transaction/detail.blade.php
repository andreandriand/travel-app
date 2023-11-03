@extends('layouts.admin')

@section('title', 'Detail Transaction')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Transaction</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Transaction</a></div>
                <div class="breadcrumb-item">Detail Transaction</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Detail Transaction {{ $transaction->user->name }}</h2>
            <p class="section-lead">
                Details of the transaction will appear here.
            </p>
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th class="align-middle">Buyer</th>
                                <td>{{ $transaction->user->name }}</td>
                            </tr>
                            <tr>
                                <th class="align-middle">Travel Package</th>
                                <td>{{ $transaction->travel_package->title }}</td>
                            </tr>
                            <tr>
                                <th class="align-middle">Additional Visa</th>
                                <td>Rp {{ number_format($transaction->additional_visa, 0, ',', '.') ?? '0' }}</td>
                            </tr>
                            <tr>
                                <th class="align-middle">Total Price</th>
                                <td>Rp {{ number_format($transaction->transaction_total, 0, ',', '.') ?? '0' }}</td>
                            </tr>
                            <tr>
                                <th class="align-middle">Status</th>
                                <td>{{ $transaction->transaction_status }}</td>
                            </tr>
                            <tr>
                                <th class="align-middle">Last Update</th>
                                <td>{{ $transaction->updated_at }}</td>
                            </tr>
                            <tr>
                                <th>Details Pax</th>
                                <td>
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Name</th>
                                            <th>Nationality</th>
                                            <th>Visa</th>
                                            <th>DOE Passport</th>
                                        </tr>
                                        @foreach ($transaction->details as $detail)
                                            <tr>
                                                <td>{{ $detail->username }}</td>
                                                <td>{{ $detail->nationality }}</td>
                                                <td>{{ $detail->is_visa ? 'Yes' : 'No' }}</td>
                                                <td>{{ $detail->doe_passport }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    @if ($transaction->transaction_status != 'SUCCESS')
                        <form action="{{ route('transaction.update', $transaction->id) }}" method="POST"
                            class="d-inline ml-2" id="approve-transaction">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="travel_package_id" value="{{ $transaction->travel_package_id }}">
                            <input type="hidden" name="user_id" value="{{ $transaction->user_id }}">
                            <input type="hidden" name="additional_visa" value="{{ $transaction->additional_visa }}">
                            <input type="hidden" name="transaction_total" value="{{ $transaction->transaction_total }}">
                            <input type="hidden" name="transaction_status" value="SUCCESS">
                            <button type="submit" class="btn btn-success">Approve
                                Transaction</button>
                        </form>
                    @endif
                    @if ($transaction->transaction_status != 'CANCEL')
                        <form action="{{ route('transaction.update', $transaction->id) }}" method="post"
                            class="d-inline ml-2" id="cancel-transaction">@csrf
                            @method('put')

                            <input type="hidden" name="travel_package_id" value="{{ $transaction->travel_package_id }}">
                            <input type="hidden" name="user_id" value="{{ $transaction->user_id }}">
                            <input type="hidden" name="additional_visa" value="{{ $transaction->additional_visa }}">
                            <input type="hidden" name="transaction_total" value="{{ $transaction->transaction_total }}">
                            <input type="hidden" name="transaction_status" value="CANCEL">
                            <button type="submit" class="btn btn-warning">Cancel
                                Transaction</button>
                        </form>
                    @endif
                    @if ($transaction->transaction_status != 'FAILED')
                        <form action="{{ route('transaction.update', $transaction->id) }}" method="post"
                            class="d-inline ml-2" id="reject-transaction">@csrf
                            @method('put')
                            <input type="hidden" name="travel_package_id" value="{{ $transaction->travel_package_id }}">
                            <input type="hidden" name="user_id" value="{{ $transaction->user_id }}">
                            <input type="hidden" name="additional_visa" value="{{ $transaction->additional_visa }}">
                            <input type="hidden" name="transaction_total" value="{{ $transaction->transaction_total }}">
                            <input type="hidden" name="transaction_status" value="FAILED">
                            <button type="submit" class="btn btn-danger">Reject
                                Transaction</button>
                        </form>
                    @endif
                    <a href="{{ route('transaction.index') }}" class="btn btn-primary ml-3 float-right px-4">Back</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-script')
    <script src="{{ asset('assets/admin/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/page/modules-sweetalert.js') }}"></script>

    <script>
        document.querySelector('#approve-transaction').addEventListener('submit', function(e) {
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
                        text: 'Transaction has been approved!',
                        icon: 'success'
                    }).then(function() {
                        form.submit(); // <--- submit form programmatically
                    });
                } else {
                    swal("Cancelled", "No action taken", "error");
                }
            })
        });
    </script>
    <script>
        document.querySelector('#cancel-transaction').addEventListener('submit', function(e) {
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
                        text: 'Transaction has been cancelled!',
                        icon: 'success'
                    }).then(function() {
                        form.submit(); // <--- submit form programmatically
                    });
                } else {
                    swal("Cancelled", "No action taken", "error");
                }
            })
        });
    </script>
    <script>
        document.querySelector('#reject-transaction').addEventListener('submit', function(e) {
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
                        text: 'Transaction has been rejected!',
                        icon: 'success'
                    }).then(function() {
                        form.submit(); // <--- submit form programmatically
                    });
                } else {
                    swal("Cancelled", "No action taken", "error");
                }
            })
        });
    </script>
@endpush
