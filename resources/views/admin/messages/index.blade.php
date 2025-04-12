@extends('layouts.admin.master')
@section('title')
    List View - Messages
@endsection
@section('css')
    <!-- extra css -->
    <!-- Sweet Alert css-->
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <x-breadcrumb title="List View" pagetitle="Messages" />

    
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
                                    <th class="sort fw-medium" data-sort="id">Msg ID</th>
                                    <th class="sort fw-medium" data-sort="customer_name">Name</th>
                                    <th class="sort fw-medium" data-sort="product_emai">Email</th>
                                    <th class="sort fw-medium" data-sort="order_date">Date</th>
                                    <th class="sort fw-medium" data-sort="status">Status</th>
                                    <th class="fw-medium" data-sort="action">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach ($messages as $msg)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="chk_child"
                                                value="option1">
                                        </div>
                                    </th>
                                    <td class="id"><a href="/admin/messages/{{ $msg->id }}"
                                            class="fw-medium link-primary">#{{$msg->id}}</a></td>
                                    <td class="customer_name">{{$msg->name}}</td>
                                    <td class="product_name">{{$msg->email}}</td>
                                    <td class="order_date">{{\Carbon\Carbon::parse($msg->created_at)->toFormattedDateString()}}</td>
                                    <td class="status text-center">
                                        <span class="badge @if($msg->is_read) bg-success-subtle text-success @else bg-danger-subtle text-danger @endif text-uppercase">{{$msg->is_read ? 'Readed' : 'Not Readed'}}</span>
                                    </td>
                                    <td>
                                        <a href="#delteModal-{{$msg->id}}" data-bs-toggle="modal" class="btn btn-soft-danger btn-sm ">
                                            <i class="ri-delete-bin-line align-bottom me-2"></i> Delete
                                        </a>
                                        <a href="/admin/messages/{{ $msg->id }}" class="btn btn-soft-secondary btn-sm ">
                                            <i class="ri-eye-fill align-bottom me-2"></i> View
                                        </a>
                                    </td>
                                </tr>    
                                @endforeach
                            </tbody>
                        </table>

                        @if(count($messages) === 0)
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
                            Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} results
                        </p>
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($messages as $msg)
    <div id="delteModal-{{$msg->id}}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Message?</p>
                        </div>
                    </div>
                    <form class="d-flex gap-2 justify-content-center mt-4 mb-2" action="/admin/messages/{{$msg->id}}" method="POST">
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
    <!-- list.js min js -->
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- <script src="{{ URL::asset('build/js/backend/order-list.init.js') }}"></script> --}}
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
