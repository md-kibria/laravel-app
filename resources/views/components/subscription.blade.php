<!-- start subscribe-->
<section class="section bg-light bg-opacity-25"
    style="background-image: url('build/images/ecommerce/bg-effect.png');background-position: center; background-size: cover;">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
                <div>
                    <p class="fs-15 text-uppercase fw-medium text-danger">
                        {{ $settings->getTranslation('subs_sub_title', session()->get('lang')) }}</p>
                    <h1 class="lh-base text-capitalize mb-3">
                        {{ $settings->getTranslation('subs_title', session()->get('lang')) }}</h1>
                    <p class="fs-15 mb-4 pb-2">{{ $settings->getTranslation('subs_desc', session()->get('lang')) }}</p>
                    <form action="{{ route('subscribe') }}" method="post" class="needs-validation">
                        @csrf
                        <div class="position-relative ecommerce-subscript">
                            <input type="email" name="email" class="form-control rounded-pill @error('email') is-invalid @enderror"
                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți adresa dvs. de e-mail' : 'Enter your email' }}" value="{{ old('email') }}">
                            <button type="submit"
                                class="btn btn-info btn-hover rounded-pill">{{ session()->get('lang') === 'ro' ? 'Abonați-vă acum' : 'Subscribe Now' }}</button>
                                @error('email')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                    </form>
                </div>
            </div>
            <!--end col-->
            <div class="col-lg-4">
                <div class="mt-5 mt-lg-0">
                    <img src="@if ($settings->subs_img) {{ asset('/storage/' . $settings->subs_img) }} @endif"
                        alt="" class="img-fluid">
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end conatiner-->
</section>
<!-- end subscribe-->
