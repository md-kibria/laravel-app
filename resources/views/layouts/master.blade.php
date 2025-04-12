<!doctype html>
<html lang="{{ session()->get('lang') === 'ro' ? 'ro' : 'en' }}" data-bs-theme="light" data-footer="dark">

<head>
    <meta charset="utf-8">
    <title>@yield('title') | {{ config('site_title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large"/>
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta content="@yield('keywords')" name="keywords">
    <meta content="@yield('description')" name="description">

    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="@yield('thumbnail')" />
    <meta property="og:site_name" content="{{ config('site_title') }}" />
    <meta property="og:locale" content="{{ session()->get('lang') === 'ro' ? 'ro_RO' : 'en_EN' }}" />
    
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="@yield('description')" />
    <meta property="twitter:site" content="{{ config('site_title') }}" />
    <meta property="twitter:image" content="@yield('thumbnail')" />

    @stack('schema')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ config('favicon') }}">

    <!-- head css -->
    @include('layouts.head-css')

    <!-- live-wire css -->
    @livewireStyles
</head>

<body>

    <!-- top tagbar -->
    @include('layouts.top-tagbar')
    <!-- topbar -->
    @include('layouts.topbar')

    @yield('content')

    <!-- footer -->
    @include('layouts.footer')
    <!-- scripts -->
    @include('layouts.vendor-scripts')

    <!-- live-wire scripts -->
    @livewireScripts

    {{-- Alert --}}
    <x-flash-message />

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('modalStayOpen', () => {
                $('#ecommerceCart').modal('show'); // Replace with your actual modal ID
            });

            Livewire.on('openModal', () => {
                $('#ecommerceCart').modal('show'); // Replace with your actual modal ID
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('cartCountUpdated', (count) => {
                document.getElementById('cartCount').textContent = count;
            });
        });
    </script>

</body>

</html>
