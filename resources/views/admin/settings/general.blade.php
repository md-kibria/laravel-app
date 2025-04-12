@extends('layouts.admin.master')
@section('title')
    General Settings
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="General Settings" pagetitle="Settings" />
  
        <form action="{{ route('admin.settings.general.basic') }}" class="needs-validation" method="POST" enctype="multipart/form-data">
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
                                    <h5 class="card-title mb-1">Basic Info</h5>
                                    <p class="text-muted mb-0">Fill all information below.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="product-title-input" value="{{ old('title') ?? $settings->title }}" placeholder="Enter title"
                                    name="title">
                                @error('title')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Logo</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                    id="product-title-input" value="{{ old('logo') ?? $settings->logo }}" placeholder="Enter logo"
                                    name="logo">
                                @error('logo')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Favicon</label>
                                <input type="file" class="form-control @error('favicon') is-invalid @enderror"
                                    id="product-title-input" value="{{ old('favicon') ?? $settings->favicon }}" placeholder="Enter favicon"
                                    name="favicon">
                                @error('favicon')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Keywords</label>
                                <input type="text" class="form-control @error('keywords') is-invalid @enderror"
                                    id="product-title-input" value="{{ old('keywords') ?? $settings->keywords }}" placeholder="Enter keywords"
                                    name="keywords">
                                @error('keywords')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                           
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Site Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror" placeholder="Enter site description">{{ old('description') ?? $settings->description }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                             <div class="mb-3">
                                <label class="form-label" for="product-title-input">Registration No</label>
                                <input type="text" class="form-control @error('registration') is-invalid @enderror"
                                    id="product-title-input" value="{{ old('registration') ?? $settings->registration }}" placeholder="Enter registration"
                                    name="registration">
                                @error('registration')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                             
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Vat No</label>
                                <input type="text" class="form-control @error('vat') is-invalid @enderror"
                                    id="product-title-input" value="{{ old('vat') ?? $settings->vat }}" placeholder="Enter vat"
                                    name="vat">
                                @error('vat')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="text-end mb-3">
                                <button type="submit" class="btn btn-success w-sm">Submit</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
    
                    <!-- end card -->
                </div>
                <div class="col-xl-3 col-lg-4">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Logo</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Logo:</p>
                            <div class="">
                                <img src="@if ($settings->logo) {{ asset('/storage/' . $settings->logo) }} @endif"
                                    alt="" class="w-full" style="width: 100px;">
                            </div>
                           
                            <p class="text-muted pt-5">Favicon:</p>
                            <div class="">
                                <img src="@if ($settings->favicon) {{ asset('/storage/' . $settings->favicon) }} @endif"
                                    alt="" class="w-full" style="width: 100px;">
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
        
                </div>
        
                <!-- end col -->
                <!-- end row -->
        </form>
   
    <form action="{{ route('admin.settings.general.contact') }}" class="needs-validation" method="POST">
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
                                <h5 class="card-title mb-1">Contact Info</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                id="product-email-input" value="{{ old('email') ?? $settings->email }}" placeholder="Enter email"
                                name="email">
                            @error('email')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                id="product-title-input" value="{{ old('phone') ?? $settings->phone }}" placeholder="Enter phone"
                                name="phone">
                            @error('phone')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Street</label>
                            <input type="text" class="form-control @error('street') is-invalid @enderror"
                                id="product-title-input" value="{{ old('street') ?? $settings->street }}" placeholder="Enter street"
                                name="street">
                            @error('street')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">City</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror"
                                id="product-title-input" value="{{ old('city') ?? $settings->city }}" placeholder="Enter city"
                                name="city">
                            @error('city')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Region</label>
                            <input type="text" class="form-control @error('region') is-invalid @enderror"
                                id="product-title-input" value="{{ old('region') ?? $settings->region }}" placeholder="Enter region"
                                name="region">
                            @error('region')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Country</label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror"
                                id="country" value="{{ old('country') ?? $settings->country }}" placeholder="Enter country"
                                name="country">
                            @error('country')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <script>
                            document.getElementById("country").addEventListener("blur", function() {
                                let input = this.value.trim();
                                this.value = input.charAt(0).toUpperCase() + input.slice(1).toLowerCase();
                            });
                            </script>
                        
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Postal Code</label>
                            <input type="text" class="form-control @error('postalCode') is-invalid @enderror"
                                id="product-title-input" value="{{ old('postalCode') ?? $settings->postalCode }}" placeholder="Enter postalCode"
                                name="postalCode">
                            @error('postalCode')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Site URL</label>
                            <input type="text" class="form-control @error('url') is-invalid @enderror"
                                id="product-title-input" value="{{ old('url') ?? $settings->url }}" placeholder="Enter url"
                                name="url">
                            @error('url')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Longitude</label>
                            <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                id="product-title-input" value="{{ old('longitude') ?? $settings->longitude }}" placeholder="Enter longitude"
                                name="longitude">
                            @error('longitude')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Latitude</label>
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                id="product-title-input" value="{{ old('latitude') ?? $settings->latitude }}" placeholder="Enter latitude"
                                name="latitude">
                            @error('latitude')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Submit</button>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- end card -->
            </div>
            <!-- end col -->
            <!-- end row -->
    </form>
   
    <form action="{{ route('admin.settings.general.api_key') }}" class="needs-validation" method="POST">
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
                                <h5 class="card-title mb-1">Api Credentials</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Google Api Key</label>
                            <input type="text" class="form-control @error('google_key') is-invalid @enderror"
                                id="product-google_key-input" value="{{ old('google_key') ?? $settings->google_key }}" placeholder="Enter google api key"
                                name="google_key">
                            @error('google_key')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Stripe Api Key</label>
                            <input type="text" class="form-control @error('stripe_key') is-invalid @enderror"
                                id="product-title-input" value="{{ old('stripe_key') ?? $settings->stripe_key }}" placeholder="Enter stripe api key"
                                name="stripe_key">
                            @error('stripe_key')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Netopia Api Key</label>
                            <input type="text" class="form-control @error('netopia_key') is-invalid @enderror"
                                id="product-title-input" value="{{ old('netopia_key') ?? $settings->netopia_key }}" placeholder="Enter netopia api key"
                                name="netopia_key">
                            @error('netopia_key')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Netopia Signature</label>
                            <input type="text" class="form-control @error('netopia_signature') is-invalid @enderror"
                                id="product-title-input" value="{{ old('netopia_signature') ?? $settings->netopia_signature }}" placeholder="Enter netopia api key"
                                name="netopia_signature">
                            @error('netopia_signature')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Submit</button>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- end card -->
            </div>
            <!-- end col -->
            <!-- end row -->
        </div>
    </form>

@endsection
@section('scripts')
    <!-- ckeditor -->
    <script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/ckeditor.js') }}"></script>

    <!-- dropzone js -->
    <script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>
    <!-- create-product -->
    <script src="{{ URL::asset('build/js/backend/create-product.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
