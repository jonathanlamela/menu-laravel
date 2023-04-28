@extends('layouts')

@section('title', 'Checkout - riepilogo')

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
                <a href="{% url 'vendite_cassa_consegna' %}">
                    <h5 class="font-semibold text-lg  border-b-slate-300 border-b-2 pb-2">1. Spedizione e consegna</h5>
                </a>
            </div>
            @if (session('tipoConsegna') != 'asporto')
                <div class="w-full md:w-1/2">
                    <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2"><a
                            href="{{ route('checkout.step2') }}">2. Indirizzo e orario</a></h5>
                </div>
            @endif
            <div class="w-full md:w-1/2">
                @if (session('tipoConsegna') != 'asporto')
                    <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">3. Riepilogo</h5>
                @else
                    <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">2. Riepilogo</h5>
                @endif
                <div class="flex flex-col space-y-4 pt-4">
                    <div class="w-full flex flex-col space-y-4">
                        @if (session('tipoConsegna') == 'asporto')
                            <p>Hai scelto di ritirare in negozio</p>
                        @else
                            <p>Hai scelto la consegna a domicilio</p>
                            <div>
                                <h6 class="uppercase font-semibold">Indirizzo e orario</h6>
                                <table class="w-full">
                                    <tr>
                                        <td class="font-medium">Indirizzo</td>
                                        <td>{{ session('indirizzo') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">Orario</td>
                                        <td>{{ session('orario') }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="w-full flex flex-col space-y-4">
                        <h6 class="uppercase font-semibold">Cosa c'è nel tuo ordine</h6>
                        <div class="p-4 bg-slate-100">
                            <table class="p-4 w-full">
                                <thead>
                                    <tr>
                                        <th class="text-left">Cibo</th>
                                        <th class="text-center" scope="col">Quantità</th>
                                        <th class="text-center" scope="col">Prezzo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart['items'] as $item)
                                        <tr class="align-middle">
                                            <td class="">{{ $item['name'] }}</td>
                                            <td class="text-center">{{ $item['quantity'] }}</td>
                                            <td class="text-center">{{ number_format($item['price'], 2) }} €</td>
                                        </tr>
                                    @endforeach


                                    @if (session('tipoConsegna') != 'asporto')
                                        <tr class="align-middle">
                                            <td>Consegna</td>
                                            <td class="text-center">1</td>
                                            <td class="text-center">
                                                {{ number_format($shippingSettings->shipping_costs ?? 0, 2) }} €</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td class="text-center">
                                            <b>Totale</b>
                                        </td>
                                        @if (session('tipoConsegna') == 'asporto')
                                            <td class="text-center">{{ number_format(session('cart')['subtotal'], 2) }} €
                                            </td>
                                        @else
                                            <td class="text-center">
                                                {{ number_format(session('cart')['subtotal'] + ($shippingSettings->shipping_costs ?? 0), 2) }}
                                                €</td>
                                        @endif
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="w-full">
                        <form method="post" class="m-0 flex flex-col space-y-4" action="{{ route('checkout.step3') }}">
                            @csrf
                            <div class="flex flex-col space-y-4">
                                <label class="form-label">
                                    Note sull'ordine
                                </label>
                                <textarea name="note" class="text-input">
                            </textarea>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success">
                                    Invia ordine
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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
        @if (session('tipoConsegna') != 'asporto')
            <li>::</li>
            <li>
                <a class="breadcrumb-link" href="{{ route('checkout.step2') }}">2.Informazioni consegna</a>
            </li>
            <li>::</li>
            <li>
                3. Riepilogo
            </li>
        @else
            <li>::</li>
            <li>
                2. Riepilogo
            </li>
        @endif

    </ol>
@endsection
