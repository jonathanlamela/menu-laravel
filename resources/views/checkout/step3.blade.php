@extends('layouts')

@section('title', 'Riepilogo ordine')

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
        @if (session('tipoConsegna') != 'asporto')
            <li class="breadcrumb-item">
                <a class='text-light' href="{{ route('checkout.step2') }}">2. Informazioni consegna</a>
            </li>
        @endif
        <li class=" breadcrumb-item active text-light" aria-current="page">Riepilogo</li>
    </x-breadcrumb>
    <div class="row g-0 flex-grow-1 p-4">
        <div class="col-lg-12 bg-light p-4 shadow">
            <a class="text-decoration-none" href="{{ route('checkout.step1') }}">
                <h5 class="m-0">1. Spedizione e consegna</h5>
            </a>
        </div>
        @if (session('tipoConsegna') != 'asporto')
            <div class="col-lg-12 bg-light p-4 shadow d-flex justify-content-center flex-column mt-2">
                <a class="text-decoration-none" href="{{ route('checkout.step2') }}">
                    <h5 class="m-0">2. Indirizzo e orario</h5>
                </a>
            </div>
        @endif
        <div class="col-lg-12 bg-light p-4 shadow d-flex justify-content-center flex-column mt-2">
            @if (session('tipoConsegna') != 'asporto')
                <h5>3. Riepilogo</h5>
            @else
                <h5>2. Riepilogo</h5>
            @endif
            <div class="col-lg-12">

                <div class="row g-0">
                    <h6>Consegna</h6>
                    @if (session('tipoConsegna') == 'asporto')
                        <p>Hai scelto di ritirare in negozio</p>
                    @else
                        <p>Hai scelto la consegna a domicilio</p>
                        <h6>
                            Indirizzo e orario
                        </h6>
                        <p>
                            {{ session('indirizzo') }}<br />
                            Ore: {{ session('orario') }}
                        </p>
                    @endif
                </div>
                <div class="row g-0">
                    <h6>Cosa c'è nel tuo ordine</h6>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Cibo</th>
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
                                    <td class="">Consegna</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">{{ setting('shipping_costs', 0.0) }} €</td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td class="text-center"><b>Totale</b></td>
                                @if (session('tipoConsegna') == 'asporto')
                                    <td class="text-center">{{ number_format(session('cart')['subtotal'], 2) }} €</td>
                                @else
                                    <td class="text-center">
                                        {{ number_format(session('cart')['subtotal'] + setting('shipping_costs', 0.0), 2) }} €
                                    </td>
                                @endif
                            </tr>
                        </tfoot>
                    </table>

                </div>
                <div class="row g-0">
                    <form method="post" class="col-lg-4" action="{{ route('checkout.step3') }}">
                        @csrf
                        <div class="form-row mb-3">
                            <label>Note sull'ordine</label>
                            <textarea name="note" class="form-control">
                    </textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Invia ordine</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
