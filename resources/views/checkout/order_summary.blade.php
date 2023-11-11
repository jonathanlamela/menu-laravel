@extends('layout')

@section('title')
    @if ($delivery_type == 'ASPORTO')
        Checkout 2 - Riepilogo ordine
    @else
        Checkout 3 - Riepilogo ordine
    @endif
@stop



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
        @if ($delivery_type == 'ASPORTO')
            <li>
                3
            </li>
        @else
            <li>
                <a class="breadcrumb-link" href="{{ route('checkout.step2') }}">2</a>
            </li>
            <li>::</li>
            <li>3</li>
        @endif
    </ol>
@stop

@section('content')
    <div class="p-8">
        <div class="flex flex-col flex-grow space-y-4">
            <div class="w-full md:w-1/2">
                <a href="{{ route('checkout.step1') }}">
                    <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">1. Tipologia consegna</h5>
                </a>
            </div>
            <div class="w-full md:w-1/2">
                <a href="{{ route('checkout.step2') }}">
                    <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">2. Indirizzo e orario</h5>
                </a>
            </div>
            <div class="w-full md:w-1/2">
                <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">3. Riepilogo</h5>
            </div>
            <div class="w-full md:w-1/2">
                <div class="flex flex-col space-y-4 pt-4">
                    <div class="w-full md:w-1/2">
                        <h6 class="uppercase font-semibold">Informazioni di consegna</h6>
                        @if ($delivery_type == 'ASPORTO')
                            <p>Hai scelto di ritirare il tuo ordine (asporto)
                            </p>
                        @else
                            <p>Hai scelto la consegna a domicilio</p>
                        @endif
                    </div>
                    @if ($delivery_type == 'DOMICILIO')
                        <div class="w-full md:w-1/2">
                            <h6 class="uppercase font-semibold">Indirizzo e orario</h6>
                            <table class="w-full">
                                <tr>
                                    <td class="font-medium">Indirizzo</td>
                                    <td>{{ $delivery_address }}</td>
                                </tr>
                                <tr>
                                    <td class="font-medium">Orario</td>
                                    <td>{{ $delivery_time }}</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                    <div class="w-full ">
                        <h6 class="uppercase font-semibold pb-4">Cosa c'è nel tuo ordine</h6>
                        <div class="p-4 bg-slate-100">
                            <table class="flex flex-col">
                                <thead>
                                    <tr class="flex border-b">
                                        <th class="w-4/6 text-left">Cibo</th>
                                        <th class="w-1/6 text-center">Quantità</th>
                                        <th class="w-1/6 text-center">Prezzo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <x-cart-row :cartItem="$item" :actions="false"></x-cart-row>
                                    @endforeach
                                    @if ($delivery_type == 'DOMICILIO')
                                        <tr class="flex border-b justify-center items-center py-2">
                                            <td class="w-4/6">Spese di consegna</td>
                                            <td class="w-1/6 text-center">1</td>
                                            <td class="w-1/6 text-center">
                                                {{ number_format($settings['shipping_costs'], 2) }} €
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr class="flex border-b py-2">
                                        <td class="w-4/6 text-left"></td>
                                        <td class="w-1/6 text-center font-bold">Totale</td>
                                        @if ($delivery_type == 'DOMICILIO')
                                            <td class="w-1/6 text-center">
                                                {{ number_format($total + $settings['shipping_costs'], 2) }} €</td>
                                        @else
                                            <td class="w-1/6 text-center">{{ number_format($total, 2) }} €</td>
                                        @endif
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <form class="flex flex-col m-0" method="post" action="{{ route('orders.create') }}">
                            <div class="flex flex-col py-2">
                                <label class="form-label">Note</label>
                                <textarea name="note" class="text-input"></textarea>
                            </div>
                            <div class="flex flex-col py-2 items-start">
                                <button type="submit" class="btn-success">Invia ordine</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
