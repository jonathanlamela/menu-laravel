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
        <li>I miei ordini</li>
    </ol>
@stop

@section('content')
    <div class="pl-8 pr-8 pt-8 flex flex-col space-y-4 pb-8 w-full flex-grow">
        <x-messages></x-messages>
        <div class="w-full pb-4">
            <p class="text-2xl antialiased font-bold">I miei ordini</p>
        </div>
        <div class="flex w-full bg-gray-100 p-2">
            <div class="w-full flex justify-end">
                <x-admin-search placeholder="Cerca un'ordine"></x-admin-search>
            </div>
        </div>
        <div class="flex w-full flex-grow">
            <table class="w-full lg:w-1/2 flex flex-col">
                <thead>
                    <tr class="h-10 flex flex-row items-center">
                        <th class="w-2/12 text-center">
                            <x-admin-order-toggler class="flex w-full flex-row space-x-1 justify-center" label="Codice"
                                field="id"></x-admin-order-toggler>
                        </th>
                        <th class="w-2/12 text-start">
                            <x-admin-order-toggler class="flex w-full flex-row space-x-1 justify-left" label="Totale"
                                field="total"></x-admin-order-toggler>
                        </th>
                        <th class="w-6/12 text-left">
                            <span class="flex w-full flex-row space-x-1 justify-left">
                                Stato ordine</span>
                        </th>
                        <th class="w-2/12 text-center">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $order)
                        <tr class="h-10 w-full odd:bg-gray-100 flex-row flex flex-grow">
                            <td class="w-2/12 text-center flex items-center justify-center">{{ $order->id }}
                            </td>
                            <td class="w-2/12 text-start flex items-center">{{ number_format($order->total_paid, 2) }} €
                            </td>
                            <td class="w-6/12 text-left flex items-center">{{ $order->orderState->name }}</td>
                            <td
                                class="w-2/12 text-center flex flex-row space-x-2 items-center content-center justify-center">
                                <a class="flex flex-row space-x-2 items-center justify-center p-2 hover:bg-green-700 hover:text-white"
                                    href="{{ route('order.view', ['order' => $order]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>

                                    <span class="hidden md:block">Mostra</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-full flex px-4 py-4">
            <x-admin-per-page></x-admin-per-page>
        </div>
        <div class="w-full flex px-4 py-4 bg-gray-100">
            {{ $data->links('globals.admin-paginator') }}
        </div>
    </div>
    </div>
@stop
