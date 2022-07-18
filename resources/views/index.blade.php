@extends('layouts')

@section('title', 'Home')

@section('topbar')
<x-topbar>
    <div class="col-lg-4 d-flex justify-content-start align-items-center p-2">
        <x-global-search-form></x-global-search-form>
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
<div class="row g-0 flex-grow-1 p-4">

</div>
@endsection

@section('nav')
<x-category-list></x-category-list>
@endsection
