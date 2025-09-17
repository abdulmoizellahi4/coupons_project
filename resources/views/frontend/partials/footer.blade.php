@php
    $footerEvents = \App\Models\Events::where('status', 1)
        ->where('show_footer', 1)
        ->orderBy('sort_order', 'asc')
        ->take(4)
        ->get();
    $brandingSettings = \App\Helpers\SettingsHelper::getBranding();
    $socialSettings = \App\Helpers\SettingsHelper::getSocial();
@endphp

<!-- Footer <start> -->
<footer class="modern-footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-content {{ $footerEvents->count() == 0 ? 'no-special-events' : '' }}">
                <!-- Brand Section -->
                <div class="footer-brand">
                    <div class="footer-logo">
                        @if($brandingSettings['site_logo_url'])
                            <img src="{{ $brandingSettings['site_logo_url'] }}" alt="{{ $brandingSettings['site_name'] }}">
                        @else
                            <img src="{{ asset('assets/img/icons/logo.png') }}" alt="{{ $brandingSettings['site_name'] }}">
                        @endif
                        <!-- <h3>{{ $brandingSettings['site_name'] }}</h3> -->
                    </div>
                    <p class="footer-description">
                        {{ $brandingSettings['site_tagline'] }}
                    </p>
                    <div class="social-links">
                        @if($socialSettings['facebook_url'])
                            <a href="{{ $socialSettings['facebook_url'] }}" target="_blank" class="social-link facebook" title="Facebook">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                        @endif
                        @if($socialSettings['twitter_url'])
                            <a href="{{ $socialSettings['twitter_url'] }}" target="_blank" class="social-link twitter" title="Twitter">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                        @endif
                        @if($socialSettings['instagram_url'])
                            <a href="{{ $socialSettings['instagram_url'] }}" target="_blank" class="social-link instagram" title="Instagram">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.297-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.807.875 1.297 2.026 1.297 3.323s-.49 2.448-1.297 3.323c-.875.807-2.026 1.297-3.323 1.297zm7.83-9.281c-.49 0-.875-.385-.875-.875s.385-.875.875-.875.875.385.875.875-.385.875-.875.875z"/>
                                </svg>
                            </a>
                        @endif
                        @if($socialSettings['youtube_url'])
                            <a href="{{ $socialSettings['youtube_url'] }}" target="_blank" class="social-link youtube" title="YouTube">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        @endif
                        @if($socialSettings['linkedin_url'])
                            <a href="{{ $socialSettings['linkedin_url'] }}" target="_blank" class="social-link linkedin" title="LinkedIn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-section">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('top-discounts') }}">Top Discounts</a></li>
                        <li><a href="{{ route('categories') }}">Categories</a></li>
                        <li><a href="{{ route('events') }}">Events</a></li>
                        <li><a href="{{ route('all-brands-uk') }}">All Brands</a></li>
                        <!-- <li><a href="{{ route('smash-voucher-codes') }}">Get Inspired</a></li> -->

                    </ul>
        </div>

                <!-- Dynamic Events -->
                @if($footerEvents->count() > 0)
                <div class="footer-section">
                    <h4 class="footer-title">Special Events</h4>
                    <ul class="footer-links">
                        @foreach($footerEvents as $event)
                            <li><a href="{{ route('event.detail', $event->seo_url) }}">{{ $event->event_name }}</a></li>
                        @endforeach
                    </ul>
                 </div>
                @endif

                <!-- Company Info -->
                <div class="footer-section">
                    <h4 class="footer-title">Company</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                    </ul>
        </div>

                <!-- Newsletter -->
                <div class="footer-section">
                    <h4 class="footer-title">Stay Updated</h4>
                    <p class="newsletter-text">Get the latest deals and offers delivered to your inbox!</p>
                    <form id="footerNewsletterForm" class="newsletter-form">
                        @csrf
                        <div class="newsletter-input-group">
                            <input type="email" name="email" id="footerNewsletterEmail" placeholder="Enter your email" required>
                            <button type="submit" class="newsletter-btn" id="footerNewsletterBtn">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <div id="footerNewsletterMessage" style="margin-top: 10px; display: none;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                @php
                    $brandingSettings = \App\Helpers\SettingsHelper::getBranding();
                @endphp
                <div class="copyright">
                    <p>&copy; {{ date('Y') }} {{ $brandingSettings['site_name'] }}. All rights reserved.</p>
                </div>
                <div class="disclosure">
                    <p><strong>Disclosure:</strong> We may earn a commission when you make a purchase through our links.</p>
                </div>
    </div>
        </div>
    </div>
</footer>

<style>
/* Modern Footer Styles */
.modern-footer {
    background: var(--background-secondary-color, #FAF9F5);
    color: var(--text-color, #ffffff);
}

.footer-main {
    padding: 3rem 0 2rem;
}
.container {
    max-width: 1280px;
    margin: 0 auto;
}

.footer-content {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1.5fr;
    gap: 3rem;
    align-items: start;
}

/* When Special Events column is hidden, adjust to 4 columns */
.footer-content.no-special-events {
    grid-template-columns: 2fr 1fr 1fr 1.5fr;
}

.footer-brand {
    max-width: 300px;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.footer-logo .logo-img {
    width: 50px;
    height: 50px;
    border-radius: 8px;
}

.footer-logo h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-color, #ffffff);
    margin: 0;
}

.footer-description {
    color: var(--text-color, #000);
    line-height: 1.6;
    margin-bottom: 2rem;
    font-size: 0.95rem;
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-link {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-color, #000);
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.social-link:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    color: var(--text-color, #ffffff);
}

.social-link.facebook:hover { background: var(--primary-color, #FA364B); }
.social-link.twitter:hover { background: var(--primary-color, #FA364B); }
.social-link.instagram:hover { background: var(--primary-color, #FA364B); }
.social-link.youtube:hover { background: var(--primary-color, #FA364B); }
.social-link.linkedin:hover { background: var(--primary-color, #FA364B); }

.footer-section {
    margin-bottom: 1rem;
}

.footer-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-color, #000);
    margin-bottom: 1.5rem;
    position: relative;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 30px;
    height: 2px;
    background: var(--primary-color, #FA364B) !important;
    border-radius: 1px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 0.75rem;
}

.footer-links a {
    color: var(--text-color, #000);
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    position: relative;
}

.footer-links a:hover {
    color: var(--primary-color, #FA364B);
    padding-left: 8px;
}

.footer-links a::before {
    content: '→';
    position: absolute;
    left: -15px;
    opacity: 0;
    transition: all 0.3s ease;
}

.footer-links a:hover::before {
    opacity: 1;
    left: -12px;
}

.newsletter-text {
    color: var(--text-color, #000);
    font-size: 0.9rem;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.newsletter-form {
    margin-top: 1rem;
}

.newsletter-input-group {
    display: flex;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 25px;
    overflow: hidden;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.newsletter-input-group input {
    flex: 1;
    padding: 12px 16px;
    border: none;
    background: var(--background-primary-color, #fff);
    color: var(--text-color, #ffffff);
    font-size: 0.9rem;
    outline: none;
}

.newsletter-input-group input::placeholder {
    color: var(--text-color, #b0b0b0);
}

.newsletter-btn {
    padding: 12px 16px;
    background: var(--primary-color, #FA364B) !important;
    border: none;
    color: #ffffff;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.newsletter-btn:hover {
    background: var(--secondary-color, #ff5252);
    transform: scale(1.05);
}

.footer-bottom {
    background: var(--secondary-color, #000);
    padding: 1.5rem 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.copyright p {
    color: var(--background-primary-color, #fff);
    font-size: 0.9rem;
    margin: 0;
}

.disclosure p {
    color: var(--background-primary-color, #fff);
    font-size: 0.85rem;
    margin: 0;
    text-align: right;
}

.disclosure strong {
    color: var(--text-color, #ffffff);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .footer-content {
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 2rem;
    }
    
    .footer-section:last-child {
        grid-column: 1 / -1;
        margin-top: 2rem;
    }
}

@media (max-width: 992px) {
    .footer-content {
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }
    
    .footer-brand {
        grid-column: 1 / -1;
        max-width: none;
    }
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
    }
    
    .disclosure p {
        text-align: center;
    }
    
    .social-links {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .footer-main {
        padding: 2rem 0 1rem;
    }
    
    .footer-content {
        gap: 1.5rem;
    }
    
    .newsletter-input-group {
        flex-direction: column;
        border-radius: 12px;
    }
    
    .newsletter-input-group input {
        border-radius: 12px 12px 0 0;
    }
    
    .newsletter-btn {
        border-radius: 0 0 12px 12px;
    }
}
</style>

<!-- Footer Newsletter AJAX -->
<script>
$(document).ready(function() {
    // Footer newsletter subscription
    $('#footerNewsletterForm').on('submit', function(e) {
        e.preventDefault();
        
        var email = $('#footerNewsletterEmail').val();
        var btn = $('#footerNewsletterBtn');
        var messageDiv = $('#footerNewsletterMessage');
        
        if (!email) {
            showFooterMessage('Please enter your email address.', 'error');
            return;
        }
        
        // Disable button and show loading
        btn.prop('disabled', true).html('<div style="width: 16px; height: 16px; border: 2px solid #fff; border-radius: 50%; border-top-color: transparent; animation: spin 1s linear infinite;"></div>');
        
        $.ajax({
            url: '{{ route("newsletter.subscribe") }}',
            type: 'POST',
            data: {
                email: email,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    showFooterMessage(response.message, 'success');
                    $('#footerNewsletterEmail').val('');
                } else {
                    showFooterMessage(response.message, 'error');
                }
            },
            error: function(xhr) {
                var message = 'Something went wrong. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                showFooterMessage(message, 'error');
            },
            complete: function() {
                btn.prop('disabled', false).html('<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>');
            }
        });
    });
    
    function showFooterMessage(message, type) {
        var messageDiv = $('#footerNewsletterMessage');
        var color = type === 'success' ? '#27ae60' : '#e74c3c';
        var bgColor = type === 'success' ? '#d4edda' : '#f8d7da';
        var borderColor = type === 'success' ? '#c3e6cb' : '#f5c6cb';
        
        messageDiv.html('<div style="color: ' + color + '; background: ' + bgColor + '; border: 1px solid ' + borderColor + '; padding: 10px; border-radius: 5px; font-size: 14px; font-weight: 500;">' + message + '</div>').show();
        
        setTimeout(function() {
            messageDiv.fadeOut();
        }, 5000);
    }
});
</script>
<!-- Footer <end> -->
