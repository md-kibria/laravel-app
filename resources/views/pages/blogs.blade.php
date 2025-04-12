@extends('layouts.master')

@section('title', 'Blogs')
@section('keywords', $keywords)
@section('description', 'Explore the latest in beauty, skincare, and aesthetic treatments with Reshape Clinique. From expert tips on body contouring to the newest trends in non-invasive procedures, our blog keeps you informed and inspired on your journey to confidence and well-being.')
@section('thumbnail', config('logo'))

@push('schema')
<x-schema.schema-wrapper>
    <x-schema.organization />
    
    <x-schema.web-page :page="[
        'url' => request()->url('/blogs'),
        'name' => 'Blogs - '.config('site_title'),
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
                '@id' => request()->url('/blogs'),
                'name' => 'Blogs'
            ]
        ]
    ]" />
    
    <x-schema.article :article="[
        'headline' => 'Blogs - '.config('site_title'),
        'keywords' => $keywords,
        'datePublished' => $datePublished,
        'dateModified' => $datePublished,
        'url' => request()->url('/blogs'),
        'description' => 'Explore the latest in beauty, skincare, and aesthetic treatments with Reshape Clinique. From expert tips on body contouring to the newest trends in non-invasive procedures, our blog keeps you informed and inspired on your journey to confidence and well-being.'
    ]" />
</x-schema.schema-wrapper>
@endpush

@section('css')
    <!-- extra css -->
    <!--Swiper slider css-->
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="mt-5"></div>
    <!-- START BLOG -->
    <section class="section bg-light bg-opacity-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="text-center">
                        <h3 class="mb-3">Expert Aesthetic Tips & Trends</h3>
                        <p class="text-muted fs-15">Explore the latest in beauty, skincare, and aesthetic treatments with
                            Reshape Clinique. From expert tips on body contouring to the newest trends in non-invasive
                            procedures, our blog keeps you informed and inspired on your journey to confidence and
                            well-being.</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                @foreach ($posts as $post)
                    <div class="col-lg-4">
                        <div class="card overflow-hidden">
                            <img src="{{ asset('/storage/' . $post->thumbnail) }}" class="img-fluid" alt="">
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
                                    <a href="{{ route('blogs.post', $post->slug) }}">
                                        <h5 class="fs-17 lh-base">
                                            {{ $post->getTranslation('title', session()->get('lang')) }}</h5>
                                    </a>
                                    <p class="text-muted fs-15 mt-2">
                                        {{ $post->getTranslation('excerpt', session()->get('lang')) }}</p>
                                    <a href="{{ route('blogs.post', $post->slug) }}"
                                        class="link-effect link-info">{{ session()->get('lang') === 'ro' ? 'Continuă să citești' : 'Continue Reading' }}
                                        <i class="bi bi-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-between align-items-center pt-2">
                <p class="text-muted mb-0">
                    Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} results
                </p>
                {{ $posts->links() }}
            </div>
        </div>
    </section>
    <!-- END BLOG -->
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
