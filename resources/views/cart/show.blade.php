@extends('layouts')

@section('title', 'Carrello')

@section('topbarLeft')
    <x-global-search-form></x-global-search-form>
@endsection

@section('topbarRight')
    <x-cart-button></x-cart-button>
    <x-account-manage></x-account-manage>
@endsection

@section('header')
    <x-header></x-header>
@endsection

@section('nav')
    <x-category-list></x-category-list>
@endsection

@section('content')
    <div class="flex p-8">
        <div class="w-full">

            @if (session('cart') && session('cart')['items'])
                <div class="flex flex-col">
                    <div class="w-full">
                        <table class="flex flex-col">
                            <thead>
                                <tr class='flex'>
                                    <th class="w-3/6 text-left">Cibo</th>
                                    <th class="w-1/6 text-center">Quantità</th>
                                    <th class="w-1/6 text-center">Prezzo</th>
                                    <th class="w-1/6 text-center">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($cart['items'] as $item)
                                    <x-cart-table-row :item="$item" :showAction="true"></x-cart-table-row>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class='flex text-center pt-2'>
                                    <td class="w-3/6"></td>
                                    <td class="w-1/6 font-semibold">Totale</td>
                                    <td class="w-1/6">{{ number_format(session('cart')['subtotal'], 2) }} €</td>
                                    <td class="w-1/6"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="w-full">
                        @if (auth()->user())
                            <div class="flex">
                                <a class="btn-success" href="{{ route('checkout.step1') }}">Vai
                                    alla cassa</a>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <p>Non ci sono elementi nel carrello</p>
            @endif
        </div>
    </div>

@endsection
