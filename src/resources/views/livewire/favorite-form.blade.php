<div>
    {{-- Be like water. --}}
    <form class="store-list__favorite-form">
        @csrf
        <button wire:click="delete({{ $shop['id'] }})" wire:model.live="favoriteIn">
            <img class="store-list__favorite"
            src="{{ asset('/images/heart-red.svg') }}" alt="">
        </button>
    </form>
</div>
