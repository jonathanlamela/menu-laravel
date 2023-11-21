@extends('layout')

@section('title') {{ __('carrier.list_title') }} @stop

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
        <li>{{ __('account.sales') }}</li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('admin.carrier.list') }}">{{ __('carrier.list_title') }}</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="pl-8 pr-8 pt-8 flex flex-col space-y-4 pb-8 w-full flex-grow">
        <x-messages></x-messages>
        <div class="w-full pb-4">
            <p class="text-2xl antialiased font-bold">{{ __('carrier.list_title') }}</p>
        </div>
        <div class="flex w-full bg-gray-100 p-2">
            <div class="w-1/2">
                <div class="flex">
                    <a href={{ route('admin.carrier.create') }} class="btn-primary">{{ __('globals.create') }}</a>
                </div>
            </div>
            <div class="w-1/2 flex justify-end">
                <x-admin-search placeholder="Cerca un corriere"></x-admin-search>
            </div>
        </div>
        <div class="flex w-full flex-grow">
            <div class="w-full flex flex-col">
                <div class="hidden h-10 lg:flex flex-row items-center font-bold">
                    <div class="w-1/12 text-center">
                        <x-admin-order-toggler class="flex w-full flex-row space-x-1 justify-center"
                            label="{{ __('carrier.id') }}" field="id"></x-admin-order-toggler>
                    </div>
                    <div class="w-7/12 text-left">
                        <x-admin-order-toggler class="flex w-full flex-row space-x-1 justify-start"
                            label="{{ __('carrier.name') }}" field="name"></x-admin-order-toggler>
                    </div>
                    <div class="w-1/12 text-left">
                        <x-admin-order-toggler class="flex w-full flex-row space-x-1 justify-start"
                            label="{{ __('carrier.cost') }}" field="costs"></x-admin-order-toggler>
                    </div>
                    <div class="w-3/12 text-center">{{ __('globals.actions') }}</div>
                </div>
                <div>
                    @foreach ($data as $carrier)
                        <div class="w-full odd:bg-gray-100">
                            <div class="hidden lg:flex w-full flex-row flex-grow">
                                <div class="w-1/12 text-center flex items-center justify-center">{{ $carrier->id }}
                                </div>
                                <div class="w-7/12 text-start flex items-center">{{ $carrier->name }}</div>
                                <div class="w-1/12 text-start flex items-center">{{ number_format($carrier->cost, 2) }} €
                                </div>
                                <div
                                    class="w-3/12  text-center flex flex-row space-x-2 items-center content-center justify-center">
                                    <x-admin-edit-button :link="route('admin.carrier.edit', ['carrier' => $carrier])"></x-admin-edit-button>
                                    <x-admin-delete-button :link="route('admin.carrier.delete', ['carrier' => $carrier])"></x-admin-delete-button>
                                </div>
                            </div>

                            <div class="flex lg:hidden w-full flex-col p-8 space-y-4">
                                <div class="w-full flex flex-row space-x-4 items-center">
                                    <div class="w-1/4 font-bold text-end">{{ __('carrier.id') }}</div>
                                    <div class="w-3/4">{{ $carrier->id }}</div>
                                </div>
                                <div class="w-full flex flex-row space-x-4 items-center">
                                    <div class="w-1/4 font-bold text-end">{{ __('carrier.name') }}</div>
                                    <div class="w-3/4">{{ $carrier->name }}</div>
                                </div>
                                <div class="w-full flex flex-row space-x-4 items-center">
                                    <div class="w-1/4 font-bold text-end">{{ __('carrier.cost') }}</div>
                                    <div class="w-3/4">{{ number_format($carrier->cost, 2) }} €</div>
                                </div>
                                <div class="w-full flex flex-row space-x-4 items-center">
                                    <div class="w-1/4 font-bold text-end">{{ __('globals.actions') }}</div>
                                    <div class="w-3/4 flex flex-row">
                                        <x-admin-edit-button :link="route('admin.carrier.edit', ['carrier' => $carrier])"></x-admin-edit-button>
                                        <x-admin-delete-button :link="route('admin.carrier.delete', ['carrier' => $carrier])"></x-admin-delete-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
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
