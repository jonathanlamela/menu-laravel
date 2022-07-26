@extends('layouts')

@section('title', 'Pagamento ordine')

@section('topbar')
<x-topbar>
    <x-topbar-left>
    </x-topbar-left>
    <x-topbar-right>
        <x-cart-button></x-cart-button>
        <x-login></x-login>
    </x-topbar-right>
</x-topbar>
@endsection

@section('header')
<div class="g-0 row">
    <x-header></x-header>
</div>
@endsection

@section('content')
<x-breadcrumb>
    <li class="breadcrumb-item">
        <a class='text-light' href="{{route('account.dashboard')}}">Profilo</a>
    </li>
    <li class="breadcrumb-item active text-light" aria-current="page">I miei ordini</li>
</x-breadcrumb>
<x-messages></x-messages>
<div class="row g-0 flex-grow-1">
    <div class="col-lg-12 p-4">
        @if(session()->has('success_message'))
        <div class="row g-0">
            <div class="alert alert-success" role="alert">
                {{session('success_message')}}
            </div>
        </div>
        @endif
        <div class="row g-0">
            <h4>I tuoi ordini</h4>
        </div>
        <div class="row g-0">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>#</th>
                            <th>Stato</th>
                            <th>Totale</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($orders as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td><span class="badge bg-dark">{{ $row->order_status}}</span></td>
                                <td>€ {{ $row->subtotal }}</td>
                                <td>
                                    <a class="text-decoration-none" href="{{route('ordini.view',["order"=>$row->id])}}">
                                        <i class="bi bi-three-dots"></i> Dettaglio
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
