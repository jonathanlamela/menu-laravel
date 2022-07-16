@extends('layouts')

@section('title', 'Pagamento ordine')

@section('topbar')
<div class="g-0 row">
    <div class="col-lg-12">
        <div class="row g-0 topbar-style">
            <div class="col-lg-4 d-flex justify-content-start align-items-center p-2">
            </div>
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4 d-flex justify-content-end align-items-center p-2 ">
                <x-cart-button></x-cart-button>
                <x-login></x-login>
            </div>
        </div>
    </div>
</div>
@endsection

@section('header')
<div class="g-0 row">
    <x-header></x-header>
</div>
@endsection

@section('content')
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
                                <td>{{ $row->orderStatus}}</td>
                                <td>€ {{ $row->subTotal }}</td>
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
