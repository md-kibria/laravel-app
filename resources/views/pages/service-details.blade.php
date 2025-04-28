@extends('layouts.master')

@section('title', $service->seo_title ?? '')
@section('keywords', $service->seo_keywords ?? '')
@section('description', $service->seo_description ?? '')
@section('thumbnail', asset('/storage/' . $service->thumbnail))

@push('schema')
    <x-schema.schema-wrapper>
        <x-schema.organization />

        <x-schema.web-page :page="[
            'url' => route('blogs.post', $service->slug),
            'name' => $service->getTranslation('name', session()->get('lang')),
            'datePublished' => $service->created_at->toIso8601String(),
            'dateModified' => $service->updated_at->toIso8601String(),
            'description' => $service->seo_description,
        ]" :image="[
            'url' => asset('/storage/' . $service->thumbnail),
            'width' => '687',
            'height' => '429',
            'caption' => $service->seo_title,
        ]" :breadcrumb="[
            [
                '@type' => 'ListItem',
                'position' => '1',
                'item' => [
                    '@id' => url('/'),
                    'name' => 'Home',
                ],
            ],
            [
                '@type' => 'ListItem',
                'position' => '2',
                'item' => [
                    '@id' => url('/services'),
                    'name' => 'Services',
                ],
            ],
            [
                '@type' => 'ListItem',
                'position' => '3',
                'item' => [
                    '@id' => url('/{{ $service->slug }}'),
                    'name' => $service->getTranslation('name', session()->get('lang')),
                ],
            ],
        ]" />

        <x-schema.article :article="[
            'headline' => $service->getTranslation('name', session()->get('lang')),
            'keywords' => $service->seo_keywords,
            'datePublished' => $service->created_at->toIso8601String(),
            'dateModified' => $service->updated_at->toIso8601String(),
            'url' => url('/{{ $service->slug }}'),
            'description' => $service->seo_description,
            'image' => asset('/storage/' . $service->thumbnail),
        ]" />
    </x-schema.schema-wrapper>
@endpush

@section('css')
    <!-- extra css -->
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    {{-- <section class="ecommerce-about"
        style="background-image: ''; background-size: cover;background-position: center;">
        <div class="bg-overlay bg-primary" style="opacity: 0.85;"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center">
                        <h1 class="text-white mb-0">
                            {{ session()->get('lang') === 'ro' ? 'Detalii serviciu' : 'Service Details' }}</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-light justify-content-center mt-4">
                                <li class="breadcrumb-item"><a
                                        href="/services">{{ session()->get('lang') === 'ro' ? 'Servicii' : 'Services' }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ session()->get('lang') === 'ro' ? 'Detalii serviciu' : 'Service Details' }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section> --}}
<section style="height: 70px;"></section>

    <section class="section">
        <div class="container">
            <div class="row gx-2">
                <div class="col-lg-6">
                    <div class="row">
                        <!--end col-->
                        <div class="col-md-12">
                            {{-- col-md-10 --}}
                            <div class="bg-light rounded-2 position-relative ribbon-box overflow-hidden">
                                {{-- <div class="ribbon ribbon-danger ribbon-shape trending-ribbon">
                                    <span class="trending-ribbon-text">{{ $service->discounted_price }}% off</span> <i
                                        class="bi bi-lightning-charge-fill text-white align-bottom float-end ms-1"></i>
                                </div> --}}
                                <div class="swiper productSwiper2">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide" style="min-height: 350px;">
                                            <img src="{{ asset('/storage/' . $service->thumbnail) }}" alt=""
                                                class="img-fluid w-100" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <!--end col-->
                <div class="col-lg-5 ms-auto">
                    <div class="ecommerce-product-widgets mt-4 mt-lg-0">
                        <div class="mb-4">
                            <div class="d-flex gap-3 mb-2">
                                <div class="fs-15 text-warning">
                                    @if ($averageRating === 0)
                                        <i class="align-bottom bi bi-star text-warning"></i>
                                    @endif
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="align-bottom bi bi-star-{{ $i <= floor($averageRating) ? 'fill' : ($i - $averageRating < 1 ? 'half' : '') }} text-warning"></i>
                                    @endfor
                                </div>
                                <span class="fw-medium"> ({{ $totalReviews }} Review)</span>
                            </div>
                            <h4 class="lh-base mb-1">{{ $service->getTranslation('name', session()->get('lang')) }}</h4>
                            <p class="text-muted mb-4">
                                {{ $service->getTranslation('short_description', session()->get('lang')) }}</p>

                            {{-- @if ($service->discounted_price > 0)
                                <h5 class="fs-24 mb-4">
                                    {{ number_format($service->price - ($service->price * $service->discounted_price) / 100, 2) }}
                                    lei
                                    <span class="text-muted fs-14"><del>{{ number_format($service->price, 2) }}
                                            lei</del></span>
                                    <span class="fs-14 ms-2 text-danger"> ({{ $service->discounted_price }}% off)</span>
                                </h5>
                            @else --}}
                                <h5 class="fs-24 mb-4">{{ $service->price }} lei</h5>
                            {{-- @endif --}}

                            <ul class="list-unstyled vstack gap-2">
                                <li class=""><i
                                        class="bi bi-check2-circle me-2 align-middle text-success"></i>{{ session()->get('lang') === 'ro' ? 'Serviciu disponibil' : 'Service Available' }}
                                </li>
                                <li class=""><i
                                        class="bi bi-check2-circle me-2 align-middle text-success"></i>{{ session()->get('lang') === 'ro' ? 'Plătiți direct cu numerar sau card' : 'Pay directly with cash or card' }}
                                </li>
                                @if ($service->discounted_price)
                                    <li class=""><i class="bi bi-check2-circle me-2 align-middle text-success"></i>
                                        {{ session()->get('lang') === 'ro' ? 'Vânzări ' . $service->discounted_price . '% reducere' : 'Sales ' . $service->discounted_price . '% Off' }}
                                    </li>
                                @endif
                            </ul>

                            {{-- Previous variation system --}}
                            {{-- @if ($service->label1_title || $service->label2_title)
                                <h6 class="fs-14 text-muted mb-3">
                                    {{ session()->get('lang') === 'ro' ? 'Informații suplimentare' : 'Additional Info' }} :
                                </h6>
                                <ul class="list-unstyled vstack gap-2 mb-0">
                                    <li>
                                        <div class="d-flex gap-3">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-tag-fill text-success align-middle fs-15"></i>
                                            </div>
                                            <div class="flex-grow-1 d-flex">
                                                <b
                                                    style="margin-right: 5px;">{{ $service->getTranslation('label1_title', session()->get('lang')) }}:</b>
                                                <ul class="clothe-size list-unstyled hstack gap-2 mb-0 flex-wrap">
                                                    @foreach (explode(',', $service->label1_options) as $item)
                                                        <li> <input type="radio" name="sizes7" id="{{ trim($item) }}">
                                                            <label
                                                                class="btn btn-soft-primary px-1 py-0 fs-12 d-flex align-items-center justify-content-center"
                                                                for="{{ trim($item) }}">{{ trim($item) }}</label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex gap-3">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-tag-fill text-success align-middle fs-15"></i>
                                            </div>
                                            <div class="flex-grow-1 d-flex">
                                                <b
                                                    style="margin-right: 5px;">{{ $service->getTranslation('label2_title', session()->get('lang')) }}:</b>
                                                <ul class="clothe-size list-unstyled hstack gap-2 mb-0 flex-wrap">
                                                    @foreach (explode(',', $service->label2_options) as $item)
                                                        <li> <input type="radio" name="sizes7" id="{{ trim($item) }}">
                                                            <label
                                                                class="btn btn-soft-primary px-1 py-0 fs-12 d-flex align-items-center justify-content-center"
                                                                for="{{ trim($item) }}">{{ trim($item) }}</label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            @endif --}}
                            {{-- New variation system --}}



                            @if (count($service->variationTypes) !== 0)
                                <h6 class="fs-14 text-muted mb-3">
                                    {{ session()->get('lang') === 'ro' ? 'Informații suplimentare' : 'Additional Info' }} :
                                </h6>
                                <ul class="list-unstyled vstack gap-2 mb-0">
                                    @foreach ($service->variationTypes as $variationType)
                                        <li>
                                            <div class="d-flex gap-3">
                                                <div class="flex-shrink-0">
                                                    <i class="bi bi-tag-fill text-success align-middle fs-15"></i>
                                                </div>
                                                <div class="flex-grow-1 d-flex">
                                                    <b
                                                        style="margin-right: 5px;">{{ $variationType->getTranslation('name', session()->get('lang')) }}:</b>
                                                    <ul class="clothe-size list-unstyled hstack gap-2 mb-0 flex-wrap">
                                                        @foreach ($variationType->variations as $variation)
                                                            <li>
                                                                <input type="radio"
                                                                    name="variation_{{ $variationType->id }}"
                                                                    id="variation_{{ $variation->id }}"
                                                                    class="variation-option"
                                                                    data-typeid="{{ $variationType->id }}"
                                                                    data-typename="{{ $variationType->getTranslation('name', session()->get('lang')) }}"
                                                                    data-name="{{ $variation->name }}"
                                                                    data-type="{{ strtolower($variationType->type === 'number' ? 'number' : 'text') }}"
                                                                    data-price="{{ $variationType->type === 'number' ? $variation->name : $variation->getFinalPriceAttribute() }}"
                                                                    data-main-price="{{ $variation->price }}"
                                                                    data-q-discount="{{ $variation->discountRule?->value }}"
                                                                    data-q-discount-type="{{ $variation->discountRule?->type }}"
                                                                    value="{{ $variation->id }}">
                                                                <label
                                                                    class="btn btn-soft-primary px-1 py-0 fs-12 d-flex align-items-center justify-content-center"
                                                                    for="variation_{{ $variation->id }}">
                                                                    {{ $variation->name }}
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            {{-- <h5 class="mt-3">
                                <strong>Total Price: </strong> <span id="total-price"
                                    class="fw-normal">{{ number_format($service->price, 2) }} </span> <span
                                    class="fw-normal">lei</span>
                            </h5> --}}
                            <h5 class="mt-3">
                                <span>Total:</span>
                                <span class="text-danger fw-bold" id="total-price">
                                    {{ $service->price }} lei
                                </span>
                                <span class="text-muted fs-14 text-decoration-line-through" id="total-price-main">

                                </span>

                            </h5>



                            <input type="hidden" wire:model="selectedVariations" id="selected-variations">
                            <input type="hidden" wire:model="calculatedPrice" id="calculated-price">


                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const variationInputs = document.querySelectorAll('.variation-option');
                                    const totalPriceSpan = document.getElementById('total-price');
                                    const totalPriceMainSpan = document.getElementById('total-price-main');
                                    const cartBtn = document.getElementById('cart-btn');
                                    const buyBtn = document.getElementById('buy-btn');

                                    cartBtn.classList.add('disabled');
                                    cartBtn.setAttribute('aria-disabled', 'true');
                                    cartBtn.setAttribute('tabindex', '-1');
                                   
                                    buyBtn.classList.add('disabled');
                                    buyBtn.setAttribute('aria-disabled', 'true');
                                    buyBtn.setAttribute('tabindex', '-1');

                                    let selected = {
                                        area: null,
                                        session: {{ count($service->variationTypes) > 1 ? 0 : 1 }},
                                        mainPrice: null,
                                        mainSession: {{ count($service->variationTypes) > 1 ? 0 : 1 }},
                                        fixedDiscount: 0,
                                    };

                                    function updateTotal() {
                                        const area = selected.area ?? 0;
                                        const session = selected.session ?? 1;
                                        const mainPrice = selected.mainPrice ?? 0;
                                        const mainSession = selected.mainSession ?? 1;
                                        const fixedDiscount = selected.fixedDiscount ?? 0;

                                        let total = area * session;
                                        const mainTotal = mainPrice * mainSession;
                                        
                                        if(fixedDiscount !== 0) {
                                            total = total - fixedDiscount;
                                        }

                                        totalPriceSpan.textContent = total.toFixed(2) + 'lei';
                                        
                                        if (total != mainTotal) {
                                            totalPriceMainSpan.textContent = mainTotal.toFixed(2) + 'lei';
                                        } else {
                                            totalPriceMainSpan.textContent = '';
                                        }

                                        // Update hidden fields for Livewire
                                        const selectedVariations = [];
                                        variationInputs.forEach(input => {
                                            if (input.checked) {
                                                selectedVariations.push({
                                                    id: input.value,
                                                    typeId: input.dataset.typeid,
                                                    type: input.dataset.typename,
                                                    dataType: input.dataset.type,
                                                    price: parseFloat(input.dataset.price),
                                                    name: input.labels[0]?.innerText.trim()
                                                });
                                            }
                                        });

                                        // document.getElementById('buy-btn').href = ;

                                        // let href = '/payment?id={{ $service->id }}&price=' + total.toFixed(2) + '&variations=' + JSON.stringify(selectedVariations);
                                        let href = buyBtn.href;
                                        href += '&price=' + total.toFixed(2) + '&variations=' + JSON.stringify(selectedVariations);
                                        buyBtn.href = href;

                                        document.getElementById('selected-variations').value = JSON.stringify(selectedVariations);
                                        document.getElementById('calculated-price').value = total.toFixed(2);

                                        if (total > 0) {
                                            cartBtn.classList.remove('disabled');
                                            cartBtn.removeAttribute('aria-disabled');
                                            cartBtn.removeAttribute('tabindex');
                                            
                                            buyBtn.classList.remove('disabled');
                                            buyBtn.removeAttribute('aria-disabled');
                                            buyBtn.removeAttribute('tabindex');
                                        } else {
                                            cartBtn.classList.add('disabled');
                                            cartBtn.setAttribute('aria-disabled', 'true');
                                            cartBtn.setAttribute('tabindex', '-1');
                                            
                                            buyBtn.classList.add('disabled');
                                            buyBtn.setAttribute('aria-disabled', 'true');
                                            buyBtn.setAttribute('tabindex', '-1');
                                        }
                                    }

                                    variationInputs.forEach(input => {
                                        input.addEventListener('change', function() {
                                            const type = this.dataset.type;
                                            const price = parseFloat(this.dataset.price);
                                            const mainPrice = parseFloat(this.dataset['mainPrice']);
                                            const qDiscount = Number(this.dataset['qDiscount']);
                                            const qDiscountType = this.dataset['qDiscountType'];

                                            if (type === 'text') {
                                                selected.area = price;
                                                selected.mainPrice = mainPrice;
                                            } else if (type === 'number') {
                                                selected.mainSession = price;
                                                if (qDiscountType == 'percentage') {
                                                    selected.session = price * (1 - (qDiscount / 100));
                                                    selected.fixedDiscount = 0;
                                                } else {
                                                    selected.session = price;
                                                    selected.fixedDiscount = qDiscount;
                                                }
                                            }

                                            updateTotal();
                                        });
                                    });
                                });
                            </script>



                            {{-- New variation system --}}
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <h5 class="fs-15 mb-0">Quantity:</h5>
                            <div class="input-step ms-2">
                                <button type="button" class="minus" id="minus">–</button>
                                <input type="number" class="product-quantity1" id="quantity" value="1"
                                    min="0" max="100" readonly="">
                                <button type="button" class="plus" id="plus">+</button>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mt-3">
                                <div class="hstack gap-2">
                                    <livewire:add-to-cart :service="$service" :quantity="1" />
                                    <a href="/payment?id={{ $service->id }}" id="buy-btn" class="btn btn-success btn-hover w-100" style="display: none">
                                        <i
                                            class="bi bi-basket2 me-2"></i>{{ session()->get('lang') === 'ro' ? 'Cumpărați acum' : 'Buy Now' }}
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>

    <section class="section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs nav-tabs-custom mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                {{ session()->get('lang') === 'ro' ? 'Descriere' : 'Description' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                {{ session()->get('lang') === 'ro' ? 'Evaluări și recenzii' : 'Ratings & Reviews' }}
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="home1" role="tabpanel">
                            {!! $service->getTranslation('description', session()->get('lang')) !!}


                            <div class="row gy-4 justify-content-center mt-2">
                                <div class="col-xxl-8 col-lg-12">
                                    <div>
                                        <div class="mb-4">
                                            <h5 class="fs-16 mb-0 fw-semibold">
                                                {{ session()->get('lang') === 'ro' ? 'Întrebări generale' : 'General Questions' }}
                                            </h5>
                                        </div>

                                        <div class="accordion accordion-border-box" id="genques-accordion">
                                            @foreach ($service->faqs as $faq)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header"
                                                        id="genques-heading-{{ $faq->id }}">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#genques-collapse-{{ $faq->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="genques-collapse-{{ $faq->id }}">
                                                            {{ $faq->getTranslation('question', session()->get('lang')) }}
                                                        </button>
                                                    </h2>
                                                    <div id="genques-collapse-{{ $faq->id }}"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="genques-heading-{{ $faq->id }}"
                                                        data-bs-parent="#genques-accordion">
                                                        <div class="accordion-body">
                                                            {{ $faq->getTranslation('answer', session()->get('lang')) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!--end accordion-->
                                    </div>
                                </div>
                                <!--end col-->
                            </div>

                        </div>
                        <div class="tab-pane" id="profile1" role="tabpanel">

                            <div>
                                <div class="d-flex flex-wrap gap-4 justify-content-between align-items-center mt-4">
                                    <div class="flex-shrink-0">
                                        <h5 class="fs-15 mb-3 fw-medium">
                                            {{ session()->get('lang') === 'ro' ? 'Evaluări totale' : 'Total Ratings' }}
                                        </h5>
                                        <h2 class="fw-bold mb-3">{{ $totalReviews }}</h2>
                                        <p class="text-muted mb-0">
                                            {{ session()->get('lang') === 'ro' ? 'Creștere a recenziilor în acest an' : 'Growth in reviews on this year' }}
                                        </p>
                                    </div>
                                    <hr class="vr">
                                    <div class="flex-shrink-0">
                                        <h5 class="fs-15 mb-3 fw-medium">
                                            {{ session()->get('lang') === 'ro' ? 'Evaluare medie' : 'Average Rating' }}
                                        </h5>
                                        <h2 class="fw-bold mb-3">{{ $averageRating }} <span
                                                class="fs-16 align-middle text-warning ms-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="bi bi-star-{{ $i <= floor($averageRating) ? 'fill' : ($i - $averageRating < 1 ? 'half' : '') }} text-warning"></i>
                                                @endfor
                                            </span>
                                            <span class="text-muted ms-2 fs-12">({{ $totalReviews }} Reviews)</span>
                                        </h2>
                                        <p class="text-muted mb-0">
                                            {{ session()->get('lang') === 'ro' ? 'Evaluare medie pe acest an' : 'Average rating on this year' }}
                                        </p>
                                    </div>
                                    <hr class="vr">
                                    <div class="flex-shrink-0 w-xl">
                                        @foreach ($ratings as $rating)
                                            @php
                                                $bgColor = match ($rating['rating']) {
                                                    5 => 'bg-primary',
                                                    4 => 'bg-success',
                                                    3 => 'bg-info',
                                                    2 => 'bg-secondary',
                                                    1 => 'bg-danger',
                                                    default => 'bg-dark',
                                                };
                                            @endphp
                                            <div class="row align-items-center g-3 mb-2">
                                                <div class="col-auto">
                                                    <div>
                                                        <h6 class="mb-0 text-muted fs-13">
                                                            <i
                                                                class="bi bi-star-fill text-warning me-1 align-bottom"></i>{{ $rating['rating'] }}
                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <div class="progress animated-progress progress-sm">
                                                            <div class="progress-bar {{ $bgColor }}"
                                                                role="progressbar"
                                                                style="width: {{ number_format($rating['percentage'], 2) }}%"
                                                                aria-valuenow="{{ number_format($rating['percentage'], 2) }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div>
                                                        <h6 class="mb-0 text-muted fs-13">{{ $rating['count'] }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                </div>
                                <div class="mt-4" data-simplebar style="max-height: 350px">
                                    @foreach ($service->reviews as $review)
                                        @if ($review->is_approved)
                                            <div class="d-flex p-3 border-bottom border-bottom-dashed">
                                                <div class="flex-shrink-0 me-3">
                                                    <img class="avatar-xs rounded-circle"
                                                        src="{{ $review->user?->image ? asset('/storage/' . $review->user->image) : URL::asset('img/default.png') }}"
                                                        alt="">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex mb-3">
                                                        <div class="flex-grow-1">
                                                            <div>
                                                                <div class="mb-2 fs-12">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $review->rating)
                                                                            <span><i
                                                                                    class="bi bi-star-fill text-warning align-bottom"></i></span>
                                                                        @else
                                                                            <span><i
                                                                                    class="bi bi-star text-warning align-bottom"></i></span>
                                                                        @endif
                                                                    @endfor
                                                                </div>

                                                                <h6 class="mb-0">{{ $review->name }}</h6>
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <p class="mb-0 text-muted"><i
                                                                    class="bi bi-calendar3 me-2 align-middle"></i>{{ \Carbon\Carbon::parse($review->created_at)->toFormattedDateString() }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0">
                                                            {{ $review->comment }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="pt-3">
                                    <h5 class="fs-18">
                                        {{ session()->get('lang') === 'ro' ? 'Adăugați o recenzie' : 'Add a Review' }}</h5>
                                    <div>
                                        <form action="/review/{{ $service->id }}/store" class="form" method="POST">
                                            @csrf
                                            <div class="d-flex align-items-center mb-3">
                                                <span
                                                    class="fs-14">{{ session()->get('lang') === 'ro' ? 'Evaluarea ta' : 'Your rating' }}:</span>

                                                <div class="ms-3" id="rating-set">
                                                    <span class="fs-14 star" data-value="1"><i
                                                            class="bi bi-star-fill text-warning align-bottom"></i></span>
                                                    <span class="fs-14 star" data-value="2"><i
                                                            class="bi bi-star-fill text-warning align-bottom"></i></span>
                                                    <span class="fs-14 star" data-value="3"><i
                                                            class="bi bi-star-fill text-warning align-bottom"></i></span>
                                                    <span class="fs-14 star" data-value="4"><i
                                                            class="bi bi-star-fill text-warning align-bottom"></i></span>
                                                    <span class="fs-14 star" data-value="5"><i
                                                            class="bi bi-star-fill text-warning align-bottom"></i></span>
                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-md-6">
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="name"
                                                        placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți numele dvs' : 'Enter your name' }}"
                                                        name="name"
                                                        value="{{ old('name') ?? Auth::check() ? Auth::user()->name : '' }}"
                                                        required>
                                                    @error('name')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="address"
                                                        placeholder="{{ session()->get('lang') === 'ro' ? 'Introdu adresa ta de e-mail' : 'Enter your email address' }}"
                                                        name="email"
                                                        value="{{ old('email') ?? Auth::check() ? Auth::user()->email : '' }}"
                                                        required>
                                                    @error('email')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <textarea class="form-control @error('comment') is-invalid @enderror" name="comment"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți comentariile și recenziile dvs' : 'Enter your comments & reviews' }}"
                                                    rows="4" required>{{ old('comment') }}</textarea>
                                                @error('email')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <input type="hidden" name="rating" id="rating" value="5">

                                            <div class="text-end">
                                                <button class="btn btn-primary btn-hover" type="submit"
                                                    value="Submit"><i class="bi bi-send align-bottom ms-1"></i>
                                                    {{ session()->get('lang') === 'ro' ? 'Trimite recenzie' : 'Send Review' }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-1">
                        <h4 class="flex-grow-1 mb-0">
                            {{ session()->get('lang') === 'ro' ? 'Servicii similare' : 'Similar Services' }}</h4>
                        <div class="flex-shrink-0">
                            <a href="/services"
                                class="link-effect link-secondary">{{ session()->get('lang') === 'ro' ? 'Toate Serviciile' : 'All Services' }}
                                <i class="bi bi-arrow-right align-bottom"></i></a>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                @foreach ($similerServices as $service)
                    <div class="col-xxl-4 col-lg-4 col-md-6">
                        <div class="card ecommerce-product-widgets border-0 rounded-0 shadow-none overflow-hidden">
                            <div class="bg-light bg-opacity-50 rounded position-relative">
                                <img src="{{ asset('/storage/' . $service->thumbnail) }}"
                                    alt="{{ $service->getTranslation('name', session()->get('lang')) }}"
                                    class="mx-auto d-block rounded-2 img-fluid w-100">
                                @if ($service->discounted_price > 0)
                                    <div class="avatar-xs label">
                                        <div class="avatar-title bg-danger rounded-circle fs-11">
                                            {{ $service->discounted_price }}%</div>
                                    </div>
                                @endif
                            </div>
                            <div class="pt-4">
                                <div>
                                    <div class="avatar-xxs mb-3">
                                        {{-- <div class="avatar-title bg-light text-muted rounded cursor-pointer">
                                            <i class="ri-error-warning-line"></i>
                                        </div> --}}
                                    </div>
                                    <a href="{{ $service->slug }}">
                                        <h6 class="text-capitalize fs-15 lh-base text-truncate mb-0">
                                            {{ $service->getTranslation('name', session()->get('lang')) }}</h6>
                                    </a>
                                    <div class="mt-2">
                                        <span class="float-end">{{ number_format($service->reviews_avg_rating, 1) }} <i
                                                class="bi bi-star-fill text-warning align-bottom"></i></span>
                                        {{-- @if ($service->discounted_price > 0)
                                            <h5 class="text-secondary mb-0">
                                                {{ number_format($service->price - ($service->price * $service->discounted_price) / 100, 2) }}
                                                lei
                                                <span class="text-muted fs-12"><del>{{ number_format($service->price, 2) }}
                                                        lei</del></span>
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
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end section-->
    </section>

    <x-subscription />

    <x-key-features />
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stars = document.querySelectorAll("#rating-set .star");
            const ratingInput = document.getElementById("rating");

            function updateStars(rating) {
                stars.forEach((s, index) => {
                    s.innerHTML = index < rating ?
                        '<i class="bi bi-star-fill text-warning align-bottom"></i>' :
                        '<i class="bi bi-star text-warning align-bottom"></i>';
                });
            }

            // Set default rating to 5
            updateStars(5);

            stars.forEach(star => {
                star.addEventListener("click", function() {
                    const ratingValue = this.getAttribute("data-value");
                    ratingInput.value = ratingValue;
                    updateStars(ratingValue);
                });
            });
        });


        // At the top of your JavaScript
        let productQuantity = 1;

        const quantity = document.getElementById('quantity');
        const plus = document.getElementById('plus');
        const minus = document.getElementById('minus');

        // Update the input initially
        quantity.value = productQuantity;

        plus.addEventListener('click', function() {
            productQuantity++;
            quantity.value = productQuantity;
        });

        minus.addEventListener('click', function() {
            if (productQuantity > 1) {
                productQuantity--;
                quantity.value = productQuantity;
            }
        });

        function getSelectedVariations() {
            let selected = [];
            document.querySelectorAll('.variation-option:checked').forEach(el => {
                selected.push({
                    id: parseInt(el.value),
                    typeId: parseInt(el.getAttribute('data-typeid')),
                    type: el.getAttribute('data-typename'),
                    dataType: el.getAttribute('data-type'),
                    name: el.getAttribute('data-name'),
                    discount: el.getAttribute('data-q-discount'),
                    discountType: el.getAttribute('data-q-discount-type'),
                    price: parseFloat(el.getAttribute('data-price')),
                });
            });
            return selected;
        }

        function calculatedPrice() {
            return document.getElementById('calculated-price').value;
        }

        // Find and modify the add to cart button click behavior
        document.addEventListener('click', function(e) {
            // Check if the clicked element is the add to cart button or contains it
            const addBtn = e.target.closest('.add-btn');
            if (addBtn && addBtn.hasAttribute('wire:id')) {
                // Prevent the default Livewire action
                e.preventDefault();
                e.stopPropagation();

                const componentId = addBtn.getAttribute('wire:id');

                // Call a method that accepts the quantity parameter
                Livewire.find(componentId).call('addToCartWithVariations', getSelectedVariations(), calculatedPrice(), parseInt(
                    productQuantity));
            }
        });
    </script>

    <!--Swiper slider js-->
    {{-- <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script> --}}

    {{-- <script src="{{ URL::asset('build/js/frontend/product-details.init.js') }}"></script> --}}

    <!-- landing-index js -->
    <script src="{{ URL::asset('build/js/frontend/menu.init.js') }}"></script>
@endsection
