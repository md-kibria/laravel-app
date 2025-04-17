<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{  config('logo') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <div class="d-flex py-3" style="justify-content: center; align-items: center;">
                    <img src="{{  config('logo') }}" alt="" height="40">
                    <h6 class="fs-3 fw-normal px-2 m-0">Admin</h6>
                </div>
            </span>
        </a>
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{  config('logo') }}" alt="" height="24">
            </span>
            <span class="logo-lg">
                <div class="d-flex py-3" style="justify-content: center; align-items: center;">
                    <img src="{{  config('logo') }}" alt="" height="40">
                    <h6 class="fs-3 fw-normal px-2 m-0">Admin</h6>
                </div>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">{{ __('Menu') }}</span></li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link menu-link"> <i class="bi bi-speedometer2"></i> <span data-key="t-dashboard">{{ __('Dashboard') }}</span> <span class="badge badge-pill bg-danger-subtle text-danger" data-key="t-hot">{{ __('Hot') }}</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProducts">
                        <i class="bi bi-box-seam"></i> <span data-key="t-products">{{ __('Services') }}</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/admin/services" class="nav-link" data-key="t-list-view">{{ __('List View') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/services/create" class="nav-link" data-key="t-create-product">{{ __('Create Service') }}</a>
                            </li>
                            <li class="nav-item">       
                                <a href="/admin/categories" class="nav-link" data-key="t-categories">{{ __('Categories') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="/admin/orders" >
                        <i class="bi bi-cart4"></i> <span data-key="t-orders">{{ __('Orders') }}</span>
                    </a>
                </li>


                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarInvoice" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoice">
                        <i class="bi bi-archive"></i> <span data-key="t-invoice">{{ __('t-invoice') }}</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarInvoice">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="invoices-list" class="nav-link" data-key="t-list-view">{{ __('t-list-view') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="invoices-details" class="nav-link" data-key="t-overview">{{ __('t-overview') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="invoices-create" class="nav-link" data-key="t-create-invoice">{{ __('t-create-invoice') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPosts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPosts">
                        <i class="mdi mdi-file-sign"></i> <span data-key="t-oosts">{{ __('Blog Posts') }}</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPosts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/admin/posts" class="nav-link" data-key="t-list-view">{{ __('View All') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/posts/create" class="nav-link" data-key="t-create-product">{{ __('Create Post') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/posts/comments" class="nav-link" data-key="t-create-product">{{ __('Comments') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users') }}" class="nav-link menu-link"> <i class="bi bi-person-bounding-box"></i> <span data-key="t-users-list">{{ __('All Users') }}</span> </a>
                </li>
  
                <li class="nav-item">
                    <a href="/admin/reviews-ratings" class="nav-link menu-link"><i class="bi bi-star"></i> <span data-key="t-reviews-ratings">{{ __('Reviews & Ratings') }}</span></a>
                </li>
               
                <li class="nav-item">
                    <a href="/admin/views" class="nav-link menu-link"><i class="bi bi-pie-chart"></i> <span data-key="t-statistics">{{ __('Visitors') }}</span> </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/subscribers" class="nav-link menu-link"><i class="bi bi-rss"></i> <span data-key="t-statistics">{{ __('Subscribers') }}</span> </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="/admin/account">
                        <i class="bi bi-person-circle"></i> <span data-key="t-account">{{ __('Account') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <i class="bi bi-window"></i> <span data-key="t-pages">{{ __('Pages') }}</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/admin/home-page" class="nav-link" data-key="home"> {{ __('Home Page') }} </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/promotions" class="nav-link" data-key="promotions"> {{ __('Promotions') }} </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/home-insta" class="nav-link" data-key="instagram"> {{ __('Instagram Images') }} </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/about-page" class="nav-link" data-key="about"> {{ __('About Page') }} </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/terms-conditions-page" class="nav-link" data-key="terms"> {{ __('Terms & Conditions') }} </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/refund-policy" class="nav-link" data-key="refund"> {{ __('Refund Policy') }} </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="/admin/messages" >
                        <i class="bi bi-envelope-check"></i> <span data-key="t-components">{{ __('Messages') }}</span> <span class="badge badge-pill bg-danger-subtle text-danger" data-key="t-hot">{{ config('msg_count') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSettings" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSettings">
                        <i class="bi bi-gear"></i> <span data-key="t-settings">{{ __('Settings') }}</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSettings">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.settings.general') }}" class="nav-link" data-key="t-general"> {{ __('General') }} </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.settings.social-media') }}" class="nav-link" data-key="t-social-media"> {{ __('Social Media') }} </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.settings.subscription') }}" class="nav-link" data-key="t-social-media"> {{ __('Subscription') }} </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>