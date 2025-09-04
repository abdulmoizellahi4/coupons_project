@extends('frontend.layouts.app')

@section('title', 'Top 20 Discounts | Big Saving Hub')
@section('description', 'Get the best discount codes and voucher codes from top UK brands. Save money on your favorite products with our verified offers.')

@section('content')
<div class="Sec">
    <div class="Wrp">
        <h1>Top Discounts & Voucher Codes</h1>
        <p>Discover the most popular and verified discount codes from top UK brands.</p>
        
        <div class="cpns">
            @forelse($topCoupons as $coupon)
            <div class="cpn {{ $coupon->exclusive ? 'exclusive' : '' }} {{ $coupon->verified ? 'verified' : '' }}" data-id="{{ $coupon->id }}">
                <div class="imgs cvr">
                    @if($coupon->cover_logo)
                        <img decoding="async" class="cvr" src="{{ asset('storage/' . $coupon->cover_logo) }}" alt="{{ $coupon->coupon_title }}" title="{{ $coupon->coupon_title }}" width="328" height="160">
                    @endif
                    @if($coupon->store && $coupon->store->store_logo)
                        <a href="{{ route('store', $coupon->store->seo_url) }}" title="{{ $coupon->store->store_name }}">
                            <img decoding="async" loading="lazy" src="{{ asset('storage/' . $coupon->store->store_logo) }}" alt="{{ $coupon->store->store_name }} discount code" title="{{ $coupon->store->store_name }} discount code" width="80" height="80">
                        </a>
                    @endif
                </div>
                <div class="cnt">
                    <div class="str-vrf">
                        @if($coupon->store)
                            <a href="{{ route('store', $coupon->store->seo_url) }}" title="{{ $coupon->store->store_name }}">{{ $coupon->store->store_name }}</a>
                        @endif
                        @if($coupon->verified)
                            <span>Verified</span>
                        @endif
                        @if($coupon->exclusive)
                            <span class="exclusive-badge">Exclusive</span>
                        @endif
                    </div>
                    <h3 role="button" aria-label="Reveal Code">{{ $coupon->coupon_title }}</h3>
                    <div class="trm-cnt">
                        @if($coupon->terms)
                            <button aria-label="View Terms" class="ctb">View Terms</button>
                        @endif
                        <span>{{ $coupon->sort_order ?? '0' }} Used</span>
                    </div>
                    @if($coupon->coupon_code)
                        <button class="cpBtn" aria-label="Reveal Code" data-code="{{ $coupon->coupon_code }}">Reveal Code</button>
                    @else
                        <a href="{{ $coupon->affiliate_url }}" class="cpBtn" target="_blank" rel="nofollow">Get Deal</a>
                    @endif
                </div>
            </div>
            @empty
            <div class="no-coupons">
                <p>No top discounts available at the moment. Check back soon!</p>
            </div>
            @endforelse
        </div>

        @if($topCoupons->hasPages())
        <div class="pagination-wrapper">
            {{ $topCoupons->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

