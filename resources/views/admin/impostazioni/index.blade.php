@extends('layouts')

@section('title', 'Categorie')

@section('header')
<x-header></x-header>
@endsection

@section('topbar')
<x-topbar>
    <x-topbar-left>
        <x-global-search-form></x-global-search-form>
    </x-topbar-left>
    <x-topbar-right>
        <x-login></x-login>
    </x-topbar-right>
</x-topbar>
@endsection



@section('content')
<div class="row g-0">
    <div class="col-lg-12 ms-4 mt-4">
        @include('app_settings::_settings')
    </div>
</div>
@endsection
