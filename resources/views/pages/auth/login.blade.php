@extends('layouts.master-auth')

@section('title', 'Login')
@section('keywords', $keywords)
@section('description', 'Let\'s get login to your account')
@section('thumbnail', config('logo'))

@push('schema')
    <x-schema.schema-wrapper>
        <x-schema.organization />
        
        <x-schema.web-page :page="[
            'url' => request()->url(),
            'name' => 'Login',
            'datePublished' => $datePublished,
            'dateModified' => $datePublished,
        ]" />

        <x-schema.article :article="[
            'headline' => 'Login',
            'description' => 'Let\'s get login to your account',
            'keywords' => $keywords,
            'datePublished' => $datePublished,
            'dateModified' => $datePublished,
            'url' => request()->url(),
            'image' => config('logo'),
        ]" />
    </x-schema.schema-wrapper>
@endpush

@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <div class="w-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="auth-card mx-lg-3">
                        <div class="card border-0 mb-0">
                            <div class="card-header bg-primary border-0">
                                <div class="row">
                                    <div class="col-lg-8 col-12">
                                        <h1 class="text-white text-capitalize lh-base fw-lighter">Let's get login to your account</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-muted fs-15">Sign in to continue</p>
                                <div class="p-2">
                                    <form class="needs-validation" novalidate action="/auth" method="POST">
                                        @method('POST')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                placeholder="Enter email address" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="{{ route('password.reset') }}" class="text-muted">Forgot password?</a>
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" name="password"
                                                    class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                                    onpaste="return false" placeholder="Enter password" id="password-input"
                                                    aria-describedby="passwordInput"
                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" value="">
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="bi bi-eye align-middle"></i></button>
                                                @error('password')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                        </div>


                                    </form>
                                </div>
                                <div class="mt-4 text-center">
                                    <p class="mb-0">Don't have an account ? <a href="/signup"
                                            class="fw-semibold text-primary text-decoration-underline"> SignUp </a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </div>
@endsection
@section('scripts')
    <script src="{{ URL::asset('build/js/pages/password-match.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
@endsection
