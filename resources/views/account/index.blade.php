@extends('layouts')

@section('title', 'Profilo')

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
            <a class="text-decoration-none" href="{{route('ordini.list')}}"><i class="bi bi-bag me-2"></i>
                I miei ordini</a>
        </div>

        @can('isAdmin')
        <div class="row g-0 mt-3">
            <h4>Amministrazione</h4>
            <h6 class="mt-1">CATALOGO</h6>
            <a class="text-decoration-none" href="{{route('admin.category.list')}}">Categorie</a>
            <a class="text-decoration-none" href="{{route('admin.food.list')}}">Cibi</a>
            <h6 class="mt-3">ORDINI</h6>
            <a class="text-decoration-none" href="{{route('admin.order.list')}}">Ordini</a>
            <h6 class="mt-3">IMPOSTAZIONI</h6>
            <a class="text-decoration-none" href="/amministrazione/impostazioni">Generali</a>

        </div>

        @endcan

    </div>
</div>
@endsection
