<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop_representative extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function shop()
    {
        return $this->BelongsTo(Shop::class);
    }
}
