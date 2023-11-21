@extends('layout')

@section('title') Checkout 2 - Informazioni consegna @stop

@section('topbar')
    <div class="w-full bg-red-900 flex flex-col md:flex-row p-1">
        <div class="w-full md:w-3/4 flex p-2 justify-center md:justify-start">
            <x-search-form></x-search-form>
        </div>
        <div class="w-full md:w-1/4 flex flex-row p-2 justify-center md:justify-end">
            <x-cart-button></x-cart-button>
            <x-account-manage></x-account-manage>
        </div>
    </div>
@stop

@section('navHeader')
    <ol class="flex flex-row space-x-2 items-center pl-8 text-white h-16">
        <li>
            <a class="breadcrumb-link" href="{{ route('cart.show') }}">Carrello</a>
        </li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('checkout.step1') }}">1</a>
        </li>
        <li>::</li>
        <li>2</li>
    </ol>
@stop

@section('content')

    <div class="p-8 w-full">
        <div class="flex flex-col flex-grow">
            <div class="w-full md:w-1/3">
                <a href={{ route('checkout.step1') }}>
                    <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">1. Consegna ordine</h5>
                </a>
            </div>
            <div class="w-full md:w-1/3">
                <form class="flex flex-col m-0 space-y-4 pb-4" method="post" action="{{ route('checkout.step2') }}">
                    @csrf
                    <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">2. Indirizzo e orario</h5>
                    <p>Inserisci le informazioni di consegna. Salta questo passaggio se hai scelto il ritiro dell'ordine.
                    </p>
                    <div class="flex flex-col space-y-2">
                        <label class="form-label">Indirizzo</label>
                        <input type="text" name="delivery_address"
                            value="{{ old('delivery_address') ?? $delivery_address }}" class="text-input" />
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label class="form-label">Orario</label>
                        <input type="text" name="delivery_time" value="{{ old('delivery_time') ?? $delivery_time }}"
                            class="@if ($errors->has('delivery_time')) text-input-invalid @else text-input @endif" />
                        @error('delivery_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <button type="submit" class="btn-secondary-outlined">Vai</button>
                    </div>
                </form>
            </div>

            <div class="w-full md:w-1/3">
                <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">3. Riepilogo</h5>
            </div>
        </div>
    </div>
@stop
