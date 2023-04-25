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
    <x-header></x-header>
@endsection

@section('content')
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a class='text-light' href="{{ route('cart.show') }}">Carrello</a>
        </li>
        <li class="breadcrumb-item">
            <a class='text-light' href="{{ route('checkout.step1') }}">1. Tipologia consegna</a>
        </li>
        <li class=" breadcrumb-item active text-light" aria-current="page">2. Informazioni consegna</li>
    </x-breadcrumb>
    <div class="row g-0 flex-grow-1 p-4">
        <div class="col-lg-12 bg-light p-4 shadow d-flex justify-content-center flex-column">
            <a class="text-decoration-none" href="{{ route('checkout.step1') }}">
                <h5 class="m-0">1. Spedizione e consegna</h5>
            </a>
        </div>
        <div class="col-lg-12 bg-light p-4 shadow d-flex justify-content-center flex-column mt-2">
            <form method="post" class="col-lg-4" action="{{ route('checkout.step2') }}">
                <h5 class="m-0">2. Indirizzo e orario</h5>
                @csrf
                <p>Inserisci l'indirizzo e l'orario di consegna preferito</p>
                <div class="form-row mb-3">
                    <label>Indirizzo di consegna</label>
                    <input name="indirizzo" value="{{ session('indirizzo') ?? old('indirizzo') }}"
                        class="form-control @error('indirizzo') is-invalid @enderror">
                    @error('indirizzo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-row mb-3">
                    <label>Orario di consegna</label>
                    <input name="orario" value="{{ session('orario') ?? old('orario') }}"
                        class="form-control  @error('orario') is-invalid @enderror">
                    @error('orario')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-row">
                    <button type="submit" class="btn btn-success">Vai</button>
                </div>
            </form>
        </div>
        <div class="col-lg-12 bg-light p-4 shadow d-flex justify-content-center flex-column mt-2">
            <h5 class="m-0">3. Riepilogo</h5>
        </div>

    </div>
@endsection
