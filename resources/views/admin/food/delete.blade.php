@extends('layout')

@section('title') {{ __('food.delete_title') }} @stop

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
        <li>{{ __('sections.catalog') }}</li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('admin.food.list') }}">{{ __('food.list_title') }}</a>
        </li>
        <li>::</li>
        <li>
            {{ __('food.delete_title') }}
        </li>
    </ol>
@stop

@section('content')
    <div class="pl-8 pr-8 pt-8 flex flex-col space-y-4 pb-8 w-full">
        <x-messages></x-messages>
        <div class="w-full">
            <p class="text-2xl antialiased font-bold">Elimina cibo "{{ $food->name }}"</p>
        </div>
        <form class="flex-col space-y-2" method="post" action="{{ route('admin.food.destroy', ['food' => $food]) }}">
            @csrf
            <p>Stai per eliminare il seguente cibo: <b>{{ $food->name }}</b>. Sei sicuro di volerlo fare?</p>
            <button type="submit" class="btn-success">
                {{ __('globals.delete') }}
            </button>
        </form>
    </div>
@stop
