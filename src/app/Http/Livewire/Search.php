<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class Search extends Component
{
    public $areaSearch;
    public $genreSearch;
    public $wordSearch;
    public $shops;
    public $areas;
    public $genres;
    public $favorites;
    public $showModal = false;

    public function mount(){
        $this->areas = Area::all();
        $this->genres = Genre::all();
        $this->shops = Shop::all();

        $this->getFavorite();
        $this->search();
    }

    public function render() {


        return view('livewire.search');
    }

    // 検索フォームの値が更新するたびにsearchアクションを呼び出す
    public function updatedAreaSearch()
    {
        $this->search();
    }

    public function updatedGenreSearch()
    {
        $this->search();
    }

    public function updatedWordSearch()
    {
        $this->search();
    }

    // お気に入り登録しているshop_idを取得
    public function getFavorite()
    {
        if(Auth::check()) {
            $this->favorites = Auth::user()->favorites()->orderBy('shop_id', 'asc')->pluck('shop_id')->toArray();
        }else {
            $this->favorites = '';
        }
    }

    // 検索機能
    public function search()
    {
        $areaSearch = $this->areaSearch;
        $genreSearch = $this->genreSearch;
        $wordSearch = $this->wordSearch;
        // dd($areaSearch);

        if(empty($areaSearch) && empty($genreSearch) && empty($wordSearch)) {
            $this->shops = Shop::with(['area', 'genre'])
            ->get();
        }

        if (!empty($areaSearch) && empty($genreSearch)) {
            $this->shops = Shop::where('area_id', $areaSearch)
            ->get();
        }

        if (empty($areaSearch) && !empty($genreSearch)) {
            $this->shops = Shop::where('genre_id', $genreSearch)
            ->get();
        }

        if (!empty($areaSearch) && !empty($genreSearch)) {
            $this->shops = Shop::where('area_id', $areaSearch)
            ->where('genre_id', $genreSearch)
            ->get();
        }

        if(!empty($this->wordSearch)) {
            $this->shops = Shop::where('name', 'LIKE', '%' .$this->wordSearch .'%')->get();
        }
    }

    // 検索ワードをurlに反映
    protected $queryString = [
        'areaSearch' => ['except' => ''],
        'genreSearch' => ['except' => ''],
        'wordSearch' => ['except' => '']
    ];

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
