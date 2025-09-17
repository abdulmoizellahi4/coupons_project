@extends('frontend.layouts.app')

@section('title', 'Special Events & Promotions')

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend_assets/css/store.css') }}">
<style>
/* Events Layout - Matching Image Design */
.Sec.bg {
    background-color: #F2F0E6;
    padding: 20px 0;
}

.Wrp {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.bx {
    background-color: #fff;
    border-radius: 15px;
    padding: 30px;
    margin: 20px 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.ttl {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 15px;
}

.ttl h3 {
    font-size: 28px;
    font-weight: bold;
    color: #000;
    margin: 0;
}

.ttl h3 a {
    color: #000;
    text-decoration: none;
}

.ttl a {
    color: #000;
    text-decoration: none;
    font-weight: 500;
}

.ttl a:hover {
    color: #4a0c98;
}

/* Event Grid */
.event-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-top: 20px;
}

.event-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.event-card-link:hover {
    text-decoration: none;
    color: inherit;
}

.event-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #e0e0e0;
}

.event-card-link:hover .event-card {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.event-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.event-content {
    padding: 20px;
}

.event-title {
    font-size: 20px;
    font-weight: bold;
    color: #000;
    margin-bottom: 10px;
    line-height: 1.3;
}

.event-type {
    display: inline-block;
    background: #FF0000;
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 10px;
}

.event-dates {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    font-size: 14px;
    color: #666;
}

.event-date {
    display: flex;
    align-items: center;
    gap: 5px;
}

.event-description {
    color: #666;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 15px;
}

.event-coupons {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #e0e0e0;
}

.event-coupons h4 {
    font-size: 16px;
    font-weight: 600;
    color: #000;
    margin-bottom: 10px;
}

.coupon-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.coupon-item {
    background: #f8f9fa;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 12px;
    color: #666;
    display: inline-block;
    margin: 2px;
}

.no-events {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.no-events h3 {
    font-size: 24px;
    margin-bottom: 10px;
    color: #000;
}

.no-events p {
    font-size: 16px;
    margin-bottom: 20px;
}

.btn-primary {
    background: #4a0c98;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: background 0.3s ease;
}

.btn-primary:hover {
    background: #3a0a7a;
    color: white;
    text-decoration: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .Wrp {
        padding: 0 15px;
    }
    
    .bx {
        padding: 20px;
        margin: 15px 0;
    }
    
    .ttl h3 {
        font-size: 24px;
    }
    
    .event-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .event-image {
        height: 150px;
    }
    
    .event-content {
        padding: 15px;
    }
    
    .event-title {
        font-size: 18px;
    }
    
    .event-dates {
        flex-direction: column;
        gap: 8px;
    }
}

@media (max-width: 480px) {
    .ttl {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .event-grid {
        gap: 15px;
    }
}
</style>
@endpush

@section('content')
<div class="Sec bg">
    <div class="Wrp">
        <div class="bx">
            <div class="ttl">
                <h3>Special Events & Promotions</h3>
                <a href="{{ route('home') }}">← Back to Home</a>
            </div>
            
            @if($events->count() > 0)
                <div class="event-grid">
                    @foreach($events as $event)
                        <a href="{{ route('event.detail', $event->seo_url) }}" class="event-card-link">
                            <div class="event-card">
                                @if($event->front_image)
                                    <img src="{{ asset('storage/'.$event->front_image) }}" alt="{{ $event->event_name }}" class="event-image">
                                @else
                                    <div class="event-image" style="display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; font-weight: bold;">
                                        {{ $event->event_name }}
                                    </div>
                                @endif
                                
                                <div class="event-content">
                                    <h3 class="event-title">
                                        {{ $event->event_name }}
                                    </h3>
                                    
                                    @if($event->event_type)
                                        <span class="event-type">{{ $event->event_type }}</span>
                                    @endif
                                    
                                    @if($event->date_available || $event->date_expiry)
                                        <div class="event-dates">
                                            @if($event->date_available)
                                                <div class="event-date">
                                                    <span>📅</span>
                                                    <span>Available: {{ \Carbon\Carbon::parse($event->date_available)->format('M d, Y') }}</span>
                                                </div>
                                            @endif
                                            @if($event->date_expiry)
                                                <div class="event-date">
                                                    <span>⏰</span>
                                                    <span>Expires: {{ \Carbon\Carbon::parse($event->date_expiry)->format('M d, Y') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    @if($event->event_short_content)
                                        <div class="event-description">
                                            {{ Str::limit($event->event_short_content, 120) }}
                                        </div>
                                    @endif
                                    
                                    @if(isset($eventCoupons[$event->id]) && $eventCoupons[$event->id]->count() > 0)
                                        <div class="event-coupons">
                                            <h4>Available Coupons ({{ $eventCoupons[$event->id]->count() }})</h4>
                                            <div class="coupon-list">
                                                @foreach($eventCoupons[$event->id] as $coupon)
                                                    <span class="coupon-item">
                                                        {{ Str::limit($coupon->coupon_title, 25) }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="no-events">
                    <h3>No Events Available</h3>
                    <p>There are currently no special events or promotions running.</p>
                    <a href="{{ route('home') }}" class="btn-primary">Browse All Coupons</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
