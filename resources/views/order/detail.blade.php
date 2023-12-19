@extends('layout')

@section('title') {{ __('order.order_details') }} @stop

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
            <a class="breadcrumb-link" href="{{ route('account.index') }}">{{ __('account.profile') }}</a>
        </li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('order.list') }}">{{ __('account.my_orders') }}</a>
        </li>
        <li>::</li>
        <li>{{ __('order.order_details') }}</li>
    </ol>
@stop

@section('content')
    <div class="pl-8 pr-8 pt-8 flex flex-col space-y-4 pb-8 w-full flex-grow">
        <x-messages></x-messages>
        <div class="w-full">
            <p class="text-2xl antialiased font-bold">{{ __('globals.order') }} {{ $order->id }}</p>
        </div>
        <div class="w-full flex flex-col">
            <b>{{ __('order.order_state') }}</b>
            <span>{{ $order->orderState->name }}</span>
        </div>
        <div class="w-full flex flex-col">
            <b>{{ __('order.delivery_type') }}</b>
            <span>{{ $order->carrier->name }} - {{ __('carrier.cost') }} {{ number_format($order->carrier->costs, 2) }}
                €</span>
        </div>
        <div class="w-full flex flex-col">
            <b>{{ __('order.delivery_info') }}</b>
            <p class="flex flex-col">
                @if ($order->delivery_address != '')
                    <span>{{ __('order.delivery_address') }}: {{ $order->delivery_address }}</span>
                @endif
                <span>{{ __('order.delivery_time') }}: {{ $order->delivery_time }}</span>
            </p>
        </div>
        @if (!$order->is_paid)
            <div class="w-full flex flex-col">
                <p class="flex flex-col items-start">
                    <a href="{{ route('order.pay', ['order' => $order]) }}"
                        class="btn-success">{{ __('order.pay_now') }}</a>
                </p>
            </div>
        @endif

        <div class="w-full lg:w-1/3 flex flex-col">
            <b>{{ __('order.order_details') }}</b>
            <div class="p-4 bg-slate-100">
                <table class="p-4 w-full">
                    <thead>
                        <tr>
                            <th class="text-left">{{ __('order.detail_name') }}</th>
                            <th class="text-center" scope="col">{{ __('order.detail_quantity') }}</th>
                            <th class="text-center" scope="col">{{ __('order.detail_price') }}</th>
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
                                <b>{{ __('order.total') }}</b>
                            </td>
                            <td class="text-center">{{ number_format($order->total_paid, 2) }} €</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @if ($order->note)
            <div class="w-full lg:w-1/3 flex flex-col">
                <b>{{ __('order.notes') }}</b>
                <p>{{ $order->note }}</p>
            </div>
        @endif

    </div>
@stop
