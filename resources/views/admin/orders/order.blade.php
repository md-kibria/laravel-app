@extends('layouts.admin.master')
@section('title')
    Order Overview
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Overview" pagetitle="Orders" />

    <div class="row mb-4 align-items-center">
        <div class="col d-flex align-items-center gap-2">
            <h6 class="fs-18 mb-0">Order ID: #{{ $order->id }}</h6>
            <span class="badge badge-pill @if($order->status == 'paid') bg-success-subtle text-success @else bg-danger-subtle text-danger @endif text-uppercase">{{$order->status}}</span>
        </div>
        <div class="col text-end">
            <a href="#invoiceModal-{{ $order->id }}" data-bs-toggle="modal" type="button" class="btn btn-secondary"><i class="ph-download-simple me-1 align-middle"></i>
                Invoice</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-3 col-lg-12">
            <div class="card bg-success bg-opacity-10 border-0">
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <div class="flex-grow-1">
                            <h6 class="fs-18 mb-3">Customer Info</h6>
                            <p class="mb-0 fw-medium">{{$order->name ?? $order->user?->name}}</p>
                            <p class="mb-1">{{$order->email ?? $order->user?->email}}</p>
                            <p class="mb-0">{{$order->phone ?? $order->user?->phone}}</p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-success-subtle text-success rounded fs-3">
                                <i class="ph-user-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-9">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Variations</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col" class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                {{-- {{dd(json_decode($item->price)->price)}} --}}
                                <tr>
                                    <td>
                                        <a href="#!" class="fw-medium link-primary">#{{ $item->service->id }}</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <img src="{{ asset('/storage/' . $item->service->thumbnail) }}" alt=""
                                                    class="avatar-xs rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">{{ $item->service->name }}</div>
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        @foreach (json_decode($item->variations) as $va)
                                            <span class="d-block"
                                                style="font-size: 12px;">{{ $va->type }}: <span
                                                    class="badge text-primary">{{ $va->name }}</span></span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span class="text-secondary">{{ number_format(json_decode($item->price)->mainPrice, 2) }} lei</span>
                                    </td>

                                    <td>{{ $item->quantity }}</td>
                                    <td class="text-end">{{ number_format(json_decode($item->price)->mainPrice * $item->quantity, 2) }} lei</td>
                                </tr>
                                @endforeach

                                @php
                                    $mainTotal = 0;
                                    foreach ($order->items as $item) {
                                        $mainTotal += json_decode($item->price)->mainPrice * $item->quantity;
                                    }
                                @endphp
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="p-0">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Sub Total:</td>
                                                    <td class="text-end">{{ number_format($mainTotal, 2) }} lei</td>
                                                </tr>
                                                <tr>
                                                    <td>Discount:</td>
                                                    <td class="text-end">({{ number_format($mainTotal - $order->total, 2) }}) lei</td>
                                                </tr>
                                                <tr class="border-top">
                                                    <th>Total (RON) :</th>
                                                    <th class="text-end">{{ number_format($order->total, 2) }} lei</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        
    </div>


   
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
    
@endsection
@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
