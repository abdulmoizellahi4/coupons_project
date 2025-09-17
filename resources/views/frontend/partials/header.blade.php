<!-- sidenv: Side Navigation <component:start> -->
<nav class="sidenv">
    <!-- snhead: Side Navigation Head <start> -->
    <span class="snhead">Menu <a href="javascript:;" class="snx ico bp_close" aria-label="Close Notification"></a></span>
    <!-- snhead: Side Navigation Head <end> -->

    <a href="{{ route('top-discounts') }}">Top 20 Discounts</a>
    <a href="{{ route('categories') }}">Categories</a>
    <a href="{{ route('events') }}">Events</a>
    <a href="{{ route('home') }}">About Us</a>
    <a href="{{ route('contact') }}">Contact Us</a>
    <a href="{{ route('mobile-app') }}">Mobile App</a>
    
    @if(Auth::guard('customer')->check())
        <div class="user-menu">
            <span>Welcome, {{ Auth::guard('customer')->user()->name }}</span>
            <form method="POST" action="{{ route('customer.logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    @else
        <a href="{{ route('customer.login') }}" class="lgnbtn">Login</a>
        <a href="{{ route('customer.register') }}" class="lgnbtn">Sign Up</a>
    @endif
    
    <!-- scl: Social Links <start> -->
    <nav class="scl">
        @php
            $socialSettings = \App\Helpers\SettingsHelper::getSocial();
        @endphp
        @if($socialSettings['facebook_url'])
            <a href="{{ $socialSettings['facebook_url'] }}" class="ico fb" title="Facebook"></a>
        @endif
        @if($socialSettings['twitter_url'])
            <a href="{{ $socialSettings['twitter_url'] }}" class="ico twt" title="Twitter"></a>
        @endif
        @if($socialSettings['instagram_url'])
            <a href="{{ $socialSettings['instagram_url'] }}" class="ico ins" title="Instagram"></a>
        @endif
        @if($socialSettings['linkedin_url'])
            <a href="{{ $socialSettings['linkedin_url'] }}" class="ico linkedin" title="LinkedIn"></a>
        @endif
        @if($socialSettings['youtube_url'])
            <a href="{{ $socialSettings['youtube_url'] }}" class="ico youtube" title="YouTube"></a>
        @endif
    </nav>
    <!-- scl: Social Links <end> -->
</nav>
<!-- sidenv: Side Navigation <component:end> -->

<!-- header <component:start> -->
<header class="header" >
    <div class="VhcWrp container">
        <!-- mbtn: Mobile Button, hmbtn: Header Menu Button <start> -->
        <a href="javascript:;" class="mbtn hmbtn" title="Toggle Menu">
            <i class="ico bp_menu"></i>
        </a>
        <!-- mbtn: Mobile Button, hmbtn: Header Menu Button <end> -->

        <!-- lgo: Logo <start> -->
        @php
            $brandingSettings = \App\Helpers\SettingsHelper::getBranding();
        @endphp
        <a href="{{ route('home') }}" class="lgo site-logo" title="{{ $brandingSettings['site_name'] }}">
            @if($brandingSettings['site_logo_url'])
                <img class="site-logo-img" loading="lazy" decoding="async" src="{{ $brandingSettings['site_logo_url'] }}" alt="{{ $brandingSettings['site_name'] }}" title="{{ $brandingSettings['site_name'] }}">
            @else
                <img class="site-logo-img" loading="lazy" decoding="async" src="{{ asset('assets/img/icons/logo.png') }}" alt="{{ $brandingSettings['site_name'] }}" title="{{ $brandingSettings['site_name'] }}">
            @endif
        </a>
        <!-- lgo: Logo <end> -->

        <!-- nls: Navigation Links <start> -->
        <nav class="nls">
            <a class="" href="{{ route('top-discounts') }}" title="Top 20 Discounts">Top 20 Discounts</a>
            
            <!-- drpdwn: Dropdown -->
            <div class="drpdwn">
                <a href="#">Trending</a>
                <div class="itemsw">
                    <div class="items itscol">
                        @if(isset($trendingStores) && $trendingStores->count() > 0)
                            @foreach($trendingStores as $store)
                                <a href="{{ route('store', $store->seo_url) }}">{{ $store->store_name }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- drpdwn: Dropdown -->
            <div class="drpdwn">
                <a href="{{ route('categories') }}" title="Categories">Categories</a>
                <div class="itemsw">
                    <div class="items">
                        @if(isset($topCategories) && $topCategories->count() > 0)
                            @foreach($topCategories as $category)
                                <div class="item">
                                    <h2><a href="{{ route('category', $category->seo_url) }}">{{ $category->category_name }}</a></h2>
                                    @php
                                        $categoryStores = $category->stores()->where('status', 1)->take(3)->get();
                                    @endphp
                                    @if($categoryStores->count() > 0)
                                        @foreach($categoryStores as $store)
                                            <a href="{{ route('store', $store->seo_url) }}">{{ $store->store_name }}</a>
                                        @endforeach
                                    @endif
                                    <a class="readbt morebt" href="{{ route('category', $category->seo_url) }}">More Brands</a>
                                </div>
                            @endforeach
                        @endif
                        
                        <!-- <div class="item">
                            <h2><a href="{{ route('categories') }}">More Categories </a></h2>
                            <a class="readbt morebt" href="{{ route('categories') }}">All Categories</a>
                        </div> -->
                    </div>
                </div>
            </div>

            <a class="sf" style="display:none" href="javascript:;" aria-label="Search" title="Search"><i class="bp_search"></i> Search</a>
        </nav>
        <!-- nls: Navigation Links <end> -->

        <div class="nls nlbmbv">
            @if(Auth::guard('customer')->check())
                <div class="user-info">
                    <span>Welcome, {{ Auth::guard('customer')->user()->name }}</span>
                    <form method="POST" action="{{ route('customer.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('customer.login') }}" class="login bp_login" aria-label="Login" title="Login"></a>
            @endif
        </div>

        <!-- mbtn: Mobile Button, hsbtn: Header Search Button <start> -->
        <a href="javascript:;" class="mbtn hsbtn" title="Toggle Seach">
            <i class="ico bp_search"></i>
        </a>
        <!-- hmbtn: Mobile Button <end> -->
    </div>
</header>
<!-- header <component:end> -->
