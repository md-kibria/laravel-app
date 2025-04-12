@extends('layouts.admin.master')
@section('title')
    Message Overview
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Message" pagetitle="Messages" />

    <div class="row mb-4 align-items-center">
        <div class="col d-flex align-items-center gap-2">
            <h6 class="fs-18 mb-0">Msg ID: #{{ $message->id }}</h6>
            <span class="badge badge-pill @if($message->status == 'paid') bg-success-subtle text-success @else bg-danger-subtle text-danger @endif text-uppercase">{{$message->status}}</span>
        </div>
        <div class="col text-end">
            <a href="#delteModal" data-bs-toggle="modal" class="btn btn-danger"><i class="ri-delete-bin-line me-1 align-middle"></i>
                Delete</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-3 col-lg-12">
            <div class="card bg-primary bg-opacity-10 border-0">
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <div class="flex-grow-1">
                            <h6 class="fs-18 mb-3">Sender Info</h6>
                            <p class="mb-0 fw-medium">{{$message->name}}</p>
                            <p class="mb-1">{{$message->email}}</p>
                            <p class="mb-0">{{$message->phone}}</p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded fs-3">
                                <i class="ph-user-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-lg-12">
            <div class="card bg-success bg-opacity-10 border-0">
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <div class="flex-grow-1">
                            <h6 class="fs-18 mb-3">Message</h6>
                            <p class="mb-1">{{$message->message}}</p>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-success-subtle text-success rounded fs-3">
                                <i class="ri-chat-3-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="delteModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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
                    <form class="d-flex gap-2 justify-content-center mt-4 mb-2" action="/admin/messages/{{$message->id}}" method="POST">
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
   
@endsection
@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
