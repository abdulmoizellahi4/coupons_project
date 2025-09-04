@extends('frontend.layouts.app')

@section('title', 'Discount Codes, Voucher Codes | Exclusive Deals')
@section('description', 'Discover the latest UK discount and voucher codes at Big Saving Hub. Explore exclusive online deals, and save big on your favourite brands. Start saving today!')

@section('content')
<!-- Page Content <start> -->
<!-- Search section <start> -->
<div class="Sec hschbg">
    <div class="Wrp">
        <h1>Tired of searching for discounts online?</h1>
        <p>Get Free Voucher Codes &amp; Promo Codes on Brands You Crave For.</p>

        <label class="hsform">
            <span class="sclfd">Search ...</span>
            <button class="bp_search" href="javascript:;" title="Search" aria-label="Search"></button>
        </label>

        <div class="spcnt">
            <div class="spcvrf"><strong>All Codes</strong> <span>Verified</span></div>
            <div class="spcdsc"><strong>{{ number_format($totalCoupons ?? 20000) }}+</strong> <span>Discount Codes</span></div>
        </div>
    </div>
</div>
<!-- Search section <end> -->

<!-- Featured Discount Voucher Offers section <start> -->
<div class="Sec fdvo">
    <h2>Featured Discount Voucher Offers</h2>
    <a href="{{ route('top-discounts') }}" class="subHd" title="Top Offers">View All Top Offers</a>
    <div class="cpns">
        @forelse($featuredCoupons ?? [] as $coupon)
        <div class="cpn {{ $coupon->coupon_code ? 'dl' : 'cd' }}" data-id="{{ $coupon->id }}">
            <div class="imgs cvr">
                @if($coupon->cover_logo)
                    <img decoding="async" class="cvr" src="{{ asset('storage/' . $coupon->cover_logo) }}" alt="{{ $coupon->store->store_name ?? 'Store' }} voucher code" title="{{ $coupon->store->store_name ?? 'Store' }} voucher code" width="328" height="160">
                @endif
                @if($coupon->store && $coupon->store->store_logo)
                    <a href="{{ route('store', $coupon->store->seo_url) }}" title="{{ $coupon->store->store_name }}">
                        <img decoding="async" loading="lazy" src="{{ asset('storage/' . $coupon->store->store_logo) }}" alt="{{ $coupon->store->store_name }} discount code" title="{{ $coupon->store->store_name }} discount code" width="80" height="80">
                    </a>
                @endif
            </div>
            <div class="cnt">
                <div class="str-vrf">
                    @if($coupon->store)
                        <a href="{{ route('store', $coupon->store->seo_url) }}" title="{{ $coupon->store->store_name }}">{{ $coupon->store->store_name }}</a>
                    @endif
                    @if($coupon->verified)
                        <span>Verified</span>
                    @endif
                </div>
                <h3 role="button" aria-label="{{ $coupon->coupon_code ? 'Reveal Code' : 'Get Deal' }}">
                    {{ $coupon->coupon_title }}
                </h3>
                <div class="trm-cnt">
                    @if($coupon->terms)
                        <button aria-label="View Terms" class="ctb">View Terms</button>
                    @endif
                    <span>{{ number_format($coupon->sort_order ?? rand(500, 5000)) }} Used</span>
                </div>
                @if($coupon->coupon_code)
                    <button class="cpBtn reveal-code" aria-label="Reveal Code" 
                            data-code="{{ $coupon->coupon_code }}" 
                            data-affiliate="{{ $coupon->affiliate_url ?? url('/') }}"
                            data-store="{{ $coupon->store->store_name ?? 'Store' }}"
                            data-title="{{ $coupon->coupon_title }}">
                        Reveal Code
                    </button>
                @else
                    <a href="{{ $coupon->affiliate_url }}" class="cpBtn get-deal" target="_blank" rel="nofollow" aria-label="Get Deal">Get Deal</a>
                @endif
            </div>
        </div>
        @empty
        <div class="no-coupons">
            <p>No featured coupons available at the moment. Check back soon!</p>
        </div>
        @endforelse
    </div>
</div>
<!-- Featured Discount Voucher Offers section <end> -->

<!-- Featured Store section <start> -->
<div class="Sec feSc">
    <h2>Featured Store</h2>
    <div class="strsld">
        @forelse($featuredStores ?? [] as $store)
        <div>
            <a href="{{ route('store', $store->seo_url) }}" title="{{ $store->store_name }}" tabindex="-1">
                @if($store->store_logo)
                    <img decoding="async" loading="lazy" src="{{ asset('storage/' . $store->store_logo) }}" alt="{{ $store->store_name }} discount code" title="{{ $store->store_name }} discount code" width="150" height="150">
                @else
                    <div class="store-placeholder">{{ substr($store->store_name, 0, 2) }}</div>
                @endif
            </a>
        </div>
        @empty
        <div class="no-stores">
            <p>No featured stores available at the moment.</p>
        </div>
        @endforelse
    </div>
</div>
<!-- Featured Store section <end> -->

<!-- Slider Section <start> -->
<div class="Sec bg">

    <!-- Clothing & Accessories <start> -->
    <div class="slds">
        <h2><a href="{{ route('category', 'clothing-and-accessories') }}" title="Clothing & Accessories">Clothing & Accessories <i class="bp_drprgt-r"></i></a></h2>
        <div class="cpns">
            @forelse($clothingCoupons ?? [] as $coupon)
            <div class="cpn {{ $coupon->coupon_code ? 'dl' : 'cd' }}" data-id="{{ $coupon->id }}">
                <div class="imgs">
                    @if($coupon->store && $coupon->store->store_logo)
                        <a href="{{ route('store', $coupon->store->seo_url) }}" title="{{ $coupon->store->store_name }}">
                            <img src="{{ asset('storage/' . $coupon->store->store_logo) }}" alt="{{ $coupon->store->store_name }} discount code" title="{{ $coupon->store->store_name }} discount code" decoding="async" loading="lazy" width="80" height="80">
                        </a>
                    @endif
                    <button title="Add to Favourite" aria-label="Add to Favourite" class="cfb bp_save"></button>
                </div>
                <div class="cnt">
                    <div class="str-vrf">
                        @if($coupon->store)
                            <a href="{{ route('store', $coupon->store->seo_url) }}">{{ $coupon->store->store_name }}</a>
                        @endif
                        @if($coupon->verified)
                            <span>Verified</span>
                        @endif
                    </div>
                    <h3 role="button" aria-label="{{ $coupon->coupon_code ? 'Reveal Code' : 'Get Deal' }}">
                        {{ $coupon->coupon_title }}
                    </h3>
                    <div class="trm-cnt">
                        @if($coupon->terms)
                            <button aria-label="View Terms" class="ctb">View Terms</button>
                        @endif
                        <span>{{ number_format($coupon->sort_order ?? rand(500, 5000)) }} Used</span>
                    </div>
                    @if($coupon->coupon_code)
                        <button class="cpBtn reveal-code" aria-label="Reveal Code" 
                                data-code="{{ $coupon->coupon_code }}" 
                                data-affiliate="{{ $coupon->affiliate_url ?? url('/') }}"
                                data-store="{{ $coupon->store->store_name ?? 'Store' }}"
                                data-title="{{ $coupon->coupon_title }}">
                            Reveal Code
                        </button>
                    @else
                        <button class="cpBtn get-deal" aria-label="Get Deal">Get Deal</button>
                    @endif
                </div>
            </div>
            @empty
            <div class="no-coupons">
                <p>No clothing coupons available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
    <!-- Clothing & Accessories <end> -->

    <!-- Home & Garden <start> -->
    <div class="slds Sec">
        <h2><a href="{{ route('category', 'home-and-garden') }}" title="Home & Garden">Home & Garden <i class="bp_drprgt-r"></i></a></h2>
        <div class="cpns">
            @forelse($homeGardenCoupons ?? [] as $coupon)
            <div class="cpn {{ $coupon->coupon_code ? 'dl' : 'cd' }}" data-id="{{ $coupon->id }}">
                <div class="imgs">
                    @if($coupon->store && $coupon->store->store_logo)
                        <a href="{{ route('store', $coupon->store->seo_url) }}" title="{{ $coupon->store->store_name }}">
                            <img src="{{ asset('storage/' . $coupon->store->store_logo) }}" alt="{{ $coupon->store->store_name }} discount code" title="{{ $coupon->store->store_name }} discount code" decoding="async" loading="lazy" width="80" height="80">
                        </a>
                    @endif
                    <button title="Add to Favourite" aria-label="Add to Favourite" class="cfb bp_save"></button>
                </div>
                <div class="cnt">
                    <div class="str-vrf">
                        @if($coupon->store)
                            <a href="{{ route('store', $coupon->store->seo_url) }}">{{ $coupon->store->store_name }}</a>
                        @endif
                        @if($coupon->verified)
                            <span>Verified</span>
                        @endif
                    </div>
                    <h3 role="button" aria-label="{{ $coupon->coupon_code ? 'Reveal Code' : 'Get Deal' }}">
                        {{ $coupon->coupon_title }}
                    </h3>
                    <div class="trm-cnt">
                        @if($coupon->terms)
                            <button aria-label="View Terms" class="ctb">View Terms</button>
                        @endif
                        <span>{{ number_format($coupon->sort_order ?? rand(500, 5000)) }} Used</span>
                    </div>
                    @if($coupon->coupon_code)
                        <button class="cpBtn reveal-code" aria-label="Reveal Code" 
                                data-code="{{ $coupon->coupon_code }}" 
                                data-affiliate="{{ $coupon->affiliate_url ?? url('/') }}"
                                data-store="{{ $coupon->store->store_name ?? 'Store' }}"
                                data-title="{{ $coupon->coupon_title }}">
                            Reveal Code
                        </button>
                    @else
                        <button class="cpBtn get-deal" aria-label="Get Deal">Get Deal</button>
                    @endif
                </div>
            </div>
            @empty
            <div class="no-coupons">
                <p>No home & garden coupons available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
    <!-- Home & Garden <end> -->

    <!-- Chrome extension Section <start> -->
    <div class="Sec Wrp">
        <div class="imgCnk">
            <img src="{{ asset('frontend_assets/images/svg/chormeExtension.svg') }}" alt="Chrome Extension" decoding="async" loading="lazy" width="565" height="384">
            <div class="txt">
                <h2>The Search for Discount Codes Ends Here</h2>
                <p>By adding thousands of store in a single place the Deal Seeker extension by Big Saving Hub, is the perfect haven for all the smart shoppers that love to save big on their sprees.</p>
                <a href="{{ route('deal-seeker') }}" aria-label="Add to Chrome Extension" title="Deal Seeker">Add to Chrome</a>
            </div>
        </div>
    </div>
    <!-- Chrome extension Section <end> -->

    <!-- Health & Beauty <start> -->
    <div class="slds">
        <h2><a href="{{ route('category', 'health-and-beauty') }}" title="Health & Beauty">Health & Beauty <i class="bp_drprgt-r"></i></a></h2>
        <div class="cpns">
            @forelse($healthBeautyCoupons ?? [] as $coupon)
            <div class="cpn {{ $coupon->coupon_code ? 'dl' : 'cd' }}" data-id="{{ $coupon->id }}">
                <div class="imgs">
                    @if($coupon->store && $coupon->store->store_logo)
                        <a href="{{ route('store', $coupon->store->seo_url) }}" title="{{ $coupon->store->store_name }}">
                            <img src="{{ asset('storage/' . $coupon->store->store_logo) }}" alt="{{ $coupon->store->store_name }} discount code" title="{{ $coupon->store->store_name }} discount code" decoding="async" loading="lazy" width="80" height="80">
                        </a>
                    @endif
                    <button title="Add to Favourite" aria-label="Add to Favourite" class="cfb bp_save"></button>
                </div>
                <div class="cnt">
                    <div class="str-vrf">
                        @if($coupon->store)
                            <a href="{{ route('store', $coupon->store->seo_url) }}">{{ $coupon->store->store_name }}</a>
                        @endif
                        @if($coupon->verified)
                            <span>Verified</span>
                        @endif
                    </div>
                    <h3 role="button" aria-label="{{ $coupon->coupon_code ? 'Reveal Code' : 'Get Deal' }}">
                        {{ $coupon->coupon_title }}
                    </h3>
                    <div class="trm-cnt">
                        @if($coupon->terms)
                            <button aria-label="View Terms" class="ctb">View Terms</button>
                        @endif
                        <span>{{ number_format($coupon->sort_order ?? rand(500, 5000)) }} Used</span>
                    </div>
                    @if($coupon->coupon_code)
                        <button class="cpBtn reveal-code" aria-label="Reveal Code" 
                                data-code="{{ $coupon->coupon_code }}" 
                                data-affiliate="{{ $coupon->affiliate_url ?? url('/') }}"
                                data-store="{{ $coupon->store->store_name ?? 'Store' }}"
                                data-title="{{ $coupon->coupon_title }}">
                            Reveal Code
                        </button>
                    @else
                        <button class="cpBtn get-deal" aria-label="Get Deal">Get Deal</button>
                    @endif
                </div>
            </div>
            @empty
            <div class="no-coupons">
                <p>No health & beauty coupons available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
    <!-- Health & Beauty <end> -->

    <!-- Jewelry & Watches <start> -->
    <div class="slds Sec">
        <h2><a href="{{ route('category', 'jewelry-and-watches') }}" title="Jewelry & Watches">Jewelry & Watches <i class="bp_drprgt-r"></i></a></h2>
        <div class="cpns">
            @forelse($jewelryWatchesCoupons ?? [] as $coupon)
            <div class="cpn {{ $coupon->coupon_code ? 'dl' : 'cd' }}" data-id="{{ $coupon->id }}">
                <div class="imgs">
                    @if($coupon->store && $coupon->store->store_logo)
                        <a href="{{ route('store', $coupon->store->seo_url) }}" title="{{ $coupon->store->store_name }}">
                            <img src="{{ asset('storage/' . $coupon->store->store_logo) }}" alt="{{ $coupon->store->store_name }} discount code" title="{{ $coupon->store->store_name }} discount code" decoding="async" loading="lazy" width="80" height="80">
                        </a>
                    @endif
                    <button title="Add to Favourite" aria-label="Add to Favourite" class="cfb bp_save"></button>
                </div>
                <div class="cnt">
                    <div class="str-vrf">
                        @if($coupon->store)
                            <a href="{{ route('store', $coupon->store->seo_url) }}">{{ $coupon->store->store_name }}</a>
                        @endif
                        @if($coupon->verified)
                            <span>Verified</span>
                        @endif
                    </div>
                    <h3 role="button" aria-label="{{ $coupon->coupon_code ? 'Reveal Code' : 'Get Deal' }}">
                        {{ $coupon->coupon_title }}
                    </h3>
                    <div class="trm-cnt">
                        @if($coupon->terms)
                            <button aria-label="View Terms" class="ctb">View Terms</button>
                        @endif
                        <span>{{ number_format($coupon->sort_order ?? rand(500, 5000)) }} Used</span>
                    </div>
                    @if($coupon->coupon_code)
                        <button class="cpBtn reveal-code" aria-label="Reveal Code" 
                                data-code="{{ $coupon->coupon_code }}" 
                                data-affiliate="{{ $coupon->affiliate_url ?? url('/') }}"
                                data-store="{{ $coupon->store->store_name ?? 'Store' }}"
                                data-title="{{ $coupon->coupon_title }}">
                            Reveal Code
                        </button>
                    @else
                        <button class="cpBtn get-deal" aria-label="Get Deal">Get Deal</button>
                    @endif
                </div>
            </div>
            @empty
            <div class="no-coupons">
                <p>No jewelry & watches coupons available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
    <!-- Jewelry & Watches <end> -->

    <!-- App Section <start> -->
    <div class="Sec Wrp noPd">
        <div class="imgCnk flxrv">
            <div class="txt">
                <h2>Save on the go with the award winning <br>
                    Big Saving Hub app</h2>
                <p>Download our free app today! 10 million people can't be wrong</p>
                <a href="https://play.google.com/store/apps/details?id=com.bigsavinghub" aria-label="Get Big Saving Hub Application at Google Store" title="Get Big Saving Hub Application at Google Store">Get the App</a>
            </div>
            <img src="{{ asset('frontend_assets/images/svg/app.svg') }}" alt="Mobile App" decoding="async" loading="lazy" width="565" height="384">
        </div>
    </div>
    <!-- App Section <end> -->

    <!-- Baby & Kids <start> -->
    <div class="slds Sec">
        <h2><a href="{{ route('category', 'baby-and-kids') }}" title="Baby & Kids">Baby & Kids <i class="bp_drprgt-r"></i></a></h2>
        <div class="cpns">
            @forelse($babyKidsCoupons ?? [] as $coupon)
            <div class="cpn {{ $coupon->coupon_code ? 'dl' : 'cd' }}" data-id="{{ $coupon->id }}">
                <div class="imgs">
                    @if($coupon->store && $coupon->store->store_logo)
                        <a href="{{ route('store', $coupon->store->seo_url) }}" title="{{ $coupon->store->store_name }}">
                            <img src="{{ asset('storage/' . $coupon->store->store_logo) }}" alt="{{ $coupon->store->store_name }} discount code" title="{{ $coupon->store->store_name }} discount code" decoding="async" loading="lazy" width="80" height="80">
                        </a>
                    @endif
                    <button title="Add to Favourite" aria-label="Add to Favourite" class="cfb bp_save"></button>
                </div>
                <div class="cnt">
                    <div class="str-vrf">
                        @if($coupon->store)
                            <a href="{{ route('store', $coupon->store->seo_url) }}">{{ $coupon->store->store_name }}</a>
                        @endif
                        @if($coupon->verified)
                            <span>Verified</span>
                        @endif
                    </div>
                    <h3 role="button" aria-label="{{ $coupon->coupon_code ? 'Reveal Code' : 'Get Deal' }}">
                        {{ $coupon->coupon_title }}
                    </h3>
                    <div class="trm-cnt">
                        @if($coupon->terms)
                            <button aria-label="View Terms" class="ctb">View Terms</button>
                        @endif
                        <span>{{ number_format($coupon->sort_order ?? rand(500, 5000)) }} Used</span>
                    </div>
                    @if($coupon->coupon_code)
                        <button class="cpBtn reveal-code" aria-label="Reveal Code" 
                                data-code="{{ $coupon->coupon_code }}" 
                                data-affiliate="{{ $coupon->affiliate_url ?? url('/') }}"
                                data-store="{{ $coupon->store->store_name ?? 'Store' }}"
                                data-title="{{ $coupon->coupon_title }}">
                            Reveal Code
                        </button>
                    @else
                        <button class="cpBtn get-deal" aria-label="Get Deal">Get Deal</button>
                    @endif
                </div>
            </div>
            @empty
            <div class="no-coupons">
                <p>No baby & kids coupons available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
    <!-- Baby & Kids <end> -->

    <!-- Flowers & Gifts <start> -->
    <div class="slds">
        <h2><a href="{{ route('category', 'flowers-and-gifts') }}" title="Flowers & Gifts">Flowers & Gifts <i class="bp_drprgt-r"></i></a></h2>
        <div class="cpns">
            @forelse($flowersGiftsCoupons ?? [] as $coupon)
            <div class="cpn {{ $coupon->coupon_code ? 'dl' : 'cd' }}" data-id="{{ $coupon->id }}">
                <div class="imgs">
                    @if($coupon->store && $coupon->store->store_logo)
                        <a href="{{ route('store', $coupon->store->seo_url) }}" title="{{ $coupon->store->store_name }}">
                            <img src="{{ asset('storage/' . $coupon->store->store_logo) }}" alt="{{ $coupon->store->store_name }} discount code" title="{{ $coupon->store->store_name }} discount code" decoding="async" loading="lazy" width="80" height="80">
                        </a>
                    @endif
                    <button title="Add to Favourite" aria-label="Add to Favourite" class="cfb bp_save"></button>
                </div>
                <div class="cnt">
                    <div class="str-vrf">
                        @if($coupon->store)
                            <a href="{{ route('store', $coupon->store->seo_url) }}">{{ $coupon->store->store_name }}</a>
                        @endif
                        @if($coupon->verified)
                            <span>Verified</span>
                        @endif
                    </div>
                    <h3 role="button" aria-label="{{ $coupon->coupon_code ? 'Reveal Code' : 'Get Deal' }}">
                        {{ $coupon->coupon_title }}
                    </h3>
                    <div class="trm-cnt">
                        @if($coupon->terms)
                            <button aria-label="View Terms" class="ctb">View Terms</button>
                        @endif
                        <span>{{ number_format($coupon->sort_order ?? rand(500, 5000)) }} Used</span>
                    </div>
                    @if($coupon->coupon_code)
                        <button class="cpBtn reveal-code" aria-label="Reveal Code" 
                                data-code="{{ $coupon->coupon_code }}" 
                                data-affiliate="{{ $coupon->affiliate_url ?? url('/') }}"
                                data-store="{{ $coupon->store->store_name ?? 'Store' }}"
                                data-title="{{ $coupon->coupon_title }}">
                            Reveal Code
                        </button>
                    @else
                        <button class="cpBtn get-deal" aria-label="Get Deal">Get Deal</button>
                    @endif
                </div>
            </div>
            @empty
            <div class="no-coupons">
                <p>No flowers & gifts coupons available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
    <!-- Flowers & Gifts <end> -->

</div>
<!-- Slider Section <end> -->

<!-- About Big Saving Hub <start> -->
<div class="Sec abt">
    <div class="grd">
        <div class="col">
            <img src="{{ asset('frontend_assets/images/svg/oatw.svg') }}" test="{{ $totalCoupons ?? 410 }}" alt="calender check icon" decoding="async" loading="lazy" width="100" height="100">
            <h2><strong>{{ number_format($totalCoupons ?? 410) }}</strong>Offers added this week</h2>
        </div>
        <div class="col">
            <img src="{{ asset('frontend_assets/images/svg/outw.svg') }}" alt="calender check icon" decoding="async" loading="lazy" width="100" height="100">
            <h2><strong>{{ number_format($totalStores ?? 2680) }}</strong>Offers used this week</h2>
        </div>
        <div class="col cnt">
            <h2>About Big Saving Hub</h2>
            <div class="scrolr">
                <p><strong>Big Saving Hub contains affiliate links to products. We may receive a commission for purchases made through these links.</strong></p>
                <p>For most of us, going out to a crowded shopping mall to buy anything is too much of a hassle. You have to waste an entire day, miss work, and then the aggravation of finding a car parking adds up to the troubles. This is where useful websites like Big Saving Hub come in. Here, you can shop for all that you want at steep discounts from the comfort of your home. Use this super-simple yet unique platform to avail great deals on your favourite products &amp; services 24/7.&nbsp;</p>
                <p>Big Saving Hub is a critically acclaimed online deals' provider for top-notch brands. Offering authentic, reliable and fresh deals for over {{ number_format($totalStores ?? 10000) }} brands on our portal, we are the front-line leaders of online deals in the UK and beyond.</p>
            </div>
        </div>
    </div>
</div>
<!-- About Big Saving Hub <end> -->

<div class="Sec Wrp">
    <div class="rsnws">
        <!-- Recommended Stores <Start> -->
        <div class="rs">
            <h2>Recommended Stores</h2>
            <div class="tbs">
                <div class="tb">
                    <a class="active" title="Clothing & Accessories" href="javascript:;" data-type="300" data-slug="clothing-and-accessories-voucher-codes" aria-label="Clothing & Accessories">Clothing & Accessories <i class="bp_drprgt-r"></i></a>
                    <a href="javascript:;" title="Home & Garden" data-type="309" data-slug="home-and-garden-voucher-codes" aria-label="Home & Garden">Home & Garden <i class="bp_drprgt-r"></i></a>
                    <a href="javascript:;" title="Health & Beauty" data-type="308" data-slug="health-and-beauty-voucher-codes" aria-label="Health & Beauty">Health & Beauty <i class="bp_drprgt-r"></i></a>
                    <a href="javascript:;" title="Jewelry & Watches" data-type="311" data-slug="jewelry-and-watches-voucher-codes" aria-label="Jewelry & Watches">Jewelry & Watches <i class="bp_drprgt-r"></i></a>
                </div>
                <div class="cnt">
                    <a class="lst" href="#" title="View All " aria-label="View All ">View All <i class="bp_drprgt-r"></i></a>
                </div>
            </div>
        </div>
        <!-- Recommended Stores <end> -->

        <!-- Newsletter <Start> -->
        <div class="snlsec">
            <img src="{{ asset('frontend_assets/images/svg/nwsltr.svg') }}" alt="paper plan" width="100" height="100" decoding="async" loading="lazy">
            <h2>Sign-up To Get Latest Voucher Codes First</h2>
            <p>Be the first one to get notified as soon as we update a new offer or discount.</p>

            <label class="snfld">
                <input type="text" name="newsletter" value="" placeholder="Enter Your Email Address Here">
                <button class="nfb" title="Subscribe">Subscribe</button>
            </label>

            <p>By signing up I agree to Big Saving Hub's <a href="{{ route('privacy-policy') }}" target="_blank">Privacy Policy</a> and consent to receive emails about offers.</p>
        </div>
        <!-- Newsletter <end> -->
    </div>
</div>

        <!-- Enhanced Coupon Modal -->
<div id="couponModal" aria-hidden="true" style="display:none;">
    <div class="cm-overlay"></div>
    
    <!-- Main Voucher Code Popup -->
    <div class="cm-main-popup" role="dialog" aria-modal="true" aria-label="Coupon Code Popup">
        <button class="cm-close" aria-label="Close popup">&times;</button>

        <!-- Main Popup Content -->
        <div class="cm-main-content">
            <h3 class="cm-title" id="cmTitle">Here is your code</h3>
            
            <div class="cm-code-wrap">
                <span id="cmCode" class="cm-code">CODE</span>
                <button id="cmCopy" class="cm-copy" aria-label="Copy code">Copy Code</button>
            </div>

            <div class="cm-actions">
                <a id="cmContinue" class="cm-continue" href="#" target="_blank" rel="noopener noreferrer">Continue to store</a>
            </div>

            <p class="cm-note" id="cmNote">This store website has been opened in a new tab. Simply copy and paste the code and enter it at the checkout.</p>

            <!-- Feedback Section -->
            <div class="cm-feedback">
                <p>Did this promotion work for you?</p>
                <div class="cm-feedback-buttons">
                    <button class="cm-feedback-btn" data-feedback="positive">👍</button>
                    <button class="cm-feedback-btn" data-feedback="negative">👎</button>
                </div>
            </div>

            <!-- More Details Link -->
            <div class="cm-more-details">
                <button class="cm-more-btn">More Details <span class="cm-chevron">▼</span></button>
            </div>
        </div>
    </div>

    <!-- Email Subscription Popup (Smaller, Below Main Popup) -->
    <div class="cm-email-popup" role="dialog" aria-modal="true" aria-label="Email Subscription Popup">
        <div class="cm-email-content">
            <div class="cm-brand-logo">
                <div class="cm-brand-circle">
                    @if($featuredStores->count() > 0 && $featuredStores->first()->store_logo)
                        <img src="{{ asset('storage/' . $featuredStores->first()->store_logo) }}" alt="{{ $featuredStores->first()->store_name }} logo" width="140" height="40" style="border-radius: 100%; border: 3px solid #fff;">
                    @else
                        <img src="{{ asset('frontend_assets/images/logo.png') }}" alt="Brand logo" width="140" height="40">
                    @endif
                </div>
            </div>
            
            <h4 class="cm-email-title" id="cmEmailTitle">Store straight to your inbox</h4>
            
            <form class="cm-email-form" id="cmEmailForm">
                <label for="cmEmailInput">Email Address</label>
                <input type="email" id="cmEmailInput" placeholder="Your Email Address" required>
                <button type="submit" class="cm-email-submit">Send Me New Codes</button>
            </form>
            
            <p class="cm-email-consent">
                By signing up I agree to topvoucherscode's <a href="{{ route('privacy-policy') }}" target="_blank">Privacy Policy</a> and consent to receive emails about offers.
            </p>
        </div>

        <!-- Website Logo at Bottom -->
        <div class="cm-website-logo">
            <span class="cm-website-name">Crop Vouchers Code</span>
        </div>
    </div>
</div>

<style>
/* Enhanced Modal CSS - Two Popup Layout */
#couponModal { 
    position: fixed; 
    inset: 0; 
    display: none; 
    align-items: center; 
    justify-content: center; 
    z-index: 9999; 
    flex-direction: column;
    gap: 20px;
}

#couponModal .cm-overlay { 
    position: absolute; 
    inset: 0; 
    background: rgba(0,0,0,0.6); 
}

/* Main Voucher Code Popup */
.cm-main-popup { 
    position: relative; 
    width: 480px; 
    max-width: calc(100% - 40px); 
    background: #fff; 
    border-radius: 16px; 
    text-align: center; 
    box-shadow: 0 20px 60px rgba(0,0,0,0.3); 
    overflow: hidden;
    z-index: 2;
}

/* Email Subscription Popup */
.cm-email-popup { 
    position: relative; 
    width: 480px; 
    max-width: calc(100% - 40px); 
    background: #fff; 
    border-radius: 16px; 
    text-align: center; 
    box-shadow: 0 15px 40px rgba(0,0,0,0.25); 
    overflow: hidden;
    z-index: 1;
}

#couponModal .cm-close { 
    position: absolute; 
    top: 15px; 
    right: 15px; 
    background: transparent; 
    border: none; 
    font-size: 24px; 
    cursor: pointer; 
    color: #666;
    z-index: 10;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background-color 0.2s;
}

#couponModal .cm-close:hover {
    background: rgba(0,0,0,0.1);
}

/* Main Popup Content */
.cm-main-content {
    padding: 40px 30px 30px;
    background: #fff;
}

.cm-title {
    font-size: 28px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 25px;
    line-height: 1.2;
}

.cm-code-wrap { 
    display: flex; 
    gap: 15px; 
    align-items: center; 
    justify-content: center; 
    margin: 25px 0; 
}

.cm-code { 
    background: #f0f9ff; 
    padding: 18px 25px; 
    border-radius: 10px; 
    font-weight: 700; 
    font-size: 20px;
    letter-spacing: 1.5px; 
    color: #0c4a6e;
    border: 2px dashed #10b981;
    min-width: 140px;
    font-family: 'Courier New', monospace;
}

.cm-copy { 
    background: #10b981; 
    color: #fff; 
    border: none; 
    padding: 15px 25px; 
    border-radius: 10px; 
    cursor: pointer; 
    font-weight: 600;
    font-size: 16px;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.cm-copy:hover {
    background: #059669;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
}

.cm-note { 
    color: #6b7280; 
    font-size: 15px; 
    margin: 20px 0; 
    line-height: 1.6;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

/* Feedback Section */
.cm-feedback {
    margin: 25px 0;
    padding: 20px 0;
    border-top: 1px solid #f0f0f0;
}

.cm-feedback p {
    margin: 0 0 15px;
    color: #6b7280;
    font-size: 15px;
    font-weight: 500;
}

.cm-feedback-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
}

.cm-feedback-btn {
    background: transparent;
    border: 2px solid #d1d5db;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    cursor: pointer;
    font-size: 20px;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cm-feedback-btn:hover {
    border-color: #10b981;
    background: #f0fdf4;
    transform: scale(1.1);
}

/* More Details */
.cm-more-details {
    margin: 20px 0;
}

.cm-more-btn {
    background: transparent;
    border: none;
    color: #6b7280;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    margin: 0 auto;
    padding: 8px 12px;
    border-radius: 6px;
    transition: background-color 0.2s;
}

.cm-more-btn:hover {
    background: #f3f4f6;
}

.cm-chevron {
    font-size: 12px;
    transition: transform 0.2s;
}

/* Email Popup Content */
.cm-email-content {
    padding: 25px 20px 20px;
    background: #f8f9fa;
}

.cm-brand-logo {
    margin-bottom: 15px;
}

.cm-brand-circle {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: #000;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
    margin: 0 auto;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.cm-email-title {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
    margin: 0 0 15px;
}

.cm-email-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 15px;
}

.cm-email-form label {
    font-size: 13px;
    font-weight: 500;
    color: #374151;
    text-align: left;
    margin-bottom: 3px;
}

.cm-email-form input {
    padding: 12px 14px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.2s;
}

.cm-email-form input:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.cm-email-submit {
    background: #10b981;
    color: #fff;
    border: none;
    padding: 12px 18px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.cm-email-submit:hover {
    background: #059669;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
}

.cm-email-consent {
    font-size: 11px;
    color: #6b7280;
    line-height: 1.4;
    margin: 0;
}

.cm-email-consent a {
    color: #ef4444;
    text-decoration: underline;
    font-weight: 500;
}

/* Website Logo */
.cm-website-logo {
    padding: 15px;
    border-top: 1px solid #e5e7eb;
    background: #fff;
    text-align: center;
}

.cm-website-name {
    font-size: 14px;
    font-weight: 600;
    color: #111827;
    letter-spacing: 0.5px;
}

/* Fixed Card Layout - Exact Reference Match */
.Sec.fdvo .cpns { 
    display: flex; 
    gap: 20px; 
    flex-wrap: wrap; 
    justify-content: center;
}

.Sec.fdvo .cpn { 
    width: 320px; 
    background: #fff; 
    border-radius: 10px; 
    overflow: hidden; 
    box-shadow: 0 0 5px 3px rgba(0,0,0,0.07); 
    position: relative; 
    transition: transform 0.2s, box-shadow 0.2s;
}

.Sec.fdvo .cpn:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 5px 3px rgba(0,0,0,0.02);
}

.Sec.fdvo .cpn .imgs { 
    position: relative; 
    height: 140px; 
    width: 100%; 
    border-bottom: 1px solid #D5D5D5;
}

.Sec.fdvo .cpn .imgs img.cvr { 
    width: 100%; 
    height: 140px; 
    object-fit: cover; 
    display: block; 
}

.Sec.fdvo .cpn .imgs a { 
    position: absolute; 
    left: 20px; 
    bottom: -30px; 
    display: block; 
}

.Sec.fdvo .cpn .imgs .store-logo {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
    border: 3px solid #fff;
    box-shadow: 0 3px 6px rgba(0,0,0,0.16);
}

.Sec.fdvo .cpn .cnt { 
    padding: 40px 20px 20px 20px; 
    display: flex;
    flex-direction: column;
    gap: 5px 0;
}

.Sec.fdvo .cpn .str-vrf { 
    display: flex; 
    gap: 8px; 
    align-items: center; 
    font-size: 12px; 
    color: #6d6e71; 
    margin-bottom: 5px;
    justify-content: space-between;
    height: 16px;
}

.Sec.fdvo .cpn .str-vrf a { 
    color: #6d6e71; 
    font-weight: 400; 
    text-decoration: none; 
    max-width: 170px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.verified-badge {
    background: #fef08e;
    color: #0f0f0f;
    padding: 3px 6px 2px;
    border-radius: 5px;
    font-size: 12px;
    font-weight: 300;
    text-transform: uppercase;
    line-height: 1;
}

.Sec.fdvo .cpn h3 { 
    margin: 10px 0; 
    font-size: 14px; 
    color: #0f0f0f; 
    line-height: 1.3; 
    font-weight: 500;
    height: 37px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-align: left;
}

.Sec.fdvo .cpn .trm-cnt { 
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
    margin-bottom: 12px; 
    color: #6d6e71; 
    font-size: 12px; 
    height: 18px;
}

.Sec.fdvo .cpn .trm-cnt button { 
    background: transparent; 
    border: none; 
    color: #6d6e71; 
    cursor: pointer; 
    font-size: 12px;
    font-weight: 300;
}

/* Enhanced Button Styling - Exact Reference Match */
.cpBtn { 
    display: inline-flex; 
    flex-wrap: wrap; 
    align-items: center; 
    align-self: center; 
    width: 100%; 
    justify-content: center; 
    padding: 12px 12px; 
    background-color: #FF0000; 
    color: #fff; 
    border-radius: 8px; 
    font-weight: 300; 
    line-height: 1;
    text-decoration: none;
    border: none;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.2s;
    position: relative;
}

.cpBtn:hover { 
    background-color: #FF0000; 
    opacity: 0.95;
}

.cpBtn.reveal-code {
    background-color: #f2f0e6;
    color: #0f0f0f;
    padding-left: 30px;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.cpBtn.reveal-code::before {
    content: attr(data-code);
    display: inline-flex;
    position: absolute;
    width: 50px;
    height: 100%;
    top: 0;
    right: 0;
    align-items: center;
    padding: 0 15px 0 0;
    overflow: hidden;
    border: 2px dashed #FF0000;
    border-left: 0;
    text-transform: uppercase;
    justify-content: end;
    box-sizing: border-box;
    border-radius: 0 9px 9px 0;
    color: #0f0f0f;
    z-index: -1;
    font-size: 14px;
}

.cpBtn.reveal-code::after {
    content: "";
    position: absolute;
    width: 100%;
    height: calc(100% + 2px);
    background-color: #FF0000;
    top: 0;
    right: 34px;
    transform: skewX(25deg);
    transition: .2s ease-in-out;
    z-index: -1;
}

.cpBtn.reveal-code:hover::after {
    right: 45px;
    box-shadow: 5px 0 5px 0 #00000040;
}

.cpBtn.get-deal {
    background-color: #FF0000;
    color: #fff;
}

.cpBtn.get-deal:hover {
    background-color: #FF0000;
    opacity: 0.95;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .Sec.fdvo .cpns { 
        justify-content: center; 
    }
    
    .Sec.fdvo .cpn {
        width: 300px;
    }
}

@media (max-width: 768px) {
    .Sec.fdvo .cpn {
        width: 100%;
        max-width: 350px;
    }
    
    #couponModal {
        gap: 15px;
    }
    
    .cm-main-popup {
        width: 95%;
        max-width: 450px;
    }
    
    .cm-email-popup {
        width: 95%;
        max-width: 450px;
    }
    
    .cm-main-content {
        padding: 25px 20px 20px;
    }
    
    .cm-email-content {
        padding: 20px 15px 15px;
    }
}

@media (max-width: 480px) {
    .Sec.fdvo .cpns {
        gap: 15px;
    }
    
    .Sec.fdvo .cpn .cnt {
        padding: 30px 15px 15px 15px;
    }
    
    .cm-code-wrap {
        flex-direction: column;
        gap: 10px;
    }
    
    .cm-verification {
        flex-direction: column;
        gap: 10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('couponModal');
    if (!modal) return;
    
    const overlay = modal.querySelector('.cm-overlay');
    const closeBtn = modal.querySelector('.cm-close');
    const cmCode = document.getElementById('cmCode');
    const cmCopy = document.getElementById('cmCopy');
    const cmContinue = document.getElementById('cmContinue');
    const cmTitle = document.getElementById('cmTitle');
    const cmNote = document.getElementById('cmNote');
    const cmEmailTitle = document.getElementById('cmEmailTitle');
    const cmEmailForm = document.getElementById('cmEmailForm');
    const cmEmailInput = document.getElementById('cmEmailInput');

    function openModal(code, affiliate, store, title) {
        // Update main popup content
        cmCode.textContent = code || '';
        cmTitle.textContent = title || 'Here is your code';
        cmNote.textContent = `This ${store} website has been opened in a new tab. Simply copy and paste the code ${code} and enter it at the checkout.`;
        
        // Update email popup content
        cmEmailTitle.textContent = `${store} straight to your inbox`;
        
        // Update brand logo with store name
        const brandLogo = document.getElementById('cmBrandLogo');
        if (brandLogo) {
            // Take first 5 characters of store name for logo
            const logoText = store ? store.substring(0, 5).toUpperCase() : 'STORE';
            brandLogo.textContent = logoText;
        }
        
        modal.style.display = 'flex';
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    // Handle Reveal Code buttons - UPDATED LOGIC
    document.querySelectorAll('.cpBtn.reveal-code').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            
            const code = this.dataset.code;
            const affiliate = this.dataset.affiliate;
            const store = this.dataset.store;
            const title = this.dataset.title;
            
            if (code && affiliate) {
                // Open your website with popup in NEW tab
                const currentUrl = window.location.href;
                const popupUrl = currentUrl + '?show_coupon=1&code=' + encodeURIComponent(code) + '&affiliate=' + encodeURIComponent(affiliate) + '&store=' + encodeURIComponent(store) + '&title=' + encodeURIComponent(title);
                window.open(popupUrl, '_blank');
                
                // Redirect CURRENT tab to affiliate URL
                window.location.href = affiliate;
            }
        });
    });

    // Handle Get Deal anchors to behave like Reveal: open new tab of our site (to show modal) and redirect current tab to affiliate
    document.querySelectorAll('.cpBtn.get-deal').forEach(btn => {
        btn.addEventListener('click', function (e) {
            // If it's an anchor, get href; if button (fallback), try data-affiliate
            const affiliate = this.getAttribute('href') || this.dataset.affiliate || '#';
            const store = this.dataset.store || this.dataset.title || '';
            const title = this.dataset.title || '';

            try {
                const params = new URLSearchParams();
                params.set('show_coupon', '1');
                params.set('code', ''); // no code available
                if (affiliate) params.set('affiliate', affiliate);
                if (store) params.set('store', store);
                if (title) params.set('title', title);
                const newUrl = window.location.origin + window.location.pathname + '?' + params.toString();
                window.open(newUrl, '_blank');
            } catch (err) {
                // ignore
            }

            // redirect current tab to affiliate
            if (affiliate && affiliate !== '#') {
                window.location.href = affiliate;
            }

            e.preventDefault();
        });
    });

    // Copy code functionality
    if (cmCopy) {
        cmCopy.addEventListener('click', function () {
            const text = cmCode.textContent.trim();
            if (!text) return;
            
            navigator.clipboard?.writeText(text).then(() => {
                const prev = cmCopy.textContent;
                cmCopy.textContent = 'Copied!';
                cmCopy.style.background = '#059669';
                
                setTimeout(() => {
                    cmCopy.textContent = prev;
                    cmCopy.style.background = '#10b981';
                }, 2000);
            }).catch(() => {
                // Fallback for older browsers
                const tmp = document.createElement('input');
                document.body.appendChild(tmp);
                tmp.value = text;
                tmp.select();
                document.execCommand('copy');
                document.body.removeChild(tmp);
                
                cmCopy.textContent = 'Copied!';
                cmCopy.style.background = '#059669';
                
                setTimeout(() => {
                    cmCopy.textContent = 'Copy Code';
                    cmCopy.style.background = '#10b981';
                }, 2000);
            });
        });
    }

    // Email signup form
    if (cmEmailForm) {
        cmEmailForm.addEventListener('submit', function (e) {
            e.preventDefault();
            
            const email = cmEmailInput.value.trim();
            if (!email) return;
            
            // Here you can add AJAX call to your newsletter subscription endpoint
            // For now, we'll just show a success message
            
            const submitBtn = this.querySelector('.cm-email-submit');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = 'Subscribed!';
            submitBtn.style.background = '#059669';
            cmEmailInput.value = '';
            
            setTimeout(() => {
                submitBtn.textContent = originalText;
                submitBtn.style.background = '#10b981';
            }, 2000);
        });
    }

    // Feedback buttons
    document.querySelectorAll('.cm-feedback-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const feedback = this.dataset.feedback;
            
            // Remove active state from all buttons
            document.querySelectorAll('.cm-feedback-btn').forEach(b => {
                b.style.background = 'transparent';
                b.style.borderColor = '#d1d5db';
            });
            
            // Add active state to clicked button
            this.style.background = feedback === 'positive' ? '#f0fdf4' : '#fef2f2';
            this.style.borderColor = feedback === 'positive' ? '#10b981' : '#ef4444';
            
            // Here you can send feedback to your backend
            console.log('Feedback:', feedback);
        });
    });

    // More details toggle
    const moreBtn = document.querySelector('.cm-more-btn');
    if (moreBtn) {
        moreBtn.addEventListener('click', function () {
            const chevron = this.querySelector('.cm-chevron');
            chevron.style.transform = chevron.style.transform === 'rotate(180deg)' 
                ? 'rotate(0deg)' 
                : 'rotate(180deg)';
            
            // Here you can toggle additional details
            console.log('More details toggled');
        });
    }

    // Close modal events
    closeBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);
    document.addEventListener('keydown', (ev) => { 
        if (ev.key === 'Escape') closeModal(); 
    });

    // Check if page loaded with modal parameters (for new tab functionality)
    try {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('show_coupon') === '1') {
            const code = urlParams.get('code') || '';
            const affiliate = urlParams.get('affiliate') || '#';
            const store = urlParams.get('store') || 'Store';
            const title = urlParams.get('title') || 'Here is your code';

            openModal(code, affiliate, store, title);

            // If no code, display 'No code required' instead and disable copy
            if (!code) {
                const codeEl = document.getElementById('cmCode');
                if (codeEl) codeEl.textContent = 'No code required';
                const copyBtn = document.getElementById('cmCopy');
                if (copyBtn) {
                    copyBtn.disabled = true;
                    copyBtn.style.opacity = '0.6';
                    copyBtn.style.cursor = 'not-allowed';
                }
                const continueBtn = document.getElementById('cmContinue');
                if (continueBtn) continueBtn.href = affiliate || '#';
            } else {
                const continueBtn = document.getElementById('cmContinue');
                if (continueBtn) continueBtn.href = affiliate || '#';
            }

            // Clean URL
            const cleanUrl = window.location.pathname;
            history.replaceState({}, '', cleanUrl);
        }
    } catch (err) {
        // Ignore parsing errors
    }
});
</script>

@endsection

