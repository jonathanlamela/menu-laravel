@extends('layouts')

@section('title', 'Cassa')

@section('topbar')
    <x-topbar>
        <x-topbar-left>
        </x-topbar-left>
        <x-topbar-right>
            <x-cart-button></x-cart-button>
            <x-account-manage></x-account-manage>
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
            <a class='text-light' href="{{ route('cart.show') }}">Carrello</a>
        </li>
        <li class=" breadcrumb-item active text-light" aria-current="page">1. Spedizione e consegna</li>
    </x-breadcrumb>
    <div class="row g-0 p-4">
        <div class="col-lg-12 bg-light p-4 shadow">
            <form method="post" class="col-lg-4" action="{{ route('checkout.step1') }}">
                <h5 class="m-0">1. Spedizione e consegna</h5>
                @csrf
                <p>Scegli il modo in cui vuoi ricevere il tuo ordine</p>
                <div class="form-row mb-3">
                    <select class="form-control" name="tipoConsegna">
                        <option value="domicilio">Consegna a domicilio ({{ setting('shipping_costs', 0.0) }}€)</option>
                        <option value="asporto">Ritiro in negozio (asporto)</option>
                    </select>
                </div>
                <div class="form-row">
                    <button type="submit" class="btn btn-success">Vai</button>
                </div>
            </form>
        </div>
        <div class="col-lg-12 bg-light p-4 shadow d-flex justify-content-center flex-column mt-2">
            <h5 class="m-0">2. Indirizzo e orario</h5>
        </div>
        <div class="col-lg-12 bg-light p-4 shadow d-flex justify-content-center flex-column mt-2">
            <h5 class="m-0">3. Riepilogo</h5>
        </div>
    </div>
@endsection
