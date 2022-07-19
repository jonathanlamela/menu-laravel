@extends('layouts')

@section('title', 'Recupera password')

@section('topbar')
<x-topbar>
    <x-topbar-left>
        <x-home-button></x-home-button>
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
        <form class="row col-lg-4" method="post" action="{{route('user-password.update')}}">
            <p>Compila il form per cambiare la tua password</p>

            @csrf
            @method('put')
            <div class="mb-3 form-group">
                <label for="inputPassword" class="form-label">Password attuale</label>
                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" />
                @error('current_password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 form-group">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" />
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 form-group">
                <label for="inputPassword" class="form-label">Conferma password</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 form-group">
                <button type="submit" class="btn btn-success">Cambia password</button>
            </div>
        </form>
    </div>
</div>
@endsection
