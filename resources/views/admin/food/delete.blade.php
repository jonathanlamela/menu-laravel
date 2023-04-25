@extends('layouts')

@section('title', 'Elimina categoria ' . $item->name)


@section('header')
    <x-header></x-header>
@endsection

@section('topbar')
    <x-topbar>
        <x-topbar-left>
            <x-global-search-form></x-global-search-form>
        </x-topbar-left>
        <x-topbar-right>
            <x-account-manage></x-account-manage>
        </x-topbar-right>
    </x-topbar>
@endsection

@section('content')
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a class='text-light' href="{{ route('account.dashboard') }}">Profilo</a>
        </li>
        <li class="breadcrumb-item">
            <a class='text-light' href="{{ route('admin.food.list') }}">Cibi</a>
        </li>
        <li class="breadcrumb-item active text-light" aria-current="page">Elimina cibo</li>
    </x-breadcrumb>
    <x-messages></x-messages>
    <div class="row g-0 ps-4 pe-4">
        <h4>Elimina categoria {{ $item->name }}</h4>
    </div>
    <div class="row g-0 ps-4 pe-4 flex-grow-1">
        <form class="col-lg-4" method="post">
            @csrf
            <div class="mb-3">
                Sei sicuro di voler eliminare questa categoria ?
                <input type="hidden" name="id" value="{{ $item->id }}" />
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Elimina</button>
            </div>
        </form>
    </div>
@endsection
