@extends('layouts.master')
@section('title')
    Shop Cart
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
                        <h4 class="text-white mb-0">Shopping Cart</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-light justify-content-center mb-0 fs-15">
                                <li class="breadcrumb-item"><a href="#!">Shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
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
    <!--end page-wrapper-->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger text-center text-capitalize mb-4 fs-14">
                        save up to <b>30%</b> to <b>40%</b> off omg! just look at the <b>great deals</b>!
                    </div>
                </div>
            </div>
            <div class="row product-list justify-content-center">
                <div class="col-lg-12">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="mb-0 flex-grow-1 fw-medium">There are <span class="fw-bold product-count"></span>
                            services in your cart</h5>
                        <div class="flex-shrink-0">
                            <a href="#!" class="text-decoration-underline link-secondary">Clear Cart</a>
                        </div>
                    </div>

                    <div class="card product">
                        <div class="card-body p-4">
                            <div class="row gy-3">
                                <div class="col-sm-auto">
                                    <div class="avatar-lg h-100">
                                        <div class="avatar-title bg-secondary-subtle rounded py-3">
                                            <img src="{{ URL::asset('build/images/products/img-15.png') }}" alt=""
                                                class="avatar-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <a href="#!">
                                        <h5 class="fs-16 lh-base mb-1">Like Style Women Black Handbag</h5>
                                    </a>
                                    <ul class="list-inline text-muted fs-13 mb-3">
                                        <li class="list-inline-item">Item Price : <span class="fw-medium">$25.00</span></li>
                                    </ul>
                                    <div class="input-step">
                                        <button type="button" class="minus">–</button>
                                        <input type="number" class="product-quantity" value="1" min="0"
                                            max="100" readonly>
                                        <button type="button" class="plus">+</button>
                                    </div>
                                </div>
                                <div class="col-sm-auto d-flex" style="flex-direction: column; justify-content: space-between">
                                    <div>
                                        <a href="#!" class="d-block text-body p-1 px-0" data-bs-toggle="modal"
                                            data-bs-target="#removeItemModal" aria-label="Close"><i
                                                class="ri-delete-bin-fill text-muted align-bottom me-1"></i> Remove</a>
                                    </div>

                                    <div class="text-lg-end">
                                        <p class="text-muted mb-1 fs-12">Total Price:</p>
                                        <h5 class="fs-16">$<span class="product-price">742.00</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card footer -->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-lg-12">
                    <div class="sticky-side-div">
                        <div class="card overflow-hidden">
                            <div class="card-header border-bottom-dashed">
                                <h5 class="card-title mb-0 fs-15">Order Summary</h5>
                            </div>
                            <div class="card-body pt-4">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless mb-0 fs-15">
                                        <tbody>
                                            <tr>
                                                <td>Sub Total :</td>
                                                <td class="text-end cart-subtotal"></td>
                                            </tr>
                                            <tr>
                                                <td>Discount <span class="text-muted">(Toner15)</span>:</td>
                                                <td class="text-end cart-discount"></td>
                                            </tr>
                                            <tr>
                                                <td>Shipping Charge :</td>
                                                <td class="text-end cart-shipping"></td>
                                            </tr>
                                            <tr>
                                                <td>Estimated Tax (12.5%) : </td>
                                                <td class="text-end cart-tax"></td>
                                            </tr>
                                            <tr class="table-active">
                                                <th>Total (USD) :</th>
                                                <td class="text-end">
                                                    <span class="fw-semibold cart-total"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-hover btn-danger">Continue Shopping</button>
                            <button type="button" class="btn btn-hover btn-success">Check Out <i
                                    class="ri-logout-box-r-line align-bottom ms-1"></i></button>
                        </div>
                    </div>
                    <!-- end stickey -->
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end conatiner-->
    </section>


    <x-subscription />

    <x-key-features />
@endsection
@section('scripts')
    <!-- landing-index js -->
    <script src="{{ URL::asset('build/js/frontend/menu.init.js') }}"></script>
@endsection
