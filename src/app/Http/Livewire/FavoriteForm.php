<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteForm extends Component
{
    public $shops;
    public $shop;
    public $favorites;
    public $shop_id;
    public $showModal = false;

    public function render()
    {
        return view('livewire.favorite-form');
    }

    // お気に入り登録しているshop_idを取得
    public function getFavorite()
    {
        if(Auth::check()) {
            $this->favorites = Auth::user()->favorites()
            ->orderBy('shop_id', 'asc')
            ->pluck('shop_id')
            ->toArray();
        }else {
            $this->favorites = '';
        }
    }

    // お気に入り追加
    public function favorite($shop_id)
    {
        $user = Auth::user();

        if ($user) {
        $user_id = Auth::id();
        }
        // 既にいいねしているかチェック
        $existingFavorite = Favorite::where('shop_id', $shop_id)
        ->where('user_id', $user_id)
        ->first();

        // 既にいいねしている場合は何もせず、そうでない場合は新しいいいねを作成する
        if (!$existingFavorite) {
            $favorite = new Favorite();
            $favorite->fill([
                'shop_id'=>$shop_id,
                'user_id'=>$user_id,
                ])->save();
        }
        $this->getFavorite();
    }

    // お気に入り削除
    public function delete($shop_id)
    {
        $user=Auth::user()->favorites()->where('shop_id', $shop_id)->delete();
        // dd($user);
        $this->getFavorite();
    }

    // モーダル画面
    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}
