@extends('layouts')

@section('title', 'Home')

@section('topbar')
<x-topbar>
    <x-topbar-left>
        <x-global-search-form></x-global-search-form>
    </x-topbar-left>
    <x-topbar-right>
        <x-cart-button></x-cart-button>
        <x-login></x-login>
    </x-topbar-right>
</x-topbar>
@endsection

@section('header')
<x-header></x-header>
@endsection

@section('content')
<div class="row g-0 flex-grow-1 p-4">

</div>
@endsection

@section('nav')
<x-category-list></x-category-list>
@endsection
