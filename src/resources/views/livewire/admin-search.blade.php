<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div class="admin-list__group">
        <h2 class="admin-list__heading">
            Administrator-list
        </h2>

        <div class="admin-search__group">
            <form class="admin-search__form" action="">
                <div class="admin-search__item">
                    <select class="admin-search__input" wire:model.live.debounce.500ms="roleSearch" name="roleSearch">
                        <option value="">全権限</option>
                        <option value="user">user</option>
                        @foreach($roles as $role)
                        <option value="{{ $role['id'] }}" @if( old('roleSearch') ==  $role['name']) selected @endif>
                            {{ $role['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-search__item">
                    <select class="admin-search__input" id="" wire:model.live.debounce.500ms="storeSearch" name="storeSearch">
                        <option value="" selected>全店舗</option>
                        @foreach($shops as $shop)
                        <option value="{{ $shop['id'] }}"
                        @if( old('storeSearch') ==  $shop['id']) selected @endif>
                            {{ $shop['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="word-search__item">
                    <img class="search-icon" src="../../images/search.svg" alt="">
                    <input class="word-search__input" type="text" name="wordSearch" placeholder="Search ..." wire:model.live.debounce.500ms="wordSearch" value="{{ request('wordSearch') }}">
                </div>
            </form>
        </div>

        <div class="admin-list__table-container">
            <table class="admin-list__table">
                <tr class="admin-list__table-row">
                    <th class="admin-list__table-heading">
                        No.
                    </th>
                    <th class="admin-list__table-heading">
                        Name
                    </th>
                    <th class="admin-list__table-heading">
                        Email
                    </th>
                    <th class="admin-list__table-heading">
                        権限
                    </th>
                    <th class="admin-list__table-heading">
                        担当店舗
                    </th>
                    <th class="admin-list__table-heading">
                    </th>
                </tr>

                @php
                    $list_item =($users->currentPage()-1)*$this->users->perPage()+1;
                @endphp

                @foreach($users as $user)
                <tr class="admin-list__table-row">
                    <td class="admin-list__table-item">
                        {{ $list_item }}
                    </td>
                    <td class="admin-list__table-item">
                        {{ $user['name'] }}
                    </td>
                    <td class="admin-list__table-item">
                        {{ $user['email'] }}
                    </td>
                    @forelse ($user->roles as $role)
                        <td class="admin-list__table-item">
                            {{ $role->name }}
                        </td>
                    @empty
                        <td class="admin-list__table-item">
                            user
                        </td>
                    @endforelse
                    @if ($user->shopRepresentative !== null)
                        <td class="admin-list__table-item">
                            @php
                            $shop = $shops->where('id', $user['shopRepresentative']['shop_id'])->first();
                            @endphp
                            {{ $shop['name'] }}
                        </td>
                    @else
                        <td class="admin-list__table-item">
                            -
                        </td>
                    @endif

                    @if ($user->roles->isEmpty())
                        <td class="admin-list__table-item">
                        </td>
                    @else
                        <td class="admin-list__table-item">
                            <button class="common-btn admin-delete__form-btn" wire:click="openModal({{$user['id']}})">削除</button>
                        </td>
                    @endif
                </tr>

                @php
                    $list_item+=1;
                @endphp

                @endforeach
            </table>
        </div>

        <div class="pagination__group">
            {{ $users->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>

        @if($showModal)
        <div class="modal__group" href="">
            <div class="modal-overlay" wire:click="closeModal()"></div>
            <div class="modal__inner">
                <div class="close-detail__modal">
                    <button class="close-detail__button" type="button" wire:click="closeModal()"><img class="close-detail__button-img" src="../../images/close-btn.svg" alt="閉じる"></button>
                </div>
                <div class="modal__content">
                    <p class="modal__content-text">このユーザーの権限を削除します。よろしいですか？</p>
                    <table class="modal-table">
                        <tr class="modal-table__row">
                            <th class="modal-table__header">name</th>
                            <td class="modal-table__item">{{ $delUser['name'] }}</td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__header">email</th>
                            <td class="modal-table__item">{{ $delUser['email'] }}</td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__header">権限</th>
                            <td class="modal-table__item">@foreach ($delUser->roles as $role){{ $role['name'] }}@endforeach</td>
                        </tr>
                    </table>
                    <button class="common-btn modal-btn" wire:click="remove()">削除</button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
