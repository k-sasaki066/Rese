<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'genre_id',
        'name',
        'address',
        'building',
        'tel',
        'opening_time',
        'closing_time',
        'max_number',
        'holiday',
        'budget',
        'image_url',
        'detail',
    ];

    public function area() {
        return $this->belongsTo(Area::class);
    }

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function shopRepresentatives()
    {
        return $this->hasMany(Shop_representative::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function menus() {
        return $this->hasMany(Menu::class);
    }
}
