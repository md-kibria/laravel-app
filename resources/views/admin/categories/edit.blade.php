@extends('layouts.admin.master')
@section('title')
    Categories
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Categories" pagetitle="Services" />

    <div class="row">
        <div class="col-xxl-3">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Update Categories</h6>
                </div>
                <div class="card-body">
                    <form autocomplete="off" class="needs-validation createCategory-form" action="/admin/categories/{{$category->id}}"
                        enctype="multipart/form-data" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" id="categoryid-input" class="form-control" value="">
                        <div class="row">
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="categoryTitle" class="form-label">Category Title (En)<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="categoryTitle" placeholder="Enter title"
                                        required name="title[en]" value="{{ $category->getTranslation('title', 'en') }}">
                                    <div class="invalid-feedback">Please enter a category title.</div>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="categoryTitle" class="form-label">Category Title (Ro)<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="categoryTitle" placeholder="Enter title"
                                        required name="title[ro]" value="{{ $category->getTranslation('title', 'ro') }}">
                                    <div class="invalid-feedback">Please enter a category title.</div>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="descriptionInput" class="form-label">Description (En)</label>
                                    <textarea class="form-control" id="descriptionInput" rows="3" placeholder="Description" name="description[en]">{{ $category->getTranslation('description', 'en') }}</textarea>
                                    <div class="invalid-feedback">Please enter a description.</div>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="descriptionInput" class="form-label">Description (Ro)</label>
                                    <textarea class="form-control" id="descriptionInput" rows="3" placeholder="Description" name="description[ro]">{{ $category->getTranslation('description', 'ro') }}</textarea>
                                    <div class="invalid-feedback">Please enter a description.</div>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="slugInput" class="form-label">Slug <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="slugInput" placeholder="Enter slug"
                                        name="slug" required value="{{ $category->slug }}">
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="category-image-input" class="form-label d-block">Image</label>

                                    <div class="position-relative d-inline-block">
                                        <div class="position-absolute top-100 start-100 translate-middle">
                                            <label for="category-image-input" class="mb-0" data-bs-toggle="tooltip"
                                                data-bs-placement="right" title="Select Category Image">
                                                <span class="avatar-xs d-inline-block">
                                                    <span
                                                        class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                        <i class="ri-image-fill"></i>
                                                    </span>
                                                </span>
                                            </label>
                                            <input class="form-control d-none" id="category-image-input" type="file"
                                                accept="image/png, image/gif, image/jpeg" name="image">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded-3">
                                                <img src="@if($category->image) {{ asset('/storage/' . $category->image) }} @else {{URL::asset('build/images/ecommerce/headphone.png')}} @endif" alt="" id="category-img"
                                                    class="avatar-md h-auto rounded-3 object-fit-cover">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="error-msg mt-1">Please add a category images.</div>
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Update Category</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
    <!--end row-->

@endsection
@section('scripts')
    <script src="{{ URL::asset('build/js/backend/product-categories.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
