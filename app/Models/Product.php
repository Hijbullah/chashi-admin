<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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
