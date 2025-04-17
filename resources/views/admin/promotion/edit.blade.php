@extends('layouts.admin.master')
@section('title')
    Edit Promotion
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Edit Promotion" pagetitle="Promotions" />
    <div class="row">
        <form action="/admin/promotions/{{$promotion->id}}/update" enctype="multipart/form-data" method="POST"
            class="col-xl-8 col-lg-8 needs-validation">
            @method('PUT')
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm">
                                <div class="avatar-title rounded-circle bg-light text-primary fs-20">
                                    <i class="bi bi-question"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-1 text-capitalize">Promotion</h5>
                            <p class="text-muted mb-0">Fill all information below.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="manufacturer-name-input">Sub Title (en)</label>
                                <input type="text" class="form-control @error('sub_title.en') is-invalid @enderror"
                                    id="manufacturer-name-input" placeholder="Enter sub-title" name="sub_title[en]"
                                    value="{{ old('sub_title.en') ?? $promotion->getTranslation('sub_title', 'en') }}">
                                @error('sub_title.en')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="manufacturer-name-input">Sub Title (ro)</label>
                                <input type="text" class="form-control @error('sub_title.ro') is-invalid @enderror"
                                    id="manufacturer-name-input" placeholder="Enter sub-title" name="sub_title[ro]"
                                    value="{{ old('sub_title.ro') ?? $promotion->getTranslation('sub_title', 'ro') }}">
                                @error('sub_title.ro')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="manufacturer-name-input">Title (en)</label>
                                <input type="text" class="form-control @error('title.en') is-invalid @enderror"
                                    id="manufacturer-name-input" placeholder="Enter title" name="title[en]"
                                    value="{{ old('title.en') ?? $promotion->getTranslation('title', 'en') }}">
                                @error('title.en')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="manufacturer-name-input">Title (ro)</label>
                                <input type="text" class="form-control @error('title.ro') is-invalid @enderror"
                                    id="manufacturer-name-input" placeholder="Enter title" name="title[ro]"
                                    value="{{ old('title.ro') ?? $promotion->getTranslation('title', 'ro') }}">
                                @error('title.ro')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="manufacturer-name-input">link</label>
                                <input type="link" class="form-control @error('link') is-invalid @enderror"
                                    id="manufacturer-name-input" placeholder="Enter link" name="link"
                                    value="{{ old('link') ?? $promotion->link }}">
                                @error('link')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="manufacturer-name-input">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="manufacturer-name-input" placeholder="Enter image" name="image"
                                    value="{{ old('image') }}">
                                @error('image')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="manufacturer-name-input">Status</label>
                                <select name="status" id=""
                                    class="form-control @error('status') is-invalid @enderror">
                                    <option value="">Select Status</option>
                                    <option value="show" @selected($promotion->status === 'show')>Show</option>
                                    <option value="hide" @selected($promotion->status === 'hide')>Hide</option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <!-- end row -->

                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-success w-sm">Submit</button>
                    </div>
                </div>
            </div>

            <!-- end card -->
        </form>
        <!-- end col -->

        <div class="col-xl-4 col-lg-4">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Image</h5>
                </div>
                <div class="card-body">
                    <div class="">
                        <img src="@if ($promotion->image) {{ asset('/storage/' . $promotion->image) }} @endif"
                            alt="" class="w-full" style="width: 100%;">
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

        </div>
        <!-- end col -->
    </div>
@endsection
@section('scripts')
    <!-- nouisliderribute js -->
    <script src="{{ URL::asset('build/libs/nouislider/nouislider.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
