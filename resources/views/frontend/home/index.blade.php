@extends('frontend.layouts.app')

@section('title', 'Discount Codes, Voucher Codes | Exclusive Deals')
@section('description', 'Discover the latest UK discount and voucher codes at Big Saving Hub. Explore exclusive online deals, and save big on your favourite brands. Start saving today!')

@section('content')
<!-- Modern Hero Section -->
<div class="modern-hero">
    <div class="hero-background">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
    </div>
    
    <div class="hero-content">
        <div class="container">
            <div class="hero-text">
                <h1 class="hero-title">
                    <span class="gradient-text">Save Big</span> with Exclusive
                    <span class="highlight">Coupon Codes</span>
                </h1>
                <p class="hero-subtitle">
                    Discover thousands of verified discount codes from your favorite brands. 
                    Start saving money on every purchase today!
                </p>
                
                <div class="search-container">
                    <div class="search-box" id="searchBox">
                        <input type="text" placeholder="Search for stores, brands, or products..." class="search-input" id="searchInput" autocomplete="off">
                        <button type="button" class="search-btn" id="searchBtn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Search Modal -->
                <div id="searchModal" class="search-modal" style="display: none;">
                    <div class="search-modal-overlay"></div>
                    <div class="search-modal-content">
                        <div class="search-modal-header">
                            <input type="text" placeholder="Search" class="search-modal-input" id="modalSearchInput" autocomplete="off">
                            <button class="search-modal-close" id="closeSearchModal">×</button>
                            <!-- <button type="button" id="testBtn" style="margin-left: 10px; padding: 5px 10px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer;">Test Search</button>
                            <button type="button" id="testBtn2" style="margin-left: 10px; padding: 5px 10px; background: #28a745; color: white; border: none; border-radius: 3px; cursor: pointer;">Test Cath</button> -->
                        </div>
                        <div class="search-modal-body">
                            <div class="search-sections">
                                <div class="search-section-left">
                                    <h3>TRENDING OFFERS</h3>
                                    <div id="trendingOffers" class="offers-list">
                                        <!-- Trending offers will be loaded here -->
                                    </div>
                                </div>
                                <div class="search-section-right">
                                    <h3>BRANDS</h3>
                                    <div id="brandsList" class="brands-list">
                                        <!-- Brands will be loaded here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">{{ number_format($totalCoupons ?? 20000) }}+</div>
                        <div class="stat-label">Active Coupons</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ number_format($totalStores ?? 1000) }}+</div>
                        <div class="stat-label">Partner Stores</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Verified Codes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Store section - Jewelry Style -->
<div class="featured-stores-jewelry-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">
                <span class="title-normal">Our</span>
                <span class="title-highlight" style="color: var(--primary-color, #FF0000) !important;">Featured Stores</span>
            </h2>
            <p class="section-subtitle">Discover amazing brands with exclusive offers</p>
        </div>
        
        <div class="stores-jewelry-grid">
                    @forelse($featuredStores ?? [] as $store)
            <div class="store-jewelry-card">
                <a href="{{ route('store', $store->seo_url) }}" class="store-jewelry-link">
                    <div class="store-jewelry-image-container">
                                @if($store->store_logo)
                            <img src="{{ asset('storage/' . $store->store_logo) }}" alt="{{ $store->store_name }}" class="store-jewelry-image">
                                @else
                            <div class="store-jewelry-placeholder">
                                <span class="placeholder-text">{{ substr($store->store_name, 0, 2) }}</span>
                                    </div>
                                @endif
                            </div>
                    <div class="store-jewelry-info">
                        <h3 class="store-jewelry-name">{{ $store->store_name }}</h3>
                        <span class="store-jewelry-category">{{ \App\Models\Coupon::where('brand_store', $store->store_name)->where('status', 1)->count() }} Offers</span>
                            </div>
                        </a>
                    </div>
                    @empty
            <div class="no-stores-message">
                <div class="no-stores-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                        <path d="M3 7V5C3 3.89543 3.89543 3 5 3H19C20.1046 3 21 3.89543 21 5V7" stroke="currentColor" stroke-width="2"/>
                        <path d="M3 7L5 21H19L21 7" stroke="currentColor" stroke-width="2"/>
                        <path d="M8 11H16" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>No Featured Stores</h3>
                <p>We're working on adding amazing stores for you!</p>
                    </div>
                    @endforelse
                </div>
            </div>
            </div>
<div class="hot-deals-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">🔥 Hot Deals</h2>
   
         <p class="section-subtitle">Limited time offers you can't miss</p>
            <a href="{{ route('top-discounts') }}" class="view-all-link">View All Deals →</a>
        </div>
        
        <div class="deals-grid">
            @forelse($featuredCoupons ?? [] as $coupon)
            <div class="deal-card {{ $coupon->coupon_code ? 'has-code' : 'deal-only' }}" data-id="{{ $coupon->id }}">
                <!-- Coupon Image Section -->
                <div class="deal-image-section">
                    @if($coupon->cover_logo)
                        <img src="{{ asset('storage/' . $coupon->cover_logo) }}" alt="{{ $coupon->coupon_title }}" class="deal-cover-image">
                    @else
                        <div class="deal-placeholder-image">
                            <div class="placeholder-icon">🎁</div>
                            <span>{{ $coupon->store->store_name ?? $coupon->brand_store ?? 'Deal' }}</span>
                        </div>
                    @endif
                    
                    <!-- Discount Badge -->
                    <div class="discount-badge">
                        {{ rand(10, 70) }}% OFF
                    </div>
                    
                    <!-- Exclusive Badge -->
                    @if($coupon->exclusive)
                        <div class="exclusive-badge">
                            <span class="exclusive-icon">⭐</span>
                            EXCLUSIVE
                        </div>
                    @endif
                </div>
                
                <!-- Deal Content -->
                <div class="deal-content-wrapper">
                    <div class="deal-header">
                        <div class="store-info">
                            @if($coupon->store && $coupon->store->store_logo)
                                <img src="{{ asset('storage/' . $coupon->store->store_logo) }}" alt="{{ $coupon->store->store_name }}" class="store-logo">
                            @endif
                            <div class="store-details">
                                <h3 class="store-name">{{ $coupon->store->store_name ?? $coupon->brand_store ?? 'Store' }}</h3>
                                @if($coupon->verified)
                                    <span class="verified-badge">✓ Verified</span>
                                @endif
                            </div>
                        </div>
                        <div class="deal-type">
                            @if($coupon->coupon_code)
                                <span class="type-badge code">
                                    <span class="badge-icon">🔑</span>
                                    CODE
                                </span>
                            @else
                                <span class="type-badge deal">
                                    <span class="badge-icon">🎯</span>
                                    DEAL
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="deal-content">
                        <h4 class="deal-title">{{ $coupon->coupon_title }}</h4>
                        <div class="deal-meta">
                            <div class="meta-item">
                                <span class="meta-icon">👥</span>
                                <span class="usage-count">{{ number_format($coupon->sort_order ?? rand(500, 5000)) }} used</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-icon">⏰</span>
                                <span class="expiry-time">Limited Time</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="deal-footer">
                        
                        @if($coupon->coupon_code)
                            <button class="deal-btn reveal-code" 
                                    data-code="{{ $coupon->coupon_code }}" 
                                    data-affiliate="{{ $coupon->affiliate_url ?? url('/') }}"
                                    data-store="{{ $coupon->store->store_name ?? $coupon->brand_store ?? 'Store' }}"
                                    data-title="{{ $coupon->coupon_title }}">
                                <span class="btn-icon">🔓</span>
                                <span class="btn-text">Reveal Code</span>
                                <span class="btn-arrow">→</span>
                            </button>
                        @else
                            <button class="deal-btn get-deal" 
                                    data-affiliate="{{ $coupon->affiliate_url }}"
                                    data-store="{{ $coupon->store->store_name ?? $coupon->brand_store ?? 'Store' }}"
                                    data-title="{{ $coupon->coupon_title }}">
                                <span class="btn-icon">🎯</span>
                                <span class="btn-text">Get Deal</span>
                                <span class="btn-arrow">→</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="no-deals">
                <div class="no-deals-icon">😔</div>
                <h3>No Hot Deals Available</h3>
                <p>Check back soon for amazing offers!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>



<!-- Categories Section -->
<div class="categories-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Shop by Category</h2>
            <p class="section-subtitle">Find deals in your favorite shopping categories</p>
        </div>
        
        <div class="categories-grid">
            @forelse($categories ?? [] as $category)
            <div class="category-card">
                <div class="category-icon">
                    @if($category->media)
                        <img src="{{ asset('storage/' . $category->media) }}" alt="{{ $category->category_name }}" class="category-image">
                    @else
                        <span class="default-icon">🏷️</span>
                    @endif
            </div>
                <h3>{{ $category->category_name }}</h3>
                <p>{{ $category->short_content ?: 'Explore amazing deals in this category' }}</p>
                <div class="category-stats">
                    <span class="store-count">{{ $category->stores_count }} Stores</span>
            </div>
                <a href="{{ route('category', $category->seo_url) }}" class="category-link">Shop Now →</a>
            </div>
            @empty
            <div class="no-categories">
                <div class="no-categories-icon">📂</div>
                <h3>No Featured Categories</h3>
                <p>We're working on adding amazing categories for you!</p>
            </div>
            @endforelse
            </div>
            </div>
        </div>


<!-- About Big Saving Hub <start> -->
<div class="Sec abt container">
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
<!-- Category Deals Section -->
<div class="category-deals-section" style="background-color: #f8fafc; padding: 5rem 0;">
    <div class="container">
        @forelse($homeCategories ?? [] as $category)
        <div class="category-section">
            <div class="category-header">
                <h3 class="category-title">
                    @if($category->media)
                        <img src="{{ asset('storage/' . $category->media) }}" alt="{{ $category->category_name }}" class="category-title-icon">
                            @else
                        <span class="category-emoji">🏷️</span>
                            @endif
                    {{ $category->category_name }}
                    </h3>
                <a href="{{ route('category', $category->seo_url) }}" class="view-more">View All →</a>
                    </div>
            <div class="deals-grid">
                @forelse($category->coupons ?? [] as $coupon)
                <div class="deal-card {{ $coupon->coupon_code ? 'has-code' : 'deal-only' }}" data-id="{{ $coupon->id }}">
                    <!-- Coupon Image Section -->
                    <div class="deal-image-section">
                        @if($coupon->cover_logo)
                            <img src="{{ asset('storage/' . $coupon->cover_logo) }}" alt="{{ $coupon->coupon_title }}" class="deal-cover-image">
                    @else
                            <div class="deal-placeholder-image">
                                <div class="placeholder-icon">🎁</div>
                                <span>{{ $coupon->store->store_name ?? $coupon->brand_store ?? 'Deal' }}</span>
                </div>
                        @endif
                        
                        <!-- Discount Badge -->
                        <div class="discount-badge">
                            {{ rand(10, 70) }}% OFF
            </div>
                        
                        <!-- Exclusive Badge -->
                        @if($coupon->exclusive)
                            <div class="exclusive-badge">
                                <span class="exclusive-icon">⭐</span>
                                EXCLUSIVE
                </div>
                        @endif
                    </div>
                    
                    <!-- Deal Content -->
                    <div class="deal-content-wrapper">
                        <div class="deal-header">
                            <div class="store-info">
                    @if($coupon->store && $coupon->store->store_logo)
                                    <img src="{{ asset('storage/' . $coupon->store->store_logo) }}" alt="{{ $coupon->store->store_name }}" class="store-logo">
                    @endif
                                <div class="store-details">
                                    <h3 class="store-name">{{ $coupon->store->store_name ?? $coupon->brand_store ?? 'Store' }}</h3>
                        @if($coupon->verified)
                                        <span class="verified-badge">✓ Verified</span>
                        @endif
                    </div>
                    </div>
                            <div class="deal-type">
                    @if($coupon->coupon_code)
                                    <span class="type-badge code">
                                        <span class="badge-icon">🔑</span>
                                        CODE
                                    </span>
                    @else
                                    <span class="type-badge deal">
                                        <span class="badge-icon">🎯</span>
                                        DEAL
                                    </span>
                    @endif
                </div>
            </div>
                        
                        <div class="deal-content">
                            <h4 class="deal-title">{{ $coupon->coupon_title }}</h4>
                            <div class="deal-meta">
                                <div class="meta-item">
                                    <span class="meta-icon">👥</span>
                                    <span class="usage-count">{{ number_format($coupon->sort_order ?? rand(500, 5000)) }} used</span>
            </div>
                                <div class="meta-item">
                                    <span class="meta-icon">⏰</span>
                                    <span class="expiry-time">Limited Time</span>
        </div>
    </div>
                </div>
                        
                        <div class="deal-footer">
                    @if($coupon->coupon_code)
                                <button class="deal-btn reveal-code" 
                                data-code="{{ $coupon->coupon_code }}" 
                                data-affiliate="{{ $coupon->affiliate_url ?? url('/') }}"
                                        data-store="{{ $coupon->store->store_name ?? $coupon->brand_store ?? 'Store' }}"
                                data-title="{{ $coupon->coupon_title }}">
                                    <span class="btn-icon">🔓</span>
                                    <span class="btn-text">Reveal Code</span>
                                    <span class="btn-arrow">→</span>
                        </button>
                    @else
                                <button class="deal-btn get-deal" 
                                data-affiliate="{{ $coupon->affiliate_url ?? url('/') }}"
                                        data-store="{{ $coupon->store->store_name ?? $coupon->brand_store ?? 'Store' }}"
                                data-title="{{ $coupon->coupon_title }}">
                                    <span class="btn-icon">🎯</span>
                                    <span class="btn-text">Get Deal</span>
                                    <span class="btn-arrow">→</span>
                        </button>
                    @endif
                        </div>
                </div>
            </div>
            @empty
                <div class="no-category-deals">
                    <p>No {{ $category->category_name }} deals available at the moment.</p>
            </div>
            @endforelse
                </div>
            </div>
            @empty
        <div class="no-categories-section">
            <div class="no-categories-icon">📂</div>
            <h3>No Categories Available</h3>
            <p>We're working on adding amazing category deals for you!</p>
            </div>
            @endforelse
        </div>
</div>
<!-- Slider Section <end> -->


<div class="Sec Wrp container">
    <div class="rsnws">
        <!-- Recommended Stores <Start> -->
        <div class="rs">
            <h2>Recommended Stores</h2>
            <div class="tbs">
                <div class="tb">
                    @forelse($recommendedCategories ?? [] as $index => $category)
                    <a class="{{ $index === 0 ? 'active' : '' }}" 
                       title="{{ $category->category_name }}" 
                       href="javascript:;" 
                       data-type="{{ $category->id }}" 
                       data-slug="{{ $category->seo_url }}" 
                       aria-label="{{ $category->category_name }}">
                        {{ $category->category_name }} <i class="bp_drprgt-r"></i>
                    </a>
                    @empty
                    <a class="active" title="No Categories" href="javascript:;" aria-label="No Categories">No Categories Available <i class="bp_drprgt-r"></i></a>
                    @endforelse
                </div>
                <div class="cnt">
                    @forelse($recommendedCategories ?? [] as $index => $category)
                    <div class="store-category-content {{ $index === 0 ? 'active' : '' }}" data-category="{{ $category->id }}">
                        @forelse($category->stores ?? [] as $store)
                        <a href="{{ route('store', $store->seo_url) }}" title="{{ $store->store_name }}" aria-label="{{ $store->store_name }}">{{ $store->store_name }}</a>
                        @empty
                        <span class="no-stores">No stores available in {{ $category->category_name }} category.</span>
                        @endforelse
                </div>
                    @empty
                    <div class="no-categories">
                        <span>No recommended categories available.</span>
                    </div>
                    @endforelse
                    <a class="lst" href="{{ route('categories') }}" title="View All Categories" aria-label="View All Categories">View All <i class="bp_drprgt-r"></i></a>
                </div>
            </div>
        </div>
        <!-- Recommended Stores <end> -->

        <!-- Newsletter <Start> -->
        <div class="snlsec">
    
            <img src="assets/images/svg/nwsltr.svg" alt="paper plan" width="100" height="100" decoding="async" loading="lazy">
            <h2>Sign-up To Get Latest Voucher Codes First</h2>
            <p>Be the first one to get notified as soon as we update a new offer or discount.</p>

            <form id="newsletterForm" class="snfld">
                @csrf
                <input type="email" name="email" id="newsletterEmail" placeholder="Enter Your Email Address Here" required>
                <button type="submit" class="nfb" title="Subscribe" id="newsletterBtn">Subscribe</button>
            </form>
            <div id="newsletterMessage" style="margin-top: 10px; display: none;"></div>

    <p>By signing up I agree to Big Saving Hub's <a href="{{ url('/privacy-policy') }}" target="_blank">Privacy Policy</a> and consent to receive emails about offers.</p>
</div>        <!-- Newsletter <end> -->
    </div>
</div>

<!-- Enhanced Coupon Modal -->
<div id="couponModal" aria-hidden="true" style="display:none;">
    <div class="cm-overlay"></div>
    
    <!-- Main Voucher Code Popup -->
    <div class="cm-main-popup" role="dialog" aria-modal="true" aria-label="Coupon Code Popup">
        <button class="cm-close" aria-label="Close popup">&times;</button>

        <!-- Main Popup Content -->
        <div class="cm-main-content text-center">
            <h3 class="cm-title" id="cmTitle">Here is your code</h3>
            
            <div class="cm-code-section">
                <div class="cm-code-display" id="cmCode">CODE123</div>
                <button class="cm-copy-btn" id="cmCopy">Copy Code</button>
            </div>
            
            <div class="cm-note" id="cmNote">
                <p>Copy the code above and use it at checkout to get your discount!</p>
            </div>
        </div>
    </div>

    <!-- Email Subscription Popup -->
    <div class="cm-email-popup" role="dialog" aria-modal="true" aria-label="Email Subscription Popup">
        <div class="cm-email-content">
            <div class="cm-brand-logo">
                <div class="cm-brand-circle" id="cmBrandLogo">
                    <span id="cmBrandText">STORE</span>
                </div>
            </div>
            
            <h3 class="cm-email-title" id="cmEmailTitle">Get More Deals!</h3>
            <p class="cm-email-subtitle">Subscribe to get exclusive offers and discounts</p>
            
            <form class="cm-email-form" id="cmEmailForm">
                <input type="email" placeholder="Enter your email" required>
                <button type="submit">Subscribe</button>
            </form>
            
            <p class="cm-email-privacy">We respect your privacy. Unsubscribe at any time.</p>
        </div>
    </div>
</div>

<style>
/* Coupon Modal Styles */
#couponModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    padding: 20px;
    box-sizing: border-box;
}

.cm-overlay {
    position: absolute;
    inset: 0; 
    background: rgba(0,0,0,0.6); 
}

/* Main Voucher Code Popup */
.cm-main-popup { 
  position: relative;
  top: 20px;
  margin: auto;
    width: 480px; 
    max-width: calc(50% - 30px); 
    background: #fff; 
    border-radius: 16px; 
    padding: 30px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    overflow: hidden;
    z-index: 2;
}

/* Email Subscription Popup */
.cm-email-popup { 
  position: relative;
  margin: auto;
  top: 40px;
    width: 480px; 
    max-width: calc(50% - 30px); 
    background: #fff; 
    border-radius: 16px; 
    padding: 30px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    overflow: hidden;
    z-index: 2;
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
    background: #fff;
    text-align: center;
}

.cm-title {
    font-size: 28px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 25px;
    line-height: 1.2;
}

.cm-code-section {
    margin: 20px 0;
}

.cm-code-display {
    background: #f8f9fa;
    border: 2px dashed #FF0000;
    border-radius: 8px;
    padding: 15px;
    font-size: 18px;
    font-weight: bold;
    color: #FF0000;
    margin-bottom: 15px;
    font-family: monospace;
}

.cm-copy-btn {
    background: #FF0000;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.cm-copy-btn:hover {
    background: #FF0000;
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
/* .cm-email-content {
    padding: 25px 20px 20px;
    background: #f8f9fa;
} */

.cm-brand-logo {
    margin-bottom: 15px;
}

.cm-brand-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #FF0000;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: white;
    font-weight: bold;
    font-size: 14px;
}

.cm-email-title {
    text-align: center;
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
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

.cm-email-form button {
    width: 100%;
    background: #FF0000;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.cm-email-form button:hover {
    background: #FF0000;
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
  const cmBrandLogo = document.getElementById('cmBrandLogo');
  const cmBrandText = document.getElementById('cmBrandText');

  function openModal(code, affiliate, store, title) {
    if (cmCode) cmCode.textContent = code;
    if (cmTitle) cmTitle.textContent = title || 'Here is your code';
    if (cmEmailTitle) cmEmailTitle.textContent = `Get More ${store} Deals!`;
    
    if (cmBrandLogo && cmBrandText) {
      if (store && store !== 'Store') {
        cmBrandText.textContent = store.substring(0,5).toUpperCase();
      } else {
        cmBrandText.textContent = 'STORE';
      }
    }

    modal.style.display = 'block';
    modal.setAttribute('aria-hidden','false');
    document.body.style.overflow = 'hidden';
  }

    function closeModal() {
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

  // Reveal code buttons
  document.querySelectorAll('.cpBtn.reveal-code').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const code = this.dataset.code;
      const affiliate = this.dataset.affiliate;
      const store = this.dataset.store;
      const title = this.dataset.title;
      if (code && affiliate) {
        const currentUrl = window.location.href.split('#')[0].split('?')[0];
        const popupUrl = currentUrl + '?show_coupon=1&code=' + encodeURIComponent(code) + '&affiliate=' + encodeURIComponent(affiliate) + '&store=' + encodeURIComponent(store) + '&title=' + encodeURIComponent(title);
        window.open(popupUrl, '_blank');
        window.location.href = affiliate;
      }
    });
  });

  // Get Deal buttons - same logic as Reveal Code but without code
  document.querySelectorAll('.cpBtn.get-deal').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const affiliate = this.getAttribute('href') || this.dataset.affiliate || '#';
      const store = this.dataset.store || this.dataset.title || '';
      const title = this.dataset.title || '';
      
      if (affiliate && affiliate !== '#') {
        const currentUrl = window.location.href.split('#')[0].split('?')[0];
        const popupUrl = currentUrl + '?show_coupon=1&code=&affiliate=' + encodeURIComponent(affiliate) + '&store=' + encodeURIComponent(store) + '&title=' + encodeURIComponent(title);
        window.open(popupUrl, '_blank');
        window.location.href = affiliate;
      }
    });
  });

  // Copy button
  if (cmCopy) {
    cmCopy.addEventListener('click', function() {
      const code = cmCode ? cmCode.textContent : '';
      if (code) {
        navigator.clipboard.writeText(code).then(function() {
          const originalText = cmCopy.textContent;
          cmCopy.textContent = 'Copied!';
          cmCopy.style.backgroundColor = '#218838';
          
          setTimeout(function() {
            cmCopy.textContent = originalText;
            cmCopy.style.backgroundColor = '#28a745';
          }, 2000);
        }).catch(function(err) {
          console.error('Could not copy text: ', err);
          alert('Coupon Code: ' + code);
        });
      }
    });
  }

  // Email form
  const emailForm = document.getElementById('cmEmailForm');
  if (emailForm) {
    emailForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const email = this.querySelector('input[type="email"]').value;
      if (email) {
        // Here you can add AJAX call to subscribe
        alert('Thank you for subscribing!');
        closeModal();
      }
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

  // show modal if params present
  try {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('show_coupon') === '1') {
      const code = urlParams.get('code') || '';
      const affiliate = urlParams.get('affiliate') || '#';
      const store = urlParams.get('store') || 'Store';
      const title = urlParams.get('title') || 'Here is your code';
      
      openModal(code, affiliate, store, title);
      
      // If no code, show "No code required" message
      if (!code) {
        if (cmCode) cmCode.textContent = 'No code required';
        if (cmCopy) {
          cmCopy.disabled = true;
          cmCopy.style.opacity = '0.6';
          cmCopy.style.cursor = 'not-allowed';
        }
      }
      
      history.replaceState({}, '', window.location.pathname);
    }
  } catch (e) {
    console.log('URL params not supported');
  }
});
</script>

<!-- Modern Home Page Styles -->
<style>
/* Modern Hero Section */
.modern-hero {
    position: relative;
    min-height: 70vh;
    display: flex;
    align-items: center;
    background: 
        linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url('{{ asset('frontend_assets/images/search-bg.webp') }}') center/cover no-repeat;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.floating-shapes {
    position: absolute;
    width: 100%;
    height: 100%;
}

.shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 120px;
    height: 120px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.shape-3 {
    width: 60px;
    height: 60px;
    top: 30%;
    right: 30%;
    animation-delay: 4s;
}

.shape-4 {
    width: 100px;
    height: 100px;
    bottom: 20%;
    left: 20%;
    animation-delay: 1s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.hero-text {
    text-align: center;
    color: white;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.gradient-text {
    background: var(--primary-color, #FF0000);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.highlight {
    color: var(--primary-color, #FF0000);
}

.hero-subtitle {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    opacity: 0.9;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.search-container {
    margin-bottom: 3rem;
}

.search-box {
    position: relative;
    max-width: 600px;
    margin: 0 auto;
}

.search-input {
    width: 100%;
    padding: 1rem 1.5rem;
    font-size: 1.1rem;
    border: none;
    border-radius: 50px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    outline: none;
    transition: all 0.3s ease;
}

.search-input:focus {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.search-btn {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    background: var(--primary-color, #FF0000);
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-btn:hover {
    transform: translateY(-50%) scale(1.1);
}

/* Search Modal Styles */
.search-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
}

.search-modal-content {
    position: relative;
    background: white;
    border-radius: 15px;
    width: 90%;
    max-width: 800px;
    max-height: 80vh;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.search-modal-header {
    display: flex;
    align-items: center;
    padding: 20px 25px;
    border-bottom: 1px solid #e0e0e0;
    background: #f8f9fa;
}

.search-modal-input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 18px;
    padding: 10px 0;
    background: transparent;
    color: #333;
}

.search-modal-input::placeholder {
    color: #999;
}

.search-modal-close {
    background: none;
    border: none;
    font-size: 24px;
    color: #666;
    cursor: pointer;
    padding: 5px;
    margin-left: 15px;
    transition: color 0.3s ease;
}

.search-modal-close:hover {
    color: #333;
}

.search-modal-body {
    padding: 25px;
    max-height: 60vh;
    overflow-y: auto;
}

.search-sections {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

.search-section-left,
.search-section-right {
    min-height: 200px;
}

.search-section-left h3,
.search-section-right h3 {
    margin: 0 0 20px 0;
    font-size: 16px;
    font-weight: 600;
    color: #333;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.offers-list,
.brands-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.offer-item {
    display: flex;
    align-items: center;
    padding: 15px;
    border-radius: 10px;
    background: #f8f9fa;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
}

.offer-item:hover {
    background: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.offer-logo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 15px;
    flex-shrink: 0;
}

.offer-logo-placeholder {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--primary-color, #FF0000);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 12px;
    margin-right: 15px;
    flex-shrink: 0;
}

.offer-content {
    flex: 1;
}

.offer-brand {
    font-weight: 600;
    color: #333;
    margin: 0 0 5px 0;
    font-size: 14px;
}

.offer-description {
    color: #666;
    font-size: 13px;
    margin: 0 0 8px 0;
}

.offer-button {
    background: var(--primary-color, #FF0000);
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s ease;
}

.offer-button:hover {
    background: #cc0000;
    transform: scale(1.05);
}

.brand-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
    transition: color 0.3s ease;
}

.brand-item:hover {
    color: var(--primary-color, #FF0000);
}

.brand-item:last-child {
    border-bottom: none;
}

.brand-name {
    font-weight: 600;
    color: var(--primary-color, #FF0000);
    font-size: 14px;
}

.brand-offers {
    color: #666;
    font-size: 12px;
}

.loading-state {
    text-align: center;
    padding: 40px;
    color: #666;
}

.loading-spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid #f3f3f3;
    border-top: 2px solid var(--primary-color, #FF0000);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-right: 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@media (max-width: 768px) {
    .search-modal-content {
        width: 95%;
        margin: 20px;
    }
    
    .search-sections {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .search-modal-header {
        padding: 15px 20px;
    }
    
    .search-modal-body {
        padding: 20px;
    }
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary-color, #FF0000);
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1rem;
    opacity: 0.8;
}

/* Featured Brands Section */
.featured-brands-section {
    padding: 4rem 0;
    background: var(--background-primary-color, #ffffff);
}

.featured-brands-section .section-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.featured-brands-section .section-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-color, #333333) !important;
    margin-bottom: 0.5rem;
}

.featured-brands-section .section-subtitle {
    font-size: 1rem;
    color: var(--text-color, #666666) !important;
    max-width: 500px;
    margin: 0 auto;
}

.brands-carousel {
    margin-bottom: 3rem;
    position: relative;
}

.carousel-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    overflow: hidden;
}

.brands-slider {
    display: flex;
    gap: 2rem;
    overflow: visible;
    padding: 1rem 0;
    width: 100%;
    max-width: 1000px;
    transition: transform 0.5s ease;
    justify-content: center;
    align-items: center;
}

.carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: var(--primary-color, #FF0000);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 1.5rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
}

.carousel-btn:hover {
    background: var(--secondary-color, #cc0000);
    transform: translateY(-50%) scale(1.1);
}

.prev-btn {
    left: -20px;
}

.next-btn {
    right: -20px;
}

.brand-item {
    flex: 0 0 120px;
    text-align: center;
    margin: 0 1rem;
}

.brand-link {
    display: block;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
}

.brand-link:hover {
    transform: translateY(-5px);
}

.brand-logo-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--background-primary-color, #ffffff);
    border: 3px solid var(--background-secondary-color, #f0f0f0);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.brand-link:hover .brand-logo-circle {
    border-color: var(--primary-color, #FF0000);
    box-shadow: 0 8px 30px rgba(255, 0, 0, 0.2);
    transform: scale(1.05);
}

.brand-logo {
    max-width: 60px;
    max-height: 60px;
    object-fit: contain;
    transition: all 0.3s ease;
}

.brand-link:hover .brand-logo {
    transform: scale(1.1);
}

.brand-placeholder {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-color, #FF0000), var(--secondary-color, #000000));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.brand-placeholder::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="brand-pattern" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="60" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23brand-pattern)"/></svg>');
    opacity: 0.3;
}

.brand-initials {
    font-size: 1.5rem;
    font-weight: 800;
    color: white;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    z-index: 1;
}

.carousel-dots {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 2rem;
}

.dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #e0e0e0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.dot.active {
    background: var(--primary-color, #FF0000);
    transform: scale(1.2);
}

.dot:hover {
    background: var(--primary-color, #FF0000);
    opacity: 0.7;
}

.no-brands {
    text-align: center;
    padding: 3rem;
    color: var(--text-color, #666);
}

.no-brands-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.no-brands h3 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: var(--text-color, #333);
}

.view-all-brands {
    text-align: center;
}

.btn-outline {
    display: inline-block;
    padding: 0.75rem 2rem;
    border: 2px solid var(--primary-color, #FF0000);
    color: var(--primary-color, #FF0000);
    text-decoration: none;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline:hover {
    background: var(--primary-color, #FF0000);
    color: white;
    transform: translateY(-2px);
}

/* Hot Deals Section */
.hot-deals-section {
    padding: 3rem 0;
    background: var(--background-primary-color, #ffffff);
}

.section-title {
    color: var(--text-color, #333333) !important;
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 0.5rem;
}

.section-subtitle {
    color: var(--text-color, #666666) !important;
    text-align: center;
    margin-bottom: 2rem;
}

.view-all-link {
    color: var(--primary-color, #FF0000);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    text-align: center;
    display: block;
    margin-bottom: 2rem;
}

.view-all-link:hover {
    color: var(--secondary-color, #cc0000);
    text-decoration: underline;
}

.deals-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-top: 2rem;
}

.deal-card {
    background: var(--background-primary-color, #ffffff);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--background-secondary-color, #e5e5e5);
    transition: all 0.3s ease;
    position: relative;
    height: 320px;
}

.deal-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}

/* Deal Image Section */
.deal-image-section {
    position: relative;
    height: 140px;
    overflow: hidden;
    background: var(--background-secondary-color, #f8f9fa);
}

.deal-cover-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.deal-card:hover .deal-cover-image {
    transform: scale(1.05);
}

.deal-placeholder-image {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: var(--background-secondary-color, #f8f9fa);
    color: var(--text-color, #666);
}

.placeholder-icon {
    font-size: 2rem;
    margin-bottom: 0.25rem;
}

.deal-placeholder-image span {
    font-size: 0.9rem;
    font-weight: 600;
    text-align: center;
}

/* Discount Badge */
.discount-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    background: var(--primary-color, #FF0000);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 700;
}

/* Exclusive Badge */
.exclusive-badge {
    position: absolute;
    top: 8px;
    left: 8px;
    background: var(--primary-color, #FF0000);
    color: white;
    padding: 0.2rem 0.4rem;
    border-radius: 8px;
    font-size: 0.6rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.1rem;
}

.exclusive-icon {
    font-size: 0.6rem;
}

/* Deal Content Wrapper */
.deal-content-wrapper {
    padding: 1rem;
    height: 180px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.deal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.store-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.store-logo {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid #e5e5e5;
}

.store-details h3 {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-color, #333);
    margin: 0;
}

.verified-badge {
    background: #38a169;
    color: white;
    padding: 0.1rem 0.4rem;
    border-radius: 8px;
    font-size: 0.6rem;
    font-weight: 600;
    margin-top: 0.1rem;
    display: inline-block;
}

.type-badge {
    padding: 0.2rem 0.4rem;
    border-radius: 8px;
    font-size: 0.6rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.1rem;
}

.type-badge.code {
    background: var(--primary-color, #FF0000);
    color: white;
}

.type-badge.deal {
    background: var(--secondary-color, #333);
    color: white;
}

.badge-icon {
    font-size: 0.6rem;
}

.deal-content {
    margin-bottom: 0.75rem;
}

.deal-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-color, #333);
    margin-bottom: 0.25rem;
    line-height: 1.2;
}

.deal-description {
    font-size: 0.75rem;
    color: var(--text-color, #666);
    margin-bottom: 0.5rem;
    line-height: 1.3;
}

.deal-meta {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.1rem;
    font-size: 0.65rem;
    color: var(--text-color, #666);
    background: var(--background-secondary-color, #f8f9fa);
    padding: 0.2rem 0.4rem;
    border-radius: 8px;
    border: 1px solid var(--background-secondary-color, #e5e5e5);
}

.meta-icon {
    font-size: 0.7rem;
}

.deal-footer {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.terms-btn {
    background: var(--background-secondary-color, #f8f9fa);
    border: 1px solid var(--background-secondary-color, #e5e5e5);
    color: var(--text-color, #666);
    cursor: pointer;
    font-size: 0.7rem;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 0.2rem;
    transition: all 0.3s ease;
}

.terms-btn:hover {
    background: var(--background-secondary-color, #e2e8f0);
    color: var(--text-color, #374151);
}

.terms-icon {
    font-size: 0.9rem;
}

.deal-btn {
    flex: 1;
    /* padding: 0.5rem 1rem; */
    border: none;
    border-radius: 8px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.3rem;
    font-size: 0.8rem;
}

.deal-btn.reveal-code {
    background: var(--primary-color, #FF0000);
    color: white;
}

.deal-btn.get-deal {
    background: var(--secondary-color, #333);
    color: white;
}

.deal-btn:hover {
    transform: translateY(-1px);
}

.deal-btn.reveal-code:hover {
    background: var(--secondary-color, #cc0000);
}

.deal-btn.get-deal:hover {
    background: var(--text-color, #555);
}

.btn-icon {
    font-size: 0.8rem;
}

.btn-arrow {
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.deal-btn:hover .btn-arrow {
    transform: translateX(3px);
}

.no-deals {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--text-color, #64748b);
    grid-column: 1 / -1;
    background: var(--background-primary-color, white);
    border-radius: 20px;
    border: 2px dashed var(--background-secondary-color, #e2e8f0);
}

.no-deals-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.no-deals h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-color, #374151);
    margin-bottom: 0.5rem;
}

/* Categories Section */
.categories-section {
    padding: 5rem 0;
    background: var(--background-secondary-color, #f8fafc);
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.category-card {
    background: var(--background-primary-color, white);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid var(--background-secondary-color, #e2e8f0);
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.category-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.category-card h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-color, #1a202c);
    margin-bottom: 0.5rem;
}

.category-card p {
    color: var(--text-color, #64748b);
    margin-bottom: 1.5rem;
}

.category-link {
    color: var(--primary-color, #667eea);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.category-link:hover {
    color: var(--secondary-color, #5a67d8);
}

/* Category Deals Section */
.category-deals-section {
    padding: 5rem 0;
    background: var(--background-primary-color, white);
}

.category-section {
    margin-bottom: 3rem;
}

.category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.category-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-color, #1a202c);
}

.view-more {
    color: var(--primary-color, #667eea);
    text-decoration: none;
    font-weight: 600;
}

.category-deals {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1rem;
}

.mini-deal-card {
    background: var(--background-secondary-color, #f8fafc);
    border-radius: 12px;
    padding: 1rem;
    border: 1px solid var(--background-secondary-color, #e2e8f0);
    transition: all 0.3s ease;
}

.mini-deal-card:hover {
    background: var(--background-primary-color, white);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.deal-store {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
}

.mini-store-logo {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    object-fit: cover;
}

.mini-store-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-color, #1a202c);
}

.mini-deal-title {
    font-size: 0.95rem;
    color: var(--text-color, #374151);
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.deal-actions {
    text-align: right;
}

.mini-btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.mini-btn.reveal-code {
    background: linear-gradient(45deg, #ff6b6b, #ffd93d);
    color: white;
}

.mini-btn.get-deal {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
}

.mini-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.no-category-deals {
    text-align: center;
    padding: 2rem;
    color: var(--text-color, #64748b);
    grid-column: 1 / -1;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .deals-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }
}

@media (max-width: 992px) {
    .deals-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .deal-card {
        height: 300px;
    }
    
    .deal-image-section {
        height: 120px;
    }
    
    .deal-content-wrapper {
        padding: 0.75rem;
        height: 180px;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-stats {
        gap: 2rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .deals-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .deal-card {
        max-width: 350px;
        margin: 0 auto;
        height: 280px;
    }
    
    .deal-image-section {
        height: 100px;
    }
    
    .deal-content-wrapper {
        padding: 0.75rem;
        height: 180px;
    }
    
    .categories-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    
    .category-deals {
        grid-template-columns: 1fr;
    }
    
    .hot-deals-section {
        padding: 3rem 0;
    }
    
    .section-title {
        font-size: 2rem !important;
    }
    
    .brands-slider {
        gap: 1.5rem;
    }
    
    .brand-logo-circle {
        width: 80px;
        height: 80px;
    }
    
    .brand-logo {
        max-width: 60px;
        max-height: 60px;
    }
    
    .brand-placeholder {
        width: 60px;
        height: 60px;
    }
    
    .brand-initials {
        font-size: 1.2rem;
    }
    
    .dot {
        width: 10px;
        height: 10px;
    }
    
    .carousel-btn {
        width: 35px;
        height: 35px;
        font-size: 1.2rem;
    }
    
    .prev-btn {
        left: -15px;
    }
    
    .next-btn {
        right: -15px;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .search-input {
        padding: 0.875rem 1.25rem;
        font-size: 1rem;
    }
    
    .brands-track {
        gap: 1rem;
    }
    
    .brand-card {
        flex: 0 0 150px;
        padding: 1rem;
    }
}

/* Recommended Stores Tab Functionality CSS */
.store-category-content {
    display: none;
}

.store-category-content.active {
    display: block;
}

.tb a {
    cursor: pointer;
    transition: all 0.3s ease;
}

.tb a:hover {
    background-color: #f8f9fa;
    color: #333;
}

.tb a.active {
    background-color: #e9ecef;
    color: #333;
    font-weight: 600;
}

.cnt .store-category-content a {
    display: inline-block;
    color: #333;
    text-decoration: none;
    font-size: 0.9rem;
    margin-right: 1rem;
    margin-bottom: 0.5rem;
    transition: color 0.3s ease;
}

.cnt .store-category-content a:hover {
    color: #007bff;
    text-decoration: underline;
}

.cnt .no-stores, .cnt .no-categories {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.cnt .lst {
    display: block;
    margin-top: 1rem;
    color: #007bff;
    text-decoration: none;
    font-weight: 600;
}

.cnt .lst:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cnt .store-category-content a {
        font-size: 0.85rem;
        margin-right: 0.75rem;
    }
}
</style>

<!-- Enhanced Coupon Modal -->
<div id="couponModal" aria-hidden="true" style="display:none;">
    <div class="cm-overlay"></div>
    
    <!-- Main Voucher Code Popup -->
    <div class="cm-main-popup" role="dialog" aria-modal="true" aria-label="Coupon Code Popup">
        <button class="cm-close" aria-label="Close popup">&times;</button>

        <!-- Main Popup Content -->
        <div class="cm-main-content">
            <h3 class="cm-title" id="cmTitle">Here is your code</h3>
            
            <div class="cm-code-section">
                <div class="cm-code-display" id="cmCode">CODE123</div>
                <button class="cm-copy-btn" id="cmCopy">Copy Code</button>
            </div>
            
            <div class="cm-note" id="cmNote">
                <p>Copy the code above and use it at checkout to get your discount!</p>
            </div>
        </div>
    </div>

    <!-- Email Subscription Popup -->
    <div class="cm-email-popup" role="dialog" aria-modal="true" aria-label="Email Subscription Popup">
        <div class="cm-email-content">
            <div class="cm-brand-logo">
                <div class="cm-brand-circle" id="cmBrandLogo">
                    <span id="cmBrandText">STORE</span>
                </div>
            </div>
            
            <h3 class="cm-email-title" id="cmEmailTitle">Get More Deals!</h3>
            <p class="cm-email-subtitle">Subscribe to get exclusive offers and discounts</p>
            
            <form class="cm-email-form" id="cmEmailForm">
                <input type="email" placeholder="Enter your email" required>
                <button type="submit">Subscribe</button>
            </form>
            
            <p class="cm-email-privacy">We respect your privacy. Unsubscribe at any time.</p>
        </div>
    </div>
</div>

<style>
/* Coupon Modal Styles */
#couponModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    padding: 20px;
    box-sizing: border-box;
}

.cm-overlay {
    position: absolute;
    inset: 0; 
    background: rgba(0,0,0,0.6); 
}

/* Main Voucher Code Popup */
.cm-main-popup { 
  position: relative;
  top: 20px;
  margin: auto;
    width: 480px; 
    max-width: calc(50% - 30px); 
    background: #fff; 
    border-radius: 16px; 
    padding: 30px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    overflow: hidden;
    z-index: 2;
}

/* Email Subscription Popup */
.cm-email-popup { 
  position: relative;
  margin: auto;
  top: 40px;
    width: 480px; 
    max-width: calc(50% - 30px); 
    background: #fff; 
    border-radius: 16px; 
    padding: 30px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    overflow: hidden;
    z-index: 2;
}

.cm-close {
    position: absolute;
    top: 15px;
    right: 20px;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #666;
    z-index: 3;
}

.cm-close:hover {
    color: #000;
}

.cm-main-content {
    text-align: center;
}

.cm-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
}

.cm-code-section {
    margin: 20px 0;
}

.cm-code-display {
    background: var(--background-secondary-color, #f8f9fa);
    border: 2px dashed var(--primary-color, #FF0000);
    border-radius: 8px;
    padding: 15px;
    font-size: 18px;
    font-weight: bold;
    color: var(--primary-color, #FF0000);
    margin-bottom: 15px;
    font-family: monospace;
}

.cm-copy-btn {
    background: var(--primary-color, #FF0000);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.cm-copy-btn:hover {
    background: var(--secondary-color, #cc0000);
}

.cm-note {
    margin-top: 20px;
    color: var(--text-color, #666);
    font-size: 14px;
}

.cm-email-content {
    text-align: center;
}

.cm-brand-logo {
    margin-bottom: 20px;
}

.cm-brand-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--primary-color, #FF0000);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: white;
    font-weight: bold;
    font-size: 14px;
}

.cm-brand-circle img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
}

.cm-email-title {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 10px;
    color: var(--text-color, #333);
}

.cm-email-subtitle {
    color: var(--text-color, #666);
    margin-bottom: 20px;
    font-size: 14px;
}

.cm-email-form {
    margin: 20px 0;
}

.cm-email-form input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    margin-bottom: 10px;
    font-size: 14px;
}

.cm-email-form button {
    width: 100%;
    background: var(--primary-color, #FF0000);
    color: white;
    border: none;
    padding: 12px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.cm-email-form button:hover {
    background: var(--secondary-color, #cc0000);
}

.cm-email-privacy {
    font-size: 12px;
    color: var(--text-color, #999);
    margin-top: 15px;
}

/* Responsive */
@media (max-width: 768px) {
    .cm-main-popup {
        top: 20px;
        left: 10px;
        right: 10px;
        width: auto;
        max-width: none;
    }
    
    .cm-email-popup {
        top: 400px;
        left: 10px;
        right: 10px;
        width: auto;
        max-width: none;
    }
    
    .cm-main-content {
        padding: 20px;
    }
    
    .cm-title {
        font-size: 20px;
    }
    
    .cm-code-display {
        font-size: 16px;
        padding: 12px;
    }
}
</style>

<script>
// Recommended Stores Tab Functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabLinks = document.querySelectorAll('.tb a');
    const storeContents = document.querySelectorAll('.store-category-content');
    
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs
            tabLinks.forEach(tab => tab.classList.remove('active'));
            storeContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
            
            // Show corresponding content
            const categoryId = this.getAttribute('data-type');
            const targetContent = document.querySelector(`.store-category-content[data-category="${categoryId}"]`);
            if (targetContent) {
                targetContent.classList.add('active');
            }
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Prevent double-init
  if (window.__couponModalInit) return;
  window.__couponModalInit = true;

  const modal = document.getElementById('couponModal');
  if (!modal) return;

  const overlay = modal.querySelector('.cm-overlay');
  const closeBtn = modal.querySelector('.cm-close');
  const cmCode = document.getElementById('cmCode');
  const cmCopy = document.getElementById('cmCopy');
  const cmTitle = document.getElementById('cmTitle');
  const cmNote = document.getElementById('cmNote');
  const cmEmailTitle = document.getElementById('cmEmailTitle');
  const cmBrandLogo = document.getElementById('cmBrandLogo');
  const cmBrandText = document.getElementById('cmBrandText');

  function openModal(code, affiliate, store, title) {
    if (cmCode) cmCode.textContent = code;
    if (cmTitle) cmTitle.textContent = title || 'Here is your code';
    if (cmEmailTitle) cmEmailTitle.textContent = `Get More ${store} Deals!`;
    
    if (cmBrandLogo && cmBrandText) {
      if (store && store !== 'Store') {
        cmBrandText.textContent = store.substring(0,5).toUpperCase();
      } else {
        cmBrandText.textContent = 'STORE';
      }
    }

    modal.style.display = 'block';
    modal.setAttribute('aria-hidden','false');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.style.display = 'none';
    modal.setAttribute('aria-hidden','true');
    document.body.style.overflow = '';
  }

  // Reveal code buttons
  document.querySelectorAll('.deal-btn.reveal-code').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const code = this.dataset.code;
      const affiliate = this.dataset.affiliate;
      const store = this.dataset.store;
      const title = this.dataset.title;
      if (code && affiliate) {
        const currentUrl = window.location.href.split('#')[0].split('?')[0];
        const popupUrl = currentUrl + '?show_coupon=1&code=' + encodeURIComponent(code) + '&affiliate=' + encodeURIComponent(affiliate) + '&store=' + encodeURIComponent(store) + '&title=' + encodeURIComponent(title);
        window.open(popupUrl, '_blank');
        window.location.href = affiliate;
      }
    });
  });

  // Get deal buttons
  document.querySelectorAll('.deal-btn.get-deal').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const affiliate = this.dataset.affiliate;
      const store = this.dataset.store;
      const title = this.dataset.title;
      if (affiliate) {
        const currentUrl = window.location.href.split('#')[0].split('?')[0];
        const popupUrl = currentUrl + '?show_coupon=1&code=No%20code%20required&affiliate=' + encodeURIComponent(affiliate) + '&store=' + encodeURIComponent(store) + '&title=' + encodeURIComponent(title);
        window.open(popupUrl, '_blank');
        window.location.href = affiliate;
      }
    });
  });

  // Copy button
  if (cmCopy) {
    cmCopy.addEventListener('click', function() {
      const code = cmCode ? cmCode.textContent : '';
      if (code && code !== 'No code required') {
        navigator.clipboard.writeText(code).then(function() {
          const originalText = cmCopy.textContent;
          cmCopy.textContent = 'Copied!';
          cmCopy.style.backgroundColor = '#218838';
          
          setTimeout(function() {
            cmCopy.textContent = originalText;
            cmCopy.style.backgroundColor = '#FF0000';
          }, 2000);
        }).catch(function(err) {
          console.error('Could not copy text: ', err);
          alert('Coupon Code: ' + code);
        });
      } else if (code === 'No code required') {
        // For deals without codes, just show message
        const originalText = cmCopy.textContent;
        cmCopy.textContent = 'No Code Needed!';
        cmCopy.style.backgroundColor = '#218838';
        
        setTimeout(function() {
          cmCopy.textContent = originalText;
          cmCopy.style.backgroundColor = '#FF0000';
        }, 2000);
      }
    });
  }

  // Email form
  const emailForm = document.getElementById('cmEmailForm');
  if (emailForm) {
    emailForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const email = this.querySelector('input[type="email"]').value;
      if (email) {
        // Here you can add AJAX call to subscribe
        alert('Thank you for subscribing!');
        closeModal();
      }
    });
  }

  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  if (overlay) overlay.addEventListener('click', closeModal);

  // show modal if params present
  try {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('show_coupon') === '1') {
      const code = urlParams.get('code') || '';
      const affiliate = urlParams.get('affiliate') || '#';
      const store = urlParams.get('store') || 'Store';
      const title = urlParams.get('title') || 'Here is your code';
      
      openModal(code, affiliate, store, title);
      
      // If no code, show "No code required" message
      if (!code || code === 'No code required') {
        if (cmCode) cmCode.textContent = 'No code required';
        if (cmCopy) {
          cmCopy.disabled = true;
          cmCopy.style.opacity = '0.6';
          cmCopy.style.cursor = 'not-allowed';
        }
      }
      
      history.replaceState({}, '', window.location.pathname);
    }
  } catch (e) {
    console.log('URL params not supported');
  }
});

// Brands Carousel Functionality - Woodmart Style
document.addEventListener('DOMContentLoaded', function() {
const brandsSlider = document.getElementById('brandsSlider');
const brandItems = document.querySelectorAll('.brand-item');
    
    if (!brandsSlider || brandItems.length === 0) {
        console.log('No brands slider or items found');
        return;
    }
    
    console.log('Found', brandItems.length, 'brand items');
    
    // Woodmart-style carousel calculations
    const itemWidth = 224; // 200px width + 24px gap
    const containerWidth = brandsSlider.parentElement.offsetWidth - 64; // Subtract padding
    const visibleItems = Math.floor(containerWidth / itemWidth);
    const totalSlides = Math.ceil(brandItems.length / visibleItems);
    let currentSlide = 0;
    let isTransitioning = false;
    
    console.log('Container width:', containerWidth, 'Visible items:', visibleItems, 'Total slides:', totalSlides);

function moveCarousel(direction) {
        if (isTransitioning || totalSlides <= 1) return;
        
        isTransitioning = true;
        currentSlide += direction;
        
        // Handle boundaries
        if (currentSlide >= totalSlides) {
            currentSlide = 0;
        } else if (currentSlide < 0) {
            currentSlide = totalSlides - 1;
        }
        
        // Calculate proper transform - move by visible items only
        const translateX = -(currentSlide * visibleItems * itemWidth);
        console.log('Moving to slide:', currentSlide, 'TranslateX:', translateX);
        
        // Smooth transition with Woodmart-style easing
        brandsSlider.style.transition = 'transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        brandsSlider.style.transform = `translateX(${translateX}px)`;
        
        setTimeout(() => {
            isTransitioning = false;
        }, 800);
    }
    
    // Auto-play carousel
    let autoPlayInterval = setInterval(() => {
        if (totalSlides > 1) {
            moveCarousel(1);
        }
    }, 4000);
    
    // Pause auto-play on hover
    brandsSlider.addEventListener('mouseenter', () => {
        clearInterval(autoPlayInterval);
    });
    
    brandsSlider.addEventListener('mouseleave', () => {
        autoPlayInterval = setInterval(() => {
    if (totalSlides > 1) {
        moveCarousel(1);
    }
}, 4000);
    });
    
    // Touch/swipe support
    let startX = 0;
    let endX = 0;
    
    brandsSlider.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });
    
    brandsSlider.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        const diff = startX - endX;
        
        if (Math.abs(diff) > 50) { // Minimum swipe distance
            if (diff > 0) {
                moveCarousel(1); // Swipe left - next
            } else {
                moveCarousel(-1); // Swipe right - previous
            }
        }
    });
    
    // Make functions global for onclick handlers
    window.moveCarousel = moveCarousel;
    
    // Generate pagination dots
function generateDots() {
    const dotsContainer = document.getElementById('carouselDots');
        if (!dotsContainer || totalSlides <= 1) return;
        
    dotsContainer.innerHTML = '';
    
    for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('span');
        dot.className = 'dot';
        if (i === 0) dot.classList.add('active');
            dot.onclick = () => {
                currentSlide = i;
                const translateX = -(currentSlide * visibleItems * itemWidth);
                brandsSlider.style.transition = 'transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                brandsSlider.style.transform = `translateX(${translateX}px)`;
                updateDots();
            };
        dotsContainer.appendChild(dot);
    }
}
    
    function updateDots() {
        const dots = document.querySelectorAll('.dot');
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
}

// Initialize carousel
    if (totalSlides > 1) {
    generateDots();
    updateDots();
    } else {
        // Hide navigation buttons if not enough items
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        if (prevBtn) prevBtn.style.display = 'none';
        if (nextBtn) nextBtn.style.display = 'none';
    }
    
    // Ensure initial position is correct
    brandsSlider.style.transform = 'translateX(0px)';
    
    // Add resize listener to recalculate on window resize
    window.addEventListener('resize', () => {
        const newContainerWidth = brandsSlider.parentElement.offsetWidth - 64;
        const newVisibleItems = Math.floor(newContainerWidth / itemWidth);
        const newTotalSlides = Math.ceil(brandItems.length / newVisibleItems);
        
        if (newTotalSlides !== totalSlides) {
            console.log('Recalculating carousel on resize');
            // Reset to first slide
            currentSlide = 0;
            brandsSlider.style.transform = 'translateX(0px)';
            generateDots();
            updateDots();
        }
    });
    
      console.log('Carousel initialized successfully');
  });
</script>

<!-- Search Modal Functionality -->
<script>
$(document).ready(function() {
    // jQuery-based search implementation
    const $searchBox = $('#searchBox');
    const $searchInput = $('#searchInput');
    const $searchBtn = $('#searchBtn');
    const $searchModal = $('#searchModal');
    const $modalSearchInput = $('#modalSearchInput');
    const $closeSearchModal = $('#closeSearchModal');
    const $trendingOffers = $('#trendingOffers');
    const $brandsList = $('#brandsList');
    
    let searchTimeout;

    if (!$searchBox.length || !$searchModal.length || !$modalSearchInput.length) {
        console.log('Search modal elements not found');
        return;
    }

    // Open modal
    function openSearchModal() {
        console.log('Opening search modal...');
        $searchModal.show();
        $('body').css('overflow', 'hidden');
        $modalSearchInput.focus();
        loadDefaultData();
    }

    // Close modal
    function closeModal() {
        $searchModal.hide();
        $('body').css('overflow', '');
        $searchInput.val('');
        $modalSearchInput.val('');
    }

    // Show loading state
    function showLoading() {
        $trendingOffers.html('<div class="loading-state"><span class="loading-spinner"></span>Loading offers...</div>');
        $brandsList.html('<div class="loading-state"><span class="loading-spinner"></span>Loading brands...</div>');
    }

    // Load default data using jQuery AJAX
    function loadDefaultData() {
        console.log('Loading default data...');
        showLoading();
        
        $.ajax({
            url: '/getHeaderSearchDefault',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log('Default data loaded successfully:', data);
                console.log('Coupons count:', data.coupons ? data.coupons.length : 0);
                console.log('Stores count:', data.stores ? data.stores.length : 0);
                renderDefaultData(data);
            },
            error: function(xhr, status, error) {
                console.error('Error loading default data:', error);
                console.error('Response:', xhr.responseText);
                renderDefaultData({ coupons: [], stores: [], categories: [] });
            }
        });
    }

    // Render default data
    function renderDefaultData(data) {
        console.log('Rendering default data:', data);
        
        // Render trending offers
        let offersHtml = '';
        if (data.coupons && data.coupons.length > 0) {
            $.each(data.coupons.slice(0, 5), function(index, coupon) {
                const storeName = coupon.store ? coupon.store.store_name : coupon.brand_store || 'Store';
                const storeLogo = coupon.store ? coupon.store.store_logo : null;
                
                offersHtml += '<a href="/search?q=' + encodeURIComponent(coupon.coupon_title) + '" class="offer-item">';
                if (storeLogo) {
                    offersHtml += '<img src="/storage/' + storeLogo + '" alt="' + storeName + '" class="offer-logo">';
                } else {
                    offersHtml += '<div class="offer-logo-placeholder">' + storeName.substring(0, 2).toUpperCase() + '</div>';
                }
                offersHtml += '<div class="offer-content">';
                offersHtml += '<div class="offer-brand">' + storeName + '</div>';
                offersHtml += '<div class="offer-description">' + coupon.coupon_title + '</div>';
                offersHtml += '<button class="offer-button">' + (coupon.coupon_code ? 'Code' : 'Deal') + '</button>';
                offersHtml += '</div></a>';
            });
        } else {
            offersHtml = '<div class="loading-state">No trending offers available</div>';
        }
        $trendingOffers.html(offersHtml);

        // Render brands
        let brandsHtml = '';
        if (data.stores && data.stores.length > 0) {
            $.each(data.stores.slice(0, 5), function(index, store) {
                brandsHtml += '<a href="/store/' + store.seo_url + '" class="brand-item">';
                brandsHtml += '<span class="brand-name">' + store.store_name + '</span>';
                brandsHtml += '<span class="brand-offers">View ' + (Math.floor(Math.random() * 10) + 5) + ' offers</span>';
                brandsHtml += '</a>';
            });
        } else {
            brandsHtml = '<div class="loading-state">No brands available</div>';
        }
        $brandsList.html(brandsHtml);
    }

    // Perform search using jQuery AJAX
    function performSearch(query) {
        console.log('Performing search for:', query);
        
        if (query.length < 2) {
            loadDefaultData();
            return;
        }

        showLoading();

        $.ajax({
            url: '/ajax-search',
            type: 'GET',
            data: { q: query },
            dataType: 'json',
            success: function(data) {
                console.log('Search results:', data);
                console.log('Stores count:', data.stores ? data.stores.length : 0);
                console.log('Coupons count:', data.coupons ? data.coupons.length : 0);
                renderSearchResults(data);
            },
            error: function(xhr, status, error) {
                console.error('Search error:', error);
                console.error('Response:', xhr.responseText);
                renderSearchResults({ stores: [], coupons: [], categories: [] });
            }
        });
    }

    // Render search results
    function renderSearchResults(data) {
        const query = data.query || $modalSearchInput.val() || '';
        console.log('Rendering search results for query:', query);
        console.log('Data received:', data);
        
        // Render offers from search results
        let offersHtml = '';
        if (data.coupons && data.coupons.length > 0) {
            console.log('Found coupons:', data.coupons.length);
            $.each(data.coupons.slice(0, 5), function(index, coupon) {
                const storeName = coupon.store ? coupon.store.store_name : coupon.brand_store || 'Store';
                const storeLogo = coupon.store ? coupon.store.store_logo : null;
                
                offersHtml += '<a href="/search?q=' + encodeURIComponent(query) + '" class="offer-item">';
                if (storeLogo) {
                    offersHtml += '<img src="/storage/' + storeLogo + '" alt="' + storeName + '" class="offer-logo">';
                } else {
                    offersHtml += '<div class="offer-logo-placeholder">' + storeName.substring(0, 2).toUpperCase() + '</div>';
                }
                offersHtml += '<div class="offer-content">';
                offersHtml += '<div class="offer-brand">' + storeName + '</div>';
                offersHtml += '<div class="offer-description">' + coupon.coupon_title + '</div>';
                offersHtml += '<button class="offer-button">' + (coupon.coupon_code ? 'Code' : 'Deal') + '</button>';
                offersHtml += '</div></a>';
            });
        } else {
            offersHtml = '<div class="loading-state">No offers found for "' + query + '"</div>';
        }
        $trendingOffers.html(offersHtml);

        // Render brands from search results
        let brandsHtml = '';
        if (data.stores && data.stores.length > 0) {
            console.log('Found stores:', data.stores.length);
            $.each(data.stores.slice(0, 5), function(index, store) {
                brandsHtml += '<a href="/store/' + store.seo_url + '" class="brand-item">';
                brandsHtml += '<span class="brand-name">' + store.store_name + '</span>';
                brandsHtml += '<span class="brand-offers">View ' + (Math.floor(Math.random() * 10) + 5) + ' offers</span>';
                brandsHtml += '</a>';
            });
        } else {
            brandsHtml = '<div class="loading-state">No brands found for "' + query + '"</div>';
        }
        $brandsList.html(brandsHtml);
    }

    // Event listeners using jQuery
    $searchBox.on('click', openSearchModal);
    $searchBtn.on('click', openSearchModal);
    $closeSearchModal.on('click', closeModal);
    
    // Test button
    $('#testBtn').on('click', function() {
        console.log('Test button clicked');
        performSearch('cath');
    });
    
    // Close modal when clicking overlay
    $searchModal.on('click', function(e) {
        if (e.target === this || $(e.target).hasClass('search-modal-overlay')) {
            closeModal();
        }
    });

    // Handle modal search input with debouncing
    $modalSearchInput.on('input', function() {
        const query = $(this).val().trim();
        
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            loadDefaultData();
            return;
        }

        searchTimeout = setTimeout(function() {
            performSearch(query);
        }, 300);
    });

    // Handle escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && $searchModal.is(':visible')) {
            closeModal();
        }
    });

    // Handle hero search input (redirect to search page)
    $searchInput.on('keydown', function(e) {
        if (e.key === 'Enter') {
            const query = $(this).val().trim();
            if (query.length >= 2) {
                window.location.href = '/search?q=' + encodeURIComponent(query);
            }
        }
    });

    // Test function - can be called from console
    window.testSearch = function(query) {
        console.log('Testing search with:', query);
        performSearch(query);
    };

    console.log('jQuery search modal initialized successfully');
    
    // Debug: Test if jQuery is loaded
    console.log('jQuery version:', $.fn.jquery);
    console.log('Search elements found:', {
        searchBox: $searchBox.length,
        searchModal: $searchModal.length,
        modalSearchInput: $modalSearchInput.length,
        trendingOffers: $trendingOffers.length,
        brandsList: $brandsList.length
    });
    
    // Debug: Test AJAX call immediately
    setTimeout(function() {
        console.log('Testing AJAX call...');
        $.ajax({
            url: '{{ url("/ajax-search") }}',
            type: 'GET',
            data: { q: 'cath' },
            dataType: 'json',
            success: function(data) {
                console.log('AJAX test successful:', data);
            },
            error: function(xhr, status, error) {
                console.error('AJAX test failed:', error, xhr.responseText);
            }
        });
    }, 1000);
});
</script>

<!-- Simple jQuery Search Implementation -->
<style>
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<script>
$(document).ready(function() {
    console.log('Simple jQuery search loaded');
    console.log('jQuery version:', $.fn.jquery);
    
    // Debug: Check if elements exist
    console.log('Search box found:', $('#searchBox').length);
    console.log('Search modal found:', $('#searchModal').length);
    console.log('Modal input found:', $('#modalSearchInput').length);
    console.log('Trending offers found:', $('#trendingOffers').length);
    console.log('Brands list found:', $('#brandsList').length);
    
    // Simple search functionality
    $('#searchBox').click(function() {
        console.log('Search box clicked');
        $('#searchModal').show();
        $('body').css('overflow', 'hidden');
        $('#modalSearchInput').focus();
        loadDefaultData();
    });
    
    $('#searchBtn').click(function() {
        console.log('Search button clicked');
        $('#searchModal').show();
        $('body').css('overflow', 'hidden');
        $('#modalSearchInput').focus();
        loadDefaultData();
    });
    
    $('#closeSearchModal').click(function() {
        $('#searchModal').hide();
        $('body').css('overflow', 'auto');
        $('#modalSearchInput').val('');
    });
    
    // Close modal when clicking overlay
    $('#searchModal').click(function(e) {
        if (e.target === this) {
            $(this).hide();
            $('body').css('overflow', 'auto');
        }
    });
    
    // Load default data
    function loadDefaultData() {
        console.log('Loading default data...');
        $('#trendingOffers').html('<div style="text-align: center; padding: 30px; color: #7f8c8d; font-size: 16px;"><div style="display: inline-block; width: 20px; height: 20px; border: 2px solid #3498db; border-radius: 50%; border-top-color: transparent; animation: spin 1s linear infinite; margin-right: 10px;"></div>Loading...</div>');
        $('#brandsList').html('<div style="text-align: center; padding: 30px; color: #7f8c8d; font-size: 16px;"><div style="display: inline-block; width: 20px; height: 20px; border: 2px solid #3498db; border-radius: 50%; border-top-color: transparent; animation: spin 1s linear infinite; margin-right: 10px;"></div>Loading...</div>');
        
        $.ajax({
            url: '{{ url("/getHeaderSearchDefault") }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log('Default data loaded:', data);
                renderDefaultData(data);
            },
            error: function(xhr, status, error) {
                console.error('Error loading default data:', error);
                $('#trendingOffers').html('<div style="text-align: center; padding: 20px;">No trending offers available</div>');
                $('#brandsList').html('<div style="text-align: center; padding: 20px;">No brands available</div>');
            }
        });
    }
    
    // Render default data
    function renderDefaultData(data) {
        var offersHtml = '';
        var brandsHtml = '';
        
        // Render offers
        if (data.coupons && data.coupons.length > 0) {
            $.each(data.coupons.slice(0, 5), function(index, coupon) {
                var storeName = coupon.store ? coupon.store.store_name : coupon.brand_store || 'Store';
                var storeUrl = coupon.store ? '{{ url("/store") }}/' + coupon.store.seo_url : '{{ url("/search") }}?q=' + encodeURIComponent(storeName);
                offersHtml += '<div style="padding: 15px; border: 1px solid #e0e0e0; margin: 8px 0; border-radius: 8px; cursor: pointer; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform=\'translateY(-2px)\'; this.style.boxShadow=\'0 4px 8px rgba(0,0,0,0.15)\'" onmouseout="this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 2px 4px rgba(0,0,0,0.1)\'" onclick="window.location.href=\'' + storeUrl + '\'">';
                offersHtml += '<div style="font-weight: 600; color: #2c3e50; font-size: 16px; margin-bottom: 5px;">' + storeName + '</div>';
                offersHtml += '<div style="color: #7f8c8d; font-size: 14px;">' + coupon.coupon_title + '</div>';
                offersHtml += '</div>';
            });
        } else {
            offersHtml = '<div style="text-align: center; padding: 30px; color: #95a5a6; font-size: 16px;"><div style="font-size: 48px; margin-bottom: 15px;">📋</div>No trending offers available</div>';
        }
        
        // Render brands
        if (data.stores && data.stores.length > 0) {
            $.each(data.stores.slice(0, 5), function(index, store) {
                brandsHtml += '<div style="padding: 15px; border: 1px solid #e0e0e0; margin: 8px 0; border-radius: 8px; cursor: pointer; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform=\'translateY(-2px)\'; this.style.boxShadow=\'0 4px 8px rgba(0,0,0,0.15)\'" onmouseout="this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 2px 4px rgba(0,0,0,0.1)\'" onclick="window.location.href=\'{{ url("/store") }}/' + store.seo_url + '\'">';
                brandsHtml += '<div style="font-weight: 600; color: #2c3e50; font-size: 16px; margin-bottom: 5px;">' + store.store_name + '</div>';
                brandsHtml += '<div style="color: #7f8c8d; font-size: 14px;">View offers</div>';
                brandsHtml += '</div>';
            });
        } else {
            brandsHtml = '<div style="text-align: center; padding: 30px; color: #95a5a6; font-size: 16px;"><div style="font-size: 48px; margin-bottom: 15px;">🏪</div>No brands available</div>';
        }
        
        $('#trendingOffers').html(offersHtml);
        $('#brandsList').html(brandsHtml);
    }
    
    // Search input handler
    var searchTimeout;
    $('#modalSearchInput').on('input', function() {
        var query = $(this).val().trim();
        
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            loadDefaultData();
            return;
        }
        
        searchTimeout = setTimeout(function() {
            performSearch(query);
        }, 300);
    });
    
    // Perform search
    function performSearch(query) {
        console.log('Searching for:', query);
        
        $('#trendingOffers').html('<div style="text-align: center; padding: 30px; color: #7f8c8d; font-size: 16px;"><div style="display: inline-block; width: 20px; height: 20px; border: 2px solid #e74c3c; border-radius: 50%; border-top-color: transparent; animation: spin 1s linear infinite; margin-right: 10px;"></div>Searching...</div>');
        $('#brandsList').html('<div style="text-align: center; padding: 30px; color: #7f8c8d; font-size: 16px;"><div style="display: inline-block; width: 20px; height: 20px; border: 2px solid #e74c3c; border-radius: 50%; border-top-color: transparent; animation: spin 1s linear infinite; margin-right: 10px;"></div>Searching...</div>');
        
        $.ajax({
            url: '{{ url("/ajax-search") }}',
            type: 'GET',
            data: { q: query },
            dataType: 'json',
            success: function(data) {
                console.log('Search results:', data);
                renderSearchResults(data, query);
            },
            error: function(xhr, status, error) {
                console.error('Search error:', error);
                $('#trendingOffers').html('<div style="text-align: center; padding: 20px;">Search failed</div>');
                $('#brandsList').html('<div style="text-align: center; padding: 20px;">Search failed</div>');
            }
        });
    }
    
    // Render search results
    function renderSearchResults(data, query) {
        var offersHtml = '';
        var brandsHtml = '';
        
        // Render offers from search results
        if (data.coupons && data.coupons.length > 0) {
            $.each(data.coupons.slice(0, 5), function(index, coupon) {
                var storeName = coupon.store ? coupon.store.store_name : coupon.brand_store || 'Store';
                var storeUrl = coupon.store ? '{{ url("/store") }}/' + coupon.store.seo_url : '{{ url("/search") }}?q=' + encodeURIComponent(storeName);
                offersHtml += '<div style="padding: 15px; border: 1px solid #e0e0e0; margin: 8px 0; border-radius: 8px; cursor: pointer; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform=\'translateY(-2px)\'; this.style.boxShadow=\'0 4px 8px rgba(0,0,0,0.15)\'" onmouseout="this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 2px 4px rgba(0,0,0,0.1)\'" onclick="window.location.href=\'' + storeUrl + '\'">';
                offersHtml += '<div style="font-weight: 600; color: #2c3e50; font-size: 16px; margin-bottom: 5px;">' + storeName + '</div>';
                offersHtml += '<div style="color: #7f8c8d; font-size: 14px;">' + coupon.coupon_title + '</div>';
                offersHtml += '</div>';
            });
        } else {
            offersHtml = '<div style="text-align: center; padding: 30px; color: #95a5a6; font-size: 16px;"><div style="font-size: 48px; margin-bottom: 15px;">🔍</div>No offers found for "' + query + '"</div>';
        }
        
        // Render brands from search results
        if (data.stores && data.stores.length > 0) {
            $.each(data.stores.slice(0, 5), function(index, store) {
                brandsHtml += '<div style="padding: 15px; border: 1px solid #e0e0e0; margin: 8px 0; border-radius: 8px; cursor: pointer; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform=\'translateY(-2px)\'; this.style.boxShadow=\'0 4px 8px rgba(0,0,0,0.15)\'" onmouseout="this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 2px 4px rgba(0,0,0,0.1)\'" onclick="window.location.href=\'{{ url("/store") }}/' + store.seo_url + '\'">';
                brandsHtml += '<div style="font-weight: 600; color: #2c3e50; font-size: 16px; margin-bottom: 5px;">' + store.store_name + '</div>';
                brandsHtml += '<div style="color: #7f8c8d; font-size: 14px;">View offers</div>';
                brandsHtml += '</div>';
            });
        } else {
            brandsHtml = '<div style="text-align: center; padding: 30px; color: #95a5a6; font-size: 16px;"><div style="font-size: 48px; margin-bottom: 15px;">🏪</div>No brands found for "' + query + '"</div>';
        }
        
        $('#trendingOffers').html(offersHtml);
        $('#brandsList').html(brandsHtml);
    }
    
    // Test function
    window.testSearch = function(query) {
        console.log('Testing search with:', query);
        performSearch(query);
    };
    
    // Test button 2
    $('#testBtn2').click(function() {
        console.log('Test Cath button clicked');
        performSearch('cath');
    });
    
        console.log('Simple search modal initialized successfully');
    });

    // Newsletter subscription
    $('#newsletterForm').on('submit', function(e) {
        e.preventDefault();
        
        var email = $('#newsletterEmail').val();
        var btn = $('#newsletterBtn');
        var messageDiv = $('#newsletterMessage');
        
        if (!email) {
            showMessage('Please enter your email address.', 'error');
            return;
        }
        
        // Disable button and show loading
        btn.prop('disabled', true).text('Subscribing...');
        
        $.ajax({
            url: '{{ route("newsletter.subscribe") }}',
            type: 'POST',
            data: {
                email: email,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    showMessage(response.message, 'success');
                    $('#newsletterEmail').val('');
                } else {
                    showMessage(response.message, 'error');
                }
            },
            error: function(xhr) {
                var message = 'Something went wrong. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                showMessage(message, 'error');
            },
            complete: function() {
                btn.prop('disabled', false).text('Subscribe');
            }
        });
    });
    
    function showMessage(message, type) {
        var messageDiv = $('#newsletterMessage');
        var color = type === 'success' ? '#27ae60' : '#e74c3c';
        messageDiv.html('<div style="color: ' + color + '; font-weight: bold;">' + message + '</div>').show();
        
        setTimeout(function() {
            messageDiv.fadeOut();
        }, 5000);
    }
    </script>

@endsection

