@extends('layouts.master')

@section('title', $post->getTranslation('title', session()->get('lang')))
@section('keywords', $post->seo_keywords ?? '')
@section('description', $post->getTranslation('excerpt', session()->get('lang')))
@section('thumbnail', asset('/storage/' . $post->thumbnail))

@push('schema')
<x-schema.schema-wrapper>
    <x-schema.organization />
    
    <x-schema.web-page :page="[
        'url' => route('blogs.post', $post->slug),
        'name' => $post->getTranslation('title', session()->get('lang')),
        'datePublished' => $post->created_at->toIso8601String(),
        'dateModified' => $post->updated_at->toIso8601String()
    ]" :image="[
        'url' => asset('/storage/' . $post->thumbnail),
        'width' => '687',
        'height' => '429',
        'caption' => $post->getTranslation('title', session()->get('lang'))
    ]" :breadcrumb="[
        [
            '@type' => 'ListItem',
            'position' => '1',
            'item' => [
                '@id' => url('/'),
                'name' => 'Home'
            ]
        ],
        [
            '@type' => 'ListItem',
            'position' => '2',
            'item' => [
                '@id' => url('/blogs'),
                'name' => 'Blog'
            ]
        ],
        [
            '@type' => 'ListItem',
            'position' => '3',
            'item' => [
                '@id' => url('/blogs/{{$post->slug}}'),
                'name' => $post->title
            ]
        ]
    ]" />

    <x-schema.article :article="[
        'headline' => $post->getTranslation('title', session()->get('lang')),
        'keywords' => $post->seo_keywords,
        'datePublished' => $post->created_at->toIso8601String(),
        'dateModified' => $post->updated_at->toIso8601String(),
        'url' => url('/blogs/{{$post->slug}}'),
        'description' => $post->getTranslation('excerpt', session()->get('lang')),
        'image' => asset('/storage/' . $post->thumbnail)
    ]" :author="[
        'name' => $post->user->name,
        'url' => url('/author/{{$post->user->id}}'),
        'image' => $post->user->image,
        'sameAs' => [url('/')]
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

            <div class="row mt-5">
                {{-- @foreach ($posts as $post) --}}
                <div class="col-lg-9 mx-auto">
                    <div class="card overflow-hidden">
                        <div class="w-100"  style="min-height: 200px;">
                            <img src="{{ asset('/storage/' . $post->thumbnail) }}" class="img-fluid bg-dark-subtle w-100" alt="">
                        </div>
                        <div class="card-body">
                            <div class="entry-meta">
                                <span class="text-muted">{{ $post->views }} <i class="mdi mdi-like"></i>
                                    {{ session()->get('lang') === 'ro' ? 'Vizualizări' : 'Views' }}</span>
                                <span class="text-muted mx-1">|</span>
                                <span class="text-muted">{{ $post->comments_count }}
                                    {{ session()->get('lang') === 'ro' ? 'Comentarii' : 'Comments' }}</span>
                            </div>
                            <div class="blog-date bg-body-secondary rounded">
                                <h4 class="mb-0">{{ $post->created_at->format('d') }}</h4>
                                <p class="text-muted mt-1">{{ $post->created_at->format('F') }}</p>
                            </div>
                            <div class="mt-3">

                                <h1 class="fs-17 lh-base">
                                    {{ $post->getTranslation('title', session()->get('lang')) }}</h1>

                                <div class="text-muted fs-15 mt-2">
                                    {!! $post->getTranslation('content', session()->get('lang')) !!}
                                </div>
                            </div>
                        </div>

                        {{-- Comments --}}
                        <div class="px-4">
                            <div class="d-flex flex-wrap gap-4 justify-content-between align-items-center mt-4">
                                <div class="flex-shrink-0">
                                    <h5 class="fs-15 mb-3 fw-medium">
                                        {{ session()->get('lang') === 'ro' ? 'Comentarii' : 'Comments' }}</h5>
                                </div>
                            </div>
                            <div class="mt-4" data-simplebar="init" style="max-height: 350px">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content"
                                                style="height: auto; overflow: hidden scroll;">
                                                <div class="simplebar-content" style="padding: 0px;">

                                                    @foreach ($post->user_comments as $comment)
                                                        @if(Auth::check())
                                                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'super')
                                                            <div class="d-flex p-3 border-bottom border-bottom-dashed">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <img class="avatar-xs rounded-circle"
                                                                        src="{{ $comment->user->image ? asset('/storage/' . $comment->user->image) : URL::asset('img/default.png') }}"
                                                                        alt="">
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="d-flex mb-2">
                                                                        <div class="flex-grow-1">
                                                                            <div>
                                                                                <h6 class="mb-0">{{ $comment->name }} @if($comment->is_approved) <span class="text-success">(Showing in public)</span> @else<span class="text-danger">(Not showing in public)</span>@endif</h6>
                                                                                <p class="mb-0 text-muted"><i
                                                                                        class="ri-calendar-event-fill me-2 align-middle"></i>{{ \Carbon\Carbon::parse($comment->created_at)->toFormattedDateString() }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        @if ($comment->is_approved)
                                                                            <form class="flex-shrink-0" action="/comment/visible/{{ $comment->id }}" method="POST">
                                                                                @csrf
                                                                                <button type="submit" type="button"
                                                                                    class="btn btn-sm btn-danger btn-icon"><i
                                                                                        class="ri-eye-off-line"></i></button>
                                                                            </form>
                                                                        @else
                                                                        <form class="flex-shrink-0" action="/comment/visible/{{ $comment->id }}" method="POST">
                                                                            @csrf
                                                                            <button type="submit" type="button"
                                                                                class="btn btn-sm btn-success btn-icon"><i
                                                                                    class="ri-eye-line"></i></button>
                                                                        </form>
                                                                        @endif
                                                                    </div>
                                                                    <div>

                                                                        <p class="mb-0">{{ $comment->comment }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @else
                                                            @if($comment->is_approved)
                                                            <div class="d-flex p-3 border-bottom border-bottom-dashed">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <img class="avatar-xs rounded-circle"
                                                                        src="{{ $comment->user->image ? asset('/storage/' . $comment->user->image) : URL::asset('img/default.png') }}"
                                                                        alt="">
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="d-flex mb-2">
                                                                        <div class="flex-grow-1">
                                                                            <div>
                                                                                <h6 class="mb-0">{{ $comment->name }}</h6>
                                                                                <p class="mb-0 text-muted"><i
                                                                                        class="ri-calendar-event-fill me-2 align-middle"></i>{{ \Carbon\Carbon::parse($comment->created_at)->toFormattedDateString() }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div>
    
                                                                        <p class="mb-0">{{ $comment->comment }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: auto; height: 719px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                    <div class="simplebar-scrollbar"
                                        style="height: 170px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
                                </div>
                            </div>
                            <div class="card p-4">
                                <h5 class="fs-18">
                                    {{ session()->get('lang') === 'ro' ? 'Adăugați un comentariu' : 'Add a Comment' }}</h5>
                                <div>
                                    <form action="/comment/{{ $post->id }}/store" class="form" method="POST">
                                        @csrf
                                        <div class="mb-3 row">
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
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
                                                    class="form-control @error('email') is-invalid @enderror" id="address"
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
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți comentariile dvs' : 'Enter your comments' }}"
                                                rows="4" required>{{ old('comment') }}</textarea>
                                            @error('email')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="text-end">
                                            <button class="btn btn-primary btn-hover" type="submit"
                                                value="Submit">{{ session()->get('lang') === 'ro' ? 'Trimite comentariu' : 'Send Comment' }}
                                                <i class="ri-send-plane-2-line align-bottom ms-1"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Comments --}}
                    </div>
                </div>
                {{-- @endforeach --}}

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
