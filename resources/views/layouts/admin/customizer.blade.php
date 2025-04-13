<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-info btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<div class="customizer-setting d-none d-md-block">
    <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
        <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
    </div>
</div>

<!-- Theme Settings -->
<div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings-offcanvas">
    <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
        <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

        <button type="button" class="btn-close btn-close-white ms-auto" id="customizerclose-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div data-simplebar class="h-100">
            <div class="p-4">

                <!-- <h6 class="mb-1 fs-15 fw-semibold text-uppercase">View Website</h6>
                <p class="text-muted">Choose your</p> -->

                <div class="mb-4 hstack gap-2">
                    <a href="/" target="_blank" class="btn w-100 btn-secondary">Visit Your Website</a>
                    <a href="/services" target="_blank" class="btn w-100 btn-success">Services</a>
                </div>

                <h6 class="mb-1 fs-15 fw-semibold text-uppercase">Layout</h6>
                <p class="text-muted">Choose your layout</p>

                <div class="row gy-3">
                    <div class="col-6">
                        <div class="form-check card-radio customize-widget">
                            <input id="customizer-layout01" name="data-layout" type="radio" value="vertical" class="form-check-input">
                            <label class="form-check-label p-0 avatar-xl w-100" for="customizer-layout01">
                                <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                    <span class="d-flex align-items-center gap-1 ps-1">
                                        <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                    </span>
                                </span>
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-2">
                                            <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-2"></span>
                                            <span class="bg-light d-block p-2 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center mt-2">Vertical</h5>
                    </div>
                    <div class="col-6">
                        <div class="form-check card-radio customize-widget">
                            <input id="customizer-layout02" name="data-layout" type="radio" value="horizontal" class="form-check-input">
                            <label class="form-check-label p-0 avatar-xl w-100" for="customizer-layout02">
                                <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                    <span class="d-flex align-items-center gap-1 ps-1">
                                        <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                    </span>
                                </span>
                                <span class="d-flex h-100 flex-column gap-1">
                                    <span class="bg-light d-flex p-1 gap-1 align-items-center">
                                        <span class="d-block p-1 bg-primary-subtle rounded me-1"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-primary-subtle ms-auto"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-primary-subtle"></span>
                                    </span>
                                    <span class="bg-light d-block p-1"></span>
                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center mt-2">Horizontal</h5>
                    </div>
                    <div class="col-6">
                        <div class="form-check card-radio customize-widget">
                            <input id="customizer-layout03" name="data-layout" type="radio" value="twocolumn" class="form-check-input">
                            <label class="form-check-label p-0 avatar-xl w-100" for="customizer-layout03">
                                <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                    <span class="d-flex align-items-center gap-1 ps-1">
                                        <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                    </span>
                                </span>
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 bg-primary-subtle mb-2"></span>
                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-2">
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-2"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center mt-2">Two Column</h5>
                    </div>
                    <!-- end col -->
                </div>

                <h6 class="mt-4 mb-1 fs-15 fw-semibold text-uppercase">Color Scheme</h6>
                <p class="text-muted">Choose Light or Dark Scheme.</p>

                <div class="colorscheme-cardradio">
                    <div class="row gy-3">
                        <div class="col-6">
                            <div class="form-check card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-mode-light" value="light">
                                <label class="form-check-label p-0 avatar-xl w-100" for="layout-mode-light">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Light</h5>
                        </div>

                        <div class="col-6">
                            <div class="form-check card-radio dark customize-widget">
                                <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-mode-dark" value="dark">
                                <label class="form-check-label p-0 avatar-xl w-100 bg-dark" for="layout-mode-dark">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light bg-opacity-10 d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-light bg-opacity-10 rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-light bg-opacity-10"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-light bg-opacity-10"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-light bg-opacity-10"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light bg-opacity-10 d-block p-1"></span>
                                                <span class="bg-light bg-opacity-10 d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Dark</h5>
                        </div>
                    </div>
                </div>

                <div id="layout-width">
                    <h6 class="mt-4 mb-1 fs-15 fw-semibold text-uppercase">Layout Width</h6>
                    <p class="text-muted">Choose Fluid or Boxed layout.</p>

                    <div class="row gy-3">
                        <div class="col-6">
                            <div class="form-check card-radio customize-widget" data-bs-toggle="collapse" data-bs-target="#collapseLayoutWidth.show">
                                <input class="form-check-input" type="radio" name="data-layout-width" id="layout-width-fluid" value="fluid">
                                <label class="form-check-label p-0 avatar-xl w-100" for="layout-width-fluid">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Fluid</h5>
                        </div>
                        <div class="col-6">
                            <div class="form-check card-radio customize-widget collapsed" data-bs-toggle="collapse" data-bs-target="#collapseLayoutWidth">
                                <input class="form-check-input" type="radio" name="data-layout-width" id="layout-width-boxed" value="boxed">
                                <label class="form-check-label p-0 avatar-xl w-100" for="layout-width-boxed">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100 border-start border-end px-3">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Boxed</h5>
                        </div>
                    </div>
                </div>

                <div class="collapse" id="collapseLayoutWidth">
                    <h6 class="mt-4 mb-1 fs-15 fw-semibold text-uppercase">Boxed Layout Body Images</h6>
                    <p class="text-muted">Choose image.</p>
                
                    <div class="row gy-3">
                        <div class="col-6">
                            <div class="form-check card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-body-image" id="data-body-image-none" value="none">
                                <label class="form-check-label p-0 avatar-xl w-100" for="data-body-image-none">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100 border-start border-end px-3">
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">None</h5>
                        </div><!--end col-->
                        <div class="col-6">
                            <div class="form-check card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-body-image" id="data-body-image-1" value="img-1">
                                <label class="form-check-label p-0 avatar-xl w-100" for="data-body-image-1">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100 border-start border-end px-3" style="background-image: url('build/images/sidebar/body-light-1.png');">
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Img 1</h5>
                        </div><!--end col-->
                        <div class="col-6">
                            <div class="form-check card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-body-image" id="data-body-image-2" value="img-2">
                                <label class="form-check-label p-0 avatar-xl w-100" for="data-body-image-2">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100 border-start border-end px-3" style="background-image: url('build/images/sidebar/body-light-2.png');">
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Img 2</h5>
                        </div><!--end col-->
                        <div class="col-6">
                            <div class="form-check card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-body-image" id="data-body-image-3" value="img-3">
                                <label class="form-check-label p-0 avatar-xl w-100" for="data-body-image-3">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100 border-start border-end px-3" style="background-image: url('build/images/sidebar/body-light-3.png');">
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Img 3</h5>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>

                <div id="layout-position">
                    <h6 class="mt-4 mb-1 fs-15 fw-semibold text-uppercase">Layout Position</h6>
                    <p class="text-muted">Choose Fixed or Scrollable Layout Position.</p>

                    <div class="btn-group radio" role="group">
                        <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed" value="fixed">
                        <label class="btn btn-light w-sm" for="layout-position-fixed">Fixed</label>

                        <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-scrollable" value="scrollable">
                        <label class="btn btn-light w-sm ms-0" for="layout-position-scrollable">Scrollable</label>
                    </div>
                </div>
                <h6 class="mt-4 mb-1 fs-15 fw-semibold text-uppercase">Topbar Color</h6>
                <p class="text-muted">Choose Light or Dark Topbar Color.</p>

                <div class="row gy-3">
                    <div class="col-6">
                        <div class="form-check card-radio customize-widget">
                            <input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-light" value="light">
                            <label class="form-check-label p-0 avatar-xl w-100" for="topbar-color-light">
                                <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                    <span class="d-flex align-items-center gap-1 ps-1">
                                        <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                    </span>
                                </span>
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center mt-2">Light</h5>
                    </div>
                    <div class="col-6">
                        <div class="form-check card-radio customize-widget">
                            <input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-dark" value="dark">
                            <label class="form-check-label p-0 avatar-xl w-100" for="topbar-color-dark">
                                <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                    <span class="d-flex align-items-center gap-1 ps-1">
                                        <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                    </span>
                                </span>
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-dark d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center mt-2">Dark</h5>
                    </div>

                    <div class="col-6">
                        <div class="form-check card-radio customize-widget">
                            <input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-brand" value="brand">
                            <label class="form-check-label p-0 avatar-xl w-100" for="topbar-color-brand">
                                <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                    <span class="d-flex align-items-center gap-1 ps-1">
                                        <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                    </span>
                                </span>
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-primary d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center mt-2">Brand</h5>
                    </div>
                </div>

                <div id="sidebar-size">
                    <h6 class="mt-4 mb-1 fs-15 fw-semibold text-uppercase">Sidebar Size</h6>
                    <p class="text-muted">Choose a size of Sidebar.</p>

                    <div class="row gy-3">
                        <div class="col-6">
                            <div class="form-check sidebar-setting card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-default" value="lg">
                                <label class="form-check-label p-0 avatar-xl w-100" for="sidebar-size-default">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Default</h5>
                        </div>

                        <div class="col-6">
                            <div class="form-check sidebar-setting card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-compact" value="md">
                                <label class="form-check-label p-0 avatar-xl w-100" for="sidebar-size-compact">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Compact</h5>
                        </div>

                        <div class="col-6">
                            <div class="form-check sidebar-setting card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-small" value="sm">
                                <label class="form-check-label p-0 avatar-xl w-100" for="sidebar-size-small">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1">
                                                <span class="d-block p-1 bg-primary-subtle mb-2"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Small (Icon View)</h5>
                        </div>

                        <div class="col-6">
                            <div class="form-check sidebar-setting card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-small-hover" value="sm-hover">
                                <label class="form-check-label p-0 avatar-xl w-100" for="sidebar-size-small-hover">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1">
                                                <span class="d-block p-1 bg-primary-subtle mb-2"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Small Hover View</h5>
                        </div>
                    </div>
                </div>

                <div id="sidebar-view">
                    <h6 class="mt-4 mb-1 fs-15 fw-semibold text-uppercase">Sidebar View</h6>
                    <p class="text-muted">Choose Default or Detached Sidebar view.</p>

                    <div class="row gy-3">
                        <div class="col-6">
                            <div class="form-check sidebar-setting card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-layout-style" id="sidebar-view-default" value="default">
                                <label class="form-check-label p-0 avatar-xl w-100" for="sidebar-view-default">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Default</h5>
                        </div>
                        <div class="col-6">
                            <div class="form-check sidebar-setting card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-layout-style" id="sidebar-view-detached" value="detached">
                                <label class="form-check-label p-0 avatar-xl w-100" for="sidebar-view-detached">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex h-100 flex-column">
                                        <span class="bg-light d-flex p-1 gap-1 align-items-center px-2">
                                            <span class="d-block p-1 bg-primary-subtle rounded me-1"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-primary-subtle ms-auto"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-primary-subtle"></span>
                                        </span>
                                        <span class="d-flex gap-1 h-100 p-1 px-2">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                </span>
                                            </span>
                                        </span>
                                        <span class="bg-light d-block p-1 mt-auto px-2"></span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Detached</h5>
                        </div>
                    </div>
                </div>
                <div id="sidebar-color">
                    <h6 class="mt-4 mb-1 fs-15 fw-semibold text-uppercase">Sidebar Color</h6>
                    <p class="text-muted">Choose a color of Sidebar.</p>

                    <div class="row gy-3">
                        <div class="col-6">
                            <div class="form-check sidebar-setting card-radio customize-widget" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-light" value="light">
                                <label class="form-check-label p-0 avatar-xl w-100" for="sidebar-color-light">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-white border-end d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Light</h5>
                        </div>
                        <div class="col-6">
                            <div class="form-check sidebar-setting card-radio customize-widget" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-dark" value="dark">
                                <label class="form-check-label p-0 avatar-xl w-100" for="sidebar-color-dark">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-dark d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-light bg-opacity-10 rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-light bg-opacity-10"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-light bg-opacity-10"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-light bg-opacity-10"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Dark</h5>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-link avatar-xl w-100 p-0 overflow-hidden border collapsed customize-widget" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient" aria-expanded="false" aria-controls="collapseBgGradient">
                                <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                    <span class="d-flex align-items-center gap-1 ps-1">
                                        <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                        <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                    </span>
                                </span>
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-vertical-gradient d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-light bg-opacity-10 rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </button>
                            <h5 class="fs-14 text-center mt-2">Gradient</h5>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="collapse" id="collapseBgGradient">
                        <div class="d-flex gap-2 flex-wrap img-switch p-2 px-3 bg-light rounded">

                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient" value="gradient">
                                <label class="form-check-label p-0 avatar-xs rounded-circle" for="sidebar-color-gradient">
                                    <span class="avatar-title rounded-circle bg-vertical-gradient"></span>
                                </label>
                            </div>
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient-2" value="gradient-2">
                                <label class="form-check-label p-0 avatar-xs rounded-circle" for="sidebar-color-gradient-2">
                                    <span class="avatar-title rounded-circle bg-vertical-gradient-2"></span>
                                </label>
                            </div>
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient-3" value="gradient-3">
                                <label class="form-check-label p-0 avatar-xs rounded-circle" for="sidebar-color-gradient-3">
                                    <span class="avatar-title rounded-circle bg-vertical-gradient-3"></span>
                                </label>
                            </div>
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient-4" value="gradient-4">
                                <label class="form-check-label p-0 avatar-xs rounded-circle" for="sidebar-color-gradient-4">
                                    <span class="avatar-title rounded-circle bg-vertical-gradient-4"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="sidebar-img">
                    <h6 class="mt-4 mb-1 fs-15 fw-semibold text-uppercase">Sidebar Images</h6>
                    <p class="text-muted">Choose a image of Sidebar.</p>

                    
                    <div class="img-switch">
                        <div class="row gy-3">
                            <div class="col-6">
                                <div class="form-check sidebar-setting card-radio customize-widget">
                                    <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-none" value="none">
                                    <label class="form-check-label p-0 avatar-xl w-100" for="sidebarimg-none">
                                        <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                            <span class="d-flex align-items-center gap-1 ps-1">
                                                <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                                <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                                <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                            </span>
                                        </span>
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-2 d-flex align-items-center justify-content-center">
                                                    <i class="ri-close-fill fs-20"></i>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check sidebar-setting card-radio customize-widget">
                                    <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-01" value="img-1">
                                    <label class="form-check-label p-0 avatar-xl w-100" for="sidebarimg-01">
                                        <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                            <span class="d-flex align-items-center gap-1 ps-1">
                                                <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                                <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                                <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                            </span>
                                        </span>
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/sidebar/img-1.jpg') }}" alt="" class="avatar-sm h-100 object-fit-cover">
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="form-check sidebar-setting card-radio customize-widget">
                                    <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-02" value="img-2">
                                    <label class="form-check-label p-0 avatar-xl w-100" for="sidebarimg-02">
                                        <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                            <span class="d-flex align-items-center gap-1 ps-1">
                                                <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                                <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                                <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                            </span>
                                        </span>
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/sidebar/img-2.jpg') }}" alt="" class="avatar-sm h-100 object-fit-cover">
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="form-check sidebar-setting card-radio customize-widget">
                                    <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-03" value="img-3">
                                    <label class="form-check-label p-0 avatar-xl w-100" for="sidebarimg-03">
                                        <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                            <span class="d-flex align-items-center gap-1 ps-1">
                                                <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                                <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                                <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                            </span>
                                        </span>
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/sidebar/img-3.jpg') }}" alt="" class="avatar-sm h-100 object-fit-cover">
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="form-check sidebar-setting card-radio customize-widget">
                                    <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-04" value="img-4">
                                    <label class="form-check-label p-0 avatar-xl w-100" for="sidebarimg-04">
                                        <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                            <span class="d-flex align-items-center gap-1 ps-1">
                                                <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                                <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                                <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                            </span>
                                        </span>
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/sidebar/img-4.jpg') }}" alt="" class="avatar-sm h-100 object-fit-cover">
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                </div>

                <div id="preloader-menu">
                    <h6 class="mt-4 mb-1 fs-15 fw-semibold text-uppercase">Preloader</h6>
                    <p class="text-muted">Choose a preloader.</p>

                    <div class="row gy-3">
                        <div class="col-6">
                            <div class="form-check sidebar-setting card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-preloader" id="preloader-view-custom" value="enable">
                                <label class="form-check-label p-0 avatar-xl w-100" for="preloader-view-custom">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <!-- <div id="preloader"> -->
                                    <span class="d-flex align-items-center justify-content-center">
                                        <span class="spinner-border text-primary avatar-xxs m-auto" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </span>
                                    </span>
                                    <!-- </div> -->
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Enable</h5>
                        </div>
                        <div class="col-6">
                            <div class="form-check sidebar-setting card-radio customize-widget">
                                <input class="form-check-input" type="radio" name="data-preloader" id="preloader-view-none" value="disable">
                                <label class="form-check-label p-0 avatar-xl w-100" for="preloader-view-none">
                                    <span class="customize-penal-main w-100 d-block d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-1 ps-1">
                                            <span class="d-inline-block badge p-0 text-bg-danger rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-success rounded-circle"></span>
                                            <span class="d-inline-block badge p-0 text-bg-warning rounded-circle"></span>
                                        </span>
                                    </span>
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-14 text-center mt-2">Disable</h5>
                        </div>
                    </div>

                </div><!-- end preloader-menu -->
            </div>
        </div>

    </div>
    <div class="offcanvas-footer border-top p-3 text-center">
        <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
            </div>
            <div class="col-6">
                <a href="/admin/settings/general" class="btn btn-primary w-100">Settings</a>
            </div>
        </div>
    </div>
</div>