@extends('layout')

@section('title') I miei ordini @stop

@section('topbar')
    <div class="w-full bg-red-900 flex flex-col md:flex-row p-1">
        <div class="w-full md:w-3/4 flex p-2 justify-center md:justify-start">
            <x-home-button></x-home-button>
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
            <a class="breadcrumb-link" href="{{ route('account.index') }}">Profilo</a>
        </li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('orders.list') }}">I miei ordini</a>
        </li>
        <li>::</li>
        <li>Dettaglio ordine</li>
    </ol>
@stop

@section('content')
    <div class="pl-8 pr-8 pt-8 flex flex-col space-y-4 pb-8 flex-grow">
        <x-messages></x-messages>
        <div class="w-full">
            <p class="text-2xl antialiased font-bold">Ordine {{ $order->id }}</p>
        </div>
        <div class="w-full flex flex-col">
            <b>Stato dell'ordine</b>
            <span>{{ $order->orderState->name }}</span>
        </div>
        <div class="w-full flex flex-col">
            <b>Informazioni sulla consegna</b>
            @if ($order->is_shipping)
                <span>Consegna a domicilio</span>
            @else
                <span>Asporto</span>
            @endif
        </div>
        @if ($order->is_shipping)
            <div class="w-full flex flex-col">
                <b>Dettagli sulla consegna</b>
                <p class="flex flex-col">
                    <span>Indirizzo: {{ $order->delivery_address }}</span>
                    <span>Orario: {{ $order->delivery_time }}</span>
                </p>
            </div>
        @endif
        <div class="w-full lg:w-1/3 flex flex-col">
            <b>Cosa c'è nel tuo ordine</b>
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
                        @foreach ($order->orderDetails as $row)
                            <tr class="align-middle" key={row.id}>
                                <td>{{ $row->name }}</td>
                                <td class="text-center">{{ $row->quantity }}</td>
                                <td class="text-center">{{ number_format($row->unit_price, 2) }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td class="text-center">
                                <b>Totale</b>
                            </td>
                            <td class="text-center">{{ number_format($order->total, 2) }} €</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @if ($order->note)
            <div class="w-full lg:w-1/3 flex flex-col">
                <b>Note</b>
                <p>{{ $order->note }}</p>
            </div>
        @endif

    </div>
@stop
