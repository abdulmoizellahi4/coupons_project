<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head prefix="og: https://ogp.me/ns# fb: https://ogp.me/ns/fb# bighsavinghub: https://ogp.me/ns/fb/bighsavinghub#">
    <meta name="fo-verify" content="b396d87c-3384-48bd-a28d-105f764a03eb">
    <meta name="verify-admitad" content="fc2c5284bd" />
    
    <link rel="preload" href="{{ asset('frontend_assets/css/fonts.css') }}" as="style" crossorigin>
    <link rel="preload" href="{{ asset('frontend_assets/css/home.css') }}" as="style" crossorigin>
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/fonts.css') }}" crossorigin>
    {{-- cache-bust css files using filemtime so browsers pick up updates immediately --}} 
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/home.css') }}?v={{ file_exists(public_path('frontend_assets/css/home.css')) ? filemtime(public_path('frontend_assets/css/home.css')) : time() }}" as="style" crossorigin>
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/brand.css') }}?v={{ file_exists(public_path('frontend_assets/css/brand.css')) ? filemtime(public_path('frontend_assets/css/brand.css')) : time() }}" as="style" crossorigin>
    <link rel="stylesheet" href="{{ route('colors.css') }}?v={{ time() }}" crossorigin>
    <link rel="preload" href="{{ asset('frontend_assets/js/home.js') }}" as="script" crossorigin>
    
    @stack('styles')

    @php
        $brandingSettings = \App\Helpers\SettingsHelper::getBranding();
    @endphp
    @if($brandingSettings['site_favicon_url'])
        <link rel="shortcut icon" href="{{ $brandingSettings['site_favicon_url'] }}" type="image/png" />
        <link rel="icon" href="{{ $brandingSettings['site_favicon_url'] }}" type="image/png">
        <link rel="mask-icon" href="{{ $brandingSettings['site_favicon_url'] }}">
        <link rel="apple-touch-icon" href="{{ $brandingSettings['site_favicon_url'] }}" />
    @else
        <link rel="shortcut icon" href="{{ asset('assets/img/icons/logo.png') }}" type="image/png" />
        <link rel="icon" href="{{ asset('assets/img/icons/logo.png') }}" type="image/png">
        <link rel="mask-icon" href="{{ asset('assets/img/icons/logo.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('assets/img/icons/logo.png') }}" />
    @endif
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="influencerrate-verification" content="21a3e1d6f5b4bfbf5b07c275a2d57093" />
    <meta http-equiv="Content-Security-Policy" content="script-src * data: https://ssl.gstatic.com 'unsafe-inline' 'unsafe-eval'">
    <meta name="google-site-verification" content="ugHy5OZkkcJbkGO2TNrGqox8Ch_-CzVOC0Oc1PNBgDk" />

    <title>@yield('title', $brandingSettings['site_name'] . ' - ' . $brandingSettings['site_tagline'])</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1.0">

    <meta name="description" content="@yield('description', 'Discover the latest UK discount and voucher codes at Big Saving Hub. Explore exclusive online deals, and save big on your favourite brands. Start saving today!')" />
    <meta name="keywords" content="@yield('keywords', 'Vouchers, Voucher Codes, Discount Vouchers, Promo Codes, Promotional Codes, Big Saving Hub')" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="data-attr" content="0,Home">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#4a0c98">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#4a0c98">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#4a0c98">
    <meta name="msvalidate.01" content="5A1FB5F8C99163D67DCCD7155E7DB790" />

    <meta name="google-site-verification" content="i7LiYoLWLfV60_B5_oC7Nd609nn2bKfh-IgxrQ2HMoQ" />
    <meta name="verification" content="5a051dc5446e023da5daa5e961ba3747" />
    <meta name="641c8b194782268" content="41362bac02e739316819b2a56ddefc6b" />
    
    <meta name="fo-verify" content="678a8df1-cdee-4224-8ae0-cd8d6b0f0355">
    <meta name="yandex-verification" content="87236fc7e50662a9" />
    <meta name="author" content="Big Saving Hub">

    <meta property="fb:app_id" content="105222033160224" />

    <meta property="og:title" content="@yield('og_title', 'BigSavingHub.com Vouchers and Coupons!')" />
    <meta property="og:description" content="@yield('og_description', 'Welcome to your favourite destination of voucher codes, promo codes, discount codes, & free shipping offers!')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('assets/img/icons/logo.png') }}" />
    <meta property="og:site_name" content="BigSavingHub.com" />
    <meta property="og:video" content="https://www.youtube.com/watch?v=cxjT21T5yeQ" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#4a0c98">
    <meta name="p:domain_verify" content="8303e513d812417acc70115a6700b145" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-title" content="BigSavingHub.com Vouchers and Coupons!">
    <meta name="application-name" content="BigSavingHub.com Vouchers and Coupons!">

    <link rel="search" href="open-search.xml" title="Search bighsavinghub.com" type="application/opensearchdescription+xml">
    <meta property="al:web:url" content="{{ url()->current() }}" />
    <link href="{{ url()->current() }}" rel="canonical" />
    <meta name="verify-reviews" content="$2y$10$3k0GNwpUB7YS2lCi8wj/COhbW1TnrT7yNYL6RS1W4D3jSwpxqzh.2">
    <meta name="ahrefs-site-verification" content="eee357cb614244b7172a63301f3120b383a6d0bc6f190dee582ab90938a8ae2f">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        var app_url = "{{ url('/') }}";
        var app_media = "{{ asset('') }}";
        var current_url = "{{ url()->current() }}";
        var current_url_full = "{{ url()->full() }}";
        var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        var Banner_Keyword = "voucher code";
        var Logo_Keyword = "discount code";
        var uid = "{{ auth()->id() ?? '0' }}";
    </script>

    <script src="../analytics.ahrefs.com/analytics.js" data-key="qgIOLYMvuRljdStz8YlpPw" async></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-V2RZW7098F"></script>
    
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-V2RZW7098F');
    </script>
</head>

<body>
    <!-- main wrapper <start> -->
    <main class="main">
        @include('frontend.partials.header')
        
        <div class="crtn"></div>
        
        <!-- Page content. -->
        @yield('content')
        
        @include('frontend.partials.footer')
    </main>

    <!-- Back to top button <start> -->
    <button id="tpBtn" type="button" tabindex="-1" class="bp_arw-ryt"></button>
    <!-- Back to top button <end> -->

    <script src="{{ asset('frontend_assets/js/home.js') }}" async crossorigin></script>
    
    @stack('scripts')
    
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"version":"2024.11.0","token":"655abde128ad45a4b790336a257ae268","server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
</body>
</html>
