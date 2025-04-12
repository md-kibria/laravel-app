@extends('layouts.master')

@section('title', $page->getTranslation('title', session()->get('lang')))
@section('keywords', $page->meta_keywords)
@section('description', $page->meta_description)
@section('thumbnail', config('logo'))

@push('schema')
    <x-schema.schema-wrapper>
        <x-schema.organization />
        
        <x-schema.web-page :page="[
            'url' => request()->url(),
            'name' => $page->meta_title,
            'datePublished' => $page->created_at->format('Y-m-d\TH:i:sP'),
            'dateModified' => $page->updated_at->format('Y-m-d\TH:i:sP'),
        ]" />

        <x-schema.article :article="[
            'headline' => $page->meta_title,
            'description' => $page->meta_description,
            'keywords' => $page->meta_keywords,
            'datePublished' => $page->created_at->format('Y-m-d\TH:i:sP'),
            'dateModified' => $page->updated_at->format('Y-m-d\TH:i:sP'),
            'url' => request()->url(),
            'image' => config('logo'),
        ]" />
    </x-schema.schema-wrapper>
@endpush

@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <section class="term-condition bg-primary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center">
                        <h1 class="text-white mb-2">{{ $page?->getTranslation('title', session()->get('lang')) }}</h1>
                        <p class="text-white-75 mb-0">Last Updated {{ \Carbon\Carbon::parse($page->updated_at)->format('d M, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="position-relative">
        <div class="svg-shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="1440"
                height="120" preserveAspectRatio="none" viewBox="0 0 1440 120">
                <g mask="url(&quot;#SvgjsMask1039&quot;)" fill="none">
                    <rect width="1440" height="120" x="0" y="0" fill="var(--tb-primary)"></rect>
                    <path d="M 0,85 C 288,68.8 1152,20.2 1440,4L1440 120L0 120z" fill="var(--tb-body-bg)"></path>
                </g>
                <defs>
                    <mask id="SvgjsMask1039">
                        <rect width="1440" height="120" fill="#ffffff"></rect>
                    </mask>
                </defs>
            </svg>
        </div>
    </div>

    <section class="section pt-0">
        <div class="container">
            <div class="card term-card mb-0">
                <div class="card-body p-5">
                    {!! $page?->getTranslation('content', session()->get('lang')) !!}
                </div>
            </div>
        </div>
    </section>

    <x-subscription />

    <x-key-features />
@endsection
@section('scripts')
    <!-- landing-index js -->
    <script src="{{ URL::asset('build/js/frontend/menu.init.js') }}"></script>
@endsection
