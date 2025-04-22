<nav class="navbar navbar-expand-lg ecommerce-navbar" id="navbar">
    <div class="container">
        <a class="navbar-brand d-none d-lg-block" href="/">
            <div class="logo-dark d-flex align-items-center">
                <img src="{{ config('logo') }}" alt="{{ config('site_title') }}"  style="height: 80%">
                {{-- <p class="px-2 m-0">{{ config('site_title') }}</p> --}}
            </div>
            <div class="logo-light">
                <img src="{{ config('logo') }}" alt="{{ config('site_title') }}" height="25">
            </div>
        </a>
        <button class="btn btn-soft-primary btn-icon d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-20"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-lg-auto mb-2 mb-lg-0" id="navigation-menu">
                 <li class="nav-item d-block d-lg-none">
                    <a class="d-block p-3 h-auto text-center" href="/">
                        <img src="{{ config('logo') }}" alt="{{ config('site_title') }}" height="50" class="card-logo-dark mx-auto">
                        <img src="{{ config('logo') }}" alt="{{ config('site_title') }}" height="50" class="card-logo-light mx-auto">
                    </a>
                </li>

                @foreach (config('categories') as $category)
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link dropdown-toggle" data-key="t-demos" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $category->getTranslation('title', session()->get('lang')) }}</a>
                    <ul class="dropdown-menu dropdown-menu-md dropdown-menu-center dropdown-menu-list submenu">
                        @foreach ($category->services as $service)
                        <li class="nav-item">
                            <a href="/{{ $service->slug }}" class="nav-link" data-key="t-main-layout">{{ $service->getTranslation('name', session()->get('lang')) }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach

                <li class="nav-item">
                    <a class="nav-link" href="/blogs" data-key="t-blogs">{{ session()->get('lang') === 'ro' ? 'Bloguri' : 'Blogs' }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about" data-key="t-about">{{ session()->get('lang') === 'ro' ? 'Despre' : 'About' }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact" data-key="t-contact">{{ session()->get('lang') === 'ro' ? 'Contact' : 'Contact' }}</a>
                </li>
            </ul>
        </div>
        <div class="bg-overlay navbar-overlay" data-bs-toggle="collapse"  data-bs-target="#navbarSupportedContent.show"></div>

        <div class="d-flex align-items-center">
            <a href="/" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle text-muted d-none" aria-label="Home" id="navHomeBtn">
                <i class="bi bi-house fs-22"></i>
            </a>
            <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle text-muted" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Search">
                <i class="bi bi-search fs-22"></i>
            </button>
            <div class="topbar-head-dropdown ms-1 header-item">
                <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle text-muted" data-bs-toggle="offcanvas" data-bs-target="#ecommerceCart" aria-controls="ecommerceCart" aria-label="Cart">
                    <i class="bi bi-cart3 fs-18"></i>
                    <span class="position-absolute topbar-badge cartitem-badge fs-10 translate-middle badge rounded-pill bg-danger" id="cartCount">{{ request()->cookie('cart') ? count(json_decode(request()->cookie('cart'), true)) : 0 }}</span>
                </button>
            </div>
    
            <div class="dropdown header-item dropdown-hover-end">
                <a href="/account" class="btn" id="page-header-user-dropdown" aria-haspopup="true" aria-expanded="false">
                    @auth
                    <img class="rounded-circle header-profile-user" src="@if(Auth::user()->image) {{ asset('/storage/' . Auth::user()->image) }} @else {{ URL::asset('img/default.png') }}@endif" alt="Header Avatar">
                    @endauth
                    @guest 
                    <img class="rounded-circle header-profile-user" src="{{ URL::asset('img/default.png') }}" alt="Header Avatar">
                    @endguest
                </a>
                <!-- <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ph-user-circle fs-22"></i>
                </button>    -->
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <h6 class="dropdown-header">Welcome {{ @Auth::user()->last_name }}!</h6>

                    @auth
                        
                    <a class="dropdown-item" href="/account"><i class="mdi mdi-account text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Account</span></a>
                    <a class="dropdown-item" href="/contact"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                    <a class="dropdown-item" href="/account"><span class="badge bg-success-subtle text-success mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a>
                    <a class="dropdown-item" href="{{ url('logout') }}"><i class="bi bi-box-arrow-right text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">{{ __('Logout') }}</span></a>
                    @endauth

                    @guest
                    <a class="dropdown-item" href="/login"><i class="mdi mdi-login text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Login</span></a>
                    <a class="dropdown-item" href="/signup"><i class="mdi mdi-account-arrow-left text-muted fs-16 align-middle me-1"></i> <span class="align-middle">SignUp</span></a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>

<!--cart -->
<livewire:cart />

<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content rounded" action="/services" method="get">
            <div class="modal-header p-3">
                <div class="position-relative w-100">
                    <input type="text" class="form-control form-control-lg border-2" placeholder="{{ session()->get('lang') === 'ro' ? 'Servicii de căutare' : 'Search Services' }}..." autocomplete="off" id="search-options" value="" name="keyword">
                    <span class="bi bi-search search-widget-icon fs-17"></span>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- removeItemModal -->
<div id="removeItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this product ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="remove-product">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- <div class="modal fade" id="subscribeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-body p-0 bg-info-subtle rounded">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-4 h-100">
                            <span class="badge bg-info-subtle text-info fs-13">GET 10% SALE OFF</span>
                            <h2 class="display-6 mt-2 mb-3">Subscribe & Get <b>50% Special</b> Discount On Email</h2>
                            <p class="mb-4 pb-lg-2 fs-16">Join our newsletter to receive the latest updates and promotion</p>
                            <form action="#!">
                                <div class="position-relative ecommerce-subscript">
                                    <input type="email" class="form-control rounded-pill border-0" placeholder="Enter your email">
                                    <button type="submit" class="btn btn-info btn-hover rounded-pill">Subscript</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-4 pb-0">
                            <img src="{{ URL::asset('build/images/subscribe.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- end modal -->

{{-- <a href="../backend/index" class="btn btn-warning position-fixed bottom-0 start-0 m-5 z-3 btn-hover d-none d-lg-block"><i class="bi bi-database align-middle me-1"></i> Backend</a> --}}

<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-info btn-icon" style="bottom: 50px;" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->