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

@section('nav')
<div class="flex h-16">
    <ol class="breadcrumb-container">
        <li>
            <a class="breadcrumb-link" href="{{route('account.dashboard')}}">
                Profilo
            </a>
        </li>
        <li>::</li>
        <li>{{auth()->user()->firstname}} {{auth()->user()->lastname}}</li>
    </ol>
</div>
@endsection


@section('content')
<div class="pl-8 pr-8 flex flex-col py-4">
    <x-messages></x-messages>
    <x-account-dashboard></x-account-dashboard>
    @can('isAdmin')
    <x-account-admin-dashboard></x-account-admin-dashboard>
    @endcan
</div>
@endsection
