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
            <h4 class='text-2xl antialiased font-sans'>I miei ordini</h4>
        </div>
        @if (count($orders) > 0)
            <div class="w-full">

                <div class="flex flex-row">
                    @foreach ($orders as $row)
                        <a href="{{ route('ordini.view', ['order' => $row->id]) }}">
                            <div class="w-full md:w-1/3 bg-red-100/30 p-4 shadow">
                                <div class="flex flex-col space-y-2">
                                    <p class="font-bold">Ordine #{{ $row->id }}</p>
                                    <div class="flex flex-row items-center">
                                        <div class="w-1/3 flex font-semibold">
                                            <p>Stato</p>
                                        </div>
                                        <div class="w-2/3 flex items-center justify-end">
                                            <span>{{ $row->order_status->description }}</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-row items-center">
                                        <div class="w-1/3 flex font-semibold">
                                            <p>Totale</p>
                                        </div>
                                        <div class="w-2/3 flex items-center justify-end">
                                            <span>{{ number_format($row->subtotal, 2) }} €</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-row items-center">
                                        <a class="underline text-red-900"
                                            href="{{ route('ordini.view', ['order' => $row->id]) }}">
                                            Dettaglio ordine
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <div class="w-full">
                <p>Non ci sono ordini</p>
            </div>
        @endif
    </div>
@endsection



@section('nav')
    <div class="flex">
        <ol class="breadcrumb-container">
            <li>
                <a class="breadcrumb-link" href="{{ route('account.dashboard') }}">
                    Profilo
                </a>
            </li>
            <li>::</li>
            <li>I miei ordini</li>
        </ol>
    </div>
@endsection
