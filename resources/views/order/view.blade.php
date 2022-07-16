@extends('layouts')

@section('title', 'Pagamento ordine')

@section('topbar')
<div class="g-0 row">
    <div class="col-lg-12">
        <div class="row g-0 topbar-style">
            <div class="col-lg-4 d-flex justify-content-start align-items-center p-2">
            </div>
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4 d-flex justify-content-end align-items-center p-2 ">
                <x-cart-button></x-cart-button>
                <x-login></x-login>
            </div>
        </div>
    </div>
</div>
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
