@extends('layouts')

@section('title', 'Checkout - spedizione e consegna')

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
                <form method="post" action="{{ route('checkout.step1') }}" class="w-full m-0 flex flex-col space-y-2">
                    @csrf
                    <h5 class="font-semibold text-lg  border-b-slate-300 border-b-2 pb-2">1. Spedizione e consegna</h5>
                    <p>Scegli il modo in cui vuoi ricevere il tuo ordine</p>
                    <select class="text-input" name="tipoConsegna">
                        <option value="domicilio">Consegna a domicilio ({{ $shippingSettings->shipping_costs }}€)</option>
                        <option value="asporto">Ritiro in negozio (asporto)</option>
                    </select>
                    <div class="w-full">
                        <button type="submit" class="btn-secondary-outlined w-20 h-10">Vai</button>
                    </div>
                </form>
            </div>
            <div class="w-full md:w-1/2">
                <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">2. Indirizzo e orario</h5>
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
        <li>Tipo consegna</li>
    </ol>
@endsection
