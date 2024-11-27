<div>
    {{-- Do your work, then step back. --}}
    <div class="store-search__group">
        <form class="store-search__form common-shadow" wire:submit="render">
            @csrf
            <div class="store-search__item">
                <select class="store-search__input" wire:model.live.debounce.500ms="areaSearch" name="areaSearch">
                    <option value="">All area</option>
                    @foreach($areas as $area)
                    <option value="{{ $area['area_id'] }}" @if( old('areaSearch') ==  $area['area_id']) selected @endif>
                        {{ $area['area']['name'] }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="store-search__item">
                <select class="store-search__input" id="" wire:model.live.debounce.500ms="genreSearch" name="Search">
                    <option value="" selected>All genre</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre['genre_id'] }}"
                    @if( old('genreSearch') ==  $genre['genre_id']) selected @endif>
                        {{ $genre['genre']['name'] }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="word-search__item">
                <img class="search-icon" src="../images/search.svg" alt="">
                <input class="word-search__input" type="text" name="wordSearch" placeholder="Search ..." wire:model.live.debounce.500ms="wordSearch" value="{{ request('wordSearch') }}">
            </div>
        </form>
    </div>

    <div class="store-list__group">
        @foreach($shops as $shop)
        <div class="store-list__item common-shadow">
            <img class="store-list__img" src="{{$shop['image_url']}}" alt="店舗画像">
            <div class="store-list__text">
                <p class="store-list__name">
                    {{ $shop['name'] }}
                </p>
                <div class="store-list__tag">
                    <span class="store-list__area-tag">
                        #{{ $shop['area']['name'] }}
                    </span>
                    <span class="store-list__genre-tag">
                        #{{ $shop['genre']['name'] }}
                    </span>
                </div>
                <div class="store-list__form">
                    <form class="store-list__detail-form" action="/detail/{{ $shop['id']}}" method="get">
                        @csrf
                        <button class="common-btn store-list__detail-btn" type="submit">
                            詳しくみる
                        </button>
                    </form>
                    @if(Auth::check())
                    <?php $favoriteIn = Auth::user()->favorites()->where('shop_id', $shop['id'])->exists();?>
                        @if($favoriteIn)
                                <button wire:click="delete({{ $shop['id'] }})"
                                wire:model.live= "favoriteIn">
                                    <img class="store-list__favorite"
                                    src="../images/heart-red.svg" alt="">
                                </button>
                        @elseif(!$favoriteIn)
                                <button wire:click="favorite({{ $shop['id'] }})"
                                wire:model.live= "favoriteIn">
                                    <img class="store-list__favorite" src="../images/heart.svg" alt="">
                                </button>
                        @endif
                    @else
                        <button class="login-information" wire:click="openModal()">
                            <img class="store-list__favorite" src="../images/heart.svg" alt="">
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($showModal)
        <div class="modal__inner">
            <div class="close-detail__modal">
                <button class="close-detail__button" type="button" wire:click="closeModal()"><img class="close-detail__button-img" src="../images/close-btn.svg" alt="閉じる"></button>
            </div>
            <div class="modal__content">
                <p class="modal__content-text">お気に入り機能を使用するにはログインが必要です</p>
                <div class="modal-btn__group">
                    <a class="common-btn modal-btn" href="/register">会員登録</a>
                    <a class="common-btn modal-btn" href="/login">ログイン</a>
                </div>
            </div>
        </div>
    @endif
</div>
