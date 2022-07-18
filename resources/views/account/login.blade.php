@extends('layouts')

@section('title', 'Accedi')

@section('topbar')
<x-topbar>
    <div class="col-lg-4 d-flex justify-content-start align-items-center p-2">
        <x-home-button></x-home-button>
    </div>
    <div class="col-lg-4">
    </div>
    <div class="col-lg-4 d-flex justify-content-end align-items-center p-2 ">
        <x-cart-button></x-cart-button>
    </div>
</x-topbar>
@endsection

@section('header')
<x-header></x-header>
@endsection

@section('content')
<x-breadcrumb>
    <li class="breadcrumb-item">
        <a class='text-light' href="{{route('home')}}">Home</a>
    </li>
    <li class="breadcrumb-item active text-light" aria-current="page">Accedi</li>
</x-breadcrumb>
<x-messages></x-messages>
<div class="row g-0 d-flex flex-grow-1">
    <div class="col-lg-12 p-4 d-flex flex-column align-items-center justify-content-center">
        <form method="post">
            @csrf
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <a class="justify-content-start text-decoration-none" href="{{route('password.request')}}">Ho dimenticato la password</a>
                <a class="justify-content-start text-decoration-none" href="{{route('register')}}">Crea account</a>
            </div>
            <div class="mb-3 row">
                <button type="submit" class="btn btn-primary">Accedi</button>
            </div>
        </form>
    </div>
</div>
@endsection
