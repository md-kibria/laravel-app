@extends('layouts.admin.master')
@section('title')
    Edit FAQ
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Edit FAQ" pagetitle="Service" />
    <form action="/admin/services/faq/{{$faq->id}}" class="needs-validation" enctype="multipart/form-data" method="POST">
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
                                        name="question[en]" value="{{ $faq->getTranslation('question', 'en') }}">
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
                                        name="question[ro]" value="{{ $faq->getTranslation('question', 'rp') }}">
                                    @error('question.ro')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">FAQ Answer (En)</label>
                                    <textarea class="form-control @error('answer.en') is-invalid @enderror" id="manufacturer-name-input"
                                        placeholder="Enter answer in english" rows="4" name="answer[en]">{{ $faq->getTranslation('answer', 'en') }}</textarea>
                                    @error('answer.en')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label @error('answer.ro') is-invalid @enderror"
                                        for="manufacturer-brand-input">FAQ Answer (Ro)</label>
                                    <textarea class="form-control" id="manufacturer-brand-input" placeholder="Enter answer in romanian" rows="4"
                                        name="answer[ro]">{{ $faq->getTranslation('answer', 'ro') }}</textarea>
                                    @error('answer.ro')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div>
                </div>
                {{-- <input type="hidden" name="service_id" value="{{ $service->id }}"> --}}
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-lg-4">

                {{-- <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Service Info</h5>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <h6>{{ $service->name }}</h6>
                            <p>{!! $service->description !!}</p>
                        </div>
                    </div>
                    <!-- end card body -->
                </div> --}}
                <!-- end card -->

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </form>

@endsection
@section('scripts')
@endsection
