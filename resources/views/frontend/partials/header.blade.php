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
    
    <div role="button" class="lgnbtn">Login</div>
    
    <!-- scl: Social Links <start> -->
    <nav class="scl">
        <a href="https://www.facebook.com/bighsavinghub" class="ico fb" title="Facebook"></a>
        <a href="https://twitter.com/bighsavinghub" class="ico twt" title="Twitter"></a>
        <a href="https://www.instagram.com/bighsavinghub/" class="ico ins" title="Instagram"></a>
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
        <a href="{{ route('home') }}" class="lgo site-logo" title="Big Saving Hub">
            <img class="site-logo-img" loading="lazy" decoding="async" src="{{ asset('assets/img/icons/logo.png') }}" alt="Big Saving Hub" title="Big Saving Hub">
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
                        <a href="{{ route('store', 'sekonda') }}">Sekonda</a>
                        <a href="{{ route('store', 'als') }}">ALS.com</a>
                        <a href="{{ route('store', 'marc-jacobs') }}">Marc Jacobs</a>
                        <a href="{{ route('store', 'the-independent-pharmacy') }}">The Independent Pharmacy</a>
                        <a href="{{ route('store', 'iherb') }}">iHerb GBP</a>
                        <a href="{{ route('store', 'morrisons') }}">Morrisons</a>
                        <a href="{{ route('store', 'vivobarefoot') }}">Vivobarefoot</a>
                        <a href="{{ route('store', 'wahl') }}">Wahl</a>
                        <a href="{{ route('store', 'booking') }}">Booking.com</a>
                        <a href="{{ route('store', 'euro-car-parts') }}">Euro Car Parts</a>
                        <a href="{{ route('store', 'willowandhall') }}">Willow & Hall</a>
                        <a href="{{ route('store', 'coconut-lane') }}">Coconut Lane</a>
                        <a href="{{ route('store', 'abelini') }}">Abelini</a>
                        <a href="{{ route('store', 'e-cigarette-direct') }}">E Cigarette Direct</a>
                        <a href="{{ route('store', 'hand-on-heart-jewellery') }}">Hand On Heart Jewellery</a>
                        <a href="{{ route('store', 'imagine-ireland') }}">Imagine Ireland</a>
                        <a href="{{ route('store', 'tools-today') }}">Tools Today</a>
                        <a href="{{ route('store', 'la-muscle') }}">LA Muscle</a>
                        <a href="{{ route('store', 'vintage-football-shirts') }}">Vintage Football Shirts</a>
                        <a href="{{ route('store', 'toca-social') }}">Toca Social</a>
                    </div>
                </div>
            </div>
            
            <!-- drpdwn: Dropdown -->
            <div class="drpdwn">
                <a href="{{ route('categories') }}" title="Categories">Categories</a>
                <div class="itemsw">
                    <div class="items">
                        <div class="item">
                            <h2><a href="{{ route('category', 'clothing-and-accessories') }}">Clothing & Accessories</a></h2>
                            <a href="{{ route('store', 'house-of-cb') }}">House Of CB</a>
                            <a href="{{ route('store', 'boden') }}">Boden</a>
                            <a href="{{ route('store', 'fashion-world') }}">Fashion World</a>
                            <a class="readbt morebt" href="{{ route('category', 'clothing-and-accessories') }}">More Brands</a>
                        </div>

                        <div class="item">
                            <h2><a href="{{ route('category', 'home-and-garden') }}">Home & Garden</a></h2>
                            <a href="{{ route('store', 'ocean-lighting') }}">Ocean Lighting</a>
                            <a href="{{ route('store', 'dunelm') }}">Dunelm</a>
                            <a href="{{ route('store', 'uk-christmas-world') }}">UK Christmas World</a>
                            <a class="readbt morebt" href="{{ route('category', 'home-and-garden') }}">More Brands</a>
                        </div>

                        <div class="item">
                            <h2><a href="{{ route('category', 'health-and-beauty') }}">Health & Beauty</a></h2>
                            <a href="{{ route('store', 'all-beauty') }}">All Beauty</a>
                            <a href="{{ route('store', 'holland-and-barrett') }}">Holland & Barrett</a>
                            <a href="{{ route('store', 'e-cigarette-direct') }}">E Cigarette Direct</a>
                            <a class="readbt morebt" href="{{ route('category', 'health-and-beauty') }}">More Brands</a>
                        </div>

                        <div class="item">
                            <h2><a href="{{ route('category', 'jewelry-and-watches') }}">Jewelry & Watches</a></h2>
                            <a href="{{ route('store', 'soufeel') }}">Soufeel</a>
                            <a href="{{ route('store', 'born-pretty') }}">Born Pretty</a>
                            <a href="{{ route('store', 'frostnyc') }}">FrostNYC</a>
                            <a class="readbt morebt" href="{{ route('category', 'jewelry-and-watches') }}">More Brands</a>
                        </div>

                        <div class="item">
                            <h2><a href="{{ route('category', 'baby-and-kids') }}">Baby & Kids</a></h2>
                            <a href="{{ route('store', 'mother-care') }}">Mothercare</a>
                            <a href="{{ route('store', 'uber-kids') }}">Uber Kids</a>
                            <a href="{{ route('store', 'modern-nursery') }}">Modern Nursery</a>
                            <a class="readbt morebt" href="{{ route('category', 'baby-and-kids') }}">More Brands</a>
                        </div>

                        <div class="item">
                            <h2><a href="{{ route('category', 'electronics') }}">Electronics</a></h2>
                            <a href="{{ route('store', 'samsung') }}">Samsung</a>
                            <a href="{{ route('store', 'appliances-direct') }}">Appliances Direct</a>
                            <a href="{{ route('store', 'buyspares') }}">BuySpares</a>
                            <a class="readbt morebt" href="{{ route('category', 'electronics') }}">More Brands</a>
                        </div>

                        <div class="item">
                            <h2><a href="{{ route('category', 'flower-and-gifts') }}">Flowers & Gifts</a></h2>
                            <a href="{{ route('store', 'red-candy') }}">Red Candy</a>
                            <a href="{{ route('store', 'funky-hampers') }}">Funky Hampers</a>
                            <a href="{{ route('store', 'temptation-gifts') }}">Temptation Gifts</a>
                            <a class="readbt morebt" href="{{ route('category', 'flower-and-gifts') }}">More Brands</a>
                        </div>

                        <div class="item">
                            <h2><a href="{{ route('category', 'sports-and-outdoors') }}">Sports & Outdoors</a></h2>
                            <a href="{{ route('store', 'teamsport-indoor-karting') }}">TeamSport Indoor Karting</a>
                            <a href="{{ route('store', 'cotswold-outdoor') }}">Cotswold Outdoor</a>
                            <a href="{{ route('store', 'under-armour') }}">Under Armour</a>
                            <a class="readbt morebt" href="{{ route('category', 'sports-and-outdoors') }}">More Brands</a>
                        </div>

                        <div class="item">
                            <h2><a href="{{ route('category', 'travel') }}">Travel</a></h2>
                            <a href="{{ route('store', 'blackpool-pleasure-beach') }}">Blackpool Pleasure Beach</a>
                            <a href="{{ route('store', 'travelodge') }}">Travelodge</a>
                            <a href="{{ route('store', 'knowsley-safari-park') }}">Knowsley Safari Park</a>
                            <a class="readbt morebt" href="{{ route('category', 'travel') }}">More Brands</a>
                        </div>

                        <div class="item">
                            <h2><a href="{{ route('categories') }}">More Categories </a></h2>
                            <a href="{{ route('category', 'department-store') }}">Department Store </a>
                            <a href="{{ route('category', 'food-and-beverage') }}">Food & Beverage </a>
                            <a href="{{ route('category', 'finance-and-insurance') }}">Finance & Insurance </a>
                            <a class="readbt morebt" href="{{ route('categories') }}">All Categories</a>
                        </div>
                    </div>
                </div>
            </div>

            <a class="sf" style="display:none" href="javascript:;" aria-label="Search" title="Search"><i class="bp_search"></i> Search</a>
        </nav>
        <!-- nls: Navigation Links <end> -->

        <div class="nls nlbmbv">
            <div role="button" class="login bp_login" role="button" aria-label="Sign Up" title="Sign Up"></div>
            <a href="{{ route('share') }}" role="button" class="nlshbt bp_share" aria-label="Share" title="Share"></a>
        </div>

        <!-- mbtn: Mobile Button, hsbtn: Header Search Button <start> -->
        <a href="javascript:;" class="mbtn hsbtn" title="Toggle Seach">
            <i class="ico bp_search"></i>
        </a>
        <!-- hmbtn: Mobile Button <end> -->
    </div>
</header>
<!-- header <component:end> -->
