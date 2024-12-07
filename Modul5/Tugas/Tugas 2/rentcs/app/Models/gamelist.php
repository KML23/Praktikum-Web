<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class gamelist extends Model
{
    use HasFactory;

    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'gamename',
        'genre',
        'release',
        'description',
        'rating',
        'img_game',
    ];

    /**
     * Get the full URL for the image attribute.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function image_game(): Attribute
    {
        return Attribute::make(
            get: fn($img_game) => url('/storage/gemelist' . $img_game),
        );
    }
}
