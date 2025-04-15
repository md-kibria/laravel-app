@extends('layouts.master')

@section('title', 'Home')
@section('keywords', $keywords)
@section('description', $description)
@section('thumbnail', config('logo'))

@push('schema')
    <x-schema.schema-wrapper>
        <x-schema.organization />

        <x-schema.web-page :page="[
            'url' => request()->url(),
            'name' => $pageName,
            'datePublished' => $datePublished,
            'dateModified' => $dateModified,
        ]" />

        <x-schema.article :article="[
            'headline' => $pageName,
            'description' => $description,
            'keywords' => $keywords,
            'datePublished' => $datePublished,
            'dateModified' => $dateModified,
            'url' => request()->url(),
            'image' => $homepageImg,
        ]" />
    </x-schema.schema-wrapper>
@endpush
@section('css')
    <!-- extra css -->
    <!--Swiper slider css-->
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <section class="position-relative">
        <div id="ecommerceHero" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="ecommerce-home bg-primary-subtle"
                        style="background-image: url('{{ $header->image ? asset('/storage/' . $header->image) : '' }}');">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div>
                                        <p class="fs-15 fw-semibold text-uppercase"><i
                                                class="bi bi-lightning-charge-fill text-success align-bottom me-1"></i>
                                            {{ $header->getTranslation('sub_title', session()->get('lang')) }}</p>
                                        <h1 class="display-3 fw-semibold text-capitalize lh-base" style="font-size: 70px">
                                            {{ $header->getTranslation('title', session()->get('lang')) }}</h1>
                                        <p class="">
                                            {{ $header->getTranslation('description', session()->get('lang')) }}</p>
                                        <a href="/services" class="btn btn-success btn-hover mt-4"><i
                                                class="ph-shopping-cart align-middle me-1"></i> {{ session()->get('lang') === 'ro' ? 'Serviciile noastre' : 'Our Services' }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row gy-4 gy-lg-0">
                @foreach ($key_features as $item)
                    <div class="col-lg-3 col-sm-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0">
                                <img src="{{ $item->image ? asset('/storage/' . $item->image) : '' }}" alt=""
                                    class="avatar-sm">
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-15">{{ $item->getTranslation('title', session()->get('lang')) }}</h5>
                                <p class="text-muted mb-0">
                                    {{ $item->getTranslation('description', session()->get('lang')) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section pt-0">
        <div class="container">
            <div class="row">
                @foreach ($featured_promotion as $item)
                    @if ($item->status === 'show')
                        <div class="col-lg-6">
                            <a href="#!"
                                class="product-banner-1 mt-4 mt-lg-0 rounded overflow-hidden position-relative d-block">
                                <img src="{{ $item->image ? asset('/storage/' . $item->image) : '' }}"
                                    class="img-fluid rounded" alt="">
                                <div class="bg-overlay blue"></div>
                                <div class="product-content p-4">
                                    <p class="text-uppercase text-white mb-2">
                                        {{ $item->getTranslation('sub_title', session()->get('lang')) }}</p>
                                    <h1 class="text-white lh-base fw-medium ff-secondary">
                                        {{ $item->getTranslation('title', session()->get('lang')) }}</h1>
                                    <div class="product-btn mt-4 text-white">
                                        Get Now <i class="bi bi-arrow-right ms-2"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <section class="position-relative bg-danger-subtle bg-cta">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="py-5">
                        <p class="text-uppercase  badge bg-danger-subtle text-danger fs-13">
                            {{ $overview->getTranslation('sub_title', session()->get('lang')) }}</p>

                        <h1 class="lh-base fw-semibold mb-3 text-capitalize">
                            {{ $overview->getTranslation('title', session()->get('lang')) }}</h1>
                        <p class="fs-16 mt-2">{{ $overview->getTranslation('description', session()->get('lang')) }}</p>
                        <div class="row">
                            <div class="col-lg-10">
                                {{-- <div class="ecommerce-land-countdown mt-3 mb-0">
                                    <div data-countdown="Jan 30, 2025" class="countdownlist"></div>
                                </div> --}}
                            </div>
                        </div>

                        <div class="mt-4 pt-2 d-flex gap-2">
                            <a href="/services" class="btn btn-primary w-md btn-hover">{{ session()->get('lang') === 'ro' ? 'Obțineți servicii' : 'Get Service' }}</a>
                            <a href="/about" class="btn btn-danger w-md btn-hover" aria-label="About Page">{{ session()->get('lang') === 'ro' ? 'Citeşte mai mult' : 'Read More' }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="">
                        <img src="{{ $overview->image ? asset('/storage/' . $overview->image) : '' }}" alt=""
                            class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="position-relative bg-success-subtle bg-cta">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="">
                        <img src="{{ $why_choose_us->image ? asset('/storage/' . $why_choose_us->image) : '' }}"
                            alt="" class="w-100">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="py-5">
                        <p class="text-uppercase  badge bg-success-subtle text-success fs-13">
                            {{ $why_choose_us->getTranslation('sub_title', session()->get('lang')) }}</p>

                        <h1 class="lh-base fw-semibold mb-3 text-capitalize">
                            {{ $why_choose_us->getTranslation('title', session()->get('lang')) }}</h1>
                        <p class="fs-16 mt-2">{{ $why_choose_us->getTranslation('description', session()->get('lang')) }}
                        </p>
                        <div class="row">
                            {{-- <div class="col-lg-10">
                                <div class="ecommerce-land-countdown mt-3 mb-0">
                                    <div data-countdown="Jan 30, 2025" class="countdownlist"></div>
                                </div>
                            </div> --}}
                        </div>

                        <div class="mt-4 pt-2 d-flex gap-2">
                            <a href="/contact" class="btn btn-primary w-md btn-hover">{{ session()->get('lang') === 'ro' ? 'Contactați acum' : 'Contact Now' }}</a>
                            <a href="/about" class="btn btn-danger w-md btn-hover" aria-label="About Page">{{ session()->get('lang') === 'ro' ? 'Citeşte mai mult' : 'Read More' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section pb-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="text-center">
                        <h3 class="mb-3">{{ session()->get('lang') === 'ro' ? 'Servicii recomandate' : 'Featured Services' }}</h3>
                        <p class="text-muted fs-15">{{ session()->get('lang') === 'ro' ? 'Ceea ce porți este modul în care te prezinți lumii, mai ales astăzi, când contactele umane sunt atât de rapide. Moda este un limbaj instantaneu.' : 'What you wear is how you present yourself to the world, especially today, when human contacts are so quick. Fashion is instant language.' }}</p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="swiper latest-slider mt-4" dir="ltr">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-wrapper pt-5">
                            @foreach ($featured_services as $service)
                                <div class="swiper-slide">
                                    <div class="card overflow-hidden">
                                        <div class="bg-dark-subtle rounded-top py-4">
                                            <div class="gallery-product" style="min-height: 150px;">
                                                <img src="@if ($service->thumbnail) {{ asset('/storage/' . $service->thumbnail) }} @else '' @endif"
                                                    alt="{{ $service->getTranslation('name', session()->get('lang')) }}"
                                                    style="max-height: 215px;max-width: 100%;" class="mx-auto d-block"
                                                    loading="lazy">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <a href="/{{ $service->slug }}">
                                                    <h6 class="fs-15 lh-base text-truncate mb-0">
                                                        {{ $service->getTranslation('name', session()->get('lang')) }}</h6>
                                                </a>
                                                <div class="mt-3">
                                                    <span
                                                        class="float-end">{{ number_format($service->reviews_avg_rating, 1) }}
                                                        <i class="bi bi-star-fill text-warning align-bottom"></i></span>
                                                    @if ($service->discounted_price > 0)
                                                        <h5 class="mb-0">
                                                            {{ number_format($service->price - ($service->price * $service->discounted_price) / 100, 2) }} lei
                                                            <span
                                                                class="text-muted fs-12"><del>{{ number_format($service->price, 2) }} lei</del></span>
                                                        </h5>
                                                    @else
                                                        <h5 class="mb-0">
                                                            {{ number_format($service->price - ($service->price * $service->discounted_price) / 100, 2) }} lei
                                                        </h5>
                                                    @endif
                                                </div>
                                                <div class="mt-3">
                                                    <livewire:add-to-cart :service="$service" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="text-center">
                        <h3 class="mb-3">{{ session()->get('lang') === 'ro' ? 'Ce spun clienții despre noi' : 'What Customers Say About Us' }}</h3>
                        <p class="text-muted fs-15">{{ session()->get('lang') === 'ro' ? 'Un client este o persoană sau o afacere care cumpără bunuri sau servicii de la o altă afacere. Clienții sunt cruciali deoarece ei generează venituri.' : 'A customer is a person or business that buys goods or services from another business. Customers are crucial because they generate revenue.' }}</p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="swiper testi-slider">
                        <div class="swiper-wrapper my-5">
                            @foreach ($reviews as $review)
                                <div class="swiper-slide">
                                    <div class="client-box m-1">
                                        <div class="client-desc p-4 border rounded">
                                            <p class="mb-0 fs-16">"{{ $review->comment }}"</p>
                                        </div>
                                        <div class="pt-4">
                                            <div class="d-flex align-items-center mt-4 pt-1">
                                                <img src="{{ $review->user?->image ? asset('/storage/' . $review->user->image) : URL::asset('img/default.png') }}"
                                                    alt="" class="avatar-sm rounded">
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="mb-2 fs-16">{{ $review->name }}</h5>
                                                    <p class="text-muted mb-0">
                                                        {{ \Carbon\Carbon::parse($review->created_at)->toFormattedDateString() }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination swiper-pagination-dark"></div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- START BLOG -->
    <section class="section bg-light bg-opacity-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="text-center">
                        <h3 class="mb-3">{{ session()->get('lang') === 'ro' ? 'Sfaturi și tendințe estetice de la experți' : 'Expert Aesthetic Tips & Trends' }}</h3>
                        <p class="text-muted fs-15">{{ session()->get('lang') === 'ro' ? 'Explorează cele mai noi tratamente de înfrumusețare, îngrijire a pielii și estetică cu Reshape Clinique. De la sfaturi de specialitate despre conturarea corpului până la cele mai noi tendințe în proceduri neinvazive, blogul nostru te ține informat și inspirat în călătoria ta către încredere și bunăstare.' : 'Explore the latest in beauty, skincare, and aesthetic treatments with Reshape Clinique. From expert tips on body contouring to the newest trends in non-invasive procedures, our blog keeps you informed and inspired on your journey to confidence and well-being.' }}</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                @foreach ($blogs as $post)
                    <div class="col-lg-4">
                        <div class="card overflow-hidden">
                            <div class="bg-dark-subtle"  style="min-height: 200px;">
                                <img src="{{ asset('/storage/' . $post->thumbnail) }}" class="img-fluid" alt="">
                            </div>
                            <div class="card-body">
                                <div class="entry-meta">
                                    <span class="text-muted">{{ (int) $post->views }} <i class="mdi mdi-like"></i>
                                        {{ session()->get('lang') === 'ro' ? 'Vizualizări' : 'Views' }}</span>
                                    <span class="text-muted mx-1">|</span>
                                    <span class="text-muted">{{ (int) $post->comments_count }}
                                        {{ session()->get('lang') === 'ro' ? 'Comentarii' : 'Comments' }}</span>
                                </div>
                                <div class="blog-date bg-body-secondary rounded">
                                    <h4 class="mb-0">{{ $post->created_at->format('d') }}</h4>
                                    <p class="text-muted mt-1">{{ $post->created_at->format('F') }}</p>
                                </div>
                                <div class="mt-3">
                                    <a href="/blogs/{{ $post->slug }}">
                                        <h5 class="fs-17 lh-base">
                                            {{ $post->getTranslation('title', session()->get('lang')) }}</h5>
                                    </a>
                                    <p class="text-muted fs-15 mt-2">
                                        {{ $post->getTranslation('excerpt', session()->get('lang')) }}</p>
                                    <a href="/blogs/{{ $post->slug }}"
                                        class="link-effect link-info">{{ session()->get('lang') === 'ro' ? 'Continuă să citești' : 'Continue Reading' }}
                                        <i class="bi bi-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 text-center">
                <a href="/blogs" class="btn btn-soft-primary btn-hover">{{ session()->get('lang') === 'ro' ? 'Vezi mai multe articole' : 'View More Articles' }} <i
                        class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
    </section>
    <!-- END BLOG -->

    <!-- START INSTAGRAM -->
    <section class="section pb-0">
        <div class="container">
            <div class="row justify-content-center g-0">
                <div class="col-lg-7">
                    <div class="text-center">
                        <h3 class="mb-3">{{ session()->get('lang') === 'ro' ? 'Urmăriți-ne pe Instagram' : 'Follow Us In Instagram' }}</h3>
                        <p class="text-muted fs-15">{{ session()->get('lang') === 'ro' ? 'Cea mai comună metodă pe care oamenii o folosesc pentru a spune „urmărește-mă” pe Instagram este trimiterea unui mesaj direct.' : 'The most common approach that peoples use to say follow me on Instagram is by sending a direct message.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="position-relative" style="min-height: 150px;">
            <div class="row g-0 mt-5">
                @foreach ($instas as $item)
                    <div class="col">
                        <div class="insta-img">
                            <a href="{{ $item->link }}" class="stretched-link" target="_blank" aria-label="Instagram Link">
                                <img src="@if ($item->image) {{ asset('/storage/' . $item->image) }} @else {{ URL::asset('build/images/ecommerce/headphone.png') }} @endif"
                                    class="img-fluid" alt="">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="insta-lable text-center mx-auto" style="width: fit-content;z-index: 10">
                <a href="{{ $instaLink->url }}" target="_blank" class="btn btn-primary btn-hover">
                    <i class="ph-instagram-logo align-middle me-1"></i> Follow In Instagram
                </a>
            </div>
        </div>
    </section>
    <!-- END INSTAGRAM -->
@endsection
@section('scripts')
    <!-- isotope-layout -->
    <script src="{{ URL::asset('build/libs/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Countdown js -->
    <script src="{{ URL::asset('build/js/pages/coming-soon.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/frontend/landing-index.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/frontend/menu.init.js') }}"></script>
@endsection
