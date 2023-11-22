@extends('layout')

@section('title') {{ __('order.edit_title') }} @stop

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
            <span class="breadcrumb-link">{{ __('sections.sales') }}</span>
        </li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('admin.order.list') }}">{{ __('order.list_title') }}</a>
        </li>
        <li>::</li>
        <li>{{ __('order.edit_title') }}</li>
    </ol>
@stop

@section('content')
    <div class="pl-8 pr-8 pt-8 flex flex-col space-y-2 pb-8 w-full">
        <x-messages></x-messages>
        <div class="w-full">
            <p class="text-2xl antialiased font-bold">{{ __('order.edit_title') }} {{ $order->id }}</p>
        </div>
        <div class="flex flex-row lg:flex space-x-2">
            <div class="w-1/2 flex flex-col space-y-2">
                <div class="w-full border border-gray-200 flex flex-col space-y-2 items-center">
                    <x-admin-update-order-state :order="$order"></x-admin-update-order-state>
                </div>
                <div class="w-full border border-gray-200 flex flex-col space-y-2 items-center">
                    <x-admin-update-order-carrier :order="$order"></x-admin-update-order-carrier>
                </div>
            </div>
            <div class="w-1/2">
                <x-admin-update-delivery-info :order="$order"></x-admin-update-delivery-info>
            </div>
        </div>
        <div class="flex flex-col lg:hidden space-y-2">
            <div class="w-full lg:w-1/2 border border-gray-200 flex flex-col space-y-2 items-center">
                <x-admin-update-order-state :order="$order"></x-admin-update-order-state>
            </div>
            <div class="w-full lg:w-1/2 border border-gray-200 flex flex-col space-y-2 items-center">
                <x-admin-update-order-carrier :order="$order"></x-admin-update-order-carrier>
            </div>
            <x-admin-update-delivery-info :order="$order"></x-admin-update-delivery-info>
        </div>
        <div class="w-full flex">
            <div class="w-full border border-gray-200 p-2 flex flex-col space-y-2 items-center ">
                <x-admin-update-order-detail :order="$order" />
            </div>
        </div>
        <div class="w-full flex">
            <div class="w-full border border-gray-200 p-2 flex flex-col space-y-2 items-center ">
                <x-admin-update-order-note :order="$order" />
            </div>
        </div>
        <div class="w-full flex">
            <div class="w-full border border-gray-200 p-2 flex flex-col space-y-2 items-center ">
                <x-admin-update-order-summary :order="$order" />
            </div>
        </div>
    </div>
@stop
