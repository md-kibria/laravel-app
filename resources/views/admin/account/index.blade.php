@extends('layouts.admin.master')
@section('title')
    Settings
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Settings" pagetitle="Accounts" />

    <form action="/account/update" class="needs-validation" method="POST" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title rounded-circle bg-light text-primary fs-20">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">Profile Info</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div>
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" placeholder="Enter your name"
                                        value="{{ old('name') ?? $user->name }}" name="name">
                                    @error('name')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <div>
                                    <label for="image" class="form-label">Image <span class="text-danger"></span></label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" placeholder="Enter your image"
                                        value="{{ old('image') ?? $user->image }}" name="image">
                                    @error('image')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <div>
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" placeholder="Enter your email"
                                        value="{{ old('email') ?? $user->email }}" name="email">
                                    @error('email')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <div>
                                    <label for="phone" class="form-label">Phone <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" placeholder="Enter your phone"
                                        value="{{ old('phone') ?? $user->phone }}" name="phone">
                                    @error('phone')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label for="cityInput" class="form-label">City</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                        id="cityInput" placeholder="City" value="{{ old('city') ?? $user->city }}"
                                        name="city">
                                    @error('city')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label for="countryInput" class="form-label">Country</label>
                                    <input type="text" class="form-control @error('country') is-invalid @enderror"
                                        id="countryInput" placeholder="Country"
                                        value="{{ old('country') ?? $user->country }}" name="country">
                                    @error('country')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label for="zipcodeInput" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control @error('zip') is-invalid @enderror"
                                        minlength="5" maxlength="6" id="zipcodeInput" placeholder="Enter zipcode"
                                        value="{{ old('zip') ?? $user->zip }}" name="zip">
                                    @error('zip')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                        placeholder="Enter description" cols="30" rows="10">{{ old('description') ?? $user->description }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-secondary">Update Profile</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--edn row-->
                    </div>

                </div>
                <!-- end card -->

                <!-- end card -->
            </div>
            <div class="col-xl-3 col-lg-4">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Image</h5>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <img src="@if ($user->image) {{ asset('/storage/' . $user->image) }} @endif"
                                alt="" class="w-full" style="width: 100%;">
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

            </div>

            <!-- end col -->
            <!-- end row -->
    </form>

    <form action="/account/update-pass" class="needs-validation" method="POST">
        @method('POST')
        @csrf
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title rounded-circle bg-light text-primary fs-20">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">Change Password</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-4">
                                <div>
                                    <label for="oldpasswordInput" class="form-label">Old Password</label>
                                    <div class="position-relative auth-pass-inputgroup">
                                    <input type="password"
                                        class="form-control password-input @error('old-password') is-invalid @enderror"
                                        id="oldpasswordInput" placeholder="Enter current password" name="old-password"
                                        value="{{ old('old-password') }}">
                                    @error('old-password')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                        type="button" id="password-addon"><i
                                            class="ri-eye-fill align-middle"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-4">
                                <label class="form-label" for="password-input">Password</label>
                                <div class="position-relative auth-pass-inputgroup">
                                    <input type="password"
                                        class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                        placeholder="Enter password" id="password-input" name="password">
                                    @error('password')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                        type="button" id="password-addon"><i
                                            class="ri-eye-fill align-middle"></i></button>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <label class="form-label" for="confirm-password">Confirm Password</label>
                                <div class="position-relative auth-pass-inputgroup">
                                    <input type="password"
                                        class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                        placeholder="Confirm password" id="confirm-password"
                                        name="password_confirmation">
                                    @error('password')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                        type="button" id="confirm-password"><i
                                            class="ri-eye-fill align-middle"></i></button>
                                </div>
                            </div>

                            <!--end col-->
                            <div id="password-contain" class="p-3 bg-danger-subtle text-danger mb-2 rounded">
                                <h5 class="fs-15 mb-3">Password must contain:</h5>
                                <p id="pass-length" class="invalid fs-13 mb-2">Minimum <b>8 characters</b></p>
                                <p id="pass-lower" class="invalid fs-13 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                <p id="pass-upper" class="invalid fs-13 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                                <p id="pass-number" class="invalid fs-13 mb-0">A least <b>number</b> (0-9)</p>
                            </div>
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Change Password</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>

                </div>
                <!-- end card -->

                <!-- end card -->
            </div>

            <!-- end col -->
            <!-- end row -->
    </form>
@endsection
@section('scripts')
    <!-- nouisliderribute js -->
    <script src="{{ URL::asset('build/libs/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/passowrd-create.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
