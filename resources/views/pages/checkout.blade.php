@extends('layouts.master')
@section('title')
    Checkout
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <section class="page-wrapper bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center d-flex align-items-center justify-content-between">
                        <h4 class="text-white mb-0">Checkout</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-light justify-content-center mb-0 fs-15">
                                <li class="breadcrumb-item"><a href="/services">{{ session()->get('lang') === 'ro' ? 'Servicii' : 'Services' }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                @guest    
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
                        <i class="bi bi-box-arrow-in-right icons"></i>{{ session()->get('lang') === 'ro' ? 'Client care revine?' : 'Returning customer?' }}<a href="/login"
                        class="link-danger"><strong> {{ session()->get('lang') === 'ro' ? 'Faceți clic aici pentru a vă autentifica' : 'Click here to login' }}</strong>.</a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endguest
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table align-middle table-borderless table-nowrap text-center mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $service)
                                            <tr>
                                                <td class="text-start">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <div class="avatar-title bg-success-subtle rounded-3">
                                                                <img src="{{ asset('/storage/' . $service->thumbnail) }}"
                                                                    alt="" class="avatar-xs">
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6>{{ $service->getTranslation('name', session()->get('lang')) }}
                                                            </h6>
                                                            <p class="text-muted mb-0">
                                                                {{ session()->get('lang') === 'ro' ? 'Categoria' : 'Categoria' }}:
                                                                {{ $service->category->getTranslation('title', session()->get('lang')) ?? '' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ number_format($service->curr_price, 2) }} lei
                                                </td>
                                                <td>
                                                    {{ $service->quantity }}
                                                </td>
                                                <td class="text-end">{{ number_format($service->curr_price * $service->quantity, 2) }} lei</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- end col -->
                <div class="col-lg-12">
                    <div class="sticky-side-div">

                        <div class="card overflow-hidden">
                            <div class="card-header border-bottom-dashed">
                                <h5 class="card-title mb-0 fs-15">{{ session()->get('lang') === 'ro' ? 'Rezumatul comenzii' : 'Order Summary' }}</h5>
                            </div>
                            <div class="card-body pt-4">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless mb-0 fs-15">
                                        <tbody>
                                            <tr>
                                                <td>Sub Total :</td>
                                                <td class="text-end cart-subtotal">
                                                    {{ number_format($total, 2) }} lei
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ session()->get('lang') === 'ro' ? 'Reducere' : 'Discount ' }} <span class="text-muted">{{-- (Toner15) --}}</span>:</td>
                                                <td class="text-end cart-discount">00.00 lei</td>
                                            </tr>
                                            <tr class="table-active">
                                                <th>Total (RON) :</th>
                                                <td class="text-end">
                                                    <span class="fw-semibold cart-total">{{ number_format($total, 2) }} lei</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-between justify-content-end">
                            <a href="/services" class="btn btn-hover btn-soft-info w-100">{{ session()->get('lang') === 'ro' ? 'Înapoi la Servicii' : 'Back To Services' }} <i
                                    class="ri-arrow-right-line label-icon align-middle ms-1"></i></a>
                            <a href="payment" class="btn btn-hover btn-primary w-100">{{ session()->get('lang') === 'ro' ? 'Continuați plata' : 'Continue Payment' }}</a>
                        </div>

                    </div>
                    <!-- end stickey -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>

    <x-subscription />

    <x-key-features />


    <!-- removeAddressModal -->
    <div id="removeAddressModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Address ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('scripts')
    <!-- form wizard init -->
    <script src="{{ URL::asset('build/js/pages/form-wizard.init.js') }}"></script>
    <!-- landing-index js -->
    <script src="{{ URL::asset('build/js/frontend/menu.init.js') }}"></script>
@endsection
