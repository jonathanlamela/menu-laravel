@extends('layouts')

@section('title', 'Pagamento ordine')

@section('topbar')
<x-topbar>
    <x-topbar-left>
    </x-topbar-left>
    <x-topbar-right>
        <x-cart-button></x-cart-button>
        <x-login></x-login>
    </x-topbar-right>
</x-topbar>
@endsection

@section('header')
<div class="g-0 row">
    <x-header></x-header>
</div>
@endsection

@section('content')
<x-breadcrumb>
    <li class="breadcrumb-item">
        <a class='text-light' href="{{route('account.dashboard')}}">Profilo</a>
    </li>
    <li class="breadcrumb-item">
        <a class='text-light' href="{{route('ordini.list')}}">I miei ordini</a>
    </li>
    <li class="breadcrumb-item active text-light" aria-current="page">Ordine {{$order->id}}</li>
</x-breadcrumb>
<x-messages></x-messages>
<div class="row g-0 flex-grow-1">
    <div class="col-lg-12 p-4">
        <div class="row g-0">
            <h4>Ordine {{$order->id}}</h4>
        </div>
    </div>
</div>
@endsection
