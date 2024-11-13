<div>
    {{-- Be like water. --}}
    @if(Auth::check())
        @if(in_array($shop['id'], $favorites))
            <form class="store-list__favorite-form">
                @csrf
                <button wire:click="delete({{ $shop['id'] }})">
                    <img class="store-list__favorite"
                    src="../images/heart-red.svg" alt="">
                </button>
            </form>
        @else
            <form class="store-list__favorite-form">
                @csrf
                <button wire:click="favorite({{ $shop['id'] }})">
                    <img class="store-list__favorite" src="../images/heart.svg" alt="">
                </button>
            </form>
        @endif
    @else
    <button class="login-information" wire:click="openModal()">
        <img class="store-list__favorite" src="../images/heart.svg" alt="">
    </button>
    @endif

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
