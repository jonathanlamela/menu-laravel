@extends('layouts')


@section('title', 'Checkout - indirizzo e orario')

@section('topbarLeft')
    <x-home-button></x-home-button>
@endsection

@section('topbarRight')
    <x-cart-button></x-cart-button>
    <x-account-manage></x-account-manage>
@endsection

@section('header')
    <x-header></x-header>
@endsection

@section('content')

    <div class="p-8">
        <div class="flex flex-col flex-grow space-y-4">
            <div class="w-full md:w-1/2">
                <a href="{{ route('checkout.step1') }}">
                    <h5 class="font-semibold text-lg  border-b-slate-300 border-b-2 pb-2">1. Spedizione e consegna</h5>
                </a>
            </div>
            <div class="w-full md:w-1/2">
                <form method="post" class="flex flex-col m-0 space-y-4" action="{{ route('checkout.step2') }}">
                    <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">2. Indirizzo e orario</h5>
                    @csrf
                    <p>Inserisci l'indirizzo e l'orario di consegna preferito</p>
                    <div class="flex flex-col space-y-2">
                        <label class="form-label">Indirizzo di consegna</label>
                        <input name="indirizzo" value="{{ session('indirizzo') ?? old('indirizzo') }}"
                            class="text-input @error('indirizzo') text-input-invalid @enderror" />
                        @error('indirizzo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label class="form-label">Orario di consegna</label>
                        <input name="orario" value="{{ session('orario') ?? old('orario') }}"
                            class="text-input @error('orario') text-input-invalid @enderror" />
                        @error('orario')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <button type="submit" class="btn-secondary-outlined w-20 h-10">Vai</button>
                    </div>
                </form>
            </div>
            <div class="w-full md:w-1/2">
                <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">3. Riepilogo</h5>
            </div>
        </div>
    </div>
@endsection


@section('nav')
    <ol class="breadcrumb-container">
        <li>
            <a class="breadcrumb-link" href="{{ route('cart.show') }}">
                Carrello
            </a>
        </li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('checkout.step1') }}">1. Tipo consegna</a>
        </li>
        <li>::</li>
        <li>
            <a>Informazioni consegna</a>
        </li>
    </ol>
@endsection
