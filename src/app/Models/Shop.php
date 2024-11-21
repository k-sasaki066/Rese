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

    public function user() {
        return $this->belongsTo(User::class);
    }
}
