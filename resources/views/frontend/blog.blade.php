@extends('frontend.layouts.app')

@section('title', 'Blog - Big Saving Hub | Latest Money Saving Tips & Deals')
@section('description', 'Read our latest blog posts about money saving tips, discount codes, shopping guides, and exclusive deals. Stay updated with Big Saving Hub blog.')
@section('keywords', 'Blog, money saving tips, discount codes, shopping guides, deals, Big Saving Hub')

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

/* Blog Page Styles */
.blog-hero {
    background: 
        linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url('{{ asset('frontend_assets/images/search-bg.webp') }}') center/cover no-repeat;
    color: white;
    padding: 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.blog-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, var(--blog-primary-light) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, var(--blog-primary-light) 0%, transparent 50%),
        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.blog-hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.blog-hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.blog-hero p {
    font-size: 1.3rem;
    margin-bottom: 30px;
    opacity: 0.95;
    line-height: 1.6;
}

.blog-main {
    padding: 80px 0;
    background: var(--blog-background-color);
}

.blog-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 40px;
    margin-bottom: 60px;
}

.blog-card {
    background: var(--blog-card-background);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid var(--blog-primary-lighter);
}

.blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    border-color: var(--blog-primary-light);
}

.blog-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    background: linear-gradient(135deg, var(--blog-primary-lighter) 0%, var(--blog-primary-light) 100%);
}

.blog-image-placeholder {
    width: 100%;
    height: 250px;
    background: linear-gradient(135deg, var(--blog-primary-lighter) 0%, var(--blog-primary-light) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--blog-primary-color);
    font-size: 3rem;
}

.blog-content {
    padding: 30px;
}

.blog-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 15px;
    font-size: 0.9rem;
    color: #6c757d;
}

.blog-date {
    display: flex;
    align-items: center;
    gap: 5px;
}

.blog-author {
    display: flex;
    align-items: center;
    gap: 5px;
}

.blog-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--blog-heading-color);
    margin-bottom: 15px;
    line-height: 1.3;
}

.blog-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-title a:hover {
    color: var(--blog-primary-color);
}

.blog-excerpt {
    color: var(--blog-text-color);
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 1rem;
}

.blog-read-more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--blog-primary-color);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.blog-read-more:hover {
    color: var(--blog-primary-dark);
    transform: translateX(5px);
}

.blog-read-more::after {
    content: '→';
    transition: transform 0.3s ease;
}

.blog-read-more:hover::after {
    transform: translateX(3px);
}

.no-blogs {
    text-align: center;
    padding: 80px 20px;
    background: var(--blog-primary-lighter);
    border-radius: 15px;
    margin: 40px 0;
    border: 1px solid var(--blog-primary-light);
}

.no-blogs-icon {
    font-size: 4rem;
    color: var(--blog-primary-color);
    margin-bottom: 20px;
}

.no-blogs h3 {
    color: var(--blog-heading-color);
    margin-bottom: 15px;
}

.no-blogs p {
    color: var(--blog-text-color);
    font-size: 1.1rem;
    margin-bottom: 30px;
}

.blog-pagination {
    display: flex;
    justify-content: center;
    margin-top: 60px;
}

.blog-pagination .pagination {
    display: flex;
    gap: 10px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.blog-pagination .page-item {
    margin: 0;
}

.blog-pagination .page-link {
    padding: 12px 18px;
    background: var(--blog-card-background);
    border: 2px solid var(--blog-primary-lighter);
    color: var(--blog-text-color);
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
    font-weight: 500;
}

.blog-pagination .page-link:hover {
    background: var(--blog-primary-color);
    border-color: var(--blog-primary-color);
    color: white;
    transform: translateY(-2px);
}

.blog-pagination .page-item.active .page-link {
    background: var(--blog-primary-color);
    border-color: var(--blog-primary-color);
    color: white;
}

.blog-pagination .page-item.disabled .page-link {
    background: var(--blog-primary-lighter);
    border-color: var(--blog-primary-lighter);
    color: var(--blog-text-color);
    cursor: not-allowed;
    opacity: 0.6;
}

.blog-pagination .page-item.disabled .page-link:hover {
    background: var(--blog-primary-lighter);
    border-color: var(--blog-primary-lighter);
    color: var(--blog-text-color);
    transform: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .blog-hero h1 {
        font-size: 2.5rem;
    }
    
    .blog-hero p {
        font-size: 1.1rem;
    }
    
    .blog-main {
        padding: 60px 0;
    }
    
    .blog-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .blog-content {
        padding: 25px 20px;
    }
    
    .blog-title {
        font-size: 1.3rem;
    }
    
    .blog-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}

@media (max-width: 480px) {
    .blog-hero {
        padding: 60px 0;
    }
    
    .blog-hero h1 {
        font-size: 2rem;
    }
    
    .blog-container {
        padding: 0 15px;
    }
    
    .blog-content {
        padding: 20px 15px;
    }
    
    .blog-title {
        font-size: 1.2rem;
    }
    
    .blog-excerpt {
        font-size: 0.95rem;
    }
}
</style>
@endpush

@section('content')

<!-- Blog Hero Section -->
<div class="blog-hero">
    <div class="blog-hero-content">
        <h1>Big Saving Hub Blog</h1>
        <p>Discover the latest money-saving tips, shopping guides, and exclusive deals to help you save more on your purchases.</p>
    </div>
</div>

<!-- Blog Main Section -->
<div class="blog-main">
    <div class="blog-container">
        @if($blogs && $blogs->count() > 0)
            <div class="blog-grid">
                @foreach($blogs as $blog)
                    <article class="blog-card">
                        @if($blog->featured_image)
                            <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                                 alt="{{ $blog->title }}" 
                                 class="blog-image">
                        @else
                            <div class="blog-image-placeholder">
                                <i class="fas fa-newspaper"></i>
                            </div>
                        @endif
                        
                        <div class="blog-content">
                            <div class="blog-meta">
                                <div class="blog-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{ $blog->formatted_date }}</span>
                                </div>
                                <div class="blog-author">
                                    <i class="fas fa-user"></i>
                                    <span>{{ $blog->author }}</span>
                                </div>
                            </div>
                            
                            <h2 class="blog-title">
                                <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                            </h2>
                            
                            <div class="blog-excerpt">
                                {{ $blog->excerpt }}
                            </div>
                            
                            <a href="{{ route('blog.show', $blog->slug) }}" class="blog-read-more">
                                Read More
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            @if($blogs->hasPages())
                <div class="blog-pagination">
                    {{ $blogs->links() }}
                </div>
            @endif
        @else
            <div class="no-blogs">
                <div class="no-blogs-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3>No Blog Posts Yet</h3>
                <p>We're working on creating amazing content for you. Check back soon for the latest money-saving tips and deals!</p>
                <a href="{{ route('categories') }}" class="btn btn-primary">
                    <i class="fas fa-tags"></i> Browse Categories
                </a>
            </div>
        @endif
    </div>
</div>

@endsection
