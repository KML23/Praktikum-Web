<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;

    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'csname',
        'description',
        'release',
        'price',
        'img_cs',
    ];

    /**
     * Get the full URL for the image attribute.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function image_cs(): Attribute
    {
        return Attribute::make(
            get: fn($img_cs) => url('/storage/product' . $img_cs),
        );
    }
}
