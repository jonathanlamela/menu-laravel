@extends('layouts')

@section('title', 'Accedi')

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
        <form method="post" class="col-lg-4">
            @csrf
            <div class="form-group pt-4">
                <label for="staticEmail">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group pt-4">
                <label for="inputPassword">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group pt-2">
                <a class="justify-content-start text-decoration-none" href="{{route('password.request')}}">Ho dimenticato la password</a>
            </div>
            <div class="form-group pt-4">
                <button type="submit" class="btn btn-primary">Accedi</button>
                <a class="btn btn-secondary" href="{{route('register')}}">Crea account</a>
            </div>

        </form>
    </div>
</div>
@endsection
