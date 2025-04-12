@extends('layouts.admin.master')
@section('title')
    Reviews & Ratings
@endsection
@section('Reviews & Ratings')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Reviews & Ratings" pagetitle="Reviews & Ratings" />

    <div class="row" data-masonry='{"percentPosition": true }'>
        @foreach ($reviews as $review)
            <div class="col-xxl-3 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-4 align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ $review->user?->image ? asset('/storage/' . $review->user->image) : URL::asset('img/default.png') }}"
                                    alt="" class="avatar-sm rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h5 class="card-title mb-1">{{ $review->name }} @if($review->is_approved) <span class="text-success fs-10">(Showing)</span> @else<span class="text-danger fs-10">(Hidden)</span>@endif</h5>
                                <p class="text-muted mb-0">{{ $review->email }}</p>
                            </div>
                            <div class="">

                                <p class="mb-0 text-muted"><i
                                        class="ri-calendar-event-fill me-2 align-middle"></i>{{ \Carbon\Carbon::parse($review->created_at)->toFormattedDateString() }}
                                </p>
                                <div class="text-warning mb-3 " style="text-align: right">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <span><i class="ri-star-s-fill text-warning align-bottom"></i></span>
                                        @else
                                            <span><i class="ri-star-s-line text-warning align-bottom"></i></span>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                        {{-- <h5 class="mb-2 mt-3">{{ $review->name }}</h5> --}}
                        {{-- <p class="mb-0 text-muted"><i
                            class="ri-calendar-event-fill me-2 align-middle"></i>{{ \Carbon\Carbon::parse($review->created_at)->toFormattedDateString() }}
                    </p> --}}
                        <p class="mb-0 text-muted fs-15">{{ $review->comment }}</p>
                        <div class="mt-2">
                            @if ($review->is_approved)
                                <form class="flex-shrink-0 d-grid" action="/admin/review/visible/{{ $review->id }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" type="button" class="btn btn-sm btn-soft-danger">Hide</button>
                                </form>
                            @else
                                <form class="flex-shrink-0 d-grid" action="/admin/review/visible/{{ $review->id }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" type="button" class="btn btn-sm btn-soft-success">Show</button>
                                </form>
                            @endif
                        </div>
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
