@extends('layouts.admin.master')
@section('title')
    Subscription
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Subscription" pagetitle="Settings" />
    <div>
        <div class="row">
            <form action="{{ route('admin.settings.subscription.update') }}" enctype="multipart/form-data" method="POST"
                class="col-xl-8 col-lg-8 needs-validation">
                @method('POST')
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
                                <h5 class="card-title mb-1 text-capitalize">Subscription Details</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Sub Title (en)</label>
                                    <input type="text" class="form-control @error('subs_sub_title.en') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter sub-title" name="subs_sub_title[en]"
                                        value="{{ old('subs_sub_title.en') ?? $settings->getTranslation('subs_sub_title', 'en') }}">
                                    @error('subs_sub_title.en')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Sub Title (ro)</label>
                                    <input type="text" class="form-control @error('subs_sub_title.ro') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter sub-title" name="subs_sub_title[ro]"
                                        value="{{ old('subs_sub_title.ro') ?? $settings->getTranslation('subs_sub_title', 'ro') }}">
                                    @error('subs_sub_title.ro')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Title (en)</label>
                                    <input type="text" class="form-control @error('subs_title.en') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter title" name="subs_title[en]"
                                        value="{{ old('subs_title.en') ?? $settings->getTranslation('subs_title', 'en') }}">
                                    @error('subs_title.en')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Title (ro)</label>
                                    <input type="text" class="form-control @error('subs_title.ro') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter title" name="subs_title[ro]"
                                        value="{{ old('subs_title.ro') ?? $settings->getTranslation('subs_title', 'ro') }}">
                                    @error('subs_title.ro')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Description (en)</label>
                                    <textarea class="form-control @error('subs_desc.en') is-invalid @enderror" id="manufacturer-name-input" rows="4"
                                        placeholder="Enter description" name="subs_desc[en]">{{ old('subs_desc.en') ?? $settings->getTranslation('subs_desc', 'en') }}</textarea>
                                    @error('subs_desc.en')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Description (ro)</label>
                                    <textarea class="form-control @error('subs_desc.ro') is-invalid @enderror" id="manufacturer-name-input" rows="4"
                                        placeholder="Enter description" name="subs_desc[ro]">{{ old('subs_desc.ro') ?? $settings->getTranslation('subs_desc', 'ro') }}</textarea>
                                    @error('subs_desc.ro')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Image</label>
                                    <input type="file" class="form-control @error('subs_img') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter image" name="subs_img"
                                        value="{{ old('subs_img') }}">
                                    @error('subs_img')
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
                            <img src="@if ($subs_img) {{ asset('/storage/' . $subs_img) }} @endif"
                                alt="" class="w-full" style="width: 100%;">
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection
@section('scripts')
<script src="{{ URL::asset('build/libs/nouislider/nouislider.min.js') }}"></script>

<!-- App js -->
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
