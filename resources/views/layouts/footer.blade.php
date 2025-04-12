<section class="section footer-landing pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="footer-info">
                    <div class="logo-dark d-flex align-items-center">
                        <img src="{{ config('logo') }}" alt="" height="28"
                            class="logo-light" style="height: 100%">
                        <img src="{{ config('logo') }}" alt="" height="28"
                            class="logo-dark" style="height: 100%">
                        {{-- <h5 class="px-2 m-0 text-white">{{ config('site_title') }}</h5> --}}
                    </div>
                    <p class="footer-desc mt-4 mb-2 me-3">{{ config('site_description') }}</p>

                    <div class="" style="display: none;">

                        {{ $socialMedias = App\Models\SocialMedia::all() }}
                    </div>

                    <div class="footer-social mt-4">
                        <ul class="list-inline mb-0">
                            @foreach ($socialMedias as $item)
                                @if ($item->name === 'facebook')
                                    <li class="list-inline-item">
                                        <a href="{{ $item->url }}" class="text-reset" aria-label="facebook"><i
                                                class="mdi mdi-facebook"></i></a>
                                    </li>
                                @endif
                                @if ($item->name === 'instagram')
                                    <li class="list-inline-item">
                                        <a href="{{ $item->url }}" class="text-reset" aria-label="instagram"><i
                                                class="mdi mdi-instagram"></i></a>
                                    </li>
                                @endif
                                @if ($item->name === 'twitter')
                                    <li class="list-inline-item">
                                        <a href="{{ $item->url }}" class="text-reset" aria-label="twitter"><i
                                                class="mdi mdi-twitter"></i></a>
                                    </li>
                                @endif
                                @if ($item->name === 'youtube')
                                    <li class="list-inline-item">
                                        <a href="{{ $item->url }}" class="text-reset" aria-label="youtube"><i
                                                class="mdi mdi-youtube"></i></a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row pl-0 pl-lg-3">
                    <div class="col-md-4">
                        <div class="mt-lg-0 mt-4">
                            <h3 class="footer-title">{{ session()->get('lang') === 'ro' ? 'Categorii' : 'Categories' }}</h3>
                            <ul class="list-unstyled footer-link mt-3">
                                @foreach (config('categories') as $category)
                                <li><a href="/services/?category={{ $category->id }}">{{ $category->getTranslation('title', session()->get('lang')) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mt-lg-0 mt-4">
                            <h3 class="footer-title">{{ session()->get('lang') === 'ro' ? 'Informaţii' : 'Information' }}</h3>
                            <ul class="list-unstyled footer-link mt-3">
                                <li><a href="/about">{{ session()->get('lang') === 'ro' ? 'Despre' : 'About' }}</a></li>
                                <li><a href="/terms-conditions">{{ session()->get('lang') === 'ro' ? 'Termeni și condiții' : 'Terms & Conditions' }}</a></li>
                                <li><a href="/refund-policy">{{ session()->get('lang') === 'ro' ? 'Politica de rambursare' : 'Refund Policy' }}</a></li>
                                <li><a href="/contact">{{ session()->get('lang') === 'ro' ? 'Contact' : 'Contact' }}</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mt-lg-0 mt-4">
                            <h3 class="footer-title">{{ session()->get('lang') === 'ro' ? 'Contul meu' : 'My Account' }}</h3>
                            <ul class="list-unstyled footer-link mt-3">
                                <li><a href="/login">Sign In</a></li>
                                <li><a href="/checkout">Checkout</a></li>
                                <li><a href="/account">Account</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row footer-border-alt mt-4 align-items-center fs-15">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © {{ config('site_title') }}. All rights reserved
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#!" aria-label="visa"><img
                                    src="{{ URL::asset('img/payment/visa.png') }}" alt=""
                                    height="30"></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" aria-label="discover"><img
                                    src="{{ URL::asset('img/payment/discover.png') }}" alt=""
                                    height="30"></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" aria-label="american-express"><img
                                    src="{{ URL::asset('img/payment/american-express.png') }}"
                                    alt="" height="30"></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" aria-label="paypal"><img
                                    src="{{ URL::asset('img/payment/paypal.png') }}"
                                    alt="" height="30"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
