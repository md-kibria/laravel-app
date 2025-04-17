@extends('layouts.admin.master')
@section('title')
    Create Variation Types
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Create Variation Types" pagetitle="Service" />
    <form action="/admin/services/{{$service->id}}/variation-types" class="needs-validation" enctype="multipart/form-data" method="POST">
        @method('POST')
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
                                        name="name[en]" value="{{ old('name.en') }}">
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
                                        name="name[ro]" value="{{ old('name.ro') }}">
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
                                        <option value="text" @selected(true)>Text</option>
                                        <option value="number">Number</option>
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

    @foreach ($variation_types as $type)
    <div class="col-12 col-md-12 col-lg-8 col-xl-9">
        <div class="card categrory-widgets overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <h5 class="flex-grow-1 mb-0">{{ $type->getTranslation('name', 'en') }}</h5>
                    <ul class="flex-shrink-0 list-unstyled hstack gap-1 mb-0">
                        <li><a href="/admin/services/variation-types/{{$type->id}}/variations" class="badge bg-success-subtle text-success">Variations</a></li>
                        <li><a href="/admin/services/variation-types/{{$type->id}}/edit" class="badge bg-info-subtle text-info">Edit</a></li>
                        <li><a href="#delteModal-{{$type->id}}" data-bs-toggle="modal"
                                class="badge bg-danger-subtle text-danger">Delete</a></li>
                    </ul>
                </div>
                <p class="text-muted overview-desc w-50">
                    {{-- {{ substr($type->getTranslation('answer', 'en'), 0, 150) }}...</p> --}}
                {{-- <img src="@if($type->image) {{ asset('/storage/' . $type->image) }} @else {{URL::asset('build/images/ecommerce/headphone.png')}} @endif" alt=""
                    class="img-fluid category-img object-fit-cover"> --}}
            </div>
        </div>
    </div>
    @endforeach

     <!-- delteModal -->
     @foreach ($variation_types as $type)
     <div id="delteModal-{{$type->id}}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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
                             <p class="text-muted mx-4 mb-0">Are you sure you want to remove this variation Type?</p>
                         </div>
                     </div>
                     <form class="d-flex gap-2 justify-content-center mt-4 mb-2" action="/admin/services/variation-types/{{$type->id}}/delete" method="POST">
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
<!-- nouisliderribute js -->
<script src="{{ URL::asset('build/libs/nouislider/nouislider.min.js') }}"></script>

<!-- App js -->
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
