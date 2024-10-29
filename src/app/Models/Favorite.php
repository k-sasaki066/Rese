<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public function shops() {
        return $this->hasMany(Shop::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
