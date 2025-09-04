<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
            'exclusive',
            'featured',
            'recommended',
            'verified',
            'status',
            'coupon_title',
            'brand_store',
            'coupon_code',
            'event_id', // Foreign key to events table
            'submitted_by',
            'affiliate_url',
            'date_available',
            'date_expiry',
            'expiry_soon',
            'description',
            'terms',
            'cover_logo',
            'sort_order'
    ];

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'brand_store', 'store_name');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    // Scope for active coupons
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Scope for featured coupons
    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    // Scope for verified coupons
    public function scopeVerified($query)
    {
        return $query->where('verified', 1);
    }

    // Scope for exclusive coupons
    public function scopeExclusive($query)
    {
        return $query->where('exclusive', 1);
    }

    // Scope for recommended coupons
    public function scopeRecommended($query)
    {
        return $query->where('recommended', 1);
    }
}
