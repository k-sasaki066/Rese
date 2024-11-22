@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin-list.css')}}">
@endsection

@section('content')
@if (session('result'))
    <div class="flash_success-message">
        {{ session('result') }}
    </div>
@endif

<div class="admin-list__group">
    <h2 class="admin-list__heading">
        Administrator-list
    </h2>
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
                Role
            </th>
            <th class="admin-list__table-heading">
                担当店舗
            </th>
        </tr>

        @php
            $list_item =($users->currentPage()-1)*$users->perPage()+1;
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
            @if ($user->shop !== null)
                <td class="admin-list__table-item">
                    {{ $user['shop']['name'] }}
                </td>
            @else
                <td class="admin-list__table-item">
                    -
                </td>
            @endif
        </tr>

        @php
            $list_item+=1;
        @endphp

        @endforeach
    </table>
    
    <div class="pagination__group">
        {{ $users->appends(request()->query())->links('vendor.pagination.custom') }}
    </div>

</div>
@endsection