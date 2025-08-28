<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
        'event_name',
        'event_type',
        'date_available',
        'date_expiry',
        'seo_url',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'front_image',
        'button_icon',
        'cover_image',
        'no_coupon_cover',
        'event_short_content',
        'detail_description',
        'status',
        'sort_order'
    ];
    
    public function coupons()
{
    return $this->hasMany(Coupon::class, 'event_id');
}
public function stores()
{
    return $this->belongsToMany(Store::class, 'event_store');
}


}

