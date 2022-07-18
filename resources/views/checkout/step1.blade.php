@extends('layouts')

@section('title', 'Cassa')

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
<x-breadcrumb>
    <li class="breadcrumb-item">
        <a class='text-light' href="{{route("cart.show")}}">Carrello</a>
    </li>
    <li class=" breadcrumb-item active text-light" aria-current="page">Spedizione e consegna</li>
</x-breadcrumb>
<div class="row g-0 flex-grow-1 p-4">
    <form method="post" class="col-lg-4" action="{{route('checkout.step1')}}">
        @csrf
        <p>Scegli il modo in cui vuoi ricevere il tuo ordine</p>
        <div class="form-row mb-3">
            <select class="form-control" name="tipo_consegna">
                <option value="domicilio">Consegna a domicilio (+2€)</option>
                <option value="asporto">Ritiro in negozio (asporto)</option>
            </select>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-success">Vai</button>
        </div>
    </form>
</div>
@endsection
