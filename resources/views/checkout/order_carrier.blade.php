@extends('layout')

@section('title') Checkout 1 - Tipologia consegna @stop



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
        <li>1</li>
    </ol>
@stop

@section('content')
    <div class="p-8">
        <div class="flex flex-col flex-grow space-y-4">
            <div class="w-full md:w-1/3">
                <form class="w-full m-0 flex flex-col space-y-2" method="post" action="{{ route('checkout.step1') }}">
                    @csrf
                    <h5 class="font-semibold text-lg  border-b-slate-300 border-b-2 pb-2">1. Consegna ordine</h5>
                    <p>Scegli il modo in cui vuoi ricevere il tuo ordine</p>
                    <select name="carrier_id"
                        class="@if ($errors->has('carrier_id')) text-input-invalid @else text-input @endif">
                        <option value="">-- Seleziona un corriere --</option>
                        @foreach ($carriers as $carrier)
                            <option value="{{ $carrier->id }}" @if ($carrier_id == $carrier->id) selected @endif>
                                {{ $carrier->name }} ({{ number_format($carrier->costs, 2) }} €)</option>
                        @endforeach
                    </select>
                    @error('carrier_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="w-full">
                        <button type="submit" class="btn-secondary-outlined w-20 h-10">Vai</button>
                    </div>
                </form>
            </div>
            <div class="w-full md:w-1/3">
                <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">2. Indirizzo e orario</h5>
            </div>
            <div class="w-full md:w-1/3">
                <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">3. Riepilogo</h5>
            </div>
        </div>
    </div>
@stop
