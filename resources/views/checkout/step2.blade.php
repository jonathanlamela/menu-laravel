@extends('layouts')

@section('title', 'Cassa')

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
            <a href="{{route('checkout.step1')}}">Indietro</a>
        </div>
        <div class="row g-0">
            <form method="post" class="col-lg-4" action="{{route('checkout.step2')}}">
                @csrf
                <p>Inserisci l'indirizzo e l'orario di consegna preferito</p>
                <div class="form-row mb-3">
                    <label>Indirizzo di consegna</label>
                    <input name="indirizzo" value="{{session('indirizzo') ?? old('indirizzo')}}" class="form-control @error('indirizzo') is-invalid @enderror">
                    @error('indirizzo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-row mb-3">
                    <label>Orario di consegna</label>
                    <input name="orario" value="{{session('orario') ?? old('orario')}}" class="form-control  @error('orario') is-invalid @enderror">
                    @error('orario')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-row mb-3">

                </div>
                <div class="form-row">
                    <button type="submit" class="btn btn-success">Vai</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
