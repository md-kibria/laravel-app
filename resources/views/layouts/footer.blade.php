<section class="section footer-landing pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer-info">
                    <div class="logo-dark d-flex align-items-center">
                        <img src="{{ config('logo') }}" alt="" class="logo-light" style="height: 100%; width: auto;">
                        <img src="{{ config('logo') }}" alt="" class="logo-dark" style="height: 100%; width: auto;">
                        {{-- <h5 class="px-2 m-0 text-white">{{ config('site_title') }}</h5> --}}
                    </div>
                    <p class="footer-desc mt-4 mb-2 me-3">{{ config('site_description') }}</p>

                    <div class="" style="display: none;">
                        {{ $socialMedias = App\Models\SocialMedia::all() }}
                    </div>

                    <div class="footer-social mt-4">
                        <ul class="list-inline mb-0">
                            @foreach ($socialMedias as $item)
                                @if ($item->name === 'facebook' && $item->url !== null)
                                    <li class="list-inline-item">
                                        <a href="{{ $item->url }}" class="text-reset" target="_blank" aria-label="facebook"><i
                                                class="mdi mdi-facebook"></i></a>
                                    </li>
                                @endif
                                @if ($item->name === 'instagram' && $item->url !== null)
                                    <li class="list-inline-item">
                                        <a href="{{ $item->url }}" class="text-reset" target="_blank" aria-label="instagram"><i
                                                class="mdi mdi-instagram"></i></a>
                                    </li>
                                @endif
                                @if ($item->name === 'twitter' && $item->url !== null)
                                    <li class="list-inline-item">
                                        <a href="{{ $item->url }}" class="text-reset" target="_blank" aria-label="twitter"><i
                                                class="mdi mdi-twitter"></i></a>
                                    </li>
                                @endif
                                @if ($item->name === 'youtube' && $item->url !== null)
                                    <li class="list-inline-item">
                                        <a href="{{ $item->url }}" class="text-reset" target="_blank" aria-label="youtube"><i
                                                class="mdi mdi-youtube"></i></a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row pl-0 pl-lg-3">

                    <div class="col-sm-6 col-md-4">
                        <div class="mt-lg-0 mt-4">
                            <h3 class="footer-title">
                                {{ session()->get('lang') === 'ro' ? 'Contactaţi-ne' : 'Contact Us' }}</h3>
                            <ul class="list-unstyled footer-link mt-3 ">
                                <li>
                                    <a href="tel:{{ config('site_phone') }}"
                                        class="text-white text-decoration-none fw-normal lh-sm lh-lg-md">
                                        @if (config('site_phone'))
                                            <i class="bi bi-telephone-outbound align-middle me-2"></i>
                                            {{ config('site_phone') }}
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:{{ config('site_email') }}"
                                        class="text-white text-decoration-none lh-sm lh-lg-md">
                                        <i class="bi bi-envelope align-middle me-2"></i> {{ config('site_email') }}
                                    </a>
                                </li>
                                <li>
                                    <span class="text-white text-decoration-none lh-sm lh-lg-md">
                                        <i class="bi bi-geo-alt align-middle me-2"></i> {{ config('site_address_street') }}
                                    </span>
                                </li>
                            </ul>
                           
                            <ul class="list-unstyled mb-0 text-white">
                                <li><i class="bi bi-chevron-double-right me-1"></i> <strong>{{ session()->get('lang') === 'ro' ? 'Luni' : 'Monday' }}:</strong> <span class="text-muted">12:00 – 20:00</span></li>
                                <li><i class="bi bi-chevron-double-right me-1"></i> <strong>{{ session()->get('lang') === 'ro' ? 'Marți – Vineri' : 'Tuesday – Friday' }}:</strong> <span class="text-muted">09:00 – 20:00</span></li>
                                <li><i class="bi bi-chevron-double-right me-1"></i> <strong>{{ session()->get('lang') === 'ro' ? 'Sâmbătă' : 'Saturday' }}:</strong> <span class="text-muted">09:00 – 17:00</span></li>
                                <li><i class="bi bi-chevron-double-right me-1"></i> <strong>{{ session()->get('lang') === 'ro' ? 'Duminică' : 'Sunday' }}:</strong> <span class="text-danger">{{ session()->get('lang') === 'ro' ? 'Închis' : 'Closed' }}</span></li>
                              </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mt-lg-0 mt-4">
                            <h3 class="footer-title">{{ session()->get('lang') === 'ro' ? 'Categorii' : 'Categories' }}
                            </h3>
                            <ul class="list-unstyled footer-link mt-3">
                                @foreach (config('categories') as $category)
                                    <li><a
                                            href="/services/?category={{ $category->id }}">{{ $category->getTranslation('title', session()->get('lang')) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="mt-lg-0 mt-4">
                            <h3 class="footer-title">
                                {{ session()->get('lang') === 'ro' ? 'Informaţii' : 'Information' }}</h3>
                            <ul class="list-unstyled footer-link mt-3">
                                <li><a href="/login">Sign In</a></li>
                                <li><a href="/account">Account</a></li>
                                <li><a
                                        href="/contact">{{ session()->get('lang') === 'ro' ? 'Contact' : 'Contact' }}</a>
                                </li>
                                <li><a
                                        href="/terms-conditions">{{ session()->get('lang') === 'ro' ? 'Termeni și condiții' : 'Terms & Conditions' }}</a>
                                </li>
                                <li><a
                                        href="/refund-policy">{{ session()->get('lang') === 'ro' ? 'Politica de rambursare' : 'Refund Policy' }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-2 d-flex flex-column justify-content-end">

                        <ul
                            class="mt-lg-0 mt-4 h-full list-unstyled footer-link mt-3 d-flex gap-2 flex-column justify-content-end">
                            <li>
                                <a href="https://anpc.ro/ce-este-sal/" target="_blank" aria-label="anpc">
                                    <img src="{{ URL::asset('img/payment/sol1.png') }}" alt=""
                                        class="w-100 rounded-4">
                                </a>
                            </li>
                            <li>
                                <a href="https://anpc.ro/ce-este-sal/" target="_blank" aria-label="anpc online">
                                    <img src="{{ URL::asset('img/payment/sol2.png') }}" alt=""
                                        class="w-100 rounded-4">
                                </a>
                            </li>
                            <li>
                                <a href="https://ec.europa.eu/consumers/odr/main/index.cfm?event=main.home2.show&lng=RO"
                                    target="_blank" aria-label="netopia">
                                    <img src="{{ URL::asset('img/payment/netopia.png') }}" alt=""
                                        class="w-100 rounded-4">
                                </a>
                            </li>
                        </ul>

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
                            <a href="#!" aria-label="visa"><img src="{{ URL::asset('img/payment/visa.png') }}"
                                    alt="" height="30"></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" aria-label="discover"><img
                                    src="{{ URL::asset('img/payment/discover.png') }}" alt=""
                                    height="30"></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" aria-label="american-express"><img
                                    src="{{ URL::asset('img/payment/american-express.png') }}" alt=""
                                    height="30"></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" aria-label="paypal"><img
                                    src="{{ URL::asset('img/payment/paypal.png') }}" alt=""
                                    height="30"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
