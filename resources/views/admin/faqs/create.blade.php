@extends('layouts.admin.master')
@section('title')
    Create FAQ
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Create FAQ" pagetitle="Service" />
    <form action="/admin/services/faq" class="needs-validation" enctype="multipart/form-data" method="POST">
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
                                <h5 class="card-title mb-1">FAQ</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">FAQ Question (En)</label>
                                    <input type="text" class="form-control @error('question.en') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter question in english"
                                        name="question[en]" value="{{ old('question.en') }}">
                                    @error('question.en')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-brand-input">FAQ Question (Ro)</label>
                                    <input type="text" class="form-control @error('question.ro') is-invalid @enderror"
                                        id="manufacturer-brand-input" placeholder="Enter question in romanian"
                                        name="question[ro]" value="{{ old('question.ro') }}">
                                    @error('question.ro')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">FAQ Answer (En)</label>
                                    <textarea class="form-control @error('answer.en') is-invalid @enderror" id="manufacturer-name-input"
                                        placeholder="Enter answer in english" rows="4" name="answer[en]">{{ old('answer.en') }}</textarea>
                                    @error('answer.en')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label @error('answer.ro') is-invalid @enderror"
                                        for="manufacturer-brand-input">FAQ Answer (Ro)</label>
                                    <textarea class="form-control @error('answer.ro') is-invalid @enderror" id="manufacturer-brand-input" placeholder="Enter answer in romanian" rows="4"
                                        name="answer[ro]">{{ old('answer.ro') }}</textarea>
                                    @error('answer.ro')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div>
                </div>
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-lg-4">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Service Info</h5>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <h6>{{ $service->name }}</h6>
                            {{-- <p>{!! substr($service->description, 0, 450) !!}...</p> --}}
                            <p>{{ substr(html_entity_decode(strip_tags($service->description)), 0, 450) }}...</p>
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

    @foreach ($faqs as $faq)
    <div class="col-xxl-12 col-12 col-md-12 col-lg-8 col-xl-9">
        <div class="card categrory-widgets overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <h5 class="flex-grow-1 mb-0">{{ $faq->getTranslation('question', 'en') }}</h5>
                    <ul class="flex-shrink-0 list-unstyled hstack gap-1 mb-0">
                        <li><a href="/admin/services/faq/{{$faq->id}}/edit" class="badge bg-info-subtle text-info">Edit</a></li>
                        <li><a href="#delteModal-{{$faq->id}}" data-bs-toggle="modal"
                                class="badge bg-danger-subtle text-danger">Delete</a></li>
                    </ul>
                </div>
                <p class="text-muted overview-desc w-50">
                    {{ substr($faq->getTranslation('answer', 'en'), 0, 150) }}...</p>
                {{-- <img src="@if($faq->image) {{ asset('/storage/' . $faq->image) }} @else {{URL::asset('build/images/ecommerce/headphone.png')}} @endif" alt=""
                    class="img-fluid category-img object-fit-cover"> --}}
            </div>
        </div>
    </div>
    @endforeach

     <!-- delteModal -->
     @foreach ($faqs as $faq)
     <div id="delteModal-{{$faq->id}}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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
                             <p class="text-muted mx-4 mb-0">Are you sure you want to remove this FAQ ?</p>
                         </div>
                     </div>
                     <form class="d-flex gap-2 justify-content-center mt-4 mb-2" action="/admin/services/faq/{{$faq->id}}" method="POST">
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
