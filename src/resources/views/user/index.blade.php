@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/index.css')}}">
@endsection

@section('content')

@if (session('result'))
    <div class="flash_success-message">
        {{ session('result') }}
    </div>
@endif

@livewire('search')

@endsection