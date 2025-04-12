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
                    <h6 class="card-title mb-0">Create Categories</h6>
                </div>
                <div class="card-body">
                    <form autocomplete="off" class="needs-validation createCategory-form" action="/admin/categories"
                        enctype="multipart/form-data" method="POST">
                        @method('POST')
                        @csrf
                        <input type="hidden" id="categoryid-input" class="form-control" value="">
                        <div class="row">
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="categoryTitle" class="form-label">Category Title (En)<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="categoryTitle" placeholder="Enter title"
                                        required name="title[en]">
                                    <div class="invalid-feedback">Please enter a category title.</div>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="categoryTitle" class="form-label">Category Title (Ro)<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="categoryTitle" placeholder="Enter title"
                                        required name="title[ro]">
                                    <div class="invalid-feedback">Please enter a category title.</div>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="descriptionInput" class="form-label">Description (En)</label>
                                    <textarea class="form-control" id="descriptionInput" rows="3" placeholder="Description" name="description[en]"></textarea>
                                    <div class="invalid-feedback">Please enter a description.</div>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="descriptionInput" class="form-label">Description (Ro)</label>
                                    <textarea class="form-control" id="descriptionInput" rows="3" placeholder="Description" name="description[ro]"></textarea>
                                    <div class="invalid-feedback">Please enter a description.</div>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="slugInput" class="form-label">Slug <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="slugInput" placeholder="Enter slug"
                                        name="slug" required>
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
                                                <img src="#" alt="" id="category-img"
                                                    class="avatar-md h-auto rounded-3 object-fit-cover">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="error-msg mt-1">Please add a category images.</div>
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Add Category</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
        <div class="col-xxl-9">
            <div class="row justify-content-between mb-4">
                <div class="col-xxl-3 col-lg-6">
                    <div class="search-box mb-3 mb-lg-0">
                        <input type="text" class="form-control" id="searchInputList"
                            placeholder="Search Category...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <!--end col-->
                <div class="col-xxl-2 col-lg-6">
                    <select class="form-control" data-choices data-choices-search-false name="choices-single-default"
                        id="idStatus">
                        <option value="">Status</option>
                        <option value="all" selected>All</option>
                        <option value="Today">Today</option>
                        <option value="Yesterday">Yesterday</option>
                        <option value="Last 7 Days">Last 7 Days</option>
                        <option value="Last 30 Days">Last 30 Days</option>
                        <option value="This Month">This Month</option>
                        <option value="Last Month">Last Month</option>
                    </select>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                @foreach ($categories as $cat)
                    <div class="col-xxl-4 col-md-6">
                        <div class="card categrory-widgets overflow-hidden">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <h5 class="flex-grow-1 mb-0">{{ $cat->getTranslation('title', 'en') }}</h5>
                                    <ul class="flex-shrink-0 list-unstyled hstack gap-1 mb-0">
                                        <li><a href="/admin/categories/{{$cat->id}}/edit" class="badge bg-info-subtle text-info">Edit</a></li>
                                        <li><a href="#delteModal-{{$cat->slug}}" data-bs-toggle="modal"
                                                class="badge bg-danger-subtle text-danger">Delete</a></li>
                                    </ul>
                                </div>
                                <p class="text-muted overview-desc w-50">
                                    {{ substr($cat->getTranslation('description', 'en'), 0, 150) }}...</p>
                                <div class="mt-3">
                                    <a data-bs-toggle="offcanvas" href="#{{$cat->slug}}"
                                        class="fw-medium link-effect">Read More <i
                                            class="ri-arrow-right-line align-bottom ms-1"></i></a>
                                </div>
                                <img src="@if($cat->image) {{ asset('/storage/' . $cat->image) }} @else {{URL::asset('build/images/ecommerce/headphone.png')}} @endif" alt=""
                                    class="img-fluid category-img object-fit-cover">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--end row-->

            <div class="row" id="pagination-element">
                <div class="col-lg-12">
                    <div
                        class="pagination-block pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
                        <div class="page-item">
                            <a href="javascript:void(0);" class="page-link" id="page-prev">←</a>
                        </div>
                        <span id="page-num" class="pagination"></span>
                        <div class="page-item">
                            <a href="javascript:void(0);" class="page-link" id="page-next">→</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

    {{-- Details --}}
    @foreach ($categories as $cat)
        <div class="offcanvas offcanvas-end" tabindex="-1" id="{{$cat->slug}}"
            aria-labelledby="overviewOffcanvasLabel">
            <div class="offcanvas-header bg-primary-subtle">
                <h5 class="offcanvas-title" id="overviewOffcanvasLabel">#{{ $cat->slug }}<span class="overview-id"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="avatar-lg mx-auto">
                    <div class="avatar-title bg-light rounded">
                        <img src="@if($cat->image) {{ asset('/storage/' . $cat->image) }} @else build/images/ecommerce/clothes.png @endif" alt=""
                            class="avatar-sm overview-img">
                    </div>
                </div>
                <div class="text-center mt-3">
                    <h5 class="overview-title">{{ $cat->getTranslation('title', 'en') }}</h5>
                    <p class="text-muted">{{ $cat->getTranslation('title', 'ro') }}</p>
                </div>

                <h6 class="fs-14">Description (En)</h6>
                <p class="text-muted overview-desc">{{ $cat->getTranslation('description', 'en') }}</p>
                
                <h6 class="fs-14">Description (Ro)</h6>
                <p class="text-muted overview-desc">{{ $cat->getTranslation('description', 'ro') }}</p>
            </div>
            <div class="p-3 border-top">
                <div class="row">
                    <div class="col-sm-6">
                        <div data-bs-dismiss="offcanvas">
                            <button type="button" class="btn btn-danger w-100 remove-list" data-bs-toggle="modal"
                                data-bs-target="#delteModal-{{$cat->slug}}"><i class="ri-delete-bin-line me-1 align-bottom"></i>
                                Delete</button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="/admin/categories/{{$cat->id}}/edit" class="btn btn-secondary w-100 edit-list" data-bs-dismiss="offcanvas"><i
                                class="ri-pencil-line me-1 align-bottom"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- delteModal -->
    @foreach ($categories as $cat)
    <div id="delteModal-{{$cat->slug}}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" id="close-removecategoryModal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-md-5">
                    <div class="text-center">
                        <div class="text-danger">
                            <i class="bi bi-trash display-4"></i>
                        </div>
                        <div class="mt-4 fs-15">
                            <h4 class="mb-1">Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this category ?</p>
                        </div>
                    </div>
                    <form class="d-flex gap-2 justify-content-center mt-4 mb-2" action="/admin/categories/{{$cat->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn w-sm btn-light btn-hover"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn w-sm btn-danger btn-hover" id="remove-category">Yes, Delete
                            It!</button>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
@endsection
@section('scripts')
    <script src="{{ URL::asset('build/js/backend/product-categories.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
