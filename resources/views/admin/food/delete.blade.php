@extends('layouts')

@section('title', 'Elimina cibo ' . $item->name)

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


    <div class="flex flex-col p-8 flex-grow space-y-2 items-start">
        <x-messages></x-messages>
        <div class="col-lg-12 p-4 d-flex flex-column">
            <form class="m-0 space-y-2 flex-col flex" method="post">
                <input type="hidden" name="id" value="{{ $item->id }}" />
                @csrf
                <p>
                    Stai per eliminare il cibo <b>{{ $item->name }}</b>. Questa operazione è irreversibile. Sei
                    sicuro di
                    voler proseguire?
                </p>
                <div class="mb-3">
                    <button type="submit" class="btn-danger">Si, elimina</button>
                </div>
            </form>
        </div>
    </div>


@endsection


@section('nav')
    <div class="flex h-16">
        <ol class="breadcrumb-container">
            <li>
                <a class="breadcrumb-link" href="{{ route('admin.food.list') }}">Cibi</a>
            </li>
            <li>::</li>
            <li>
                Elimina
            </li>
        </ol>
    </div>
@endsection
