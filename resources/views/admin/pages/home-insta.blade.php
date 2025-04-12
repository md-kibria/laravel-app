@extends('layouts.admin.master')
@section('title')
    Instagram
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Instagram" pagetitle="Services" />

    <div class="row">
        <div class="col-xxl-3">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Add Image</h6>
                </div>
                <div class="card-body">
                    <form autocomplete="off" class="needs-validation createCategory-form" action="/admin/home-insta"
                        enctype="multipart/form-data" method="POST">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-xxl-12 col-lg-12">
                                <div class="mb-3">
                                    <label for="slugInput" class="form-label">Link <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="slugInput" placeholder="Enter link"
                                        name="link" required>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-12">
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

                                    <div class="error-msg mt-1">Please add a insta images.</div>
                                </div>
                            </div>
                            <input type="hidden" name="type" value="insta">
                            <div class="col-xxl-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
        <div class="col-xxl-9">
            
            <!--end row-->

            <div class="row">
                @foreach ($insta as $item)
                    <div class="col-xxl-4 col-md-4">

                        <div class="card">
                            <img class="card-img-top img-fluid" src="@if($item->image) {{ asset('/storage/' . $item->image) }} @else {{URL::asset('build/images/ecommerce/headphone.png')}} @endif" alt="Card image cap">
                            <div class="card-body">
                                <a href="{{ $item->link }}" class="card-text">{{ $item->link }}</a>
                                <form class="text-end pt-2" action="/admin/home-insta/{{ $item->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--end row-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->

    {{-- Details --}}
    {{-- @foreach ($categories as $cat)
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
    @endforeach --}}

    <!-- delteModal -->
    {{-- @foreach ($categories as $cat)
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
    @endforeach --}}
@endsection
@section('scripts')
    <script src="{{ URL::asset('build/js/backend/product-categories.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
