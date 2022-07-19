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
<div class="row g-0 flex-grow-1">
    <div class="col-lg-12 p-4">
        @if(session()->has('success_message'))
        <div class="row g-0">
            <div class="alert alert-success" role="alert">
                {{session('success_message')}}
            </div>
        </div>
        @endif
        <div class="row g-0">
            <h4>Ordine {{$order->id}}</h4>
        </div>
    </div>
</div>
@endsection
