<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        // 'slug',
        'description',
        'image',
        'icon',
        // 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();
        
    //     static::creating(function ($category) {
    //         if (empty($category->slug)) {
    //             $category->slug = Str::slug($category->name);
    //         }
    //     });
    // }
}
