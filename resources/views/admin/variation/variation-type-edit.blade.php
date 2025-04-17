@extends('layouts.admin.master')
@section('title')
    Edit Variation Types
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Edit Variation Types" pagetitle="Variation Types" />
    <form action="/admin/services/variation-types/{{$variation_type->id}}/update" class="needs-validation" enctype="multipart/form-data" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-xl-9 col-lg-8">


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
                                <h5 class="card-title mb-1">Variation Types</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Variation Types (En)</label>
                                    <input type="text" class="form-control @error('name.en') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter variation types in english"
                                        name="name[en]" value="{{ old('name.en') ?? $variation_type->getTranslation('name', 'en') }}">
                                    @error('name.en')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-brand-input">Variation Types (Ro)</label>
                                    <input type="text" class="form-control @error('name.ro') is-invalid @enderror"
                                        id="manufacturer-brand-input" placeholder="Enter variation types in romanian"
                                        name="name[ro]" value="{{ old('name.ro') ?? $variation_type->getTranslation('name', 'ro') }}">
                                    @error('name.ro')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Type</label>
                                    <select name="type" id=""
                                        class="form-control @error('type') is-invalid @enderror">
                                        <option value="">Select type</option>
                                        <option value="text" @selected($variation_type->type == 'text')>Text</option>
                                        <option value="number" @selected($variation_type->type == 'number')>Number</option>
                                    </select>
    
                                    @error('type')
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
        </div>
        <!-- end row -->
    </form>

@endsection
@section('scripts')
<!-- nouisliderribute js -->
<script src="{{ URL::asset('build/libs/nouislider/nouislider.min.js') }}"></script>

<!-- App js -->
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
