@extends('layout')

@section('title') {{ __('checkout.step_3_title') }} @stop



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
            <a class="breadcrumb-link" href="{{ route('cart.show') }}">{{ __('cart') }}</a>
        </li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('checkout.step1') }}">1</a>
        </li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('checkout.step2') }}">2</a>
        </li>
        <li>::</li>
        <li>3</li>
    </ol>
@stop

@section('content')
    <div class="p-8 w-full">
        <div class="flex flex-col flex-grow space-y-4">
            <div class="w-full md:w-1/2">
                <a href="{{ route('checkout.step1') }}">
                    <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">
                        {{ __('checkout.step_1_name') }}</h5>
                </a>
            </div>
            <div class="w-full md:w-1/2">
                <a href="{{ route('checkout.step2') }}">
                    <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">
                        {{ __('checkout.step_2_name') }}</h5>
                </a>
            </div>
            <div class="w-full md:w-1/2">
                <h5 class="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">
                    {{ __('checkout.step_3_name') }}</h5>
            </div>
            <div class="w-full md:w-1/2">
                <div class="flex flex-col space-y-4 pt-4">
                    <div class="w-full md:w-1/2">
                        <h6 class="uppercase font-semibold">{{ __('order.delivery_info') }}</h6>
                        <p>{{ $carrier->name }}</p>
                    </div>
                    <div class="w-full md:w-1/2">
                        <h6 class="uppercase font-semibold">{{ __('checkout.address_and_time') }}</h6>
                        <table class="w-full">
                            <tr>
                                <td class="font-medium">{{ __('order.delivery_address') }}</td>
                                <td>{{ $delivery_address }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium">{{ __('order.delivery_time') }}</td>
                                <td>{{ $delivery_time }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full ">
                        <h6 class="uppercase font-semibold pb-4">{{ __('checkout.order_details') }}</h6>
                        <div class="p-4 bg-slate-100">
                            <table class="flex flex-col">
                                <thead>
                                    <tr class="flex border-b">
                                        <th class="w-4/6 text-left">{{ __('checkout.food') }}</th>
                                        <th class="w-1/6 text-center">{{ __('checkout.quantity') }}</th>
                                        <th class="w-1/6 text-center">{{ __('checkout.price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <x-cart-row :cartItem="$item" :actions="false"></x-cart-row>
                                    @endforeach
                                    <tr class="flex border-b justify-center items-center py-2">
                                        <td class="w-4/6">{{ __('checkout.shipping_costs') }}</td>
                                        <td class="w-1/6 text-center">1</td>
                                        <td class="w-1/6 text-center">
                                            {{ number_format($carrier->costs, 2) }} €
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="flex border-b py-2">
                                        <td class="w-4/6 text-left"></td>
                                        <td class="w-1/6 text-center font-bold">{{ __('checkout.total') }}</td>
                                        <td class="w-1/6 text-center">{{ number_format($total + $carrier->costs, 2) }} €
                                        </td>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <form class="flex flex-col m-0" method="post" action="{{ route('order.create') }}">
                            @csrf
                            <div class="flex flex-col py-2">
                                <label class="form-label">{{ __('order.notes') }}</label>
                                <textarea name="note" class="text-input"></textarea>
                            </div>
                            <div class="flex flex-col py-2 items-start">
                                <button type="submit" class="btn-success">{{ __('checkout.send_order') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
