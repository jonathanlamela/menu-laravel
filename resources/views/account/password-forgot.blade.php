@extends('layouts')

@section('title', 'Recupera password')

@section('topbar')
<x-topbar>
    <div class="col-lg-4 d-flex justify-content-start align-items-center p-2">
        <x-home-button></x-home-button>
    </div>
    <div class="col-lg-4">
    </div>
    <div class="col-lg-4 d-flex justify-content-end align-items-center p-2 ">
        <x-cart-button></x-cart-button>
        <x-login />
    </div>
</x-topbar>
@endsection

@section('header')
<x-header></x-header>
@endsection

@section('nav')

@endsection

@section('content')
<x-breadcrumb>
    <li class="breadcrumb-item">
        <a class='text-light' href="{{route("account.dashboard")}}">Profilo</a>
    </li>
    <li class="breadcrumb-item active text-light" aria-current="page">Cambia password</li>
</x-breadcrumb>
<x-messages></x-messages>
<div class="row g-0 d-flex flex-grow-1">
    <div class="col-lg-12 p-4 d-flex flex-column align-items-center justify-content-center">
        <form method="post" class="col-lg-4" action="{{route('password.email')}}">
            <p>Compila il form per cambiare la tua password</p>

            @csrf
            <div class="mb-3 form-group">
                <label for="staticEmail" class="form-label">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="staticEmail">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Recupera la password</button>
            </div>
        </form>
    </div>
</div>
@endsection
