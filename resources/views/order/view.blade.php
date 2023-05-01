@extends('layouts')

@section('title', 'Pagamento ordine')

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


    <div class="pl-8 pr-8 flex flex-col py-4 space-y-4">
        <x-messages></x-messages>


        <div class="w-full">
            <h4 class='text-2xl antialiased font-sans'>Dettagli ordine #{{ $order->id }}</h4>
        </div>
        <div class="w-full flex flex-col">
            <b>Stato dell'ordine</b>
            <span>{{ $order->order_status->description }}</span>
        </div>
        @if (!$order->is_paid)
            <div class="w-full flex flex-col items-start">
                <b>Azioni sull'ordine</b>
                <a href="{{ route('ordini.paga', ['order' => $order]) }}" class="btn btn-sm btn-success">Paga ora</a>
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
        @if ($order->note)
            <div>
                <b>Note ordine</b>
                {{ $order->note }}
            </div>
        @endif

    </div>
@endsection


@section('nav')
    <div class="flex h-16">
        <ol class="breadcrumb-container">
            <li>
                <a class="breadcrumb-link" href="{{ route('account.dashboard') }}">Profilo</a>
            </li>
            <li>::</li>
            <li>
                <a class="breadcrumb-link" href="{{ route('ordini.list') }}">I miei ordini</a>
            </li>
            <li>::</li>
            <li>
                Ordine {{ $order->id }}
            </li>

        </ol>
    </div>

@endsection
