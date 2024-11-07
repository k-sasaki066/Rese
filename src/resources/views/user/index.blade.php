@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/index.css')}}">
@endsection

@section('content')

@livewire('search')

@endsection