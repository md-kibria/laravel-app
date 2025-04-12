    <div class="top-tagbar">
        <div class="w-100">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-4 col-9">
                    @if(config('site_address'))
                    <div class="fs-14 fw-medium">
                        <i class="bi bi-geo-alt align-middle me-2"></i> {{ config('site_address') }}
                    </div>
                    @endif
                </div>
                <div class="col-md-4 col-6 d-none d-xxl-block">
                    <div class="d-flex align-items-center justify-content-center gap-3 fs-14 fw-medium">
                        @if(config('site_email'))
                        <div>
                            <i class="bi bi-envelope align-middle me-2"></i> {{ config('site_email') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 col-3">
                    <div class="d-flex align-items-center justify-content-end gap-3 fs-14">
                        <div class="text-reset fw-normal d-none d-lg-block">
                            @if(config('site_phone'))
                            <i class="bi bi-telephone-outbound align-middle me-2"></i> {{ config('site_phone') }}
                            @endif
                        </div>
                        <hr class="vr d-none d-lg-block">
                        <div class="dropdown topbar-head-dropdown topbar-tag-dropdown justify-content-end">
                            <button type="button"
                                class="btn btn-icon btn-topbar text-reset rounded-circle fs-14 fw-medium"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @switch(Session::get('lang'))
                                    @case('ro')
                                        <img src="{{ URL::asset('build/images/flags/ro.svg') }}"
                                            class="rounded-circle me-2" alt="Header Language" height="16">
                                        <span id="lang-name">Românian</span>
                                    @break

                                    @default
                                        <img src="{{ URL::asset('build/images/flags/us.svg') }}" class="rounded-circle me-2"
                                            alt="Header Language" height="16">
                                        <span id="lang-name">English</span>
                                @endswitch
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="/change?lang=en" class="dropdown-item notify-item language py-2"
                                    data-lang="en" title="English">
                                    <img src="{{ URL::asset('build/images/flags/us.svg') }}" alt="user-image"
                                        class="me-2 rounded-circle" height="18">
                                    <span class="align-middle">English</span>
                                </a>

                                <!-- item-->
                                <a href="/change?lang=ro" class="dropdown-item notify-item language"
                                    data-lang="sp" title="Romania">
                                    <img src="{{ URL::asset('build/images/flags/ro.svg') }}" alt="user-image"
                                        class="me-2 rounded-circle" height="18">
                                    <span class="align-middle">Românian</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
