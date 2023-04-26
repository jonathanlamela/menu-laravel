@extends('layouts')

@section('title', 'Verifica account')

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
    <div class="flex h-16">
        <ol class="breadcrumb-container">
            <li>
                <a class="breadcrumb-link" href="/">
                    Profilo
                </a>
            </li>
            <li>::</li>
            <li>Account non verificato</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="px-8 pt-4">
        <x-messages></x-messages>
    </div>
    <div class='flex flex-grow justify-center items-center'>
        <div class="flex flex-col space-y-2 w-full md:w-1/2">
            <p>Il tuo account è stato creato, ma dobbiamo verificare che la mail sia realmente tua.
                Ti abbiamo inviato su ({{ request()->user()->email }}) un link da
                cliccare per verificare la tua email.</p>
            <div class="flex flex-row space-x-2">
                <form method="post" action="{{ route('verification.send') }}">
                    @csrf
                    <button class="btn btn-primary">Non ho ricevuto la mail</button>
                </form>
                <form method="post" class="m-0" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-secondary-outlined">Esci da questo account</button>
                </form>
            </div>

        </div>

    </div>

@endsection
