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

}
