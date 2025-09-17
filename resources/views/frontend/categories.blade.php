@extends('frontend.layouts.app')

@section('title', 'Browse By Categories')

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend_assets/css/store.css') }}">
<style>
/* Dynamic Color Variables */
:root {
    --categories-primary-color: {{ $settings['primary_color'] ?? '#FF0000' }};
    --categories-primary-light: {{ $settings['primary_color'] ?? '#FF0000' }}20;
    --categories-primary-lighter: {{ $settings['primary_color'] ?? '#FF0000' }}10;
    --categories-primary-dark: {{ $settings['primary_color'] ?? '#FF0000' }}CC;
    --categories-secondary-color: {{ $settings['secondary_color'] ?? '#ff4444' }};
    --categories-accent-color: {{ $settings['primary_color'] ?? '#FF0000' }};
    --categories-text-color: {{ $settings['text_color'] ?? '#2d3748' }};
    --categories-heading-color: {{ $settings['text_color'] ?? '#1a202c' }};
    --categories-background-color: {{ $settings['background_primary_color'] ?? '#ffffff' }};
    --categories-card-background: {{ $settings['background_primary_color'] ?? '#ffffff' }};
}

/* Categories Layout - Matching Image Design */
.Sec.bg {
    background-color: var(--categories-primary-lighter);
    padding: 20px 0;
}

.Wrp {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.bx {
    background-color: var(--categories-card-background);
    border-radius: 15px;
    padding: 30px;
    margin: 20px 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border: 1px solid var(--categories-primary-lighter);
}

.ttl {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    border-bottom: 1px solid var(--categories-primary-lighter);
    padding-bottom: 15px;
}

.ttl h3 {
    font-size: 28px;
    font-weight: bold;
    color: var(--categories-heading-color);
    margin: 0;
}

.ttl h3 a {
    color: var(--categories-heading-color);
    text-decoration: none;
    transition: color 0.3s ease;
}

.ttl h3 a:hover {
    color: var(--categories-primary-color);
}

.ttl a {
    color: var(--categories-text-color);
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    transition: color 0.3s ease;
}

.ttl a:hover {
    color: var(--categories-primary-color);
}

.imgs {
    display: flex;
    gap: 15px;
    margin-bottom: 30px;
    flex-wrap: wrap;
    justify-content: flex-start;
}

.imgs a {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    transition: transform 0.2s ease;
    width: 100px;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.imgs a:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.imgs img {
    width: 80px;
    height: 80px;
    object-fit: contain;
}

.text-links-columns {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 20px;
    margin-top: 20px;
}

.text-links-columns .column {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.text-links-columns .column a {
    color: var(--categories-text-color);
    text-decoration: none;
    font-size: 14px;
    padding: 5px 0;
    transition: color 0.2s ease;
    line-height: 1.4;
}

.text-links-columns .column a:hover {
    color: var(--categories-primary-color);
}

.no-categories {
    text-align: center;
    padding: 40px 20px;
    background: var(--categories-card-background);
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border: 1px solid var(--categories-primary-lighter);
}

.no-categories h3 {
    font-size: 24px;
    color: var(--categories-heading-color);
    margin-bottom: 10px;
}

.no-categories p {
    font-size: 16px;
    color: var(--categories-text-color);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .text-links-columns {
        grid-template-columns: repeat(5, 1fr);
    }
}

@media (max-width: 992px) {
    .text-links-columns {
        grid-template-columns: repeat(4, 1fr);
    }
    
    .imgs {
        justify-content: flex-start;
    }
}

@media (max-width: 768px) {
    .text-links-columns {
        grid-template-columns: repeat(3, 1fr);
    }
    
    .ttl {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .imgs {
        gap: 10px;
    }
    
    .imgs a {
        width: 80px;
        height: 80px;
    }
    
    .imgs img {
        width: 60px;
        height: 60px;
    }
}

@media (max-width: 576px) {
    .text-links-columns {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .bx {
        padding: 20px;
    }
    
    .ttl h3 {
        font-size: 24px;
    }
}
</style>
@endpush

@section('content')
<!-- Page title <start> -->
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
            <span itemprop="name">Categories</span>
            <meta itemprop="position" content="2">
          </a>
        </li>
    </ul>
    <!-- Breadcrumb <end> -->
          <!-- Top 20 Discounts Head <start> -->
      <div class="dcHd" style="background-image: url('assets/images/svg/dc20.svg');">
        <h1>Browse By Categories</h1>
      </div>
      <!-- Top 20 Discounts Head <end> -->
    
  </div>
</div>
<!-- Page title <end> -->

<!-- Dynamic Categories Section -->
<div class="Sec bg">
  <div class="Wrp">
    <div>
      @if(isset($categories) && count($categories) > 0)
        @foreach($categories as $category)
          <div class="bx">
            <div class="ttl">                
              <h3><a href="{{ route('category', $category->seo_url) }}" title="{{ $category->category_name }}">{{ $category->category_name }}</a></h3>                
              <a href="{{ route('category', $category->seo_url) }}" title="{{ $category->category_name }}">View All <i class="bp_visit"></i></a>
            </div>
            <div class="lnks">
              @if($category->brands && count($category->brands) > 0)
                
                <!-- All Brands Text Links -->
                <div class="text-links-columns">
                  @php
                    $brandsPerColumn = ceil(count($category->brands) / 7);
                    $columns = array_chunk($category->brands->toArray(), $brandsPerColumn);
                  @endphp
                  
                  @foreach($columns as $columnBrands)
                    <div class="column">
                      @foreach($columnBrands as $brand)
                        <a href="{{ route('store', $brand['seo_url']) }}" title="{{ $brand['store_name'] }}">{{ $brand['store_name'] }}</a>
                      @endforeach
                    </div>
                  @endforeach
                </div>
              @endif
            </div>
          </div>
        @endforeach
      @else
        <div class="no-categories">
          <h3>No categories available</h3>
          <p>Please check back later for available categories.</p>
        </div>
      @endif
    </div>
  </div>
</div>

@endsection

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
    background: var(--categories-primary-lighter);
    border: 2px dashed var(--categories-primary-color);
    border-radius: 8px;
    padding: 15px;
    font-size: 18px;
    font-weight: bold;
    color: var(--categories-primary-color);
    margin-bottom: 15px;
    font-family: monospace;
}

.cm-copy-btn {
    background: var(--categories-primary-color);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.cm-copy-btn:hover {
    background: var(--categories-primary-dark);
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

/* Email Popup Content */
.cm-brand-logo {
    margin-bottom: 15px;
}

.cm-brand-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--categories-primary-color);
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
    background: var(--categories-primary-color);
    color: white;
    border: none;
    padding: 12px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.cm-email-form button:hover {
    background: var(--categories-primary-dark);
}

.cm-email-privacy {
    font-size: 11px;
    color: #6b7280;
    line-height: 1.4;
    margin: 0;
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

  function openModal(code, affiliate, store, title) {
    if (cmCode) cmCode.textContent = code || '';
    if (cmTitle) cmTitle.textContent = title || 'Here is your code';
    if (cmNote) cmNote.textContent = `This ${store} website has been opened in a new tab. Simply copy and paste the code ${code} and enter it at the checkout.`;
    if (cmEmailTitle) cmEmailTitle.textContent = `${store} straight to your inbox`;

    // update brand logo
    const brandLogo = document.getElementById('cmBrandLogo');
    if (brandLogo) {
      const img = brandLogo.querySelector('img');
      if (img) {
        img.alt = store + ' logo';
      } else {
        brandLogo.textContent = (store || 'STORE').substring(0,5).toUpperCase();
      }
    }

    modal.style.display = 'block';
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.style.display = 'none';
    modal.setAttribute('aria-hidden','true');
    document.body.style.overflow = '';
  }

  // Store link click handlers - Direct redirect without popup
  document.querySelectorAll('.text-links-columns .column a').forEach(link => {
    link.addEventListener('click', function(e) {
      // Allow normal link behavior - direct redirect to store page
      // No preventDefault() - let the link work normally
      // No popup - direct navigation to store page
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
  if (cmEmailForm) {
    cmEmailForm.addEventListener('submit', function(e) {
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