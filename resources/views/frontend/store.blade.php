@extends('frontend.layouts.app')

@section('title', $store->meta_title ?? $store->store_name . ' Discount Codes & Voucher Codes')
@section('description', $store->meta_description ?? 'Get the latest ' . $store->store_name . ' discount codes, voucher codes, and promo codes. Save money on your purchases with verified offers.')

@push('styles')
<link rel="preload" href="{{ asset('frontend_assets/css/fonts.css') }}" as="style" crossorigin>
<link rel="preload" href="{{ asset('frontend_assets/css/store.css') }}" as="style" crossorigin>
<link rel="stylesheet" href="{{ asset('frontend_assets/css/fonts.css') }}" crossorigin>
<link rel="stylesheet" href="{{ asset('frontend_assets/css/store.css') }}" as="style" crossorigin>
<link rel="preload" href="{{ asset('frontend_assets/js/store.js') }}" as="script" crossorigin>
@endpush

@push('scripts')
<script src="{{ asset('frontend_assets/js/store.js') }}" async crossorigin></script>
@endpush

@section('content')



<!-- Page Content <start> -->
<input type="radio" name="cpnflt" id="cpnall" checked>
<input type="radio" name="cpnflt" id="cpncd">
<input type="radio" name="cpnflt" id="cpnfs">
<input type="radio" name="cpnflt" id="cpndl">

<div class="pgHd">
  <div class="Wrp">
    <!-- Breadcrumb <start> -->
    <ul class="brdcrb" itemscope itemtype="http://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a href="{{ url('/') }}" class="link" itemprop="item">
          <span itemprop="name">Home</span>
          <meta itemprop="position" content="1">
        </a>
      </li>
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a href="{{ route('all-brands-uk') }}" class="link" itemprop="item">
          <span itemprop="name">All Brands</span>
          <meta itemprop="position" content="2">
        </a>
      </li>
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a href="{{ route('store', $store->seo_url) }}" class="link active" itemprop="item">
          <span itemprop="name">{{ $store->store_name }}</span>
          <meta itemprop="position" content="3">
        </a>
      </li>
    </ul>
    <!-- Breadcrumb <end> -->

    <!-- Store Head <start> -->
    <div class="strHd">
      <div class="lgo">
        @if($store->store_logo)
            <img src="{{ asset('storage/' . $store->store_logo) }}" alt="{{ $store->store_name }} discount code" title="{{ $store->store_name }} discount code">
        @else
            <div class="store-logo-placeholder">{{ substr($store->store_name, 0, 2) }}</div>
        @endif
        <button class="sfvbtn bp_hrt" role="button" aria-label="Save store" data-id="{{ $store->id }}"></button>
      </div>
      <div class="cntr">
        <!-- store title -->
        <h1>{{ $store->store_name }} Discount Code {{ date('F Y') }}</h1>
        <!-- store title <end> -->

        <!-- store description -->
        <p class="d-tab-none">Save money with these {{ $storeCoupons->count() }} {{ $store->store_name }} voucher codes & deals</p>
        <!-- store description <end> -->

        <!-- rating -->
        <div class="rating">
            <input type="radio" id="star1" name="rating" value="1">
            <label class="bp_str rated" for="star1" onclick="storeRating(1, {{ $store->id }}, '{{ request()->ip() }}')"></label>
            <input type="radio" id="star2" name="rating" value="2">
            <label class="bp_str rated" for="star2" onclick="storeRating(2, {{ $store->id }}, '{{ request()->ip() }}')"></label>
            <input type="radio" id="star3" name="rating" value="3">
            <label class="bp_str rated" for="star3" onclick="storeRating(3, {{ $store->id }}, '{{ request()->ip() }}')"></label>
            <input type="radio" id="star4" name="rating" value="4">
            <label class="bp_str rated" for="star4" onclick="storeRating(4, {{ $store->id }}, '{{ request()->ip() }}')"></label>
            <input type="radio" id="star5" name="rating" value="5">
            <label class="bp_str" for="star5" onclick="storeRating(5, {{ $store->id }}, '{{ request()->ip() }}')"></label>
            <p class="ratingCalculator">Rated 4 from 21 votes</p>
        </div>
        <!-- rating <end> -->
      </div>
      <div class="btns">
        <span class="vsts"><i class="bp_views"></i> {{ number_format(rand(1000, 100000)) }}</span>
        <a href="{{ $store->affiliate_url ?? url('/') }}" class="affiliate btn" data-aff-id="{{ $store->id }}" aria-label="Visit Site" target="_blank" rel="nofollow noopener noreferrer" style="padding:0px 20px;"><i class="bp_visit"></i> Visit Site</a>
      </div>
    </div>
    <!-- Store Head <end> -->
  </div>
</div>

<!-- sidebar wrp -->
<div class="Sec bg">
  <div class="splt Wrp">
    <!-- coupon side -->
    <div class="wgtc">
      <div class="cpns wd">
        @if($storeCoupons->count() > 0)
            @foreach($storeCoupons as $coupon)
            <!-- coupon:code <start> -->
            <div class="cpn {{ $coupon->coupon_code ? 'cd' : 'dl' }} {{ $coupon->free_shipping ? 'fs' : '' }} {{ $coupon->student_offer ? 'std' : '' }}" data-id="{{ $coupon->id }}">
                <button title="Add to Favourite" class="cfb bp_save hideIconS" aria-label="Add to Favourite"></button>
                
                <a class="clgo" href="javascript:;" title="{{ $store->store_name }} Vouchers Code">
                    @if($store->store_logo)
                        <img src="{{ asset('storage/' . $store->store_logo) }}" alt="{{ $store->store_name }} discount code" title="{{ $store->store_name }} discount code" decoding="async" loading="lazy" width="90" height="90">
                    @else
                        <div class="store-logo-placeholder">{{ substr($store->store_name, 0, 2) }}</div>
                    @endif
                </a>

                <div class="ccnt">
                    <div class="ctp">
                        @if($coupon->verified)
                            <span class="cvrf">Verified</span>
                        @endif
                    </div>
                    <h3 role="button" aria-label="{{ $coupon->coupon_code ? 'Reveal Code' : 'Get Deal' }}" title="{{ $coupon->coupon_title }}">
                        {{ $coupon->coupon_title }}
                    </h3>

                    <div class="cbt">
                        @if($coupon->terms)
                            <button class="ctb" title="Terms" aria-label="Details">Details</button>
                        @endif
                        <span class="cusd">{{ number_format($coupon->sort_order ?? rand(500, 5000)) }} Used</span>
                    </div>
                </div>

                @if($coupon->coupon_code)
                    <button class="cpBtn reveal-code" title="Reveal Code" aria-label="Reveal Code" 
                            data-code="{{ $coupon->coupon_code }}" 
                            data-affiliate="{{ $coupon->affiliate_url ?? $store->affiliate_url ?? url('/') }}"
                            data-store="{{ $store->store_name }}"
                            data-title="{{ $coupon->coupon_title }}">
                        Reveal Code
                    </button>
                @else
                    <a href="{{ $coupon->affiliate_url ?? $store->affiliate_url }}" class="cpBtn get-deal" target="_blank" rel="nofollow">Get Deal</a>
                @endif

                @if($coupon->terms)
                <div class="ctc" style="display: none;">
                    <h3>Terms & Conditions</h3>
                    <div class="dyncnt">
                        {!! nl2br(e($coupon->terms)) !!}
                    </div>
                </div>
                @endif
            </div>
            <!-- coupon:code <end> -->
            @endforeach

            <!-- Newsletter Section -->
            <div class="snlsec wide">
                <h2>Stay Updated – Never Miss a {{ $store->store_name }} Voucher Code Again!</h2>
                <p>Be the first one to get notified as soon as we update a new offer or discount.</p>

                <label class="snfld">
                    <input type="text" name="newsletter" value="" placeholder="Enter Your Email Address Here">
                    <button class="nfb" title="Subscribe">Subscribe</button>
                </label>

                <p>By signing up I agree to Big Saving Hub's <a href="{{ route('privacy-policy') }}" target="_blank">Privacy Policy</a> and consent to receive emails about offers.</p>
            </div>
        @else
            <div class="no-coupons">
                <p>No active coupons available for {{ $store->store_name }} at the moment. Check back soon for new offers!</p>
            </div>
        @endif
      </div>



      <!-- store table <start> -->
      <div class="crd tbl">
        <h3 class="hd">Save Big with {{ $store->store_name }} Discount Codes – {{ date('d F Y') }}!</h3>
        <table>
          <tr>
            <th>Offers</th>
            <th>Last Checked</th>
            <th>Code</th>
          </tr>
          @if($storeCoupons->count() > 0)
            @foreach($storeCoupons->take(4) as $coupon)
            <tr>
              <td>{{ $coupon->coupon_title }}</td>
              <td>{{ date('jS M Y') }}</td>
              <td>{{ $coupon->coupon_code ? '*******' : 'Deal' }}</td>
            </tr>
            @endforeach
          @endif
          <tr>
            <td class="tcntr" colspan="3">Updated: {{ date('d/m/Y') }}</td>
          </tr>
        </table>
      </div>
      <!-- store table <end> -->

      <!-- store faq <start> -->
      @if(!empty($store->faqs))
        <div class="crd faqs" id="srtFaq">
          <h3 class="hd">FAQ</h3>
              <div class="faq">
              {!! $store->faqs !!}
          </div>
        </div>
      @endif
      <!-- store faq <end> -->

      <!-- store more content <start> -->
      @if(!empty($store->detail_description))
      <div class="crd" id="abtStr">
        <h3 class="hd">More About {{ $store->store_name }}</h3>
        <div class="cnt 3">
          {!! $store->detail_description !!}
        </div>
      </div>
      @endif
      <!-- store more content <end> -->
    </div>

    <!-- sidebar -->
    <div class="wgts"> 

      <!-- rating -->
      <div class="wgt rating-box">
        <h3>How Did We Do? Rate {{ $store->store_name }} Vouchers Today!</h3>
        <div class="rating mb-3">
          <input type="radio" id="star1" name="rating" value="1">
          <label class="bp_str rated" for="star1" onclick="storeRating(1, {{ $store->id }}, '{{ request()->ip() }}')"></label>
          <input type="radio" id="star2" name="rating" value="2">
          <label class="bp_str rated" for="star2" onclick="storeRating(2, {{ $store->id }}, '{{ request()->ip() }}')"></label>
          <input type="radio" id="star3" name="rating" value="3">
          <label class="bp_str rated" for="star3" onclick="storeRating(3, {{ $store->id }}, '{{ request()->ip() }}')"></label>
          <input type="radio" id="star4" name="rating" value="4">
          <label class="bp_str rated" for="star4" onclick="storeRating(4, {{ $store->id }}, '{{ request()->ip() }}')"></label>
          <input type="radio" id="star5" name="rating" value="5">
          <label class="bp_str" for="star5" onclick="storeRating(5, {{ $store->id }}, '{{ request()->ip() }}')"></label>
        </div>
        <p class="ratingCalculator">Rated 4 from 21 votes</p>
      </div>
      <!-- rating end -->

      <!-- Expert Review -->
      <div class="wgt">
        <div class="pst">
          <div class="hd">
            <!-- <img src="{{ asset('frontend_assets/images/Female-01.png') }}" alt="Anna Lawrence" decoding="async" loading="lazy" width="64" height="64"> -->
            <div>
              <h3>Why we love shopping at {{ $store->store_name }} <i class="bp_hrt"></i></h3>
              <!-- <span>by <a href="{{ url('/') }}">Anna Lawrence</a></span>
              <span>Content Executive - Interior and Pets</span> -->
            </div>
          </div>
          <div class="cnt">
            <p>{{ $store->content }}</p>
          </div>
        </div>
      </div>

      <!-- Today's Discount Code -->
      <div class="wgt today-discount-code">
        <div class="padding-div">
          <h3>Today's Hand Tested Discount Code</h3>
          <p class="last-update">Last updated: <span>{{ date('d-M-Y') }}</span></p>
          <ol>
            <li>Voucher Codes: <span>{{ $storeCoupons->where('coupon_code', '!=', null)->count() }}</span></li>
            <li>Deals: <span>{{ $storeCoupons->where('coupon_code', null)->count() }}</span></li>
          </ol>
        </div>
        <span class="total-offers">Total Offers: <span>{{ $storeCoupons->count() }}</span></span>
      </div>

      <!-- Filter by -->
      <div class="wgt">
        <h3>Filter by</h3>
        <div class="flts">
          <label class="cfltr" for="cpnall">All</label>
          <label class="cfltr" for="cpncd">Voucher Code</label>
          <label class="cfltr" for="cpnfs">Free Delivery</label>
          <label class="cfltr" for="cpndl">Online Sale</label>
        </div>
        
        <!-- quick links <start> -->
        <div class="qL" id="qucklinks">
          <div>Quick Links</div>
          <a href="#abtStr">About {{ $store->store_name }}</a>
          <a href="#tpHntsss" title="Hints and Tips">Hints and Tips</a>
          <a href="#srtFaq" title="{{ $store->store_name }}">FAQs</a>
        </div>
        <!-- quick links <end> -->
      </div>
      <!-- filters <end> -->

      <!-- What Makes -->
      <div class="wgt">
        <h3>What Makes <i class="bp_hrt"></i> {{ $store->store_name }} Special?</h3>
        <ol>
          <li><i class="bp_fr-dls"></i> Free Deals</li>
          <li><i class="bp_fr-dl"></i> Free Delivery</li>
          <li><i class="bp_st-ofr"></i> Student Offers</li>
        </ol>
      </div>
      <!-- What Makes end -->

      <!-- Social -->
      <div class="wgt">
        <h3>Become a Member of the {{ $store->store_name }} Social Club!</h3>
        <div class="scl">
          @if($store->facebook_url)
            <a href="{{ $store->facebook_url }}" target="_blank" class="bp_fb" title="Facebook" aria-label="Facebook"></a>
          @endif
          @if($store->twitter_url)
            <a href="{{ $store->twitter_url }}" target="_blank" title="Twitter" aria-label="Twitter">
              <svg style="width: 20px; fill: #000;" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path></svg>
            </a>
          @endif
          @if($store->instagram_url)
            <a href="{{ $store->instagram_url }}" target="_blank" class="bp_insta" title="Instagram" aria-label="Instagram"></a>
          @endif
          @if($store->youtube_url)
            <a href="{{ $store->youtube_url }}" target="_blank" class="bp_yt" title="Youtube" aria-label="Youtube"></a>
          @endif
        </div>
      </div>
      <!-- Social end -->

      <!-- Hints & Tips -->
      <div class="wgt" id="tpHntsss">
        <div class="tpHnts">
          <h3>Hints & Tips</h3>
          <div>If you are looking for additional ways to save a significant amount of money on your shopping trip at {{ $store->store_name }}, the following are some of the ways you can do so:</div>
          <ul>
            <li>Always check out our website before making a purchase at {{ $store->store_name }} to see if you can get their products at a lower price than what they now offer.</li>
            <li>You may ensure that you are aware of the most recent changes made to the {{ $store->store_name }} website by subscribing to the newsletter programmed offered by the company.</li>
            <li>Don't forget to look through the sales and clearance part of the website for {{ $store->store_name }}! Deals like those can be found at the location.</li>
            <li>If you follow {{ $store->store_name }} on any of the major social media platforms (Facebook, Instagram, or Twitter), you will never miss an update.</li>
            <li>{{ $store->store_name }} is known to update their website with promotional codes for gift cards, free shipping and delivery, and next-day delivery frequently. Be sure to confirm that they are.</li>
          </ul>
        </div>
      </div>
      <!-- Hints & Tips end -->

      <!-- Related Stores -->
      @if($relatedStores->count() > 0)
      <div class="wgt">
        <h3>Related Stores</h3>
        <div class="btns">
          @foreach($relatedStores as $relatedStore)
            <a href="{{ route('store', $relatedStore->seo_url) }}" title="{{ $relatedStore->store_name }}">{{ $relatedStore->store_name }}</a>
          @endforeach
        </div>
      </div>
      @endif

      <!-- Related Categories -->
      @if($storeCategories->count() > 0)
      <div class="wgt">
        <h3>Related Categories</h3>
        <div class="btns">
          @foreach($storeCategories as $category)
            @if(!empty($category->category_slug))
              <a href="{{ route('category', $category->category_slug) }}" title="{{ $category->category_name }}">{{ $category->category_name }}</a>
            @else
              <span title="{{ $category->category_name }}">{{ $category->category_name }}</span>
            @endif
          @endforeach
        </div>
      </div>
      @endif

      <!-- Store shoppers also like -->
      @if($relatedStores->count() > 0)
      <div class="wgt">
        <h3>{{ $store->store_name }} shoppers also like</h3>
        <div class="lgos">
          @foreach($relatedStores->take(8) as $relatedStore)
            <a href="{{ route('store', $relatedStore->seo_url) }}" title="{{ $relatedStore->store_name }}">
              @if($relatedStore->store_logo)
                <img src="{{ asset('storage/' . $relatedStore->store_logo) }}" alt="{{ $relatedStore->store_name }} discount code" title="{{ $relatedStore->store_name }} discount code" decoding="async" loading="lazy" width="64" height="64">
              @else
                <div class="store-placeholder-small">{{ substr($relatedStore->store_name, 0, 2) }}</div>
              @endif
              <div>
                {{ $relatedStore->store_name }}
                <span>{{ rand(5, 15) }} Discount Available</span>
              </div>
            </a>
          @endforeach
        </div>
      </div>
      @endif
    </div>
    <!-- sidebar <end> -->
  </div>
</div>
<!-- sidebar wrp <end> -->

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

    <!-- Email Subscription Popup -->
    <div class="cm-email-popup" role="dialog" aria-modal="true" aria-label="Email Subscription Popup">
        <div class="cm-email-content">
            <div class="cm-brand-logo">
                <div class="cm-brand-circle" id="cmBrandLogo">
                    @if($store->store_logo)
                        <img src="{{ asset('storage/' . $store->store_logo) }}" alt="{{ $store->store_name }} logo" width="140" height="40" style="border-radius: 100%; border: 3px solid #fff;">
                    @else
                        {{ substr($store->store_name, 0, 5) }}
                    @endif
                </div>
            </div>
            
            <h4 class="cm-email-title" id="cmEmailTitle">{{ $store->store_name }} straight to your inbox</h4>
            
            <form class="cm-email-form" id="cmEmailForm">
                <label for="cmEmailInput">Email Address</label>
                <input type="email" id="cmEmailInput" placeholder="Your Email Address" required>
                <button type="submit" class="cm-email-submit">Send Me New Codes</button>
            </form>
            
            <p class="cm-email-consent">
                By signing up I agree to Big Saving Hub's <a href="{{ route('privacy-policy') }}" target="_blank">Privacy Policy</a> and consent to receive emails about offers.
            </p>
        </div>

        <!-- Website Logo at Bottom -->
        <div class="cm-website-logo">
            <span class="cm-website-name">Big Saving Hub</span>
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

/* Responsive Design */
@media (max-width: 768px) {
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
    .cm-code-wrap {
        flex-direction: column;
        gap: 10px;
    }
}
</style>
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
  const cmEmailForm = document.getElementById('cmEmailForm');
  const cmEmailInput = document.getElementById('cmEmailInput');

  function openModal(code, affiliate, store, title) {
    if (cmCode) cmCode.textContent = code || '';
    if (cmTitle) cmTitle.textContent = title || 'Here is your code';
    if (cmNote) cmNote.textContent = `This ${store} website has been opened in a new tab. Simply copy and paste the code ${code} and enter it at the checkout.`;
    if (cmEmailTitle) cmEmailTitle.textContent = `${store} straight to your inbox`;

    // update brand logo - preserve <img> if present
    const brandLogo = document.getElementById('cmBrandLogo');
    if (brandLogo) {
      const img = brandLogo.querySelector('img');
      if (img) {
        img.alt = store + ' logo';
        // optionally replace src: img.src = someUrl;
      } else {
        brandLogo.textContent = (store || 'STORE').substring(0,5).toUpperCase();
      }
    }

    modal.style.display = 'flex';
    modal.setAttribute('aria-hidden','false');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.style.display = 'none';
    modal.setAttribute('aria-hidden','true');
    document.body.style.overflow = '';
  }

  // Reveal code buttons
  document.querySelectorAll('.cpBtn.reveal-code').forEach(btn => {
    btn.addEventListener('click', function (e) {
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

  // safe listeners
  if (cmCopy) {
    cmCopy.addEventListener('click', function () {
      const text = (cmCode && cmCode.textContent || '').trim();
      if (!text) return;
      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(() => {
          const prev = cmCopy.textContent;
          cmCopy.textContent = 'Copied!';
          setTimeout(() => cmCopy.textContent = prev, 2000);
        }).catch(() => fallbackCopy(text));
      } else {
        fallbackCopy(text);
      }
    });
  }

  function fallbackCopy(text) {
    const tmp = document.createElement('textarea');
    tmp.value = text;
    tmp.style.position = 'fixed';
    tmp.style.top = '-9999px';
    document.body.appendChild(tmp);
    tmp.select();
    try { document.execCommand('copy'); } catch (e) {}
    document.body.removeChild(tmp);
    if (cmCopy) {
      const prev = cmCopy.textContent;
      cmCopy.textContent = 'Copied!';
      setTimeout(() => { cmCopy.textContent = prev; }, 2000);
    }
  }

  if (cmEmailForm) {
    cmEmailForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const email = (cmEmailInput && cmEmailInput.value || '').trim();
      if (!email) return;
      const submitBtn = this.querySelector('.cm-email-submit');
      const originalText = submitBtn ? submitBtn.textContent : '';
      if (submitBtn) submitBtn.textContent = 'Subscribed!';
      if (cmEmailInput) cmEmailInput.value = '';
      setTimeout(() => { if (submitBtn) submitBtn.textContent = originalText; }, 2000);
    });
  }

  // feedback & more toggle (guards added)
  document.querySelectorAll('.cm-feedback-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.cm-feedback-btn').forEach(b => { b.style.background = 'transparent'; b.style.borderColor = '#d1d5db'; });
      const feedback = this.dataset.feedback;
      this.style.background = feedback === 'positive' ? '#f0fdf4' : '#fef2f2';
      this.style.borderColor = feedback === 'positive' ? '#10b981' : '#ef4444';
    });
  });

  const moreBtn = document.querySelector('.cm-more-btn');
  if (moreBtn) {
    moreBtn.addEventListener('click', function () {
      const chevron = this.querySelector('.cm-chevron');
      if (chevron) chevron.style.transform = chevron.style.transform === 'rotate(180deg)' ? 'rotate(0deg)' : 'rotate(180deg)';
    });
  }

  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  if (overlay) overlay.addEventListener('click', closeModal);

  // show modal if params present
  try {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('show_coupon') === '1' && urlParams.get('code')) {
      openModal(urlParams.get('code'), urlParams.get('affiliate') || '#', urlParams.get('store') || 'Store', urlParams.get('title') || 'Here is your code');
      history.replaceState({}, '', window.location.pathname);
    }
  } catch (err) { /* ignore */ }
});
</script>

@endsection
