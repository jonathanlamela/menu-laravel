@extends('layouts')

@section('title', 'Riepilogo ordine')

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
<div class="row g-0 flex-grow-1 p-4">
    <div class="col-lg-12">
        <div class="row g-0 mb-3">
            @if(session('tipoConsegna')=='asporto')
            <a href="{{route('checkout.step1')}}">Indietro</a>
            @else
            <a href="{{route('checkout.step2')}}">Indietro</a>
            @endif
        </div>
        <div class="row g-0">
            <h6>Consegna</h6>
            @if(session('tipoConsegna')=='asporto')
            <p>Hai scelto di ritirare in negozio</p>
            @else
            <p>Hai scelto la consegna a domicilio</p>
            <h6>
                Indirizzo e orario
            </h6>
            <p>
                {{session('indirizzo')}}
                Ore: {{session('orario')}}
            </p>
            @endif
        </div>
        <div class="row g-0">
            <h6>Cosa c'è nel tuo ordine</h6>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Cibo</th>
                        <th class="text-center" scope="col">Quantità</th>
                        <th class="text-center" scope="col">Prezzo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart["items"] as $item)
                    <tr class="align-middle">
                        <td class="">{{$item["name"]}}</td>
                        <td class="text-center">{{$item["quantity"]}}</td>
                        <td class="text-center">{{number_format($item["price"],2)}} €</td>
                    </tr>
                    @endforeach
                    @if(session('tipoConsegna')!='asporto')
                    <tr class="align-middle">
                        <td class="">Consegna</td>
                        <td class="text-center">1</td>
                        <td class="text-center">2.00 €</td>
                    </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td class="text-center"><b>Totale</b></td>
                        @if(session('tipoConsegna')=='asporto')
                        <td class="text-center">{{number_format(session('cart')["subTotal"],2)}} €</td>
                        @else
                        <td class="text-center">{{number_format(session('cart')["subTotal"]+2,2)}} €</td>
                        @endif
                    </tr>
                </tfoot>
            </table>

        </div>
        <div class="row g-0">
            <form method="post" class="col-lg-4" action="{{route('checkout.step3')}}">
                @csrf
                <div class="form-row mb-3">
                    <label>Note sull'ordine</label>
                    <textarea name="note" class="form-control">
                    </textarea>
                </div>
                <button type="submit" class="btn btn-success">Invia ordine</button>
            </form>
        </div>
    </div>
</div>
@endsection
