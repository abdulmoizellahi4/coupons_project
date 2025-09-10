<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'parent_id',
        'seo_url',
        'meta_title',
        'meta_description',
        'short_content',
        'description',
        'media',
        'status',
        'sort_order',
        'featured',
        'show_home',
        'recommended'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function stores()
{
    return $this->belongsToMany(Store::class, 'category_store');
}

}
