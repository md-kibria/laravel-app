@extends('layouts.master')
@section('title')
    My Account
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <!-- start profile -->
    <section class="position-relative">
        <div class="profile-basic position-relative"
            style="background-image: url('build/images/profile-bg.jpg');background-size: cover;background-position: center; height: 300px;">
            <div class="bg-overlay bg-primary" style="--bs-bg-opacity: 0.99;"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pt-3">
                        <div class="mt-n5 d-flex gap-3 flex-wrap align-items-end">
                            <img src="@if ($user->image) {{ asset('/storage/' . $user->image) }} @else {{ URL::asset('img/default.png') }} @endif"
                                alt="" class="avatar-xl rounded p-1 bg-light mt-n3">
                            <div>
                                <h5 class="fs-18">{{ $user->name }}</h5>
                                @if ($user->city || $user->country)
                                    <div class="text-muted">
                                        <i class="bi bi-geo-alt"></i> {{ $user->city }}, {{ $user->country }}
                                    </div>
                                @endif
                            </div>
                            <div class="ms-md-auto">
                                <!-- <p class="mb-0">Toner Member Since Jan 2020</p> -->
                                <a href="/services" class="btn btn-success btn-hover"><i
                                        class="bi bi-cart4 me-1 align-middle"></i> Shopping Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end profile -->

    <!-- start tab-->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column gap-3" role="tablist">
                                <li class="nav-item " role="presentation">
                                    <a class="nav-link fs-15 active" data-bs-toggle="tab" href="#custom-v-pills-profile"
                                        role="tab" aria-selected="true"><i
                                            class="bi bi-person-circle align-middle me-1"></i>
                                        {{ session()->get('lang') === 'ro' ? 'Informații despre cont' : 'Account Info' }}</a>
                                </li>
                                <li class="nav-item " role="presentation">
                                    <a class="nav-link fs-15" data-bs-toggle="tab" href="#custom-v-pills-order"
                                        role="tab" aria-selected="false" tabindex="-1"><i
                                            class="bi bi-bag align-middle me-1"></i>
                                        {{ session()->get('lang') === 'ro' ? 'Comenzi' : 'Orders' }}</a>
                                </li>
                                <li class="nav-item " role="presentation">
                                    <a class="nav-link fs-15" data-bs-toggle="tab" href="#custom-v-pills-setting"
                                        role="tab" aria-selected="false" tabindex="-1"><i
                                            class="bi bi-gear align-middle me-1"></i>
                                        {{ session()->get('lang') === 'ro' ? 'Setări' : 'Settings' }}</a>
                                </li>
                                <li class="nav-item " role="presentation">
                                    <a class="nav-link fs-15" href="/account/password"><i
                                            class="bi bi-key align-middle me-1"></i>
                                        {{ session()->get('lang') === 'ro' ? 'Resetează parola' : 'Reset Password' }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-15" href="/logout"><i
                                            class="bi bi-box-arrow-right align-middle me-1"></i>
                                        {{ session()->get('lang') === 'ro' ? 'Deconectare' : 'Logout' }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-lg-9">
                    <div class="tab-content text-muted">
                        <div class="tab-pane fade show active" id="custom-v-pills-profile" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="d-flex mb-4">
                                                <h6 class="fs-16 text-decoration-underline flex-grow-1 mb-0">{{ session()->get('lang') === 'ro' ? 'Date personale' : 'Personal Details' }}
                                                </h6>
                                            </div>

                                            <div class="table-responsive table-card px-1">
                                                <table class="table table-borderless table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                {{ session()->get('lang') === 'ro' ? 'Numele clientului' : 'Customer Name' }}
                                                            </td>
                                                            <td class="fw-medium">
                                                                {{ $user->name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                {{ session()->get('lang') === 'ro' ? 'Număr de telefon mobil' : 'Mobile / Phone Number' }}
                                                            </td>
                                                            <td class="fw-medium">
                                                                {{ $user->phone ?? 'Null' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                {{ session()->get('lang') === 'ro' ? 'Adresa de e-mail' : 'Email Address' }}
                                                            </td>
                                                            <td class="fw-medium">
                                                                {{ $user->email ?? 'null' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                {{ session()->get('lang') === 'ro' ? 'Locaţie' : 'Location' }}
                                                            </td>
                                                            <td class="fw-medium">
                                                                {{ $user->city ?? 'null' }},
                                                                {{ $user->country ?? 'null' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                {{ session()->get('lang') === 'ro' ? 'Întrucât membru' : 'Since Member' }}
                                                            </td>
                                                            <td class="fw-medium">
                                                                {{ \Carbon\Carbon::parse($user->created_at)->toFormattedDateString() }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>
                                    </div>
                                    <!--end card-->
                                </div>
                                <!--end col-->
                            </div>
                        </div>

                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="custom-v-pills-order" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table fs-15 align-middle table-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Order ID</th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Total Amount</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-body">#{{ $order->id }}</a>
                                                        </td>
                                                        <td>
                                                            @foreach ($order->items as $item)
                                                                <a href="/{{ $item->service->slug }}">
                                                                    <p class="mb-0 fs-13">
                                                                        {{ $item->service->getTranslation('name', session()->get('lang')) }}
                                                                    </p>
                                                                </a>
                                                            @endforeach
                                                        </td>
                                                        <td><span
                                                                class="text-muted">{{ \Carbon\Carbon::parse($order->created_at)->toFormattedDateString() }}</span>
                                                        </td>
                                                        <td class="fw-medium">{{ number_format($order->total, 2) }} lei
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge @if ($order->status == 'paid') bg-success-subtle text-success @else bg-danger-subtle text-danger @endif text-uppercase">{{ $order->status }}</span>
                                                        </td>
                                                        <td>
                                                            {{-- <a href="#invoiceModal-{{ $order->id }}" data-bs-toggle="modal"
                                                            class="btn btn-secondary btn-sm">Invoice</a> --}}
                                                            <a href="/invoice/{{ $order->id }}" target="_blank"
                                                                class="btn btn-secondary btn-sm">Invoice</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="custom-v-pills-setting" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="/account/update" method="POST" enctype="multipart/form-data">
                                                @method('POST')
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h5 class="fs-16 text-decoration-underline mb-4">{{ session()->get('lang') === 'ro' ? 'Date personale' : 'Personal Details' }}
                                                        </h5>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Name</label>
                                                            <input type="text" class="form-control"
                                                                id="firstnameInput" placeholder="Enter your firstname"
                                                                value="{{ $user->name }}" name="name">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Image</label>
                                                            <input type="file" class="form-control" id="image"
                                                                name="image">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="phonenumberInput" class="form-label">Phone
                                                                Number</label>
                                                            <input type="text" class="form-control"
                                                                id="phonenumberInput"
                                                                placeholder="Enter your phone number"
                                                                value="{{ $user->phone }}" name="phone">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Email
                                                                Address</label>
                                                            <input type="email" class="form-control" id="emailInput"
                                                                placeholder="Enter your email"
                                                                value="{{ $user->email }}" name="email">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="cityInput" class="form-label">City</label>
                                                            <input type="text" class="form-control" id="cityInput"
                                                                placeholder="City" value="{{ $user->city }}"
                                                                name="city">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="countryInput" class="form-label">Country</label>
                                                            <input type="text" class="form-control" id="countryInput"
                                                                placeholder="Country" value="{{ $user->country }}"
                                                                name="country">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="zipcodeInput" class="form-label">Zip Code</label>
                                                            <input type="text" class="form-control" minlength="5"
                                                                maxlength="6" id="zipcodeInput"
                                                                placeholder="Enter zipcode" value="{{ $user->zip }}"
                                                                name="zip">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="mb-3 pb-2">
                                                            <label for="exampleFormControlTextarea"
                                                                class="form-label">Description</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your description" rows="3"
                                                                name="description">{{ $user->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                                <div class="text-sm-end">
                                                    <button type="submit"
                                                        class="btn btn-secondary d-block d-sm-inline-block"><i
                                                            class="ri-edit-box-line align-middle me-2"></i> Update
                                                        Profile</button>
                                                </div>
                                            </form>
                                            <!--end tab-pane-->
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!--end card-->
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div> <!-- end row-->
        </div>
    </section>
    <!-- end tab-->

    <x-subscription />

    <x-key-features />

    <!-- Modal -->
    @foreach ($orders as $order)
        <div class="modal fade" id="invoiceModal-{{ $order->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-custom-size">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="invoiceModalLabel">Invoice #{{ $order->id }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <x-invoice orderId="{{ $order->id }}" />
                        <!--end card-->
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('scripts')
    <!-- landing-index js -->
    {{-- <script src="{{ URL::asset('build/js/frontend/menu.init.js') }}"></script> --}}
@endsection
