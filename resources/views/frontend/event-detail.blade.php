@extends('frontend.layouts.app')

@section('title', $event->meta_title ?? $event->event_name . ' Discount Codes & Voucher Codes')
@section('description', $event->meta_description ?? 'Get the latest ' . $event->event_name . ' discount codes, voucher codes, and promo codes. Save money on your purchases with verified offers.')
@section('keywords', trim($event->meta_keywords ?? '') ? $event->meta_keywords : ($event->event_name . ' discount codes, ' . $event->event_name . ' voucher codes, ' . $event->event_name . ' promo codes, ' . $event->event_name . ' coupons'))

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
        <a href="{{ route('events') }}" class="link" itemprop="item">
          <span itemprop="name">Events</span>
          <meta itemprop="position" content="2">
        </a>
      </li>
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a href="{{ route('event.detail', $event->seo_url) }}" class="link active" itemprop="item">
          <span itemprop="name">{{ $event->event_name }}</span>
          <meta itemprop="position" content="3">
        </a>
      </li>
    </ul>
    <!-- Breadcrumb <end> -->

    <!-- Event Head <start> -->
    <div class="strHd">
      <div class="lgo">
        @if($event->front_image)
            <img src="{{ asset('storage/' . $event->front_image) }}" alt="{{ $event->event_name }} discount code" title="{{ $event->event_name }} discount code">
        @else
            <div class="store-logo-placeholder">{{ substr($event->event_name, 0, 2) }}</div>
        @endif
        <button class="sfvbtn bp_hrt" role="button" aria-label="Save event" data-id="{{ $event->id }}"></button>
      </div>
      <div class="cntr">
        <!-- event title -->
        <h1>{{ $event->event_name }} Discount Code {{ date('F Y') }}</h1>
        <!-- event title <end> -->

        <!-- event description -->
        <p class="d-tab-none">Save money with these {{ $eventCoupons->count() }} {{ $event->event_name }} voucher codes & deals</p>
        <!-- event description <end> -->

        <!-- rating -->
        <div class="rating">
            <input type="radio" id="star1" name="rating" value="1">
            <label class="bp_str rated" for="star1" onclick="eventRating(1, {{ $event->id }}, '{{ request()->ip() }}')"></label>
            <input type="radio" id="star2" name="rating" value="2">
            <label class="bp_str rated" for="star2" onclick="eventRating(2, {{ $event->id }}, '{{ request()->ip() }}')"></label>
            <input type="radio" id="star3" name="rating" value="3">
            <label class="bp_str rated" for="star3" onclick="eventRating(3, {{ $event->id }}, '{{ request()->ip() }}')"></label>
            <input type="radio" id="star4" name="rating" value="4">
            <label class="bp_str rated" for="star4" onclick="eventRating(4, {{ $event->id }}, '{{ request()->ip() }}')"></label>
            <input type="radio" id="star5" name="rating" value="5">
            <label class="bp_str" for="star5" onclick="eventRating(5, {{ $event->id }}, '{{ request()->ip() }}')"></label>
            <p class="ratingCalculator">Rated 4 from 21 votes</p>
        </div>
        <!-- rating <end> -->
      </div>
      <div class="btns">
        <span class="vsts"><i class="bp_views"></i> {{ number_format(rand(1000, 100000)) }}</span>
        <a href="{{ route('events') }}" class="affiliate btn" aria-label="View All" style="padding:0px 20px;"><i class="bp_visit"></i> View All</a>
      </div>
    </div>
    <!-- Event Head <end> -->
  </div>
</div>

<!-- sidebar wrp -->
<div class="Sec bg">
  <div class="splt Wrp">
    <!-- coupon side -->
    <div class="wgtc">
      <div class="cpns wd">
        @if($eventCoupons->count() > 0)
            @foreach($eventCoupons as $coupon)
            <!-- coupon:code <start> -->
            <div class="cpn {{ $coupon->coupon_code ? 'cd' : 'dl' }} {{ $coupon->free_shipping ? 'fs' : '' }} {{ $coupon->student_offer ? 'std' : '' }}" data-id="{{ $coupon->id }}">
                <button title="Add to Favourite" class="cfb bp_save hideIconS" aria-label="Add to Favourite"></button>
                
                <a class="clgo" href="javascript:;" title="{{ $event->event_name }} Vouchers Code">
                    @if($coupon->store && $coupon->store->store_logo)
                        <img src="{{ asset('storage/' . $coupon->store->store_logo) }}" alt="{{ $coupon->store->store_name }} discount code" title="{{ $coupon->store->store_name }} discount code" decoding="async" loading="lazy" width="90" height="90">
                    @else
                        <div class="store-logo-placeholder">{{ substr($coupon->brand_store ?? 'EV', 0, 2) }}</div>
                    @endif
                </a>

                <div class="ccnt">
                    <div class="ctp">
                        @if($coupon->verified)
                            <span class="cvrf">Verified</span>
                        @endif
                        @if($event->event_type)
                            <span class="event-type-badge">{{ $event->event_type }}</span>
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
                            data-affiliate="{{ $coupon->affiliate_url ?? ($coupon->store ? $coupon->store->affiliate_url : url('/')) }}"
                            data-store="{{ $coupon->brand_store ?? ($coupon->store ? $coupon->store->store_name : 'Store') }}"
                            data-title="{{ $coupon->coupon_title }}">
                        Reveal Code
                    </button>
                @else
                    <button class="cpBtn get-deal" aria-label="Get Deal" 
                            data-affiliate="{{ $coupon->affiliate_url ?? ($coupon->store ? $coupon->store->affiliate_url : url('/')) }}"
                            data-store="{{ $coupon->brand_store ?? ($coupon->store ? $coupon->store->store_name : 'Store') }}"
                            data-title="{{ $coupon->coupon_title }}">
                        Get Deal
                    </button>
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
                <h2>Stay Updated – Never Miss a {{ $event->event_name }} Voucher Code Again!</h2>
                <p>Be the first one to get notified as soon as we update a new offer or discount.</p>

                <label class="snfld">
                    <input type="text" name="newsletter" value="" placeholder="Enter Your Email Address Here">
                    <button class="nfb" title="Subscribe">Subscribe</button>
                </label>

                <p>By signing up I agree to Big Saving Hub's <a href="{{ route('privacy-policy') }}" target="_blank">Privacy Policy</a> and consent to receive emails about offers.</p>
            </div>
        @else
            <div class="no-coupons">
                <p>No active coupons available for {{ $event->event_name }} at the moment. Check back soon for new offers!</p>
            </div>
        @endif
      </div>

      <!-- event table <start> -->
      <div class="crd tbl">
        <h3 class="hd">Save Big with {{ $event->event_name }} Discount Codes – {{ date('d F Y') }}!</h3>
        <table>
          <tr>
            <th>Offers</th>
            <th>Last Checked</th>
            <th>Code</th>
          </tr>
          @if($eventCoupons->count() > 0)
            @foreach($eventCoupons->take(4) as $coupon)
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
      <!-- event table <end> -->

      <!-- event faq <start> -->
      @if(!empty($event->detail_description))
        <div class="crd faqs" id="srtFaq">
          <h3 class="hd">About {{ $event->event_name }}</h3>
              <div class="faq">
              {!! nl2br(e($event->detail_description)) !!}
          </div>
        </div>
      @endif
      <!-- event faq <end> -->

      <!-- event more content <start> -->
      @if(!empty($event->event_short_content))
      <div class="crd" id="abtStr">
        <h3 class="hd">More About {{ $event->event_name }}</h3>
        <div class="cnt 3">
          {!! nl2br(e($event->event_short_content)) !!}
        </div>
      </div>
      @endif
      <!-- event more content <end> -->
    </div>

    <!-- sidebar -->
    <div class="wgts"> 

      <!-- rating -->
      <div class="wgt rating-box">
        <h3>How Did We Do? Rate {{ $event->event_name }} Vouchers Today!</h3>
        <div class="rating mb-3">
          <input type="radio" id="star1" name="rating" value="1">
          <label class="bp_str rated" for="star1" onclick="eventRating(1, {{ $event->id }}, '{{ request()->ip() }}')"></label>
          <input type="radio" id="star2" name="rating" value="2">
          <label class="bp_str rated" for="star2" onclick="eventRating(2, {{ $event->id }}, '{{ request()->ip() }}')"></label>
          <input type="radio" id="star3" name="rating" value="3">
          <label class="bp_str rated" for="star3" onclick="eventRating(3, {{ $event->id }}, '{{ request()->ip() }}')"></label>
          <input type="radio" id="star4" name="rating" value="4">
          <label class="bp_str rated" for="star4" onclick="eventRating(4, {{ $event->id }}, '{{ request()->ip() }}')"></label>
          <input type="radio" id="star5" name="rating" value="5">
          <label class="bp_str" for="star5" onclick="eventRating(5, {{ $event->id }}, '{{ request()->ip() }}')"></label>
        </div>
        <p class="ratingCalculator">Rated 4 from 21 votes</p>
      </div>
      <!-- rating end -->

      <!-- Expert Review -->
      <div class="wgt">
        <div class="pst">
          <div class="hd">
            <div>
              <h3>Why we love {{ $event->event_name }} <i class="bp_hrt"></i></h3>
            </div>
          </div>
          <div class="cnt">
            <p>{{ $event->event_short_content ?? 'Discover amazing deals and discounts with ' . $event->event_name . '. This special event offers exclusive savings and promotional codes for your favorite stores.' }}</p>
          </div>
        </div>
      </div>

      <!-- Today's Discount Code -->
      <div class="wgt today-discount-code">
        <div class="padding-div">
          <h3>Today's Hand Tested Discount Code</h3>
          <p class="last-update">Last updated: <span>{{ date('d-M-Y') }}</span></p>
          <ol>
            <li>Voucher Codes: <span>{{ $eventCoupons->where('coupon_code', '!=', null)->count() }}</span></li>
            <li>Deals: <span>{{ $eventCoupons->where('coupon_code', null)->count() }}</span></li>
          </ol>
        </div>
        <span class="total-offers">Total Offers: <span>{{ $eventCoupons->count() }}</span></span>
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
          <a href="#abtStr">About {{ $event->event_name }}</a>
          <a href="#tpHntsss" title="Hints and Tips">Hints and Tips</a>
          <a href="#srtFaq" title="{{ $event->event_name }}">Event Details</a>
        </div>
        <!-- quick links <end> -->
      </div>
      <!-- filters <end> -->

      <!-- What Makes -->
      <div class="wgt">
        <h3>What Makes <i class="bp_hrt"></i> {{ $event->event_name }} Special?</h3>
        <ol>
          <li><i class="bp_fr-dls"></i> Exclusive Deals</li>
          <li><i class="bp_fr-dl"></i> Limited Time Offers</li>
          <li><i class="bp_st-ofr"></i> Special Promotions</li>
        </ol>
      </div>
      <!-- What Makes end -->

      <!-- Event Info -->
      @if($event->date_available || $event->date_expiry)
      <div class="wgt">
        <h3>Event Details</h3>
        @if($event->date_available)
          <p><strong>Available From:</strong> {{ \Carbon\Carbon::parse($event->date_available)->format('F d, Y') }}</p>
        @endif
        @if($event->date_expiry)
          <p><strong>Expires On:</strong> {{ \Carbon\Carbon::parse($event->date_expiry)->format('F d, Y') }}</p>
        @endif
        @if($event->event_type)
          <p><strong>Event Type:</strong> {{ $event->event_type }}</p>
        @endif
      </div>
      @endif

      <!-- Related Events -->
      @if($relatedEvents->count() > 0)
      <div class="wgt">
        <h3>Related Events</h3>
        <div class="btns">
          @foreach($relatedEvents as $relatedEvent)
            <a href="{{ route('event.detail', $relatedEvent->seo_url) }}" title="{{ $relatedEvent->event_name }}">{{ $relatedEvent->event_name }}</a>
          @endforeach
        </div>
      </div>
      @endif

      <!-- Participating Stores -->
      @if($eventStores->count() > 0)
      <div class="wgt">
        <h3>Participating Stores</h3>
        <div class="btns">
          @foreach($eventStores as $store)
            <a href="{{ route('store', $store->seo_url) }}" title="{{ $store->store_name }}">{{ $store->store_name }}</a>
          @endforeach
        </div>
      </div>
      @endif

      <!-- Event shoppers also like -->
      @if($relatedEvents->count() > 0)
      <div class="wgt">
        <h3>{{ $event->event_name }} shoppers also like</h3>
        <div class="lgos">
          @foreach($relatedEvents->take(8) as $relatedEvent)
            <a href="{{ route('event.detail', $relatedEvent->seo_url) }}" title="{{ $relatedEvent->event_name }}">
              @if($relatedEvent->front_image)
                <img src="{{ asset('storage/' . $relatedEvent->front_image) }}" alt="{{ $relatedEvent->event_name }} discount code" title="{{ $relatedEvent->event_name }} discount code" decoding="async" loading="lazy" width="64" height="64">
              @else
                <div class="store-placeholder-small">{{ substr($relatedEvent->event_name, 0, 2) }}</div>
              @endif
              <div>
                {{ $relatedEvent->event_name }}
                <span>{{ rand(5, 15) }} Discount Available</span>
              </div>
            </a>
          @endforeach
        </div>
      </div>
      @endif

      <!-- Hints & Tips -->
      <div class="wgt" id="tpHntsss">
        <div class="tpHnts">
          <h3>Hints & Tips</h3>
          <div>If you are looking for additional ways to save a significant amount of money during {{ $event->event_name }}, the following are some of the ways you can do so:</div>
          <ul>
            <li>Always check out our website before making a purchase during {{ $event->event_name }} to see if you can get products at a lower price than what they now offer.</li>
            <li>You may ensure that you are aware of the most recent changes made to the {{ $event->event_name }} by subscribing to the newsletter programmed offered by the company.</li>
            <li>Don't forget to look through the sales and clearance part of the website for {{ $event->event_name }}! Deals like those can be found at the location.</li>
            <li>If you follow {{ $event->event_name }} on any of the major social media platforms (Facebook, Instagram, or Twitter), you will never miss an update.</li>
            <li>{{ $event->event_name }} is known to update their website with promotional codes for gift cards, free shipping and delivery, and next-day delivery frequently. Be sure to confirm that they are.</li>
          </ul>
        </div>
      </div>
      <!-- Hints & Tips end -->
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
                    <span id="cmBrandText">EVENT</span>
                </div>
            </div>
            
            <h3 class="cm-email-title" id="cmEmailTitle">Get More Deals!</h3>
            <p class="cm-email-subtitle text-center">Subscribe to get exclusive offers and discounts</p>
            
            <form class="cm-email-form" id="cmEmailForm">
                <input type="email" placeholder="Enter your email" required>
                <button type="submit">Subscribe</button>
            </form>
            
            <p class="cm-email-privacy">We respect your privacy. Unsubscribe at any time.</p>
        </div>
    </div>
</div>

<style>
/* Event-specific styles */
.event-type-badge {
    background: #FF0000;
    color: white;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 10px;
    font-weight: 500;
    margin-left: 5px;
}

.store-placeholder-small {
    width: 64px;
    height: 64px;
    background: #4a0c98;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-weight: bold;
    font-size: 18px;
}

.no-coupons {
    text-align: center;
    padding: 40px 20px;
    color: #666;
}

.no-coupons p {
    font-size: 16px;
    margin: 0;
}

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
    margin-top: 20px;
    color: #666;
    font-size: 14px;
}

/* Email Subscription Styles */
.cm-email-content {
    text-align: center;
}

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

.cm-email-subtitle {
    color: #6b7280;
    font-size: 16px;
    margin: 0 0 25px;
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

.cm-email-privacy {
    font-size: 12px;
    color: #999;
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
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('couponModal');
  const closeBtn = document.querySelector('.cm-close');
  const overlay = document.querySelector('.cm-overlay');
  const cmCode = document.getElementById('cmCode');
  const cmCopy = document.getElementById('cmCopy');
  const cmTitle = document.getElementById('cmTitle');
  const cmNote = document.getElementById('cmNote');
  const cmBrandText = document.getElementById('cmBrandText');
  const cmEmailTitle = document.getElementById('cmEmailTitle');

  function closeModal() {
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }

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

  // Copy functionality
  if (cmCopy) {
    cmCopy.addEventListener('click', function() {
      if (cmCode) {
        navigator.clipboard.writeText(cmCode.textContent).then(() => {
          cmCopy.textContent = 'Copied!';
          setTimeout(() => {
            cmCopy.textContent = 'Copy Code';
          }, 2000);
        });
      }
    });
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
        const popupUrl = currentUrl + '?show_coupon=1&affiliate=' + encodeURIComponent(affiliate) + '&store=' + encodeURIComponent(store) + '&title=' + encodeURIComponent(title);
        window.open(popupUrl, '_blank');
        window.location.href = affiliate;
      }
    });
  });

  // Email form
  const emailForm = document.getElementById('cmEmailForm');
  if (emailForm) {
    emailForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const email = this.querySelector('input[type="email"]').value;
      if (email) {
        // Here you would typically send the email to your backend
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
      if (!code) {
        if (cmCode) cmCode.textContent = 'No code required';
        if (cmCopy) cmCopy.style.display = 'none';
      }
    }
  } catch (e) {
    console.log('URL params not supported');
  }
});
</script>

@endsection