@extends('layouts.admin.master')
@section('title')
    Update service
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Update service" pagetitle="Service" />
    <form action="/admin/services/{{$service->id}}" class="needs-validation" enctype="multipart/form-data" method="POST">
        @method('PUT')
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
                                <h5 class="card-title mb-1">Service Information</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">

                            <label class="form-label" for="product-title-input">Service title (En)</label>
                            <input type="text" class="form-control @error('name.en') is-invalid @enderror"
                                id="product-title-input" value="{{ old('name.en') ?? $service->getTranslation('name', 'en') }}" placeholder="Enter product title"
                                name="name[en]">
                            @error('name.en')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Service title (Ro)</label>
                            <input type="text" class="form-control @error('name.ro') is-invalid @enderror"
                                id="product-title-input" value="{{ old('name.ro') ?? $service->getTranslation('name', 'ro') }}" placeholder="Enter product title"
                                name="name[ro]">
                            @error('name.ro')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Service description (En)</label>

                            <textarea type="text" class="form-control @error('description.en') is-invalid @enderror" id="service-dec-en"
                                placeholder="Enter description in English" name="description[en]">{{ old('description.en') ?? $service->getTranslation('description', 'en') }}</textarea>
                            @error('description.en')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Service description (Ro)</label>

                            <textarea type="text" class="form-control @error('description.ro') is-invalid @enderror" id="service-dec-ro"
                                placeholder="Enter description in Romanian" name="description[ro]">{{ old('description.ro') ?? $service->getTranslation('description', 'ro') }}</textarea>
                            @error('description.ro')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <label class="form-label">Service category</label>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="/admin/categories" class="float-end text-decoration-underline">Add New</a>
                                </div>
                            </div>
                            <div>
                                <select class="form-select @error('category_id') is-invalid @enderror" id="choices-category-input" name="category_id">
                                    <option value="">Select service category</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" @selected($service->category_id == $cat->id)>{{ $cat->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id') 
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title rounded-circle bg-light text-primary fs-20">
                                        <i class="bi bi-images"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">Service Gallery</h5>
                                <p class="text-muted mb-0">Add service gallery images.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <label for="service-image-input" class="form-label d-block">Thumbnail</label>

                        <div class="position-relative d-inline-block">
                            <div class="position-absolute top-100 start-100 translate-middle">
                                <label for="service-image-input" class="mb-0" data-bs-toggle="tooltip"
                                    data-bs-placement="right" title="Select Service Image">
                                    <span class="avatar-xs d-inline-block">
                                        <span class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                            <i class="ri-image-fill"></i>
                                        </span>
                                    </span>
                                </label>
                                <input class="form-control d-none" id="service-image-input" type="file"
                                    accept="image/png, image/gif, image/jpeg" name="thumbnail">
                            </div>
                            <div class="avatar-lg">
                                <div class="avatar-title bg-light rounded-3">
                                    <img src="@if($service->thumbnail) {{asset('/storage/' . $service->thumbnail)}} @else#@endif" alt="" id="service-img"
                                        class="avatar-md h-auto rounded-3 object-fit-cover">
                                </div>
                            </div>

                        </div>

                        <div class="error-msg mt-1">Please add a service images.</div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title rounded-circle bg-light text-primary fs-20">
                                        <i class="bi bi-list-ul"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">General Information</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product-price-input">Price</label>
                                    <div class="input-group has-validation mb-3">
                                        <span class="input-group-text" id="product-price-addon">$</span>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                            id="product-price-input" placeholder="Enter price" aria-label="Price"
                                            aria-describedby="product-price-addon" name="price"
                                            value="{{ old('price') ?? $service->price }}">
                                        @error('price')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product-discount-input">Discount</label>
                                    <div class="input-group has-validation mb-3">
                                        <span class="input-group-text" id="product-discount-addon">%</span>
                                        <input type="number" class="form-control" id="product-discount-input"
                                            placeholder="Enter discount" aria-label="discount"
                                            aria-describedby="product-discount-addon" name="discounted_price"
                                            value="{{ old('discounted_price') ?? $service->discounted_price }}">
                                        <div class="invalid-feedback">Please enter a product discount.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="vid-url-input">Video URL</label>
                                    <input type="text" class="form-control" id="vid-url-input"
                                        placeholder="https://youtube.com/video_id" name="video_url"
                                        value="{{ old('video_url') ?? $service->video_url }}">
                                    <div class="invalid-feedback">Please enter a url.</div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        <!-- end row -->
                        {{-- Lebel 1 --}}
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="label-1-en-input">Label-1 Title (En)</label>
                                    <input type="text" class="form-control" id="label-1-en-input"
                                        placeholder="Like: Zone" name="label1_title[en]"
                                        value="{{ old('label1_title[en]') ?? $service->getTranslation('label1_title', 'en') }}">
                                    <div class="invalid-feedback">Please enter label-1 title.</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="label-1-ro-input">Label-1 Title (Ro)</label>
                                    <input type="text" class="form-control" id="label-1-ro-input"
                                        placeholder="Like: Area" name="label1_title[ro]"
                                        value="{{ old('label1_title[ro]') ?? $service->getTranslation('label1_title', 'ro') }}">
                                    <div class="invalid-feedback">Please enter label-1 title.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="label-1-options-brand-input">Label-1 Options</label>
                                    <input type="text" class="form-control" id="label-1-options-brand-input"
                                        placeholder="Like: FullBody, Chin, Neck..." name="label1_options"
                                        value="{{ old('label1_options') ?? $service->label1_options }}">
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <!-- end row -->
                        {{-- Lebel 2 --}}
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="label-2-en-input">Label-2 Title (En)</label>
                                    <input type="text" class="form-control" id="label-2-en-input"
                                        placeholder="Like: Number of Sessions" name="label2_title[en]"
                                        value="{{ old('label2_title[en]') ?? $service->getTranslation('label2_title', 'en') }}">
                                    <div class="invalid-feedback">Please enter label-2 title</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="label-2-ro-input">Label-2 Title (Ro)</label>
                                    <input type="text" class="form-control" id="label-2-ro-input"
                                        placeholder="Like: Numar Sedinte" name="label2_title[ro]"
                                        value="{{ old('label2_title[ro]') ?? $service->getTranslation('label2_title', 'ro') }}">
                                    <div class="invalid-feedback">Please enter label-2 title</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="label-2-options-brand-input">Label-2 Options</label>
                                    <input type="text" class="form-control" id="label-2-options-brand-input"
                                        placeholder="Like: 1, 3, 6" name="label2_options"
                                        value="{{ old('label2_options') ?? $service->label2_options }}">
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                </div>
                <!-- end card -->

                {{-- <div class="card">
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
                                <h5 class="card-title mb-1">FAQ</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">FAQ-1 Question (En)</label>
                                    <input type="text" class="form-control" id="manufacturer-name-input"
                                        placeholder="Enter question in english">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-brand-input">FAQ-1 Question (Ro)</label>
                                    <input type="text" class="form-control" id="manufacturer-brand-input"
                                        placeholder="Enter question in romanian">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">FAQ-1 Answer (En)</label>
                                    <textarea class="form-control" id="manufacturer-name-input" placeholder="Enter answer in english" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-brand-input">FAQ-1 Answer (Ro)</label>
                                    <textarea class="form-control" id="manufacturer-brand-input" placeholder="Enter answer in romanian" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div>
                </div> --}}
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-lg-4">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Slug</h5>
                    </div>
                    <div class="card-body">
                        <div class="hstack gap-3 align-items-start">
                            <div class="flex-grow-1">
                                <input class="form-control @error('slug') is-invalid @enderror" data-choices
                                    data-choices-multiple-remove="true" placeholder="Enter slug" type="text"
                                    value="{{ old('slug') ?? $service->slug }}" name="slug">
                                @error('slug')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Short Description</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="flex-grow-1">
                                <label for="seo-description" class="form-label">In English</label>
                                <textarea class="form-control" placeholder="Enter short description in english" rows="3"
                                    name="short_description[en]">{{ old('short_description.en') ?? $service->getTranslation('short_description', 'en') }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="flex-grow-1">
                                <label for="seo-description" class="form-label">In Romanian</label>
                                <textarea class="form-control" placeholder="Enter short description in romanian" rows="3"
                                    name="short_description[ro]">{{ old('short_description.ro') ?? $service->getTranslation('short_description', 'ro') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Status</label>

                            <select class="form-select" id="choices-publish-status-input" data-choices
                                data-choices-search-false name="status">
                                <option value="published" @selected($service->status == 'published')>Published</option>
                                <option value="draft" @selected($service->status == 'draft')>Draft</option>
                            </select>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">SEO</h5>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <div class="flex-grow-1">
                                <label for="seo-title" class="form-label">Title</label>
                                <input class="form-control" data-choices placeholder="Enter seo title" type="text"
                                    value="{{ old('seo_title') ?? $service->seo_title }}" name="seo_title">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="flex-grow-1">
                                <label for="seo-keywords" class="form-label">Keywords</label>
                                <input class="form-control" data-choices placeholder="Enter seo keywords" type="text"
                                    value="{{ old('seo_keywords') ?? $service->seo_keywords }}" name="seo_keywords">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="flex-grow-1">
                                <label for="seo-description" class="form-label">Description</label>
                                <textarea class="form-control" placeholder="Enter seo description" rows="3" name="seo_description">{{ old('seo_description') ?? $service->seo_description }}</textarea>
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
