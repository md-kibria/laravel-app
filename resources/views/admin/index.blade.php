@extends('layouts.admin.master')
@section('title')
    Dashboard
@endsection
@section('css')
    <!-- extra css -->
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">

    <!--Swiper slider css-->
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row">
        <div class="col-xxl-3 col-lg-6 order-first">
            <div class="row row-cols-xxl-12">
                <div class="col">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="vr rounded bg-secondary opacity-50" style="width: 4px;"></div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-medium text-muted fs-14 text-truncate">Total Earnings</p>
                                    <h4 class="fs-22 fw-semibold mb-3">$<span class="counter-value"
                                            data-target="{{ $totalRevenue }}">0</span></h4>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ((int) $earningsChange < 0)
                                            <h5 class="badge bg-danger-subtle text-danger mb-0">
                                                <i class="ri-arrow-right-down-line align-bottom"></i> {{ $earningsChange }}
                                                %
                                            </h5>
                                        @else
                                            <h5 class="badge bg-success-subtle text-success mb-0">
                                                <i class="ri-arrow-right-up-line align-bottom"></i> {{ $earningsChange }} %
                                            </h5>
                                        @endif
                                        <p class="text-muted mb-0">than last week</p>
                                    </div>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-secondary-subtle text-secondary rounded fs-3">
                                        <i class="ph-wallet"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->
        </div>
        <div class="col-xxl-3 col-lg-6 order-first">
            <div class="row row-cols-xxl-12">
                <div class="col">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="vr rounded bg-info opacity-50" style="width: 4px;"></div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-medium text-muted fs-14 text-truncate">Orders</p>
                                    <h4 class="fs-22 fw-semibold mb-3"><span class="counter-value"
                                            data-target="{{ $totalOrders }}">0</span> </h4>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ((int) $ordersChange < 0)
                                            <h5 class="badge bg-danger-subtle text-danger mb-0">
                                                <i class="ri-arrow-right-down-line align-bottom"></i> {{ $ordersChange }} %
                                            </h5>
                                        @else
                                            <h5 class="badge bg-success-subtle text-success mb-0">
                                                <i class="ri-arrow-right-down-line align-bottom"></i> {{ $ordersChange }} %
                                            </h5>
                                        @endif
                                        <p class="text-muted mb-0">than last week</p>
                                    </div>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info-subtle text-info rounded fs-3">
                                        <i class="ph-storefront"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->
        </div>
        <div class="col-xxl-3 col-lg-6 order-first">
            <div class="row row-cols-xxl-12">
                <div class="col">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="vr rounded bg-warning opacity-50" style="width: 4px;"></div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-medium text-muted fs-14 text-truncate">Total Users</p>
                                    <h4 class="fs-22 fw-semibold mb-3"><span class="counter-value"
                                            data-target="{{ $totalUsers }}">0</span> </h4>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ((int) $usersChange < 0)
                                            <h5 class="badge bg-danger-subtle text-danger mb-0">
                                                <i class="ri-arrow-right-down-line align-bottom"></i> {{ $usersChange }} %
                                            </h5>
                                        @else
                                            <h5 class="badge bg-success-subtle text-success mb-0">
                                                <i class="ri-arrow-right-down-line align-bottom"></i> {{ $usersChange }} %
                                            </h5>
                                        @endif
                                        <p class="text-muted mb-0">than last week</p>
                                    </div>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning-subtle text-warning rounded fs-3">
                                        <i class="ph-user-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->
        </div>
        <div class="col-xxl-3 col-lg-6 order-first">
            <div class="row row-cols-xxl-12">
                <div class="col">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="vr rounded bg-primary opacity-50" style="width: 4px;"></div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-medium text-muted fs-14 text-truncate">Services</p>
                                    <h4 class="fs-22 fw-semibold mb-3"><span class="counter-value"
                                            data-target="{{ $totalServices }}">0</span> </h4>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ((int) $servicesChange < 0)
                                            <h5 class="badge bg-danger-subtle text-danger mb-0">
                                                <i class="ri-arrow-right-down-line align-bottom"></i> {{ $servicesChange }}
                                                %
                                            </h5>
                                        @else
                                            <h5 class="badge bg-success-subtle text-success mb-0">
                                                <i class="ri-arrow-right-down-line align-bottom"></i> {{ $servicesChange }}
                                                %
                                            </h5>
                                        @endif
                                        <p class="text-muted mb-0">than last week</p>
                                    </div>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary-subtle text-primary rounded fs-3">
                                        <i class="ph-sketch-logo"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->
        </div>
        <!--end col-->

        <div class="col-xxl-12 order-last">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-8">
                            <div id="line_chart_datalabel"
                                data-colors='["--tb-secondary", "--tb-secondary", "--tb-success"]' class="apex-charts"
                                dir="ltr"></div>
                        </div>
                        <div class="col-xxl-4">
                            <div class="d-flex align-items-center gap-3 mb-4 mt-3 mt-xxl-0">

                            </div>
                            <div class="row g-0 text-center">
                                <div class="col-6 col-sm-6">
                                    <div class="p-3 border border-dashed border-bottom-0">
                                        <h5 class="mb-1"><span class="counter-value"
                                                data-target="{{ $totalOrders }}">0</span></h5>
                                        <p class="text-muted mb-0">Orders</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-6">
                                    <div class="p-3 border border-dashed border-start-0 border-bottom-0">
                                        <h5 class="mb-1">$<span class="counter-value"
                                                data-target="{{ $totalRevenue }}">0</span>
                                        </h5>
                                        <p class="text-muted mb-0">Earnings</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-6">
                                    <div class="p-3 border border-dashed">
                                        <h5 class="mb-1"><span class="counter-value"
                                                data-target="{{ $totalBlogViews }}">0</span></h5>
                                        <p class="text-muted mb-0">Blogs Views</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-6">
                                    <div class="p-3 border border-dashed border-start-0">
                                        @if ((int) $earningsChange < 0)
                                            <h5 class="mb-1 text-danger"><span class="counter-value"
                                                    data-target="{{ $earningsChange }}">0</span>%</h5>
                                        @else
                                            <h5 class="mb-1 text-success"><span class="counter-value"
                                                    data-target="{{ $earningsChange }}">0</span>%</h5>
                                        @endif
                                        <p class="text-muted mb-0">Earning than last week</p>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->

                            <div class="card mt-4 mb-0 bg-info-subtle border-0">
                                <div class="card-body">
                                    <h5 class="fs-16">Reached The Target</h5>
                                    <p class="text-muted">Hey there! It's always awesome to reach your goals and boost
                                        productivity!</p>
                                    <a href="/views" class="btn btn-info btn-sm">See Analytics <i
                                            class="bi bi-arrow-right ms-1 align-middle"></i></a>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div><!-- end card body -->
            </div><!-- end card -->
            <div class="card overflow-hidden">
                <div class="position-absolute opacity-50 start-0 end-0 top-0 bottom-0"
                    style="background-image: url('build/images/sidebar/body-light-1.png');"></div>
                <div class="card-body d-flex justify-content-between align-items-center z-1">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <i class="ph-storefront display-6"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title fw-medium fs-17 mb-1">Want to Boost Your Audience? <b>Start a Blog!</b>
                            </h5>
                            <p class="mb-0">Blogging helps engage your audience, build trust, and drive more traffic to
                                your site.</p>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('admin.posts.create') }}"
                            class="btn btn-success btn-label btn-hover rounded-pill"><i
                                class="bi bi-box-seam label-icon align-middle rounded-pill fs-16 me-2"></i> Add New
                            Blog</a>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div><!-- end col -->
    </div>

    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">New Users</h4>
                    <a href="users-list" class="flex-shrink-0">View All <i
                            class="ri-arrow-right-line align-bottom ms-1"></i></a>
                </div><!-- end card header -->

                <div data-simplebar style="max-height: 445px;">
                    @foreach ($users as $user)
                        <div class="p-3 border-bottom border-bottom-dashed">
                            <div class="d-flex align-items-center gap-2">
                                <div class="flex-shrink-0">
                                    <img src="@if ($user->image) {{ asset('/storage/' . $user->image) }} @else {{ URL::asset('img/default.png') }} @endif"
                                        alt="" class="rounded dash-avatar">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $user->name }}</h6>
                                    <p class="fs-13 text-muted mb-0">
                                        {{ \Carbon\Carbon::parse($user->created_at)->toFormattedDateString() }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="mailto:{{ $user->email }}" class="btn btn-icon btn-sm btn-soft-danger"><i
                                            class="ph-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> <!-- .card-->
        </div> <!-- .col-->
        <div class="col-12 col-md-9">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Recent Orders</h4>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a href="/admin/orders" class="flex-shrink-0">View All <i
                                    class="ri-arrow-right-line align-bottom ms-1"></i></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Today</a>
                                <a class="dropdown-item" href="#">Yesterday</a>
                                <a class="dropdown-item" href="#">Last 7 Days</a>
                                <a class="dropdown-item" href="#">Last 30 Days</a>
                                <a class="dropdown-item" href="#">This Month</a>
                                <a class="dropdown-item" href="#">Last Month</a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-centered align-middle table-nowrap mb-0" id="customerTable">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <a href="/admin/orders/{{ $order->id }}"
                                                class="fw-medium link-primary">#{{ $order->id }}</a>
                                        </td>
                                        <td>
                                            <a href="/admin/orders/{{ $order->id }}"
                                                class="text-reset">{{ $order->name ?? $order->user->name }}</a>
                                        </td>
                                        <td>{{ $order->email ?? $order->user->email }}</td>
                                        <td>
                                            {{ number_format($order->total, 2) }} lei
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->toFormattedDateString() }}</td>
                                        <td><span
                                                class="badge @if ($order->status == 'paid') bg-success-subtle text-success @else bg-danger-subtle text-danger @endif text-uppercase">{{ $order->status }}</span>
                                        </td>
                                        <td>
                                            <a href="/admin/orders/{{ $order->id }}"
                                                class="btn btn-soft-secondary btn-sm ">
                                                <i class="ri-eye-fill align-bottom me-2"></i> View
                                            </a>
                                        </td>
                                    </tr><!-- end tr -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="align-items-center mt-4 pt-2 justify-content-between d-flex">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ URL::asset('build/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/world-merc.js') }}"></script>

    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        //  Line chart datalabel
        var linechartDatalabelColors = getChartColorsArray("line_chart_datalabel");
        if (linechartDatalabelColors) {
            var options = {
                chart: {
                    height: 405,
                    zoom: {
                        enabled: true
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: linechartDatalabelColors,
                markers: {
                    size: 0,
                    colors: "#ffffff",
                    strokeColors: linechartDatalabelColors,
                    strokeWidth: 1,
                    strokeOpacity: 0.9,
                    fillOpacity: 1,
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: [2, 2, 2],
                    curve: 'smooth'
                },
                series: {!! json_encode($finalData) !!},
                fill: {
                    type: ['solid', 'gradient', 'solid'],
                    gradient: {
                        shadeIntensity: 1,
                        type: "vertical",
                        inverseColors: false,
                        opacityFrom: 0.3,
                        opacityTo: 0.0,
                        stops: [20, 80, 100, 100]
                    },
                },
                grid: {
                    row: {
                        colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.2
                    },
                    borderColor: '#f1f1f1'
                },
                xaxis: {
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        chart: {
                            toolbar: {
                                show: false
                            }
                        },
                        legend: {
                            show: false
                        },
                    }
                }]
            }

            var chart = new ApexCharts(
                document.querySelector("#line_chart_datalabel"),
                options
            );
            chart.render();
        }

        // world map with line & markers
        var vectorMapWorldLineColors = getChartColorsArray("world-map-line-markers");
        if (vectorMapWorldLineColors)
            var worldlinemap = new jsVectorMap({
                map: "world_merc",
                selector: "#world-map-line-markers",
                zoomOnScroll: false,
                zoomButtons: false,
                markers: [{
                        name: "Greenland",
                        coords: [71.7069, 42.6043],
                        style: {
                            image: "build/images/flags/gl.svg",
                        }
                    },
                    {
                        name: "Canada",
                        coords: [56.1304, -106.3468],
                        style: {
                            image: "build/images/flags/ca.svg",
                        }
                    },
                    {
                        name: "Brazil",
                        coords: [-14.2350, -51.9253],
                        style: {
                            image: "build/images/flags/br.svg",
                        }
                    },
                    {
                        name: "Serbia",
                        coords: [44.0165, 21.0059],
                        style: {
                            image: "build/images/flags/rs.svg",
                        }
                    },
                    {
                        name: "Russia",
                        coords: [61, 105],
                        style: {
                            image: "build/images/flags/ru.svg",
                        }
                    },
                    {
                        name: "US",
                        coords: [37.0902, -95.7129],
                        style: {
                            image: "build/images/flags/us.svg",
                        }
                    },
                    {
                        name: "Australia",
                        coords: [25.2744, 133.7751],
                        style: {
                            image: "build/images/flags/au.svg",
                        }
                    },
                ],
                lines: [{
                        from: "Canada",
                        to: "Serbia",
                    },
                    {
                        from: "Russia",
                        to: "Serbia"
                    },
                    {
                        from: "Greenland",
                        to: "Serbia"
                    },
                    {
                        from: "Brazil",
                        to: "Serbia"
                    },
                    {
                        from: "US",
                        to: "Serbia"
                    },
                    {
                        from: "Australia",
                        to: "Serbia"
                    },
                ],
                regionStyle: {
                    initial: {
                        stroke: "#9599ad",
                        strokeWidth: 0.25,
                        fill: vectorMapWorldLineColors,
                        fillOpacity: 1,
                    },
                },
                labels: {
                    markers: {
                        render(marker, index) {
                            return marker.name || marker.labelName || 'Not available'
                        }
                    }
                },
                lineStyle: {
                    animation: true,
                    strokeDasharray: "6 3 6",
                },
            });


        // Multi-Radial Bar
        var chartRadialbarMultipleColors = getChartColorsArray("multiple_radialbar");
        if (chartRadialbarMultipleColors) {
            var options = {
                series: [85, 69, 45, 78],
                chart: {
                    height: 300,
                    type: 'radialBar',
                },
                sparkline: {
                    enabled: true
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -90,
                        endAngle: 90,
                        dataLabels: {
                            name: {
                                fontSize: '22px',
                            },
                            value: {
                                fontSize: '16px',
                            },
                            total: {
                                show: true,
                                label: 'Sales',
                                formatter: function(w) {
                                    return 2922
                                }
                            }
                        }
                    }
                },
                labels: ['Fashion', 'Electronics', 'Groceries', 'Others'],
                colors: chartRadialbarMultipleColors,
                legend: {
                    show: false,
                    fontSize: '16px',
                    position: 'bottom',
                    labels: {
                        useSeriesColors: true,
                    },
                    markers: {
                        size: 0
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector("#multiple_radialbar"), options);
            chart.render();
        }


        //  Spline Area Charts
        var areachartSplineColors = getChartColorsArray("area_chart_spline");
        if (areachartSplineColors) {
            var options = {
                series: [{
                    name: 'This Month',
                    data: [49, 54, 48, 54, 67, 88, 96]
                }, {
                    name: 'Last Month',
                    data: [57, 66, 74, 63, 55, 70, 85]
                }],
                chart: {
                    height: 250,
                    type: 'area',
                    toolbar: {
                        show: false
                    }
                },
                fill: {
                    type: ['gradient', 'gradient'],
                    gradient: {
                        shadeIntensity: 1,
                        type: "vertical",
                        inverseColors: false,
                        opacityFrom: 0.3,
                        opacityTo: 0.0,
                        stops: [50, 70, 100, 100]
                    },
                },
                markers: {
                    size: 4,
                    colors: "#ffffff",
                    strokeColors: areachartSplineColors,
                    strokeWidth: 1,
                    strokeOpacity: 0.9,
                    fillOpacity: 1,
                    hover: {
                        size: 6,
                    }
                },
                grid: {
                    show: false,
                    padding: {
                        top: -35,
                        right: 0,
                        bottom: 0,
                        left: -6,
                    },
                },
                legend: {
                    show: false,
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [2, 2],
                    curve: 'smooth'
                },
                colors: areachartSplineColors,
                xaxis: {
                    labels: {
                        show: false,
                    }
                },
                yaxis: {
                    labels: {
                        show: false,
                    }
                },
            };

            var chart = new ApexCharts(document.querySelector("#area_chart_spline"), options);
            chart.render();
        }
    </script>
@endsection
