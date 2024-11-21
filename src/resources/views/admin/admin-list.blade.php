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
                Shop
            </th>
            <th class="admin-list__table-heading">
                Role
            </th>
        </tr>
        <tr class="admin-list__table-row">
            <td class="admin-list__table-item">
                1
            </td>
            <td class="admin-list__table-item">
                test
            </td>
            <td class="admin-list__table-item">
                test@test.com
            </td>
            <td class="admin-list__table-item">
                test
            </td>
            <td class="admin-list__table-item">
                test
            </td>
        </tr>
        <tr class="admin-list__table-row">
            <td class="admin-list__table-item">
                1
            </td>
            <td class="admin-list__table-item">
                test
            </td>
            <td class="admin-list__table-item">
                test@test.com
            </td>
            <td class="admin-list__table-item">
                test
            </td>
            <td class="admin-list__table-item">
                test
            </td>
        </tr>
    </table>
</div>
@endsection