<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $casts = [
        'bullet_points' => 'array',
        'pre_order' => 'boolean',
        'is_popular' => 'boolean',
        'is_flash_sale' => 'boolean',
        'is_spacial' => 'boolean'
    ];

    public function getRouteKeyName()
    {
    	return 'slug';
    }
}
