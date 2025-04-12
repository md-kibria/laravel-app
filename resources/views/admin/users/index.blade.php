@extends('layouts.admin.master')
@section('title')
    Users List
@endsection
@section('css')
    <!-- extra css -->
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/nouislider/nouislider.min.css') }}">
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/mermaid.min.css') }}">
@endsection
@section('content')
    <x-breadcrumb title="Users List" pagetitle="Dashboard" />

    <div class="row">

        <!-- end col -->
        <div class="col-xl-12 col-lg-12">
            <div class="table-responsive table-card m-1">
                <table class="table table-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Join Date</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="align-middle">
                                    <a href="#" class="fw-semibold">#{{ $user->id }}</a>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2 avatar-sm">
                                            <div class="avatar-title bg-light rounded">
                                                @if($user->image)
                                                    <img src="{{ asset('/storage/' . $user->image) }}" alt="" class="avatar-xs" />
                                                @else
                                                <span class="text-body-secondary text-center fs-6" style="line-height: 13px;"><small>No <br/>Image</small></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">{{ $user->phone ?? '—' }}</td>
                                <td class="align-middle">{{ $user->city ?? '—'}}, {{ $user->country ?? '—' }}</td>
                                <td class="align-middle">
                                    {{ \Carbon\Carbon::parse($user->created_at)->toFormattedDateString() }}</td>
                                <td class="align-middle"><span
                                        class="badge @if ($user->role === 'admin') bg-success @else bg-primary @endif text-capitalize">{{ $user->role }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="btn-group">
                                        @if ($user->role === 'user')
                                        <a href="#updateModal-{{$user->id}}" data-bs-toggle="modal" class="btn btn-sm btn-success" title="Make Admin">
                                            <i class="bi bi-shield-check"></i>
                                        </a>
                                        @else
                                        <a href="#updateModal-{{$user->id}}" data-bs-toggle="modal" class="btn btn-sm btn-warning" title="Remove Admin">
                                            <i class="bi bi-shield-minus"></i>
                                        </a>
                                        @endif
                                        <a href="#delteModal-{{$user->id}}" data-bs-toggle="modal" class="btn btn-sm btn-danger">
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
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                </p>
                {{ $users->links() }}
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <!-- updateItemModal -->
    @foreach ($users as $user)
    <div id="updateModal-{{$user->id}}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" id="close-removecategoryModal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-md-5">
                    <div class="text-center">
                        <div class="text-success">
                            <i class="bi bi-shield-shaded display-4"></i>
                        </div>
                        <div class="mt-4 fs-15">
                            <h4 class="mb-1">Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to change the role to {{ $user->role === 'user' ? 'admin' : 'user' }}?</p>
                        </div>
                    </div>
                    <form class="d-flex gap-2 justify-content-center mt-4 mb-2" action="/admin/users/{{$user->id}}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="button" class="btn w-sm btn-light btn-hover"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn w-sm btn-success btn-hover" id="remove-category">Yes, Change
                            It!</button>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
    <!-- removeItemModal -->
    @foreach ($users as $user)
    <div id="delteModal-{{$user->id}}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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
                            <p class="text-muted mx-4 mb-0">Are you sure you want to delete this User?</p>
                        </div>
                    </div>
                    <form class="d-flex gap-2 justify-content-center mt-4 mb-2" action="/admin/users/{{$user->id}}" method="POST">
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
