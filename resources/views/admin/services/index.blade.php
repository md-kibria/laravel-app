@extends('layouts.admin.master')
@section('title')
    Service List
@endsection
@section('css')
    <!-- extra css -->
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/nouislider/nouislider.min.css') }}">
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/mermaid.min.css') }}">
@endsection
@section('content')
    <x-breadcrumb title="Service List" pagetitle="Services" />

    <div class="row">

        <!-- end col -->
        <div class="col-xl-12 col-lg-12">
            <div class="row g-4 mb-4">
                <div class="col-sm-auto">
                    <div>
                        <a href="/admin/services/create" class="btn btn-success"><i
                                class="ri-add-line align-bottom me-1"></i> Add Product</a>
                    </div>
                </div>
                {{-- <div class="col-sm">
                    <div class="d-flex justify-content-sm-end">
                        <div class="search-box ms-2">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Search Products...">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                </div> --}}
            </div>

            {{-- <div id="product-list" class="gridjs-border-none mb-4"></div> --}}
            <div class="table-responsive table-card m-1">
                <table class="table table-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            {{-- <th scope="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
                                    <label class="form-check-label" for="cardtableCheck"></label>
                                </div>
                            </th> --}}
                            <th scope="col">Id</th>
                            <th scope="col">Service Name</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Price</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Orders</th>
                            <th scope="col">Publish</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td class="align-middle">
                                    <a href="#" class="fw-semibold">#{{ $service->id }}</a>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2 avatar-sm">
                                            <div class="avatar-title bg-light rounded">
                                                @if($service->thumbnail)
                                                    <img src="{{ asset('/storage/' . $service->thumbnail) }}" alt="" class="avatar-xs" />
                                                @else
                                                <span class="text-body-secondary text-center fs-6" style="line-height: 13px;"><small>No <br/>Thumb</small></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $service->name }}</h6>
                                            <p class="mb-0 text-muted">Category : <span class="fw-medium">{{ $service->category->title ?? '' }}</span></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">{{ number_format($service->reviews_avg_rating, 1) }} <i
                                    class="ri-star-fill text-warning align-bottom"></i></td>
                                <td class="align-middle">
                                    @if ($service->discounted_price)
                                        ${{ $service->price - ($service->price * $service->discounted_price) / 100 }}
                                        <p class="mb-0 text-body-secondary"><del>${{ $service->price }}</del></p>
                                    @else
                                        ${{ $service->price }}
                                    @endif
                                </td>
                                <td class="align-middle">{{ (int) $service->discounted_price }}%</td>
                                <td class="align-middle">{{ count($service->orders) }}</td>
                                <td class="align-middle">
                                    {{ \Carbon\Carbon::parse($service->created_at)->toFormattedDateString() }}</td>
                                <td class="align-middle"><span
                                        class="badge @if ($service->status === 'published') bg-success @else bg-danger @endif text-capitalize">{{ $service->status }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="btn-group">
                                        <a href="/admin/services/{{ $service->id }}/edit" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="/admin/services/{{ $service->id }}/faq" class="btn btn-sm btn-secondary">
                                            <i class="bi bi-question-octagon"></i>
                                        </a>
                                        <a href="#delteModal-{{$service->id}}" data-bs-toggle="modal" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center pt-2">
                <p class="text-muted mb-0">
                    Showing {{ $services->firstItem() }} to {{ $services->lastItem() }} of {{ $services->total() }} results
                </p>
                {{ $services->links() }}
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <!-- removeItemModal -->
    @foreach ($services as $service)
    <div id="delteModal-{{$service->id}}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" id="close-removecategoryModal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-md-5">
                    <div class="text-center">
                        <div class="text-danger">
                            <i class="bi bi-trash display-4"></i>
                        </div>
                        <div class="mt-4 fs-15">
                            <h4 class="mb-1">Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Service?</p>
                        </div>
                    </div>
                    <form class="d-flex gap-2 justify-content-center mt-4 mb-2" action="/admin/services/{{$service->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn w-sm btn-light btn-hover"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn w-sm btn-danger btn-hover" id="remove-category">Yes, Delete
                            It!</button>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
@endsection
@section('scripts')
    <!-- nouisliderribute js -->
    <script src="{{ URL::asset('build/libs/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/wnumb/wNumb.min.js') }}"></script>

    <!-- gridjs js -->
    <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

    <!-- Product list init -->
    <script src="{{ URL::asset('build/js/backend/product-list.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
