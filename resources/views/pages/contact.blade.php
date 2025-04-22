@extends('layouts.master')

@section('title', 'Contact')
@section('keywords', $keywords)
@section('description', 'We invite you to send us your phone number or email address so we can contact you! We will be happy to clarify things for you and set up an appointment!')
@section('thumbnail', config('logo'))

@push('schema')
    <x-schema.schema-wrapper>
        <x-schema.organization />
        
        <x-schema.web-page :page="[
            'url' => request()->url(),
            'name' => 'Contact',
            'datePublished' => $datePublished,
            'dateModified' => $dateModified,
        ]" />

        <x-schema.article :article="[
            'headline' => 'Contact',
            'description' => 'We invite you to send us your phone number or email address so we can contact you! We will be happy to clarify things for you and set up an appointment!',
            'keywords' => $keywords,
            'datePublished' => $datePublished,
            'dateModified' => $dateModified,
            'url' => request()->url(),
            'image' => config('logo'),
        ]" />
    </x-schema.schema-wrapper>
@endpush

@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <section class="term-condition bg-primary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center">
                        <h1 class="text-white mb-2">Contact Us</h1>
                        <p class="text-white-75 mb-0">We invite you to send us your phone number or email address so we
                            can contact you! We will be happy to clarify things for you and set up an appointment!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="position-relative">
        <div class="svg-shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="1440"
                height="120" preserveAspectRatio="none" viewBox="0 0 1440 120">
                <g mask="url(&quot;#SvgjsMask1039&quot;)" fill="none">
                    <rect width="1440" height="120" x="0" y="0" fill="var(--tb-primary)"></rect>
                    <path d="M 0,85 C 288,68.8 1152,20.2 1440,4L1440 120L0 120z" fill="var(--tb-body-bg)"></path>
                </g>
                <defs>
                    <mask id="SvgjsMask1039">
                        <rect width="1440" height="120" fill="#ffffff"></rect>
                    </mask>
                </defs>
            </svg>
        </div>
    </div>

    <section class="section pt-0">
        <div class="container">
            <div class="card term-card mb-0">
                <div class="card-body py-5">
                    <p class="w-50 text-center mx-auto"></p>

                    <div class="row">
                        <form action="/message" class="col-lg-6 px-5" style="border-right: 1px solid rgb(215, 218, 221)" method="POST">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <b class="text-muted mb-1" style="color: rgb(73, 80, 87)">Available 24/7</b>
                                <h2 class="mb-4" style="color: rgb(73, 80, 87)">Get In Touch</h2>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your name"
                                            id="firstNameinput" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email"
                                            id="email" value="{{ old('email') }}" name="email">
                                            @error('email')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <textarea class="form-control @error('message') is-invalid @enderror" placeholder="Enter your message" name="message" id="message" cols="30"
                                            rows="10">{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </div><!--end row-->
                        </form>

                        <div class="col-lg-6 px-5 pt-5 sm:pt-0" style="display: flex; flex-direction: column; justify-content: center">
                            <div class="d-flex py-2" style="gap: 10px;">
                                <div class="d-flex" style="border: 1px solid rgb(73, 80, 87); border-radius: 50%; height: 35px; width: 35px; align-items: center; justify-content: center;">
                                    <i class="fs-20 bi bi-geo-alt" style="color: rgb(73, 80, 87)"></i>
                                </div>
                                <div class="flex-grow-1" style="color: rgb(73, 80, 87);">
                                    <h3 class="fs-20" style="color: rgb(73, 80, 87)">Location</h3>
                                    <p class="" style="border-bottom: 1px solid rgb(215, 218, 221);">{{ $location }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex py-2" style="gap: 10px;">
                                <div class="d-flex" style="border: 1px solid rgb(73, 80, 87); border-radius: 50%; height: 35px; width: 35px; align-items: center; justify-content: center;">
                                    <i class="fs-20 bi bi-telephone" style="color: rgb(73, 80, 87)"></i>
                                </div>
                                <div class="flex-grow-1" style="color: rgb(73, 80, 87)">
                                    <h3 class="fs-20" style="color: rgb(73, 80, 87)">Phone Number</h3>
                                    <a href="tel:{{ $phone }}" class="d-block" style="border-bottom: 1px solid rgb(215, 218, 221); color: rgb(73, 80, 87);margin-bottom: 1rem;">{{ $phone }}</a>
                                </div>
                            </div>
                            
                            <div class="d-flex py-2" style="gap: 10px;">
                                <div class="d-flex" style="border: 1px solid rgb(73, 80, 87); border-radius: 50%; height: 35px; width: 35px; align-items: center; justify-content: center;">
                                    <i class="fs-20 bi bi-envelope" style="color: rgb(73, 80, 87)"></i>
                                </div>
                                <div class="flex-grow-1" style="color: rgb(73, 80, 87)">
                                    <h3 class="fs-20" style="color: rgb(73, 80, 87)">Email Address</h3>
                                    <a href="mailto:{{ $email }}" class="d-block" style="border-bottom: 1px solid rgb(215, 218, 221); color: rgb(73, 80, 87);margin-bottom: 1rem;">{{ $email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-subscription />

    <x-key-features />
@endsection
@section('scripts')
    <!-- landing-index js -->
    <script src="{{ URL::asset('build/js/frontend/menu.init.js') }}"></script>
@endsection
