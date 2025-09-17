@extends('frontend.layouts.app')

@section('title', 'Contact Us - Big Saving Hub | Get in Touch')
@section('description', 'Contact Big Saving Hub for support, partnerships, or feedback. We\'re here to help you save more and provide the best discount code experience.')
@section('keywords', 'Contact Big Saving Hub, customer support, partnership inquiries, feedback, help center')

@push('styles')
<link rel="preload" href="{{ asset('frontend_assets/css/fonts.css') }}" as="style" crossorigin>
<link rel="preload" href="{{ asset('frontend_assets/css/store.css') }}" as="style" crossorigin>
<link rel="stylesheet" href="{{ asset('frontend_assets/css/fonts.css') }}" crossorigin>
<link rel="stylesheet" href="{{ asset('frontend_assets/css/store.css') }}" as="style" crossorigin>
<style>
/* Dynamic Color Variables */
:root {
    --contact-primary-color: {{ $settings['primary_color'] ?? '#FF0000' }};
    --contact-primary-light: {{ $settings['primary_color'] ?? '#FF0000' }}20;
    --contact-primary-lighter: {{ $settings['primary_color'] ?? '#FF0000' }}10;
    --contact-primary-dark: {{ $settings['primary_color'] ?? '#FF0000' }}CC;
    --contact-secondary-color: {{ $settings['secondary_color'] ?? '#ff4444' }};
    --contact-accent-color: {{ $settings['primary_color'] ?? '#FF0000' }};
    --contact-text-color: {{ $settings['text_color'] ?? '#2d3748' }};
    --contact-heading-color: {{ $settings['text_color'] ?? '#1a202c' }};
    --contact-background-color: {{ $settings['background_primary_color'] ?? '#ffffff' }};
    --contact-card-background: {{ $settings['background_primary_color'] ?? '#ffffff' }};
}

/* Contact Us Page Styles */
.contact-hero {
    background: 
        linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url('{{ asset('frontend_assets/images/search-bg.webp') }}') center/cover no-repeat;
    color: white;
    padding: 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.contact-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, var(--contact-primary-light) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, var(--contact-primary-light) 0%, transparent 50%),
        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.contact-hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.contact-hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.contact-hero p {
    font-size: 1.3rem;
    margin-bottom: 30px;
    opacity: 0.95;
    line-height: 1.6;
}

.contact-main {
    padding: 80px 0;
    background: var(--contact-background-color);
}

.contact-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: start;
}

.contact-info {
    background: var(--contact-primary-lighter);
    padding: 40px;
    border-radius: 15px;
    height: fit-content;
    border: 1px solid var(--contact-primary-light);
}

.contact-info h2 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--contact-heading-color);
    margin-bottom: 30px;
    position: relative;
}

.contact-info h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, var(--contact-primary-color) 0%, var(--contact-primary-dark) 100%);
    border-radius: 2px;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    padding: 20px;
    background: var(--contact-card-background);
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
    border: 1px solid var(--contact-primary-lighter);
}

.info-item:hover {
    transform: translateY(-5px);
    border-color: var(--contact-primary-light);
}

.info-icon {
    width: 50px;
    height: 50px;
    background: var(--contact-primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    font-size: 1.5rem;
    color: white;
}

.info-content h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--contact-heading-color);
    margin-bottom: 5px;
}

.info-content p {
    color: var(--contact-text-color);
    margin: 0;
    font-size: 0.95rem;
}

.contact-form-section {
    background: var(--contact-card-background);
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid var(--contact-primary-lighter);
}

.contact-form-section h2 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--contact-heading-color);
    margin-bottom: 30px;
    position: relative;
}

.contact-form-section h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, var(--contact-primary-color) 0%, var(--contact-primary-dark) 100%);
    border-radius: 2px;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    color: var(--contact-heading-color);
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.form-group input,
.form-group textarea,
.form-group select {
    padding: 15px;
    border: 2px solid var(--contact-primary-lighter);
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: var(--contact-card-background);
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    outline: none;
    border-color: var(--contact-primary-color);
    box-shadow: 0 0 0 3px var(--contact-primary-light);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.submit-btn {
    background: linear-gradient(135deg, var(--contact-primary-color) 0%, var(--contact-primary-dark) 100%);
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    align-self: flex-start;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px var(--contact-primary-light);
}

.faq-section {
    background: var(--contact-primary-lighter);
    padding: 80px 0;
}

.faq-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 20px;
}

.faq-section h2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 50px;
    position: relative;
}

.faq-section h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, #FF0000 0%, rgb(102, 102, 102) 100%);
    border-radius: 2px;
}

.faq-grid {
    display: grid;
    gap: 20px;
}

.faq-item {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.faq-question {
    padding: 25px;
    background: white;
    border: none;
    width: 100%;
    text-align: left;
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background 0.3s ease;
}

.faq-question:hover {
    background: #f8f9fa;
}

.faq-question::after {
    content: '+';
    font-size: 1.5rem;
    color: #FF0000;
    transition: transform 0.3s ease;
}

.faq-item.active .faq-question::after {
    transform: rotate(45deg);
}

.faq-answer {
    padding: 0 25px;
    max-height: 0;
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-item.active .faq-answer {
    padding: 0 25px 25px;
    max-height: 200px;
}

.faq-answer p {
    color: #6c757d;
    line-height: 1.6;
    margin: 0;
}

.office-hours {
    background: white;
    padding: 30px;
    border-radius: 10px;
    margin-top: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.office-hours h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 15px;
}

.office-hours p {
    color: #6c757d;
    margin: 5px 0;
}

/* Responsive Design */
@media (max-width: 992px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .contact-hero h1 {
        font-size: 2.5rem;
    }
    
    .contact-hero p {
        font-size: 1.1rem;
    }
    
    .contact-main {
        padding: 60px 0;
    }
    
    .contact-info,
    .contact-form-section {
        padding: 30px 20px;
    }
    
    .info-item {
        padding: 15px;
    }
    
    .info-icon {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
        margin-right: 15px;
    }
    
    .faq-section {
        padding: 60px 0;
    }
    
    .faq-section h2 {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .contact-hero {
        padding: 60px 0;
    }
    
    .contact-hero h1 {
        font-size: 2rem;
    }
    
    .contact-info h2,
    .contact-form-section h2 {
        font-size: 1.5rem;
    }
    
    .info-item {
        flex-direction: column;
        text-align: center;
    }
    
    .info-icon {
        margin-right: 0;
        margin-bottom: 15px;
    }
}
</style>
@endpush

@section('content')

<!-- Contact Hero Section -->
<div class="contact-hero">
    <div class="contact-hero-content">
        <h1>Contact Us</h1>
        <p>We're here to help! Get in touch with our team for support, partnerships, or any questions about Big Saving Hub.</p>
    </div>
</div>

<!-- Contact Main Section -->
<div class="contact-main">
    <div class="contact-container">
        <div class="contact-grid">
            <!-- Contact Information -->
            @php
                $contactSettings = \App\Helpers\SettingsHelper::getContact();
            @endphp
            <div class="contact-info">
                <h2>Get in Touch</h2>
                
                <div class="info-item">
                    <div class="info-icon">📧</div>
                    <div class="info-content">
                        <h3>Email Us</h3>
                        <p>{{ $contactSettings['contact_email'] }}<br>{{ $contactSettings['partnership_email'] }}</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">📞</div>
                    <div class="info-content">
                        <h3>Call Us</h3>
                        <p>{{ $contactSettings['contact_phone'] }}<br>{{ $contactSettings['business_hours'] }}</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">📍</div>
                    <div class="info-content">
                        <h3>Visit Us</h3>
                        <p>{{ $contactSettings['contact_address'] }}</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">💬</div>
                    <div class="info-content">
                        <h3>Live Chat</h3>
                        <p>Available 24/7<br>Click the chat icon below</p>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="contact-form-section">
                <h2>Send us a Message</h2>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name *</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name *</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <select id="subject" name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                            <option value="support" {{ old('subject') == 'support' ? 'selected' : '' }}>Technical Support</option>
                            <option value="partnership" {{ old('subject') == 'partnership' ? 'selected' : '' }}>Partnership Opportunity</option>
                            <option value="feedback" {{ old('subject') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                            <option value="complaint" {{ old('subject') == 'complaint' ? 'selected' : '' }}>Complaint</option>
                            <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" placeholder="Please describe your inquiry in detail..." required>{{ old('message') }}</textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="faq-section">
    <div class="faq-container">
        <h2>Frequently Asked Questions</h2>
        
        <div class="faq-grid">
            <div class="faq-item">
                <button class="faq-question">How do I report a broken coupon code?</button>
                <div class="faq-answer">
                    <p>If you find a coupon code that doesn't work, please contact our support team with the store name and coupon code. We'll verify and update it within 24 hours.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">How can I become a partner store?</button>
                <div class="faq-answer">
                    <p>We'd love to partner with you! Please email {{ $contactSettings['partnership_email'] }} with your store details, and our partnership team will get back to you within 2 business days.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">Do you have a mobile app?</button>
                <div class="faq-answer">
                    <p>Yes! Our mobile app is available for both iOS and Android. You can download it from the App Store or Google Play Store to get exclusive mobile-only deals.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">How often are coupon codes updated?</button>
                <div class="faq-answer">
                    <p>We update our coupon codes multiple times daily. Our system automatically checks for new codes and removes expired ones to ensure you always have access to working discounts.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">Can I suggest new stores to add?</button>
                <div class="faq-answer">
                    <p>Absolutely! We welcome suggestions for new stores. Please email us with the store name, website, and any available discount codes, and we'll consider adding them to our platform.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">How do I unsubscribe from emails?</button>
                <div class="faq-answer">
                    <p>You can unsubscribe from our emails by clicking the unsubscribe link at the bottom of any email, or by contacting our support team. We respect your privacy and will process your request immediately.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// FAQ Toggle Functionality
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            // Close other open items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle current item
            item.classList.toggle('active');
        });
    });
});
</script>

@endsection
