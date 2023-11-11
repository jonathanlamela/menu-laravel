@extends('layout')

@section('title') Conferma la tua email @stop

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
            <a class="breadcrumb-link">Account</a>
        </li>
        <li>::</li>
        <li>Crea account</li>
    </ol>
@stop

@section('content')

    <div class="px-8 pt-8">
        <x-messages></x-messages>
    </div>

    <div class='flex flex-grow flex-col justify-center items-center'>
        <div class='flex flex-grow justify-center items-center'>
            <div class="flex flex-col space-y-2 w-full md:w-1/2">
                <p>Il tuo account è stato creato, ma dobbiamo verificare che la mail sia realmente tu.
                    Ti abbiamo inviato su {{ auth()->user()->email }} un link da
                    cliccare per verificare la tua email.</p>
                <div class="flex flex-row space-x-2">
                    <form method="post" action="{{ route('verification.send') }}">
                        @csrf
                        <button class="btn btn-primary">Non ho ricevuto la mail</button>
                    </form>
                    <form class="m-0" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-secondary-outlined">Esci da questo account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
