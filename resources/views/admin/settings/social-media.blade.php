@extends('layouts.admin.master')
@section('title')
    Social Media
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Social Media" pagetitle="Settings" />
    <form action="{{ route('admin.settings.social-media.update') }}" class="needs-validation" method="POST">
        @method('POST')
        @csrf
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title rounded-circle bg-light text-primary fs-20">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">Social Media Link</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Facebook</label>
                            <input type="link" class="form-control @error('facebook') is-invalid @enderror"
                                id="product-title-input" value="{{ old('facebook') ?? $socialMediaLinks['facebook']->url }}" placeholder="Enter facebook link"
                                name="facebook">
                            @error('facebook')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Instagram</label>
                            <input type="link" class="form-control @error('instagram') is-invalid @enderror"
                                id="product-title-input" value="{{ old('instagram') ?? $socialMediaLinks['instagram']->url }}" placeholder="Enter instagram link"
                                name="instagram">
                            @error('instagram')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Twitter/X</label>
                            <input type="link" class="form-control @error('twitter') is-invalid @enderror"
                                id="product-title-input" value="{{ old('twitter') ?? $socialMediaLinks['twitter']->url }}" placeholder="Enter twitter/x link"
                                name="twitter">
                            @error('twitter')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">YouTube</label>
                            <input type="link" class="form-control @error('youtube') is-invalid @enderror"
                                id="product-title-input" value="{{ old('youtube') ?? $socialMediaLinks['youtube']->url }}" placeholder="Enter youtube link"
                                name="youtube">
                            @error('youtube')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
                <!-- end card -->

                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- end col -->
            <!-- end row -->
    </form>

    <x-editor-script id="service-dec-en" />
    <x-editor-script id="service-dec-ro" />
@endsection
@section('scripts')
    <!-- ckeditor -->
    <script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/ckeditor.js') }}"></script>

    <!-- dropzone js -->
    <script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>
    <!-- create-product -->
    <script src="{{ URL::asset('build/js/backend/create-product.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
