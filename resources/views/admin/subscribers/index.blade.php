@extends('layouts.admin.master')
@section('title')
    Subscribers
@endsection
@section('css')
    <!-- extra css -->
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/nouislider/nouislider.min.css') }}">
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/mermaid.min.css') }}">
@endsection
@section('content')
    <x-breadcrumb title="Subscribers" pagetitle="Dashboard" />

    <div class="row">

        <!-- end col -->
        <div class="col-xl-12 col-lg-12">
            <div class="table-responsive table-card m-1">
                <table class="table table-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Email</th>
                            <th scope="col">Ip</th>
                            <th scope="col">Agent</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribers as $subscriber)
                            <tr>
                                <td class="align-middle">
                                    <a href="#" class="fw-semibold">#{{ $subscriber->id }}</a>
                                </td>
                                <td class="align-middle">{{ $subscriber->email }}</td>
                                <td class="align-middle">{{ $subscriber->ip_address }}</td>
                                <td class="align-middle">{{ $subscriber->user_agent }}</td>
                                <td class="align-middle">
                                    {{ \Carbon\Carbon::parse($subscriber->created_at)->toFormattedDateString() }}</td>
                                <td class="align-middle">
                                    <div class="btn-group">
                                        <a href="mailto:{{ $subscriber->email }}/edit" class="btn btn-sm btn-primary">
                                            <i class="bi bi-envelope"></i>
                                        </a>
                                        <a href="#delteModal-{{ $subscriber->id }}" data-bs-toggle="modal"
                                            class="btn btn-sm btn-danger">
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
                    Showing {{ $subscribers->firstItem() }} to {{ $subscribers->lastItem() }} of
                    {{ $subscribers->total() }} results
                </p>
                {{ $subscribers->links() }}
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <!-- removeItemModal -->
    @foreach ($subscribers as $subscriber)
        <div id="delteModal-{{ $subscriber->id }}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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
                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this email?</p>
                            </div>
                        </div>
                        <form class="d-flex gap-2 justify-content-center mt-4 mb-2"
                            action="/admin/subscribers/{{ $subscriber->id }}" method="POST">
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
