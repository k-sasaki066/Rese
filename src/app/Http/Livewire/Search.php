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
    public $showModal = false;
    public $favoriteIn;
    protected $query;

    public function mount(){

        $this->search();
    }

    public function render() {
        $this->areas = shop::with('area')->groupBy('area_id')->get('area_id');
        $this->genres = shop::with('genre')->groupBy('genre_id')->get('genre_id');


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

    // 検索機能
    public function search()
    {
        $this->query = Shop::with('area', 'genre')
            ->leftJoin('ratings', 'shops.id', '=', 'ratings.shop_id')
            ->select(
                'shops.id',
                'area_id',
                'genre_id',
                'name',
                'image_url',
            )
            ->selectRaw(
                'AVG(rating) as rating_avg'
            )
            ->groupBy(
                'shops.id',
                'area_id',
                'genre_id',
                'name',
                'image_url',
            );
        $this->getAreaSearch();
        $this->getGenreSearch();
        $this->getWordSearch();
        $this->shops = $this->query->get(['shops.*']);
    }

    public function getAreaSearch() {
        $areaSearch = $this->areaSearch;
        if(!empty($areaSearch)) {
            $this->query->where('area_id', $areaSearch);
        }
    }

    public function getGenreSearch() {
        $genreSearch = $this->genreSearch;
        if(!empty($genreSearch)) {
            $this->query->where('genre_id', $genreSearch);
        }
    }

    public function getWordSearch() {
        $wordSearch = $this->wordSearch;
        if(!empty($wordSearch)) {
            $this->query->where('name', 'LIKE', '%' .$this->wordSearch .'%');
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
        $this->favoriteIn = true;
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
        $this->search();
    }

    // お気に入り削除
    public function delete($shop_id)
    {
        $user=Auth::user()->favorites()->where('shop_id', $shop_id)->delete();
        $this->favoriteIn = false;
        $this->search();
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
