<div class="top-tagbar">
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-4 col-9">
                <div class="fs-14 fw-medium">
                    <i class="bi bi-clock align-middle me-2"></i> <span id="current-time"></span>
                </div>
            </div>
            <div class="col-md-4 col-6 d-none d-xxl-block">
                <div class="d-flex align-items-center justify-content-center gap-3 fs-14 fw-medium">
                    @if (config('site_url'))
                        <div>
                            <i class="bi bi-globe align-middle me-2"></i> {{ config('site_url') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4 col-3">
                <div class="d-flex align-items-center justify-content-end gap-3 fs-14">
                    @if (config('site_email'))
                        <div class="text-reset fw-normal d-none d-lg-block">
                            <i class="bi bi-envelope align-middle me-2"></i> {{ config('site_email') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
