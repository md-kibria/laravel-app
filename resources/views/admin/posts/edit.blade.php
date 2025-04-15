@extends('layouts.admin.master')
@section('title')
    Edit post
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Edit post" pagetitle="post" />
    <form action="/admin/posts/{{ $post->id }}" class="needs-validation" enctype="multipart/form-data" method="POST">
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
                                <h5 class="card-title mb-1">Post Information</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">

                            <label class="form-label" for="post-title-input">Post title (En)</label>
                            <input type="text" class="form-control @error('title.en') is-invalid @enderror"
                                id="post-title-input" value="{{ old('title.en') ?? $post->getTranslation('title', 'en') }}" placeholder="Enter post title"
                                name="title[en]">
                            @error('title.en')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="post-title-input">Post title (Ro)</label>
                            <input type="text" class="form-control @error('title.ro') is-invalid @enderror"
                                id="post-title-input" value="{{ old('title.ro') ?? $post->getTranslation('title', 'ro') }}" placeholder="Enter post title"
                                name="title[ro]">
                            @error('title.ro')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Post content (En)</label>

                            <textarea type="text" class="form-control @error('content.en') is-invalid @enderror" id="service-dec-en"
                                placeholder="Enter content in English" name="content[en]">{{ old('content.en') ?? $post->getTranslation('content', 'en') }}</textarea>
                            @error('content.en')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Post content (Ro)</label>

                            <textarea type="text" class="form-control @error('content.ro') is-invalid @enderror" id="service-dec-ro"
                                placeholder="Enter content in Romanian" name="content[ro]">{{ old('content.ro') ?? $post->getTranslation('content', 'ro') }}</textarea>
                            @error('content.ro')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
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
                                    <img src="{{ $post->thumbnail ? asset('/storage/' . $post->thumbnail) : '#' }}" alt="" id="service-img"
                                        class="avatar-md h-auto rounded-3 object-fit-cover">
                                </div>
                            </div>

                        </div>

                        @error('thumbnail')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <!-- end card -->

               
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
                                <input class="form-control @error('slug') is-invalid @enderror" placeholder="Enter slug" type="text"
                                    value="{{ old('slug') ?? $post->slug }}" name="slug">
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
                        <h5 class="card-title mb-0">Excerpt</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="flex-grow-1">
                                <label for="excerpt" class="form-label">In English</label>
                                <textarea class="form-control @error('excerpt.en') is-invalid @enderror" placeholder="Enter excerpt in english" rows="3"
                                    name="excerpt[en]">{{ old('excerpt.en') ?? $post->getTranslation('excerpt', 'en') }}</textarea>
                                     @error('excerpt.en')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="flex-grow-1">
                                <label for="excerpt" class="form-label">In Romanian</label>
                                <textarea class="form-control @error('excerpt.ro') is-invalid @enderror" placeholder="Enter excerpt in romanian" rows="3"
                                    name="excerpt[ro]">{{ old('excerpt.ro') ?? $post->getTranslation('excerpt', 'ro') }}</textarea>
                                     @error('excerpt.ro')
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
                        <h5 class="card-title mb-0">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>

                            <select class="form-select" id="status" name="status">
                                <option value="published" @selected($post->status == 'published')>Published</option>
                                <option value="draft" @selected($post->status == 'draft')>Draft</option>
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
                                <label for="seo-keywords" class="form-label">Keywords</label>
                                <input class="form-control" placeholder="Enter seo keywords" type="text"
                                    value="{{ old('seo_keywords') ?? $post->seo_keywords }}" name="seo_keywords">
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
    <!-- Edit-product -->

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
