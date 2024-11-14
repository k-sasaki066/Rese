<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteForm extends Component
{
    public $shops;
    public $shop;
    public $shop_id;
    public $showModal = false;

    public function render()
    {
        return view('livewire.favorite-form');
    }

    // お気に入り削除
    public function delete($shop_id)
    {
        $user=Auth::user()->favorites()->where('shop_id', $shop_id)->delete();
    }
}
