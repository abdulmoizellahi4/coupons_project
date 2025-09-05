@extends('frontend.layouts.app')

@section('title', 'Top 20 Discounts | Big Saving Hub')
@section('description', 'Get the best discount codes and voucher codes from top UK brands. Save money on your favorite products with our verified offers.')
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
<div class="pgHd">
  <div class="Wrp">
    <!-- Breadcrumb <start> -->
    <ul class="brdcrb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
  <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
    <a href="{{ route('home') }}" class="link" itemprop="item">
      <span itemprop="name">Home</span>
      <meta itemprop="position" content="1">
    </a>
  </li>
      <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
      <a href="javascript:;" class="link" itemprop="item">
        <span itemprop="name">Top 20 Discount </span>
        <meta itemprop="position" content="2">
      </a>
    </li>
    
  
 
</ul>
    <!-- Breadcrumb <end> -->
          <!-- Top 20 Discounts Head <start> -->
      <div class="dcHd" style="background-image: url('assets/images/svg/dc20.svg');">
        <h1>Top 20 Discounts</h1>
      </div>
      <!-- Top 20 Discounts Head <end> -->
    
  </div>
</div>
<!-- sidebar wrp -->
<div class="Sec bg">
  <div class="splt Wrp">
    <!-- coupon side -->
    <div class="wgtc">
            <div class="cpns wd">
       
       

          <!-- cpn: Coupon cpncd: Coupon Code -->
  

@if($topCoupons->count() > 0)
    @foreach($topCoupons as $coupon)
    <!-- ######################################### -->
        <!-- coupon:code <start> -->
        <div class="cpn cd " data-id="{{ $coupon->id }}">
            <button data-id="{{ $coupon->id }}" title="Add to Favourite" class="cfb bp_save " aria-label="Add to Favourite"></button>
            <a class="clgo" href="{{ route('store', $coupon->store->seo_url ?? 'store') }}" title="{{ $coupon->store->store_name ?? 'Store' }} Vouchers Code">
                <img src="{{ asset('storage/' . ($coupon->store->store_logo ?? 'default-store.png')) }}" alt="{{ $coupon->store->store_name ?? 'Store' }} discount code" title="{{ $coupon->store->store_name ?? 'Store' }} discount code" decoding="async" loading="lazy" width="90" height="90">
            </a>

            <div class="ccnt">
                <div class="ctp">
                    @if($coupon->verified)
                                            <span class="cvrf">Verified</span>
                    @endif
                </div>
                <h3 role="button" aria-label="Reveal Code" title="{{ $coupon->coupon_title }}">
                    @if($coupon->exclusive)
                        <strong class="cexclv">Exclusive</strong> 
                    @endif
                    {{ $coupon->coupon_title }}
                </h3>

                <div class="cbt">
                    <button class="ctb" title="Terms" aria-label="Details">Details</button>
                    
                    <span class="cusd">{{ rand(1, 10) }}.{{ rand(1, 9) }}K Used</span>
                </div>

            </div>


            <button class="cpBtn reveal-code" title="Reveal Code" aria-label="Reveal Code" 
                    data-code="{{ $coupon->coupon_code }}" 
                    data-affiliate="{{ $coupon->affiliate_url ?? ($coupon->store ? $coupon->store->affiliate_url : url('/')) }}"
                    data-store="{{ $coupon->store ? $coupon->store->store_name : 'Store' }}"
                    data-title="{{ $coupon->coupon_title }}">
                Reveal Code
            </button>


            <div class="ctc" style="display: none;">

                <!-- cte: Coupon Terms Expiry -->
                
                <h3>Terms &amp; Conditions</h3>

                <div class="dyncnt">
                    <p>{!! nl2br(e($coupon->terms ?? '1. Some exclusions apply.<br>2. Cannot be used in conjunction with any other offer.<br>3. For full Terms & Conditions kindly visit brands website.')) !!}</p>
                                    </div>
            </div>
        </div>
        <!-- coupon:code <end> -->

        
    <!-- ######################################### -->
    @endforeach
@else
    <div class="no-coupons">
        <p>No exclusive coupons available at the moment.</p>
                                    </div>
@endif
 
      </div>
    </div>
    <!-- coupon side <end> -->




  
    <!-- coupon side <end> -->
    <!-- sidebar -->
    <div class="wgts">

<!-- wgtcnt: Widget Content <start> -->
<div class="wgt">

    <h3 class="brdr">About Top 20 Discounts</h3>
    <p>Driving a car with qualitative accessories get you out of problematic life. It is always hard to find out cheap and advance vehicles accessories. Today it is nearly impossible to have an enjoyable drive in low cost without compromising on quality. But this problem is being solved by automotive coupon codes available at Top Vouchers Code. Here you can avail discounts through different deals on different types of Vehicles' parts and accessories i.e. Tires, Mirrors, Seats and Staring etc.You will find ATS Euromaster voucher codes at TVC through which you can get your vehicle's battery changed at extremely low cost. These and other types of discount deals, that Top Vouchers Code is featuring, has brought a revolutionary and dramatic type of change in automotive Industry. Accept this now you can top up your wallet by receiving Motoquipe discount codes on car accessories. To sell customers LED lights and other parts in competitive prices here you can find Led Equipped Voucher codes.So driving with joy and pleasure, spending less amount of money, is now a piece of cake. There was a time when people used to be passionate about driving but not now it's not. Because it's really hard to get as much discounts on goods, especially on cars and bikes. But now these discount offers by TVC has let people buy bikes and cars more. Here you can find tremendous ways of saving money so that you can save up for a dinner with the family or a night out with your mates rather than spending on vehicles. These are the incredible changes which have been made due to TVC's Automotive Promo codes by which you are able to manage your expenses properly. Hope these discount deals will help you find what you need at huge discounts.</p>
  </div>

<div class="wgt">
    <h3>Browse By Store</h3>
    <div class="btns alp">
          <a href="{{ route('all-brands-uk') }}?q=A">A</a>
          <a href="{{ route('all-brands-uk') }}?q=B">B</a>
          <a href="{{ route('all-brands-uk') }}?q=C">C</a>
          <a href="{{ route('all-brands-uk') }}?q=D">D</a>
          <a href="{{ route('all-brands-uk') }}?q=E">E</a>
          <a href="{{ route('all-brands-uk') }}?q=F">F</a>
          <a href="{{ route('all-brands-uk') }}?q=G">G</a>
          <a href="{{ route('all-brands-uk') }}?q=H">H</a>
          <a href="{{ route('all-brands-uk') }}?q=I">I</a>
          <a href="{{ route('all-brands-uk') }}?q=J">J</a>
          <a href="{{ route('all-brands-uk') }}?q=K">K</a>
          <a href="{{ route('all-brands-uk') }}?q=L">L</a>
          <a href="{{ route('all-brands-uk') }}?q=M">M</a>
          <a href="{{ route('all-brands-uk') }}?q=N">N</a>
          <a href="{{ route('all-brands-uk') }}?q=O">O</a>
          <a href="{{ route('all-brands-uk') }}?q=P">P</a>
          <a href="{{ route('all-brands-uk') }}?q=Q">Q</a>
          <a href="{{ route('all-brands-uk') }}?q=R">R</a>
          <a href="{{ route('all-brands-uk') }}?q=S">S</a>
          <a href="{{ route('all-brands-uk') }}?q=T">T</a>
          <a href="{{ route('all-brands-uk') }}?q=U">U</a>
          <a href="{{ route('all-brands-uk') }}?q=V">V</a>
          <a href="{{ route('all-brands-uk') }}?q=W">W</a>
          <a href="{{ route('all-brands-uk') }}?q=X">X</a>
          <a href="{{ route('all-brands-uk') }}?q=Y">Y</a>
          <a href="{{ route('all-brands-uk') }}?q=Z">Z</a>
        <a href="{{ route('all-brands-uk') }}?q=0-9" class="active">0-9</a>
    </div>
  </div>
  
  
  
    <div class="wgt nbp">
    <h3>Trending Brands</h3>
    <p>Major Discounts, Vouchers and Codes for the month of September 2025</p>
    <div class="btns">
      
@if(isset($trendingStores) && $trendingStores->count() > 0)
    @foreach($trendingStores as $store)
        <a href="{{ route('store', $store->seo_url) }}" title="{{ $store->store_name }}">{{ $store->store_name }}</a>
    @endforeach
@else
  <a href="{{ route('store', 'debenhams') }}" title="Debenhams UK">Debenhams UK</a>
  <a href="{{ route('store', 'asos') }}" title="ASOS UK">ASOS UK</a>
  <a href="{{ route('store', 'boden') }}" title="Boden">Boden</a>
  <a href="{{ route('store', 'dominos-pizza') }}" title="Dominos Pizza">Dominos Pizza</a>
  <a href="{{ route('store', 'missguided') }}" title="Missguided UK">Missguided UK</a>
  <a href="{{ route('store', 'dunelm') }}" title="Dunelm">Dunelm</a>
  <a href="{{ route('store', 'asda-george') }}" title="Asda George">Asda George</a>
  <a href="{{ route('store', 'samsung') }}" title="Samsung">Samsung</a>
  <a href="{{ route('store', 'clarks') }}" title="Clarks UK">Clarks UK</a>
  <a href="{{ route('store', 'currys-pc-world') }}" title="Currys PC World">Currys PC World</a>
  <a href="{{ route('store', 'groupon') }}" title="Groupon">Groupon</a>
  <a href="{{ route('store', 'pizza-express') }}" title="Pizza Express">Pizza Express</a>
  <a href="{{ route('store', 'marks-and-spencer') }}" title="Marks and Spencer">Marks and Spencer</a>
  <a href="{{ route('store', 'the-white-company') }}" title="The White Company">The White Company</a>
  <a href="{{ route('store', 'boohoo') }}" title="Boohoo">Boohoo</a>
  <a href="{{ route('store', 'very') }}" title="Very">Very</a>
  <a href="{{ route('store', 'just-eat') }}" title="Just Eat">Just Eat</a>
  <a href="{{ route('store', 'ebay') }}" title="Ebay">Ebay</a>
  <a href="{{ route('store', 'all-beauty') }}" title="All Beauty">All Beauty</a>
  <a href="{{ route('store', 'dorothy-perkins') }}" title="Dorothy Perkins">Dorothy Perkins</a>
  <a href="{{ route('store', 'bershka') }}" title="Bershka">Bershka</a>
  <a href="{{ route('store', 'vonhaus') }}" title="VonHaus">VonHaus</a>
  <a href="{{ route('store', 'monsoon') }}" title="Monsoon">Monsoon</a>
  <a href="{{ route('store', 'appliances-direct') }}" title="Appliances Direct">Appliances Direct</a>
  <a href="{{ route('store', 'usc') }}" title="USC">USC</a>
  <a href="{{ route('store', 'notino') }}" title="Notino">Notino</a>
  <a href="{{ route('store', 'uber-eats') }}" title="Uber Eats">Uber Eats</a>
  <a href="{{ route('store', 'qwertee') }}" title="Qwertee">Qwertee</a>
  <a href="{{ route('store', 'natures-best') }}" title="Natures Best">Natures Best</a>
  <a href="{{ route('store', 'majestic-wine') }}" title="Majestic Wine">Majestic Wine</a>
  <a href="{{ route('store', 'udemy') }}" title="Udemy">Udemy</a>
  <a href="{{ route('store', 'moda-furnishings') }}" title="Moda Furnishings">Moda Furnishings</a>
  <a href="{{ route('store', 'smiggle') }}" title="smiggle.co.uk">smiggle.co.uk</a>
  <a href="{{ route('store', 'michael-kors') }}" title="Michael Kors">Michael Kors</a>
  <a href="{{ route('store', 'sports-direct') }}" title="Sports Direct">Sports Direct</a>
  <a href="{{ route('store', 'gymshark') }}" title="GymShark">GymShark</a>
  <a href="{{ route('store', 'ambrose-wilson') }}" title="Ambrose Wilson">Ambrose Wilson</a>
  <a href="{{ route('store', 'argos') }}" title="Argos">Argos</a>
  <a href="{{ route('store', 'screwfix') }}" title="Screwfix">Screwfix</a>
  <a href="{{ route('store', 'new-look') }}" title="New Look">New Look</a>
  <a href="{{ route('store', 'studio') }}" title="Studio">Studio</a>
  <a href="{{ route('store', 'h-and-m') }}" title="H&amp;M">H&amp;M</a>
  <a href="{{ route('store', 'john-lewis') }}" title="John Lewis">John Lewis</a>
  <a href="{{ route('store', 'pizza-hut') }}" title="Pizza Hut">Pizza Hut</a>
@endif
      </div>
    <a href="{{ route('all-brands-uk') }}" class="bwsMre">Browse A-Z</a>
  </div>
   


  <div class="snlsec sdbr">
  
    <img src="assets/images/svg/nwsltr.svg" alt="paper plan" width="100" height="100" decoding="async" loading="lazy">


    <h2>Sign-up To Get Lastest Voucher Codes First</h2>

  <p>Be the first one to get notified as soon as we update a new offer or discount.</p>

  <form action="{{ route('newsletter.subscribe') }}" method="POST" class="snfld">
    @csrf
    <input type="email" name="email" value="" placeholder="Enter Your Email Address Here" required>
    <button type="submit" class="nfb" title="Subscribe">Subscribe</button>
  </form>

  <p>By signing up I agree to topvoucherscode's <a href="{{ route('privacy-policy') }}" target="_blank">Privacy Policy</a> and consent to receive emails about offers.</p>
</div>

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
    background: #FF0000;
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
    color: #333;
}

.cm-email-subtitle {
    color: #666;
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

@endsection