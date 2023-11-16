@extends('layouts.frontend')

@section('title', 'Checkout')

@section('content')
    <div class="container">
        <nav class="row navbar navbar-expand-lg navbar-light bg-white">
            <div class="navbar-nav ml-auto mr-auto mr-sm-auto mr-lg-0 mr-md-auto">
                <a class="navbar-brand" href="index.html">
                    <img src="assets/frontend/images/logo.png" alt="" />
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
                                <li class="breadcrumb-item" aria-current="page">
                                    Details
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Checkout
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 pl-lg-0">
                        <div class="card card-details mb-3">
                            <h1>Who is Going?</h1>
                            <p>
                                Trip to {{ $transactions->travel_package->title }},
                                {{ $transactions->travel_package->location }}
                            </p>
                            <div class="attendee">
                                <table class="table table-responsive-sm text-center">
                                    <thead>
                                        <tr>
                                            <td scope="col">Picture</td>
                                            <td scope="col">Name</td>
                                            <td scope="col">Nationality</td>
                                            <td scope="col">Visa</td>
                                            <td scope="col">Passport</td>
                                            <td scope="col"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions->details as $detail)
                                            <tr>
                                                <td>
                                                    <img src="https://ui-avatars.com/api/?name={{ $detail->username }}"
                                                        alt="Photo Profile" class="rounded-circle" height="60" />
                                                </td>
                                                <td class="align-middle">{{ $detail->username }}</td>
                                                <td class="align-middle">{{ $detail->nationality }}</td>
                                                <td class="align-middle">{{ $detail->is_visa ? '30 Days' : 'N/A' }}</td>
                                                <td class="align-middle">
                                                    {{ $detail->doe_passport > date('Y-m-d') ? 'Active' : 'Inactive' }}
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('checkout.remove', $detail->id) }}">
                                                        <img src="{{ asset('assets/frontend/images/ic_remove.png') }}"
                                                            alt="" />
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    No Visitor
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="member mt-3">
                                <h2>Add Member</h2>
                                <form action="{{ route('checkout.create', $transactions->id) }}" method="POST"
                                    class="form-inline">
                                    @csrf
                                    <label class="sr-only" for="inputUsername">Name</label>
                                    <input type="text" name="username" class="form-control mb-2 mr-sm-2"
                                        id="inputUsername" placeholder="Username" required />

                                    <label class="sr-only" for="nationality">Nationality</label>
                                    <input type="text" name="nationality" class="form-control mb-2 mr-sm-2"
                                        style="width: 100px"id="nationality" placeholder="nationality" required />

                                    <label class="sr-only" class="mr-2"
                                        for="inlineFormCustomSelectPref">Preference</label>
                                    <select class="custom-select mb-2 mr-sm-2" id="inlineFormCustomSelectPref"
                                        name="is_visa" required>
                                        <option disabled selected value="">VISA</option>
                                        <option value="1">30 Days</option>
                                        <option value="0">N/A</option>
                                    </select>

                                    <label class="sr-only" for="doePassport">DOE Passport</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" class="form-control datepicker" style="width: 120px"
                                            id="doePassport" placeholder="DOE Passport" name="doe_passport" required />
                                    </div>

                                    <button type="submit" class="btn btn-add-now mb-2 px-4">
                                        Add Now
                                    </button>
                                </form>
                                <h3 class="mt-2 mb-0">Note</h3>
                                <p class="disclaimer mb-0">
                                    You are only able to invite member that has registered in
                                    Nomads.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-details card-right">
                            <h2>Checkout Information</h2>
                            <table class="trip-informations">
                                <tr>
                                    <th width="50%">Members</th>
                                    <td width="50%" class="text-right">{{ $transactions->details->count() }} person</td>
                                </tr>
                                <tr>
                                    <th width="50%">Additional Visa</th>
                                    <td width="50%" class="text-right">
                                        Rp {{ number_format($transactions->additional_visa, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Trip Price</th>
                                    <td width="50%" class="text-right">
                                        Rp {{ number_format($transactions->travel_package->price, 0, ',', '.') }} / person
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Sub Total</th>
                                    <td width="50%" class="text-right">Rp
                                        {{ number_format($transactions->transaction_total, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Total (+Unique)</th>
                                    <td width="50%" class="text-right text-total">
                                        <span class="text-blue">Rp
                                            {{ number_format($transactions->transaction_total + mt_rand(0, 999), 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            <hr />
                            <h2>Payment Instructions</h2>
                            <p class="payment-instructions">
                                You will be redirected to another page to pay using QRIS powered by Gopay.
                            </p>
                            <img src="{{ asset('assets/frontend/images/gopay.png') }}" class="w-50" />
                        </div>
                        <div class="join-container">
                            <a href="{{ route('checkout.success', $transactions->id) }}"
                                class="btn btn-block btn-join-now mt-3 py-2">I Have
                                Made Payment</a>
                        </div>
                        <div class="text-center mt-3">
                            <a href="#" class="text-muted">Cancel Booking</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/libraries/gijgo/css/gijgo.min.css') }}" />
@endpush

@push('addon-script')
    <script src="{{ asset('assets/frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap4',
                icons: {
                    rightIcon: '<img src="{{ asset('assets/frontend/images/ic_doe.png') }}" />'
                }
            });
        });
    </script>
@endpush
