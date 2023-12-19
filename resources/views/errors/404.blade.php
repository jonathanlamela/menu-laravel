@extends('layout')

@section('title') {{ __('globals.page_not_founded') }} @stop



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
            <a class="breadcrumb-link" href="{{ route('home') }}">{{ __('globals.home') }}</a>
        </li>
        <li>::</li>
        <li>{{ __('globals.page_not_founded') }}</li>
    </ol>
@stop

@section('content')
    <div class="flex items-center justify-center flex-grow">
        <div class="flex flex-col items-center space-y-4">
            <div class="flex flex-col items-center space-y-4 animate-bounce">
                <span class="text-3xl">404</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                    stroke="currentColor" class="w-12 h-12 ">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                </svg>
            </div>
            <p>{{ __('globals.page_not_founded_text') }}</p>
        </div>
    </div>
@stop
