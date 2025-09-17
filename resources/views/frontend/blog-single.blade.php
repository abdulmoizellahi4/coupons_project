@extends('frontend.layouts.app')

@section('title', $blog->meta_title ?: $blog->title . ' - Big Saving Hub Blog')
@section('description', $blog->meta_description ?: $blog->excerpt)
@section('keywords', $blog->meta_keywords ?: 'blog, money saving, discount codes, deals')

@push('styles')
<link rel="preload" href="{{ asset('frontend_assets/css/fonts.css') }}" as="style" crossorigin>
<link rel="preload" href="{{ asset('frontend_assets/css/store.css') }}" as="style" crossorigin>
<link rel="stylesheet" href="{{ asset('frontend_assets/css/fonts.css') }}" crossorigin>
<link rel="stylesheet" href="{{ asset('frontend_assets/css/store.css') }}" as="style" crossorigin>
<style>
/* Dynamic Color Variables */
:root {
    --blog-primary-color: {{ $settings['primary_color'] ?? '#FF0000' }};
    --blog-primary-light: {{ $settings['primary_color'] ?? '#FF0000' }}20;
    --blog-primary-lighter: {{ $settings['primary_color'] ?? '#FF0000' }}10;
    --blog-primary-dark: {{ $settings['primary_color'] ?? '#FF0000' }}CC;
    --blog-secondary-color: {{ $settings['secondary_color'] ?? '#ff4444' }};
    --blog-accent-color: {{ $settings['primary_color'] ?? '#FF0000' }};
    --blog-text-color: {{ $settings['text_color'] ?? '#2d3748' }};
    --blog-heading-color: {{ $settings['text_color'] ?? '#1a202c' }};
    --blog-background-color: {{ $settings['background_primary_color'] ?? '#ffffff' }};
    --blog-card-background: {{ $settings['background_primary_color'] ?? '#ffffff' }};
}

/* Professional Blog Single Styles */
.blog-single-hero {
    background: 
        linear-gradient(135deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)),
        url('{{ asset('frontend_assets/images/search-bg.webp') }}') center/cover no-repeat;
    color: white;
    padding: 120px 0 100px;
    text-align: center;
    position: relative;
    overflow: hidden;
    min-height: 60vh;
    display: flex;
    align-items: center;
}

.blog-single-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, var(--blog-primary-light) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, var(--blog-primary-light) 0%, transparent 50%),
        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.05"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.05"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.05"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.05"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.8;
}

.blog-single-hero-content {
    position: relative;
    z-index: 2;
    max-width: 900px;
    margin: 0 auto;
    padding: 0 30px;
}

.blog-single-hero h1 {
    font-size: 4rem;
    font-weight: 800;
    margin-bottom: 25px;
    text-shadow: 3px 3px 6px rgba(0,0,0,0.5);
    line-height: 1.1;
    letter-spacing: -0.02em;
}

.blog-single-hero p {
    font-size: 1.4rem;
    margin-bottom: 40px;
    opacity: 0.95;
    line-height: 1.6;
    font-weight: 300;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.blog-single-main {
    padding: 100px 0;
    background: linear-gradient(180deg, var(--blog-background-color) 0%, var(--blog-primary-lighter) 100%);
    position: relative;
}

.blog-single-main::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, var(--blog-primary-light) 50%, transparent 100%);
}

.blog-single-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 30px;
    position: relative;
}

.blog-single-content {
    background: var(--blog-card-background);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 
        0 20px 60px rgba(0,0,0,0.08),
        0 8px 25px rgba(0,0,0,0.05);
    margin-bottom: 60px;
    border: 1px solid var(--blog-primary-lighter);
    transition: all 0.3s ease;
}

.blog-single-content:hover {
    transform: translateY(-5px);
    box-shadow: 
        0 25px 80px rgba(0,0,0,0.12),
        0 12px 35px rgba(0,0,0,0.08);
}

.blog-single-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    transition: transform 0.3s ease;
}

.blog-single-image:hover {
    transform: scale(1.02);
}

.blog-single-image-placeholder {
    width: 100%;
    height: 500px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 5rem;
    position: relative;
}

.blog-single-image-placeholder::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background: var(--blog-primary-light);
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
    50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.7; }
    100% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
}

.blog-single-body {
    padding: 60px;
    position: relative;
}

.blog-single-meta {
    display: flex;
    align-items: center;
    gap: 40px;
    margin-bottom: 40px;
    padding: 25px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    font-size: 1rem;
    color: #6c757d;
    flex-wrap: wrap;
}

.blog-single-date,
.blog-single-author,
.blog-single-views {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 20px;
    background: var(--blog-primary-lighter);
    border-radius: 25px;
    border: 1px solid var(--blog-primary-light);
    transition: all 0.3s ease;
    font-weight: 500;
}

.blog-single-date:hover,
.blog-single-author:hover,
.blog-single-views:hover {
    background: var(--blog-primary-light);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px var(--blog-primary-light);
}

.blog-single-date i,
.blog-single-author i,
.blog-single-views i {
    color: var(--blog-primary-color);
    font-size: 1.1rem;
}

.blog-single-title {
    font-size: 3rem;
    font-weight: 800;
    color: var(--blog-heading-color);
    margin-bottom: 35px;
    line-height: 1.1;
    letter-spacing: -0.02em;
    position: relative;
}

.blog-single-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 0;
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--blog-primary-color), var(--blog-secondary-color));
    border-radius: 2px;
}

.blog-single-excerpt {
    font-size: 1.3rem;
    color: var(--blog-text-color);
    line-height: 1.7;
    margin-bottom: 50px;
    padding: 30px;
    background: linear-gradient(135deg, var(--blog-primary-lighter) 0%, var(--blog-card-background) 100%);
    border-radius: 15px;
    border-left: 5px solid var(--blog-primary-color);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    font-weight: 400;
    position: relative;
}

.blog-single-excerpt::before {
    content: '"';
    position: absolute;
    top: -10px;
    left: 20px;
    font-size: 4rem;
    color: var(--blog-primary-light);
    font-family: serif;
    line-height: 1;
}

.blog-single-text {
    font-size: 1.2rem;
    line-height: 1.8;
    color: var(--blog-text-color);
    font-weight: 400;
}

.blog-single-text h1,
.blog-single-text h2,
.blog-single-text h3,
.blog-single-text h4,
.blog-single-text h5,
.blog-single-text h6 {
    margin-top: 3rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
    color: var(--blog-heading-color);
    line-height: 1.3;
    position: relative;
}

.blog-single-text h1 { font-size: 2.5rem; }
.blog-single-text h2 { font-size: 2.2rem; }
.blog-single-text h3 { font-size: 1.9rem; }
.blog-single-text h4 { font-size: 1.6rem; }
.blog-single-text h5 { font-size: 1.3rem; }
.blog-single-text h6 { font-size: 1.1rem; }

.blog-single-text h2::before,
.blog-single-text h3::before {
    content: '';
    position: absolute;
    left: -30px;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 30px;
    background: linear-gradient(180deg, var(--blog-primary-color), var(--blog-secondary-color));
    border-radius: 2px;
}

.blog-single-text p {
    margin-bottom: 2rem;
    text-align: justify;
}

.blog-single-text ul,
.blog-single-text ol {
    margin-bottom: 2rem;
    padding-left: 2.5rem;
}

.blog-single-text li {
    margin-bottom: 0.8rem;
    position: relative;
}

.blog-single-text ul li::before {
    content: '•';
    color: var(--blog-primary-color);
    font-weight: bold;
    position: absolute;
    left: -1.5rem;
}

.blog-single-text img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 3rem 0;
    box-shadow: 
        0 10px 30px rgba(0,0,0,0.1),
        0 4px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
}

.blog-single-text img:hover {
    transform: scale(1.02);
}

.blog-single-text blockquote {
    border-left: 5px solid var(--blog-primary-color);
    padding: 2.5rem;
    margin: 3rem 0;
    font-style: italic;
    background: linear-gradient(135deg, var(--blog-primary-lighter) 0%, var(--blog-card-background) 100%);
    border-radius: 12px;
    font-size: 1.2rem;
    position: relative;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
}

.blog-single-text blockquote::before {
    content: '"';
    position: absolute;
    top: -10px;
    left: 20px;
    font-size: 4rem;
    color: var(--blog-primary-light);
    font-family: serif;
    line-height: 1;
}

.blog-single-text table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
}

.blog-single-text table th,
.blog-single-text table td {
    border: 1px solid #dee2e6;
    padding: 1rem;
    text-align: left;
}

.blog-single-text table th {
    background-color: #FF0000;
    color: white;
    font-weight: 600;
}

.blog-single-text table tr:nth-child(even) {
    background-color: #f8f9fa;
}

.blog-single-text a {
    color: #FF0000;
    text-decoration: none;
    font-weight: 500;
}

.blog-single-text a:hover {
    text-decoration: underline;
}

.blog-single-footer {
    padding: 30px 50px;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.blog-single-tags {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.blog-single-tags strong {
    color: #2c3e50;
}

.blog-single-tag {
    background: #FF0000;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-single-tag:hover {
    background: #cc0000;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.blog-single-share {
    display: flex;
    align-items: center;
    gap: 15px;
}

.blog-single-share strong {
    color: #2c3e50;
}

.blog-single-share a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-single-share a:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.blog-single-share .facebook { background: #3b5998; }
.blog-single-share .twitter { background: #1da1f2; }
.blog-single-share .linkedin { background: #0077b5; }
.blog-single-share .whatsapp { background: #25d366; }

.back-to-blog {
    text-align: center;
    margin-bottom: 60px;
}

.back-to-blog a {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    color: var(--blog-primary-color);
    text-decoration: none;
    font-weight: 600;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    padding: 15px 30px;
    background: var(--blog-primary-lighter);
    border: 2px solid var(--blog-primary-light);
    border-radius: 50px;
    position: relative;
    overflow: hidden;
}

.back-to-blog a::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, var(--blog-primary-light), transparent);
    transition: left 0.5s ease;
}

.back-to-blog a:hover::before {
    left: 100%;
}

.back-to-blog a:hover {
    color: #ffffff;
    background: var(--blog-primary-color);
    transform: translateY(-3px);
    box-shadow: 0 10px 25px var(--blog-primary-light);
}

.back-to-blog a::after {
    content: '←';
    transition: transform 0.3s ease;
    font-size: 1.3rem;
}

.back-to-blog a:hover::after {
    transform: translateX(-5px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .blog-single-hero {
        padding: 80px 0 60px;
        min-height: 50vh;
    }
    
    .blog-single-hero h1 {
        font-size: 2.8rem;
    }
    
    .blog-single-hero p {
        font-size: 1.2rem;
    }
    
    .blog-single-main {
        padding: 60px 0;
    }
    
    .blog-single-container {
        padding: 0 20px;
    }
    
    .blog-single-body {
        padding: 40px 30px;
    }
    
    .blog-single-title {
        font-size: 2.2rem;
    }
    
    .blog-single-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .blog-single-date,
    .blog-single-author,
    .blog-single-views {
        padding: 10px 15px;
        font-size: 0.9rem;
    }
    
    .blog-single-text h2::before,
    .blog-single-text h3::before {
        left: -20px;
        width: 3px;
        height: 20px;
    }
    
    .blog-single-footer {
        padding: 30px;
    }
    
    .blog-single-tags {
        flex-wrap: wrap;
    }
    
    .blog-single-share {
        flex-wrap: wrap;
    }
    
    .back-to-blog a {
        padding: 12px 25px;
        font-size: 1.1rem;
    }
}

@media (max-width: 480px) {
    .blog-single-hero {
        padding: 60px 0 40px;
        min-height: 40vh;
    }
    
    .blog-single-hero h1 {
        font-size: 2.2rem;
    }
    
    .blog-single-hero p {
        font-size: 1.1rem;
    }
    
    .blog-single-container {
        padding: 0 15px;
    }
    
    .blog-single-body {
        padding: 30px 20px;
    }
    
    .blog-single-title {
        font-size: 1.9rem;
    }
    
    .blog-single-text {
        font-size: 1.1rem;
    }
    
    .blog-single-excerpt {
        font-size: 1.2rem;
        padding: 20px;
    }
    
    .blog-single-image,
    .blog-single-image-placeholder {
        height: 300px;
    }
    
    .blog-single-image-placeholder {
        font-size: 3rem;
    }
    
    .back-to-blog a {
        padding: 10px 20px;
        font-size: 1rem;
    }
}
</style>
@endpush

@section('content')

<!-- Blog Single Hero Section -->
<div class="blog-single-hero">
    <div class="blog-single-hero-content">
        <h1>{{ $blog->title }}</h1>
        <p>Published on {{ $blog->formatted_date }} by {{ $blog->author }}</p>
    </div>
</div>

<!-- Blog Single Main Section -->
<div class="blog-single-main">
    <div class="blog-single-container">
        
        <!-- Back to Blog -->
        <div class="back-to-blog">
            <a href="{{ route('blog') }}">
                Back to Blog
            </a>
        </div>

        <!-- Blog Content -->
        <article class="blog-single-content">
            @if($blog->featured_image)
                <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                     alt="{{ $blog->title }}" 
                     class="blog-single-image">
            @else
                <div class="blog-single-image-placeholder">
                    <i class="fas fa-newspaper"></i>
                </div>
            @endif
            
            <div class="blog-single-body">
                <div class="blog-single-meta">
                    <div class="blog-single-date">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ $blog->formatted_date }}</span>
                    </div>
                    <div class="blog-single-author">
                        <i class="fas fa-user"></i>
                        <span>{{ $blog->author }}</span>
                    </div>
                    <div class="blog-single-views">
                        <i class="fas fa-eye"></i>
                        <span>{{ number_format($blog->views_count) }} views</span>
                    </div>
                </div>
                
                <h1 class="blog-single-title">{{ $blog->title }}</h1>
                
                @if($blog->excerpt)
                    <div class="blog-single-excerpt">
                        {{ $blog->excerpt }}
                    </div>
                @endif
                
                <div class="blog-single-text">
                    {!! $blog->description !!}
                </div>
            </div>
            
            <div class="blog-single-footer">
                <div class="blog-single-tags">
                    <strong>Tags:</strong>
                    @if($blog->meta_keywords)
                        @foreach(explode(',', $blog->meta_keywords) as $keyword)
                            <a href="#" class="blog-single-tag">{{ trim($keyword) }}</a>
                        @endforeach
                    @else
                        <span class="text-muted">No tags</span>
                    @endif
                </div>
                
                <div class="blog-single-share">
                    <strong>Share:</strong>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                       class="facebook" 
                       target="_blank" 
                       title="Share on Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" 
                       class="twitter" 
                       target="_blank" 
                       title="Share on Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                       class="linkedin" 
                       target="_blank" 
                       title="Share on LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}" 
                       class="whatsapp" 
                       target="_blank" 
                       title="Share on WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </article>
    </div>
</div>

<script>
// Increment view count
document.addEventListener('DOMContentLoaded', function() {
    // Simple view count increment (you can implement proper tracking later)
    fetch('{{ route("blog.view", $blog->slug) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
    }).catch(function(error) {
        console.log('View count update failed:', error);
    });
});
</script>

@endsection
