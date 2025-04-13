@extends('layouts.admin.master')
@section('title')
    Terms & Conditions
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Terms & Conditions" pagetitle="Pages" />
    <form action="/admin/store-page" class="needs-validation" method="POST">
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
                                <h5 class="card-title mb-1">Page Information</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">

                            <label class="form-label" for="product-title-input">Page title (En)</label>
                            <input type="text" class="form-control @error('title.en') is-invalid @enderror"
                                id="product-title-input" value="{{ old('title.en') ?? $page?->getTranslation('title', 'en') }}" placeholder="Enter product title"
                                name="title[en]">
                            @error('title.en')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Page title (Ro)</label>
                            <input type="text" class="form-control @error('title.ro') is-invalid @enderror"
                                id="product-title-input" value="{{ old('title.ro') ?? $page?->getTranslation('title', 'ro') }}" placeholder="Enter product title"
                                name="title[ro]">
                            @error('title.ro')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Page content (En)</label>

                            <textarea type="text" class="form-control @error('content.en') is-invalid @enderror" id="service-dec-en"
                                placeholder="Enter content in English" name="content[en]">{{ old('content.en') ?? $page?->getTranslation('content', 'en') }}</textarea>
                            @error('content.en')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Page content (Ro)</label>

                            <textarea type="text" class="form-control @error('content.ro') is-invalid @enderror" id="service-dec-ro"
                                placeholder="Enter content in Romanian" name="content[ro]">{{ old('content.ro') ??  $page?->getTranslation('content', 'ro') }}</textarea>
                            @error('content.ro')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
                <!-- end card -->

                <input type="hidden" name="slug" value="terms-conditions">
                
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-lg-4">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">SEO</h5>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <div class="flex-grow-1">
                                <label for="seo-title" class="form-label">Title</label>
                                <input class="form-control" placeholder="Enter meta title" type="text"
                                    value="{{ old('meta_title') ?? $page?->meta_title }}" name="meta_title">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="flex-grow-1">
                                <label for="seo-keywords" class="form-label">Keywords</label>
                                <input class="form-control" placeholder="Enter meta keywords" type="text"
                                    value="{{ old('meta_keywords') ?? $page?->meta_keywords }}" name="meta_keywords">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="flex-grow-1">
                                <label for="seo-description" class="form-label">Description</label>
                                <textarea class="form-control" placeholder="Enter meta description" rows="3" name="meta_description">{{ old('meta_description') ?? $page?->meta_description }}</textarea>
                            </div>
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
