@extends('layouts')

@section('title', "Elimina ordine ".$item->id)

@section('topbar')
<x-topbar>
    <x-topbar-left>
    </x-topbar-left>
    <x-topbar-right>
        <x-login></x-login>
    </x-topbar-right>
</x-topbar>
@endsection

@section('header')
<div class="g-0 row">
    <x-header></x-header>
</div>
@endsection

@section('nav')

@endsection

@section('content')
<div class="col-lg-12 p-4 flex-grow-1">
    <div class="row g-0">
        <h4>Elimina ordine {{$item->id}}</h4>
    </div>
    <div class="row g-0">
        <form class="col-lg-4" method="post">
            @csrf
            <div class="mb-3">
                Sei sicuro di voler eliminare quest'ordine ?
                <input type="hidden" name="id" value="{{$item->id}}" />
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Elimina</button>
            </div>
        </form>
    </div>
</div>
@endsection
