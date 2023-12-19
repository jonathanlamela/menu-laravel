@extends('layout')

@section('title') {{ __('cart.index_title') }} @stop

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
            <a class="breadcrumb-link">{{ __('cart.index_title') }}</a>
        </li>
        <li>::</li>
        <li>{{ __('cart.your_cart') }}</li>
    </ol>
@stop

@section('content')
    <div class="flex flex-col p-8 w-full">
        @if (count($cart->items) > 0)
            <div class="flex flex-col">
                <div class="w-full">
                    <table class="flex flex-col">
                        <thead>
                            <tr class='flex'>
                                <th class="w-3/6 text-left">{{ __('cart.food') }}</th>
                                <th class="w-1/6 text-center">{{ __('cart.quantity') }}</th>
                                <th class="w-1/6 text-center">{{ __('cart.price') }}</th>
                                <th class="w-1/6 text-center">{{ __('globals.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart->items as $item)
                                <x-cart-row :cartItem="$item"></x-cart-row>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class='flex text-center pt-2'>
                                <td class="w-3/6"></td>
                                <td class="w-1/6 font-semibold">{{ __('cart.total') }}</td>
                                <td class="w-1/6">{{ number_format($cart->total(), 2) }} €</td>
                                <td class="w-1/6"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="w-full">
                    <x-checkout-button></x-checkout-button>
                </div>
            </div>
        @else
            <p>{{ __('cart.cart_empty') }}</p>
        @endif
    </div>
@stop
