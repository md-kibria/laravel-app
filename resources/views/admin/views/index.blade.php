@extends('layouts.admin.master')
@section('title')
    Visitors
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
                                    <p class="text-uppercase fw-medium text-muted fs-14 text-truncate">Home Page Views</p>
                                    <h4 class="fs-22 fw-semibold mb-3"><span class="counter-value"
                                            data-target="{{ $totalHomeViews }}">0</span></h4>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ((int) $homeViewChange < 0)
                                            <h5 class="badge bg-danger-subtle text-danger mb-0">
                                                <i class="ri-arrow-right-down-line align-bottom"></i> {{ $homeViewChange }}
                                                %
                                            </h5>
                                        @else
                                            <h5 class="badge bg-success-subtle text-success mb-0">
                                                <i class="ri-arrow-right-up-line align-bottom"></i> {{ $homeViewChange }} %
                                            </h5>
                                        @endif
                                        <p class="text-muted mb-0">than last week</p>
                                    </div>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-secondary-subtle text-secondary rounded fs-3">
                                        <i class="ph-house-line-light"></i>
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
                                    <p class="text-uppercase fw-medium text-muted fs-14 text-truncate">Service Views</p>
                                    <h4 class="fs-22 fw-semibold mb-3"><span class="counter-value"
                                            data-target="{{ $totalServiceViews }}">0</span> </h4>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ((int) $serviceViewChange < 0)
                                            <h5 class="badge bg-danger-subtle text-danger mb-0">
                                                <i class="ri-arrow-right-down-line align-bottom"></i>
                                                {{ $serviceViewChange }} %
                                            </h5>
                                        @else
                                            <h5 class="badge bg-success-subtle text-success mb-0">
                                                <i class="ri-arrow-right-up-line align-bottom"></i> {{ $serviceViewChange }}
                                                %
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
                                    <p class="text-uppercase fw-medium text-muted fs-14 text-truncate">Blog Views</p>
                                    <h4 class="fs-22 fw-semibold mb-3"><span class="counter-value"
                                            data-target="{{ $totalBlogViews }}">0</span> </h4>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ((int) $blogViewChange < 0)
                                            <h5 class="badge bg-danger-subtle text-danger mb-0">
                                                <i class="ri-arrow-right-down-line align-bottom"></i> {{ $blogViewChange }}
                                                %
                                            </h5>
                                        @else
                                            <h5 class="badge bg-success-subtle text-success mb-0">
                                                <i class="ri-arrow-right-up-line align-bottom"></i> {{ $blogViewChange }} %
                                            </h5>
                                        @endif
                                        <p class="text-muted mb-0">than last week</p>
                                    </div>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning-subtle text-warning rounded fs-3">
                                        <i class="ph-pencil-line-thin"></i>
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
                                    <p class="text-uppercase fw-medium text-muted fs-14 text-truncate">Pages Views</p>
                                    <h4 class="fs-22 fw-semibold mb-3"><span class="counter-value"
                                            data-target="{{ $totalPagesViews }}">0</span> </h4>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ((int) $pagesViewChange < 0)
                                            <h5 class="badge bg-danger-subtle text-danger mb-0">
                                                <i class="ri-arrow-right-down-line align-bottom"></i>
                                                {{ $pagesViewChange }} %
                                            </h5>
                                        @else
                                            <h5 class="badge bg-success-subtle text-success mb-0">
                                                <i class="ri-arrow-right-up-line align-bottom"></i> {{ $pagesViewChange }}
                                                %
                                            </h5>
                                        @endif
                                        <p class="text-muted mb-0">than last week</p>
                                    </div>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary-subtle text-primary rounded fs-3">
                                        <i class="ph-notebook-thin"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->
        </div>
        <!--end col-->


    </div>

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Website Visitors({{ $views->total() }})</h4>
                    <form class="flex-shrink-0 d-flex align-items-center" style="gap: 10px;" action="/admin/views">
                        <div class="dropdown card-header-dropdown">
                            <span class="text-reset dropdown-btn d-flex align-items-center">
                                <span class="fw-semibold text-uppercase fs-12">Sort Type: </span>
                                <select name="type" id="" class="form-control-sm m-0 border-0"
                                    style="display: inline-block;">
                                    <option value="">Select</option>
                                    <option value="all" selected>All</option>
                                    <option value="service">Service</option>
                                    <option value="blog">Blog</option>
                                    <option value="page">Page</option>
                                </select>
                            </span>
                        </div>
                        <div class="dropdown card-header-dropdown">
                            <span class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold text-uppercase fs-12">Sort by:
                                </span>
                                <select name="time" id="" class="form-control-sm m-0 border-0"
                                    style="display: inline-block;">
                                    <option value="">Select</option>
                                    <option value="today" selected>Today</option>
                                    <option value="last 7 days">Last 7 Days</option>
                                    <option value="last 30 days">Last 30 Days</option>
                                    <option value="all">All Time</option>
                                </select>
                            </span>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                    </form>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-centered align-middle table-nowrap mb-0" id="customerTable">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Page</th>
                                    <th scope="col">Ip</th>
                                    <th scope="col">Agent</th>
                                    <th scope="col">Referrer</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($views as $view)
                                    <tr>
                                        <td>#{{ $view->id }}</td>
                                        <td>{{ $view->user_id ? $view->user->name : '—' }}</td>
                                        <td>
                                            @if ($view->type === 'page')
                                                {{ $view->page_id }}
                                            @elseif($view->type === 'service')
                                                {{ $view->service->name }}
                                            @else
                                                {{ $view->post->title }}
                                            @endif
                                        </td>
                                        <td>{{ $view->ip_address }}</td>
                                        <td>{{ $view->user_agent }}</td>
                                        <td>{{ $view->referrer ?? '—' }}</td>
                                        <td><span
                                                class="badge @if ($view->type == 'service') bg-success-subtle text-success @elseif($view->type == 'post') bg-secondary-subtle text-secondary @else bg-primary-subtle text-primary @endif text-uppercase">{{ $view->type }}</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($view->created_at)->toFormattedDateString() }}</td>
                                    </tr><!-- end tr -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="align-items-center mt-4 pt-2 justify-content-between d-flex">
                        <div class="d-flex justify-content-between align-items-center pt-2 w-100">
                            <p class="text-muted mb-0">
                                Showing {{ $views->firstItem() }} to {{ $views->lastItem() }} of {{ $views->total() }}
                                results
                            </p>
                            {{ $views->links() }}
                        </div>
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
                series: {!! json_encode($homeViewChange) !!},
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
