@extends('layout')

@section('title') {{ $category->name }} @stop



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
    <x-category-pills></x-category-pills>
@stop

@section('content')

    <div class="flex flex-col p-8 w-full">
        <div class="w-full pb-4">
            <h4 class="font-bold text-lg">Categoria {{ strtolower($category->name) }}</h4>
        </div>
        <div class="w-full space-y-4">
            @if (count($foods) == 0)
                <p>Non ci sono cibi per questa categoria</p>
            @endif
            @foreach ($foods as $food)
                <div class="flex flex-row">
                    <div class="w-3/4">
                        <div class="flex flex-col">
                            <div>{{ $food->name }}</div>
                            <div class="font-extralight text-sm">{{ $food->ingredients }}</div>
                        </div>
                    </div>
                    <div class="w-1/4">
                        <div class="flex justify-end items-center space-x-2">
                            <span class="font-light antialiased">{{ number_format($food->price, 2) }} €</span>
                            <x-add-to-cart-button :item="$food"></x-add-to-cart-button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@stop
