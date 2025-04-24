@extends('layouts.master')

@section('title', 'Services')
@section('keywords', $keywords)
@section('description', $description)
@section('thumbnail', config('logo'))

@push('schema')
<x-schema.schema-wrapper>
    <x-schema.organization />
    
    <x-schema.web-page :page="[
        'url' => request()->url('/services'),
        'name' => 'Services - '.config('site_title'),
        'datePublished' => $datePublished,
        'dateModified' => $datePublished
    ]" :breadcrumb="[
        [
            '@type' => 'ListItem',
            'position' => '1',
            'item' => [
                '@id' => request()->url(),
                'name' => 'Home'
            ]
        ],
        [
            '@type' => 'ListItem',
            'position' => '2',
            'item' => [
                '@id' => request()->url('/services'),
                'name' => 'Services'
            ]
        ]
    ]" />
    
    <x-schema.article :article="[
        'headline' => 'Services - '.config('site_title'),
        'keywords' => $keywords,
        'datePublished' => $datePublished,
        'dateModified' => $datePublished,
        'url' => request()->url('/services'),
        'description' => $description
    ]" />
</x-schema.schema-wrapper>
@endpush

@section('css')
    <!-- extra css -->
    <!-- nouisliderribute css -->
    {{-- <link rel="stylesheet" href="{{ URL::asset('build/libs/nouislider/nouislider.min.css') }}"> --}}
@endsection
@section('content')
    
    <div class="mt-4"></div>

    <div class="position-relative section">
        <div class="container">
            <div class="ecommerce-product gap-4">
                <div class="sidebar small-sidebar flex-shrink-0">
                    <form class="card overflow-hidden" action="/services" method="get">

                        <div class="card-header">
                            <div class="d-flex mb-3">
                                <div class="flex-grow-1">
                                    <h5 class="fs-16">{{ session()->get('lang') === 'ro' ? 'Filtre' : 'Filters' }}</h5>
                                </div>
                                <div class="flex-shrink-0">
                                    {{-- <a href="/services" class="text-decoration-underline" id="clearall">Clear All</a> --}}
                                </div>
                            </div>

                            <div class="search-box">
                                <input name="keyword" type="text" class="form-control" id="searchProductList"
                                    autocomplete="off" placeholder="{{ session()->get('lang') === 'ro' ? 'Servicii de căutare' : 'Search Services' }}...">
                                {{-- <i class="bi bi-search"></i> --}}
                            </div>
                        </div>

                        <div class="accordion accordion-flush filter-accordion">

                            <div class="card-body border-bottom">
                                <div>
                                    <p class="text-muted text-uppercase fs-13 fw-medium mb-3">{{ session()->get('lang') === 'ro' ? 'Categorii' : 'Categories' }}</p>
                                    <ul class="list-unstyled mb-0 filter-list">
                                        @foreach ($categories as $cat)
                                            <li>
                                                <a href="/services/?category={{ $cat->id }}"
                                                    class="d-flex py-1 align-items-center">
                                                    <div class="flex-grow-1">
                                                        <h5 class="fs-14 mb-0 listname">
                                                            {{ $cat->getTranslation('title', session()->get('lang')) }}</h5>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <span
                                                            class="badge bg-light text-muted">{{ count($cat->services) }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            {{-- <div class="card-body border-bottom">
                                <p class="text-muted text-uppercase fs-13 fw-medium mb-4">Price</p>

                                <div id="product-price-range" data-slider-color="info"></div>
                                <div class="formCost d-flex gap-2 align-items-center mt-3">
                                    <input class="form-control form-control-sm" type="text" id="minCost"
                                        value="0"> <span class="fw-semibold text-muted">to</span> <input
                                        class="form-control form-control-sm" type="text" id="maxCost" value="1000">
                                </div>
                            </div> --}}
                            <!-- end accordion-item -->
                        </div>
                    </form>
                    <!-- end card -->
                </div>
                <div class="flex-grow-1">

                    <div class="d-flex align-items-center gap-2 mb-4">
                        <p class="text-muted flex-grow-1 mb-0">
                            @if ($keyword)
                                Showing results of keyword "{{ $keyword }}"
                            @elseif ($categoryName)
                                Showing results of category
                                "{{ $categoryName->getTranslation('title', session()->get('lang')) }}"
                            @else
                                Showing results of all services
                            @endif
                        </p>
                    </div>

                    <div class="row" idX="product-grid">
                        {{--  --}}
                        @foreach ($services as $service)
                            <div class="col-xxl-4 col-lg-4 col-md-6">
                                <div class="card ecommerce-product-widgets border-0 rounded-0 shadow-none overflow-hidden">
                                    <div class="bg-light bg-dark-subtle bg-opacity-50 rounded py-4 position-relative" style="min-height: 200px;">
                                        @if($service->thumbnail)
                                        <picture>
                                            <source srcset="{{ asset('/storage/' . $service->thumbnail) }}" type="image/webp">
                                        <img src="{{ asset('/storage/' . $service->thumbnail) }}"
                                            alt="{{ $service->getTranslation('name', session()->get('lang')) }}"
                                            style="max-height: 200px;max-width: 100%;" class="mx-auto d-block rounded-2" loading="lazy">
                                        </picture>
                                        @endif
                                        @if ($service->discounted_price > 0)
                                            <div class="avatar-xs label">
                                                <div class="avatar-title bg-danger rounded-circle fs-11">
                                                    {{ $service->discounted_price }}%</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="pt-4">
                                        <div>
                                            {{-- <div class="avatar-xxs mb-3">
                                                <div class="avatar-title bg-light text-muted rounded cursor-pointer">
                                                    <i class="ri-error-warning-line"></i>
                                                </div>
                                            </div> --}}
                                            <a href="/{{ $service->slug }}">
                                                <h6 class="text-capitalize fs-15 lh-base text-truncate mb-0">
                                                    {{ $service->getTranslation('name', session()->get('lang')) }}</h6>
                                            </a>
                                            <div class="mt-2">
                                                <span class="float-end text-muted">{{ number_format($service->reviews_avg_rating, 1) }} <i
                                                        class="bi bi-star-fill text-warning align-bottom"></i></span>
                                                {{-- @if ($service->discounted_price > 0)
                                                    <h5 class="text-secondary mb-0">
                                                        {{ number_format($service->price - ($service->price * $service->discounted_price) / 100, 2) }} lei
                                                        <span
                                                            class="text-muted fs-12"><del>{{ number_format($service->price, 2) }} lei</del></span>
                                                    </h5>
                                                @else --}}
                                                    <h5 class="text-secondary mb-0">
                                                        {{ $service->price }} lei</h5>
                                                {{-- @endif --}}
                                            </div>
                                            <div class="tn mt-3">
                                                {{-- <livewire:add-to-cart :service="$service" /> --}}

                                                <a href="/{{ $service->slug }}" class="btn btn-primary btn-hover w-100 add-btn" >
                                                    <i class="mdi mdi-cart me-1"></i>
                                                    {{ session()->get('lang') === 'ro' ? 'Detalii despre serviciu' : 'Service Details' }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{--  --}}
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-2">
                        <p class="text-muted mb-0">
                            Showing {{ $services->firstItem() }} to {{ $services->lastItem() }} of
                            {{ $services->total() }} results
                        </p>
                        {{ $services->links() }}
                    </div>

                    <div class="row d-none" id="search-result-elem">
                        <div class="col-lg-12">
                            <div class="text-center py-5">
                                <div class="avatar-lg mx-auto mb-4">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-24">
                                        <i class="bi bi-search"></i>
                                    </div>
                                </div>

                                <h5>No matching records found</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end container-->
    </div>

    <x-subscription />

    <x-key-features />
@endsection
@section('scripts')
    <!-- nouisliderribute js -->
    {{-- <script src="{{ URL::asset('build/libs/nouislider/nouislider.min.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('build/libs/wnumb/wNumb.min.js') }}"></script> --}}

    <!-- Product-grid init js -->
    {{-- <script src="{{ URL::asset('build/js/frontend/product-grid.init.js') }}"></script> --}}

    <!-- landing-index js -->
    {{-- <script src="{{ URL::asset('build/js/frontend/menu.init.js') }}"></script> --}}
@endsection
