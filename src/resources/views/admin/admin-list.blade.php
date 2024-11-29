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

@livewire('admin-search')

@endsection