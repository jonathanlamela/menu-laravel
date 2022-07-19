@extends('layouts')

@section('title', 'Verifica account')

@section('topbar')
<x-topbar>
    <x-topbar-left>
        <x-home-button></x-home-button>
    </x-topbar-left>
    <x-topbar-right>
        <x-cart-button></x-cart-button>
    </x-topbar-right>
</x-topbar>
@endsection

@section('header')
<x-header></x-header>
@endsection

@section('content')
<x-breadcrumb>
    <li class="breadcrumb-item">
        <a class='text-light' href="{{route("home")}}">Home</a>
    </li>
    <li class=" breadcrumb-item active text-light" aria-current="page">Verifica email</li>
</x-breadcrumb>
<x-messages></x-messages>
<div class="row g-0 d-flex flex-grow-1">
    <div class="col-lg-12 p-4 d-flex flex-column align-items-center justify-content-center">
        <div class="row d-flex flex-column align-items-center justify-content-center">
            <div class="col-lg-6">
                <p>Il tuo account è stato creato, ma dobbiamo verificare che la mail sia realmente tua.
                    Ti abbiamo inviato su ({{request()->user()->email}}) un link da
                    cliccare per verificare la tua email.</p>
                <form method="post" action="{{route('verification.send')}}">
                    @csrf
                    <button class="btn btn-primary">Non ho ricevuto la mail</button>
                </form>
                <form method="post" class="m-0" action="{{route('logout')}}">
                    @csrf
                    <button class="btn btn-info">Esci da questo account</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
