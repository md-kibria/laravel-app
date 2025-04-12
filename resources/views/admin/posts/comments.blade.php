@extends('layouts.admin.master')
@section('title')
    Comments
@endsection
@section('Comments')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Comments" pagetitle="Posts" />

    <div class="row" data-masonry='{"percentPosition": true }'>
        @foreach ($comments as $comment)
            <div class="col-xxl-3 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-4 align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ $comment->user->image ? asset('/storage/' . $comment->user->image) : URL::asset('img/default.png') }}"
                                    alt="" class="avatar-sm rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h5 class="card-title mb-1">{{ $comment->name }} @if($comment->is_approved) <span class="text-success fs-10">(Showing)</span> @else<span class="text-danger fs-10">(Hidden)</span>@endif</h5>
                                <p class="text-muted mb-0">{{ $comment->email }}</p>
                            </div>
                            <div class="">
                                @if ($comment->is_approved)
                                    <form class="flex-shrink-0" action="/comment/visible/{{ $comment->id }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" type="button" class="btn btn-sm btn-danger btn-icon"><i
                                                class="ri-eye-off-line"></i></button>
                                    </form>
                                @else
                                    <form class="flex-shrink-0" action="/comment/visible/{{ $comment->id }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" type="button" class="btn btn-sm btn-success btn-icon"><i
                                                class="ri-eye-line"></i></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <p class="mb-0 text-muted"><i
                            class="ri-calendar-event-fill me-2 align-middle"></i>{{ \Carbon\Carbon::parse($comment->created_at)->toFormattedDateString() }}
                    </p>


                        {{-- <p class="mb-0 text-muted"><i class="ri-calendar-event-fill me-2 align-middle"></i>{{ \Carbon\Carbon::parse($comment->created_at)->toFormattedDateString() }}</p> --}}
                        <p class="mb-0 text-muted fs-15">{{ $comment->comment }}</p>
                    </div>
                </div>

                {{-- <div class="card card-body">
                    <div class="d-flex mb-4 align-items-center">
                        <div class="flex-shrink-0">
                            <img src="http://localhost:8001/build/images/users/avatar-1.jpg" alt="" class="avatar-sm rounded-circle">
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h5 class="card-title mb-1">Oliver Phillips</h5>
                            <p class="text-muted mb-0">Digital Marketing</p>
                        </div>
                    </div>
                    <h6 class="mb-1">$15,548</h6>
                    <p class="card-text text-muted">Expense Account</p>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm">See Details</a>
                </div> --}}
            </div>
        @endforeach
    </div>
    <!--end row-->
@endsection
@section('scripts')
    <!-- Masonry plugin -->
    <script src="{{ URL::asset('build/libs/masonry-layout/masonry.pkgd.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
