@extends('layouts.admin.master')
@section('title')
    Home Page
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Home Page" pagetitle="Pages" />
    <div>
        @foreach ($homepage_content as $item)
            @if ($item->section === 'header' || $item->section === 'overview' || $item->section === 'why_choose_us')
                <div class="row">
                    <form action="/admin/home-page" enctype="multipart/form-data" method="POST"
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
                                        <h5 class="card-title mb-1 text-capitalize">{{ $item->section }}</h5>
                                        <p class="text-muted mb-0">Fill all information below.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Sub Title (en)</label>
                                            <input type="text"
                                                class="form-control @error('sub_title.en') is-invalid @enderror"
                                                id="manufacturer-name-input" placeholder="Enter sub-title"
                                                name="sub_title[en]"
                                                value="{{ old('sub_title.en') ?? $item->getTranslation('sub_title', 'en') }}">
                                            @error('sub_title.en')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Sub Title (ro)</label>
                                            <input type="text"
                                                class="form-control @error('sub_title.ro') is-invalid @enderror"
                                                id="manufacturer-name-input" placeholder="Enter sub-title"
                                                name="sub_title[ro]"
                                                value="{{ old('sub_title.ro') ?? $item->getTranslation('sub_title', 'ro') }}">
                                            @error('sub_title.ro')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Title (en)</label>
                                            <input type="text"
                                                class="form-control @error('title.en') is-invalid @enderror"
                                                id="manufacturer-name-input" placeholder="Enter title" name="title[en]"
                                                value="{{ old('title.en') ?? $item->getTranslation('title', 'en') }}">
                                            @error('title.en')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Title (ro)</label>
                                            <input type="text"
                                                class="form-control @error('title.ro') is-invalid @enderror"
                                                id="manufacturer-name-input" placeholder="Enter title" name="title[ro]"
                                                value="{{ old('title.ro') ?? $item->getTranslation('title', 'ro') }}">
                                            @error('title.ro')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Description (en)</label>
                                            <textarea class="form-control @error('description.en') is-invalid @enderror" id="manufacturer-name-input" rows="4"
                                                placeholder="Enter description" name="description[en]">{{ old('description.en') ?? $item->getTranslation('description', 'en') }}</textarea>
                                            @error('description.en')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Description (ro)</label>
                                            <textarea class="form-control @error('description.ro') is-invalid @enderror" id="manufacturer-name-input" rows="4"
                                                placeholder="Enter description" name="description[ro]">{{ old('description.ro') ?? $item->getTranslation('description', 'ro') }}</textarea>
                                            @error('description.ro')
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

                                    <input type="hidden" name="section" value="{{ $item->section }}">
                                    <input type="hidden" name="type" value="general">

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
                                    <img src="@if ($item->image) {{ asset('/storage/' . $item->image) }} @endif"
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
            @endif
            @if ($item->type === 'key_features')
                <div class="row">
                    <form action="/admin/home-page" enctype="multipart/form-data" method="POST"
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
                                        <h5 class="card-title mb-1 text-capitalize">{{ $item->section }}</h5>
                                        <p class="text-muted mb-0">Fill all information below.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Title (en)</label>
                                            <input type="text"
                                                class="form-control @error('title.en') is-invalid @enderror"
                                                id="manufacturer-name-input" placeholder="Enter title" name="title[en]"
                                                value="{{ old('title.en') ?? $item->getTranslation('title', 'en') }}">
                                            @error('title.en')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Title (ro)</label>
                                            <input type="text"
                                                class="form-control @error('title.ro') is-invalid @enderror"
                                                id="manufacturer-name-input" placeholder="Enter title" name="title[ro]"
                                                value="{{ old('title.ro') ?? $item->getTranslation('title', 'ro') }}">
                                            @error('title.ro')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Description
                                                (en)</label>
                                            <textarea class="form-control @error('description.en') is-invalid @enderror" id="manufacturer-name-input"
                                                rows="4" placeholder="Enter description" name="description[en]">{{ old('description.en') ?? $item->getTranslation('description', 'en') }}</textarea>
                                            @error('description.en')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Description
                                                (ro)</label>
                                            <textarea class="form-control @error('description.ro') is-invalid @enderror" id="manufacturer-name-input"
                                                rows="4" placeholder="Enter description" name="description[ro]">{{ old('description.ro') ?? $item->getTranslation('description', 'ro') }}</textarea>
                                            @error('description.ro')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Image</label>
                                            <input type="file"
                                                class="form-control @error('image') is-invalid @enderror"
                                                id="manufacturer-name-input" placeholder="Enter image" name="image"
                                                value="{{ old('image') }}">
                                            @error('image')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <input type="hidden" name="section" value="{{ $item->section }}">
                                    <input type="hidden" name="type" value="key_features">

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
                                    <img src="@if ($item->image) {{ asset('/storage/' . $item->image) }} @endif"
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
            @endif
            @if ($item->type === 'featured_promotion')
                <div class="row">
                    <form action="/admin/home-page" enctype="multipart/form-data" method="POST"
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
                                        <h5 class="card-title mb-1 text-capitalize">{{ $item->section }}</h5>
                                        <p class="text-muted mb-0">Fill all information below.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Sub Title (en)</label>
                                            <input type="text"
                                                class="form-control @error('sub_title.en') is-invalid @enderror"
                                                id="manufacturer-name-input" placeholder="Enter sub-title"
                                                name="sub_title[en]"
                                                value="{{ old('sub_title.en') ?? $item->getTranslation('sub_title', 'en') }}">
                                            @error('sub_title.en')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Sub Title (ro)</label>
                                            <input type="text"
                                                class="form-control @error('sub_title.ro') is-invalid @enderror"
                                                id="manufacturer-name-input" placeholder="Enter sub-title"
                                                name="sub_title[ro]"
                                                value="{{ old('sub_title.ro') ?? $item->getTranslation('sub_title', 'ro') }}">
                                            @error('sub_title.ro')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Title (en)</label>
                                            <input type="text"
                                                class="form-control @error('title.en') is-invalid @enderror"
                                                id="manufacturer-name-input" placeholder="Enter title" name="title[en]"
                                                value="{{ old('title.en') ?? $item->getTranslation('title', 'en') }}">
                                            @error('title.en')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Title (ro)</label>
                                            <input type="text"
                                                class="form-control @error('title.ro') is-invalid @enderror"
                                                id="manufacturer-name-input" placeholder="Enter title" name="title[ro]"
                                                value="{{ old('title.ro') ?? $item->getTranslation('title', 'ro') }}">
                                            @error('title.ro')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">link</label>
                                            <input type="link"
                                                class="form-control @error('link') is-invalid @enderror"
                                                id="manufacturer-name-input" placeholder="Enter link" name="link"
                                                value="{{ old('link') ?? $item->link }}">
                                            @error('link')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Image</label>
                                            <input type="file"
                                                class="form-control @error('image') is-invalid @enderror"
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
                                                <option value="show" @selected($item->status === 'show')>Show</option>
                                                <option value="hide" @selected($item->status === 'hide')>Hide</option>
                                            </select>

                                            @error('status')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <input type="hidden" name="section" value="{{ $item->section }}">
                                    <input type="hidden" name="type" value="featured_promotion">

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
                                    <img src="@if ($item->image) {{ asset('/storage/' . $item->image) }} @endif"
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
            @endif
            @if ($item->section === 'featured_services')
                <div class="row">
                    <form action="/admin/home-page" enctype="multipart/form-data" method="POST"
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
                                        <h5 class="card-title mb-1 text-capitalize">{{ $item->section }}</h5>
                                        <p class="text-muted mb-0">Fill all information below.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row ">


                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Featured Service
                                                1</label>
                                            <select name="featured_service[1]" id="" class="form-control">
                                                <option value="">Select Service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Featured Service
                                                2</label>
                                            <select name="featured_service[2]" id="" class="form-control">
                                                <option value="">Select Service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Featured Service
                                                3</label>
                                            <select name="featured_service[3]" id="" class="form-control">
                                                <option value="">Select Service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Featured Service
                                                4</label>
                                            <select name="featured_service[4]" id="" class="form-control">
                                                <option value="">Select Service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="section" value="{{ $item->section }}">
                                    <input type="hidden" name="type" value="general">

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
                                <h5 class="card-title mb-0">Featured Services</h5>
                            </div>
                            <div class="card-body">
                                <ol class="">
                                    @foreach ($featured_services as $item)
                                        <li>{{$item->name}}</li>
                                    @endforeach
                                </ol>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            @endif
        @endforeach
    </div>
@endsection
@section('scripts')
@endsection
