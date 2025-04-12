@extends('layouts.admin.master')
@section('title')
    Home Page
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Slider" pagetitle="Pages" />
    <form action="/admin/sliders/store" class="needs-validation" enctype="multipart/form-data" method="POST">
        @method('POST')
        @csrf
        <div class="row">
            <div class="col-xl-8 col-lg-8">


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
                                <h5 class="card-title mb-1">Sliders</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Top Text</label>
                                    <input type="text" class="form-control @error('top-text') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter top text" name="top-text"
                                        value="{{ old('top-text') }}">
                                    @error('top-text')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Main Text</label>
                                    <input type="text" class="form-control @error('main-text') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter main text" name="main-text"
                                        value="{{ old('main-text') }}">
                                    @error('main-text')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Bottom Text</label>
                                    <input type="text" class="form-control @error('bottom-text') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter bottom text" name="bottom-text"
                                        value="{{ old('bottom-text') }}">
                                    @error('bottom-text')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Button Text</label>
                                    <input type="text" class="form-control @error('button-text') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter button text" name="button-text"
                                        value="{{ old('button-text') }}">
                                    @error('button-text')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Button Color</label>
                                    <select name="button-color" id=""
                                        class="form-control @error('button-color') is-invalid @enderror"
                                        id="manufacturer-name-input">
                                        <option value="">Select Color</option>
                                        <option value="btn-success" @selected(old('button-color') == 'btn-success')>Green</option>
                                        <option value="btn-primary" @selected(old('button-color') == 'btn-primary')>Blue</option>
                                        <option value="btn-danger" @selected(old('button-color') == 'btn-danger')>Red</option>
                                    </select>
                                    @error('button-color')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Button Link</label>
                                    <input type="link" class="form-control @error('button-link') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter button link" name="button-link"
                                        value="{{ old('button-link') }}">
                                    @error('button-link')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Background Image</label>
                                    <input type="file" class="form-control @error('bg-image') is-invalid @enderror"
                                        id="manufacturer-name-input" name="bg-image" value="{{ old('bg-image') }}">
                                    @error('bg-image')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Main Slider Image</label>
                                    <input type="file" class="form-control @error('main-image') is-invalid @enderror"
                                        id="manufacturer-name-input" name="main-image" value="{{ old('main-image') }}">
                                    @error('main-image')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div>
                </div>

                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-4 col-lg-4">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Guide</h5>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <img src="{{ URL::asset('img/guide/slider.png') }}" alt="" class="w-full"
                                style="width: 100%;">
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </form>

    @foreach ($sliders as $slide)
        <div class="col-xxl-12 col-12 col-md-12 col-lg-8 col-xl-9">


            <div class=" bg-primary-subtle"
                style="background-image: url('{{ asset('/storage/' . $slide->{'main-image'}) }}');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <p class="fs-15 fw-semibold text-uppercase"> {{ $slide->{'top-text'} }} </p>
                                <h1 class="display-4 fw-semibold text-capitalize lh-base">{{ $slide->{'main-text'} }}</h1>
                                <p class="fs-18 mb-4">{{ $slide->{'bottom-text'} }}</p>
                                <a href="{{ $slide->{'button-link'} }}" class="btn {{ $slide->{'button-color'} }} btn-hover">{{ $slide->{'button-text'} }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('scripts')
@endsection
