@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/editor/store-editor-form.css')}}">
<link rel="stylesheet" href="{{ asset('css/editor/menu-editor-form.css')}}">
@endsection

@section('content')
@if (session('result'))
    <div class="flash_success-message">
        {{ session('result') }}
    </div>
@endif
<div class="store-edit__group">
    <h2 class="store-edit__heading">
        メニュー登録
    </h2>
    <form class="store-edit__form" action="/editor/shop/menu" method="post">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $shop_id }}">
        <table class="store-edit__table">
            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    メニュー名<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input" type="text" name="name"
                    value="{{ old('name') }}" placeholder="メニュー名">
                    <div class="error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    価格（税抜）<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input" type="text" name="price" value="{{ old('price') }}" placeholder="例：1000">
                    <div class="error-message">
                    @error('price')
                    {{ $message }}
                    @enderror
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    説明<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <textarea class="store-edit__textarea" name="detail" rows="10">{{ old('detail')}}</textarea>
                    <div class="error-message">
                    @error('detail')
                    {{ $message }}
                    @enderror
                    </div>
                </td>
            </tr>
        </table>

        <div class="store-edit__btn-group">
            <a class="store-edit__btn" href="#editor">保存</a>
        </div>

        <div class="modal__group" id="editor">
            <a class="modal-overlay" href="#!"></a>
            <div class="modal__inner">
                <div class="close-detail__modal">
                    <a href="#!" class="close-detail__button"><img class="close-detail__button-img" src="../../images/close-btn.svg" alt="閉じる"></a>
                </div>
                <div class="modal__content">
                    <p class="modal__content-text">メニューを登録します。よろしいですか？</p>
                    <button class="common-btn modal-btn" type="submit">更新</button>
                </div>
            </div>
        </div>
    </form>

    <div class="menu-list__group">
        <h3 class="menu-list__heading">登録済みメニュー編集</h3>
        @if($menus->isEmpty())
        <p class="menu-info__text">登録済みのメニューはありません</p>
        @else
        @foreach($menus as $menu)
        <div class="menu-list__table-container">
            <table class="menu-list__table">
                <tr class="menu-list__table-row">
                    <th class="menu-list__table-heading">
                        メニュー名
                    </th>
                    <td class="menu-list__table-item">
                        {{ $menu['name'] }}
                    </td>
                    <td class="menu-list__table-btn" rowspan="3">
                        <div class="menu-btn__group">
                                <a class="menu-update__btn common-btn" href="#update{{ $menu['id'] }}">編集</a>
                                <a class="menu-delete__btn common-btn" href="#delete{{ $menu['id'] }}">削除</a>
                        </div>
                    </td>
                </tr>
                <tr class="menu-list__table-row">
                    <th class="menu-list__table-heading">
                        価格（税抜）
                    </th>
                    <td class="menu-list__table-item">
                        {{ $menu['price'] }}
                    </td>
                </tr>
                <tr class="menu-list__table-row">
                    <th class="menu-list__table-heading">
                        説明
                    </th>
                    <td class="menu-list__table-item">
                        {{ $menu['detail'] }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="modal__group" id="update{{ $menu['id'] }}">
            <a class="modal-overlay" href="#!"></a>
            <div class="modal__inner">
                <div class="close-detail__modal">
                    <a href="#!" class="close-detail__button"><img class="close-detail__button-img" src="../../images/close-btn.svg" alt="閉じる"></a>
                </div>
                <div class="modal__content">
                    <form class="menu-delete__form" action="/editor/shop/menu/update{{ $menu['id'] }}" method="post">
                        @csrf
                        @method('PATCH')
                        <table class="modal-table">
                            <tr class="modal-table__row">
                                <th class="modal-table__header">name</th>
                                <td class="modal-table__item">
                                    <input class="store-edit__input modal-input" type="text" name="editName" value="{{ $menu['name'] }}">
                                    <div class="error-message">
                                    @error('editName')
                                    {{ $message }}
                                    @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr class="modal-table__row">
                                <th class="modal-table__header">price</th>
                                <td class="modal-table__item">
                                    <input class="store-edit__input modal-input" type="text" name="editPrice" value="{{ $menu['price'] }}">
                                    <div class="error-message">
                                    @error('editPrice')
                                    {{ $message }}
                                    @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr class="modal-table__row">
                                <th class="modal-table__header">detail</th>
                                <td class="modal-table__item">
                                    <textarea class="store-edit__textarea modal-input" name="editDetail" rows="10">{{ $menu['detail']}}</textarea>
                                    <div class="error-message">
                                    @error('editDetail')
                                    {{ $message }}
                                    @enderror
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <p class="modal-update__text">メニューを更新します。よろしいですか？</p>
                        <button class="common-btn modal-update__btn" type="submit">更新</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal__group" id="delete{{ $menu['id'] }}">
            <a class="modal-overlay" href="#!"></a>
            <div class="modal__inner">
                <div class="close-detail__modal">
                    <a href="#!" class="close-detail__button"><img class="close-detail__button-img" src="../../images/close-btn.svg" alt="閉じる"></a>
                </div>
                <div class="modal__content">
                    <table class="modal-table">
                        <tr class="modal-table__row">
                            <th class="modal-table__header">name</th>
                            <td class="modal-table__item">{{ $menu['name'] }}</td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__header">price</th>
                            <td class="modal-table__item">{{ $menu['price'] }}</td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__header">detail</th>
                            <td class="modal-table__item">{{ $menu['detail'] }}</td>
                        </tr>
                    </table>
                    <p class="modal-delete__text">メニューを削除します。よろしいですか？</p>
                    <form class="menu-delete__form" action="/editor/shop/menu/delete{{ $menu['id'] }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="common-btn modal-delete__btn" type="submit">削除</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection