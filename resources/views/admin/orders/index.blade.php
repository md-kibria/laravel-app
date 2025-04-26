@extends('layouts.admin.master')
@section('title')
    List View - Orders
@endsection
@section('css')
    <!-- extra css -->
    <!-- Sweet Alert css-->
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <x-breadcrumb title="List View" pagetitle="Orders" />

    
    <!--end row-->

    <div class="row" id="orderList">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card mb-1">
                        <table class="table align-middle table-nowrap" id="orderTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll"
                                                value="option">
                                        </div>
                                    </th>
                                    <th class="sort fw-medium" data-sort="id">Order ID</th>
                                    <th class="sort fw-medium" data-sort="customer_name">Customer</th>
                                    <th class="sort fw-medium" data-sort="product_name">Email</th>
                                    <th class="sort fw-medium" data-sort="amount">Amount</th>
                                    <th class="sort fw-medium" data-sort="method">Method</th>
                                    <th class="sort fw-medium" data-sort="transaction">Transaction Id</th>
                                    <th class="sort fw-medium" data-sort="transaction">Tran Msg</th>
                                    <th class="sort fw-medium" data-sort="type">Type</th>
                                    <th class="sort fw-medium" data-sort="order_date">Order Date</th>
                                    <th class="sort fw-medium" data-sort="status">Payment Status</th>
                                    <th class="fw-medium" data-sort="action">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach ($orders as $order)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="chk_child"
                                                value="option1">
                                        </div>
                                    </th>
                                    <td class="id"><a href="/admin/orders/{{ $order->id }}"
                                            class="fw-medium link-primary">#{{$order->id}}</a></td>
                                    <td class="customer_name">{{$order->name ?? $order->user?->name}}</td>
                                    <td class="product_name">{{$order->email ?? $order->user?->email}}</td>
                                    <td class="amount">{{number_format($order->total, 2)}} lei</td>
                                    <td class="method text-uppercase">{{ $order->method }}</td>
                                    <td class="transactionId text-uppercase">{{ $order->transactionId }}</td>
                                    <td class="transactionStatus">{{ $order->transactionStatus }}</td>
                                    <td class="type text-capitalize">{{ $order->type }}</td>
                                    <td class="order_date">{{\Carbon\Carbon::parse($order->created_at)->toFormattedDateString()}}</td>
                                    <td class="status">
                                        <span class="badge @if($order->status == 'paid') bg-success-subtle text-success @else bg-danger-subtle text-danger @endif text-uppercase">{{$order->status}}</span>
                                    </td>
                                    <td>
                                        <a href="/admin/orders/{{ $order->id }}" class="btn btn-soft-secondary btn-sm ">
                                            <i class="ri-eye-fill align-bottom me-2"></i> View
                                        </a>
                                    </td>
                                </tr>    
                                @endforeach
                            </tbody>
                        </table>

                        @if(count($orders) === 0)
                        <div class="noresult">
                            <div class="text-center py-4">
                                <div class="avatar-md mx-auto mb-4">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-24">
                                        <i class="bi bi-search"></i>
                                    </div>
                                </div>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0"></p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-2">
                        <p class="text-muted mb-0">
                            Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} results
                        </p>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- list.js min js -->
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- <script src="{{ URL::asset('build/js/backend/order-list.init.js') }}"></script> --}}
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
