@extends('layouts.admin.master')
@section('title')
    Create Promotions
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Create Promotions" pagetitle="Home Page" />

    <div class="row">
        <form action="/admin/promotions" enctype="multipart/form-data" method="POST"
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
                            <h5 class="card-title mb-1 text-capitalize">Promotion</h5>
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
                                    value="{{ old('sub_title.en') }}">
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
                                    value="{{ old('sub_title.ro') }}">
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
                                    value="{{ old('title.en') }}">
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
                                    value="{{ old('title.ro') }}">
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
                                    value="{{ old('link') }}">
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
                                    <option value="show" @selected(true)>Show</option>
                                    <option value="hide">Hide</option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

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
    </div>
    

    @foreach ($promotions as $promo)
    <div class="col-12 col-md-12 col-lg-8 col-xl-8">
        <div class="card categrory-widgets overflow-hidden @if($promo->status == 'hide') bg-warning-subtle @endif">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <h6 class="text-muted flex-grow-1 mb-0">{{ $promo->getTranslation('sub_title', 'en') }}</h6>
                    <ul class="flex-shrink-0 list-unstyled hstack gap-1 mb-0">
                        <li><a href="/admin/promotions/{{$promo->id}}/edit" class="badge bg-info-subtle text-info">Edit</a></li>
                        <li><a href="#delteModal-{{$promo->id}}" data-bs-toggle="modal"
                                class="badge bg-danger-subtle text-danger">Delete</a></li>
                    </ul>
                </div>
                <h3 class="overview-desc w-50">
                    {{ $promo->getTranslation('title', 'en') }}</h3>
                {{-- <img src="@if($promo->image) {{ asset('/storage/' . $promo->image) }} @else {{URL::asset('build/images/ecommerce/headphone.png')}} @endif" alt=""
                    class="img-fluid category-img object-fit-cover"> --}}
            </div>
        </div>
    </div>
    @endforeach

     <!-- delteModal -->
     @foreach ($promotions as $promo)
     <div id="delteModal-{{$promo->id}}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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
                             <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Promotion ?</p>
                         </div>
                     </div>
                     <form class="d-flex gap-2 justify-content-center mt-4 mb-2" action="/admin/promotions/{{$promo->id}}" method="POST">
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
