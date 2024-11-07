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
    public $shop_id;
    public $favorites;
    public $showModal = false;

    public function mount(){
        $this->areas = Area::all();
        $this->genres = Genre::all();
        $this->shops = Shop::all();

        $this->getFavorite();
    }

    public function render() {

        $this->search();

        return view('livewire.search');
    }

    public function updatedAreaSearch()
    {
        $this->search();
    }

    public function updatedGenreSearch()
    {
        $this->search();
    }


    public function getFavorite()
    {
        if(Auth::check()) {
            $this->favorites = Auth::user()->favorites()->pluck('shop_id')->toArray();
        }else {
            $this->favorites = '';
        }
    }

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

    protected $queryString = [
        'areaSearch' => ['except' => ''],
        'genreSearch' => ['except' => ''],
        'wordSearch' => ['except' => '']
    ];

    public function favorite($shop_id)
    {
        $user = Auth::user();
        // dd($this->areas);

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
            $favorite->shop_id = $shop_id;
            $favorite->user_id = $user_id;
            $favorite->save();
        }

        $this->getFavorite();
    }

    public function delete($shop_id)
    {
        $user=Auth::user()->favorites()->where('shop_id', $shop_id)->delete();
        // dd($user);
        $this->getFavorite();
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}
