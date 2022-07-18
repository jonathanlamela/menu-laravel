@extends('layouts')

@section('title', 'Profilo')

@section('topbar')
<x-topbar>
    <div class="col-lg-4 d-flex justify-content-start align-items-center p-2">
        <x-home-button></x-home-button>
    </div>
    <div class="col-lg-4">
    </div>
    <div class="col-lg-4 d-flex justify-content-end align-items-center p-2 ">
        <x-cart-button></x-cart-button>
        <x-login></x-login>
    </div>
</x-topbar>
@endsection

@section('header')
<x-header></x-header>
@endsection


@section('content')
<x-breadcrumb>
    <li class="breadcrumb-item active text-light" aria-current="page">Profilo</li>
    <li class="breadcrumb-item active text-light" aria-current="page">{{auth()->user()->firstname}} {{auth()->user()->lastname}} </li>
</x-breadcrumb>
<div class="row g-0  d-flex flex-grow-1">
    <div class="col-lg-12 p-4 d-flex flex-column align-items-start justify-content-start">


        <div class="row g-0">
            <h4>Il mio profilo</h4>
            <a class="text-decoration-none" href="{{route('account.informazioni-personali')}}"><i class="bi bi-person-lines-fill me-2"></i>
                Informazioni personali</a>
            <a class="text-decoration-none" href="{{route('account.cambia-password')}}"><i class="bi bi-key me-2"></i>
                Cambia la password</a>
        </div>

        @can('isAdmin')
        <div class="row g-0 mt-3">
            <h4>Amministrazione</h4>
            <a class="text-decoration-none" href="{{route('admin.category.list')}}">Gestisci categorie</a>
            <a class="text-decoration-none" href="{{route('admin.food.list')}}">Gestisci cibi</a>
            <a class="text-decoration-none" href="{{route('admin.order.list')}}">Gestisci ordini</a>

        </div>

        @endcan

    </div>
</div>
@endsection
