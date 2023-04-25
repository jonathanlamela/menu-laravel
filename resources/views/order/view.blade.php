@extends('layouts')

@section('title', 'Pagamento ordine')

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
            <a class='text-light' href="{{ route('account.dashboard') }}">Profilo</a>
        </li>
        <li class="breadcrumb-item">
            <a class='text-light' href="{{ route('ordini.list') }}">I miei ordini</a>
        </li>
        <li class="breadcrumb-item active text-light" aria-current="page">Ordine {{ $order->id }}</li>
    </x-breadcrumb>
    <x-messages></x-messages>
    <div class="row g-0 flex-grow-1">
        <div class="col-lg-12 p-4">
            <div class="row g-0">
                <h4>Ordine {{ $order->id }}</h4>
            </div>
            <div class="row g-0">
                <p>
                    <b>Stato dell'ordine</b>
                    <br />
                    <span class="">{{ $order->order_status }}</span>
                </p>
                @if (!$order->is_paid)
                    <p>
                        <b>Azioni sull'ordine</b>
                        <br />
                        <a href="{{ route('ordini.paga', ['order' => $order]) }}" class="btn btn-sm btn-success">Paga ora</a>
                    </p>
                @endif
            </div>
            <div class="row g-0">
                <b>Cosa c'è nel tuo ordine</b>
            </div>
            <div class="row g-0">
                <div class="col-lg-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Cibo</th>
                                <th class="text-center" scope="col">Prezzo unitario</th>
                                <th class="text-center" scope="col">Prezzo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->order_details as $item)
                                <tr class="align-middle">
                                    <td>{{ $item->quantity }}x {{ $item->name }}</td>
                                    <td class="text-center">{{ number_format($item->unit_price, 2) }} €</td>
                                    <td class="text-center">{{ number_format($item->price, 2) }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td class="text-center">
                                    <b>Totale</b>
                                </td>
                                <td class="text-center">{{ number_format($order->subtotal, 2) }} €</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
