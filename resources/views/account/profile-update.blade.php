@extends('layouts')

@section('title', 'Aggiorna profilo')

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
    <li class=" breadcrumb-item active text-light" aria-current="page">Informazioni personali</li>
</x-breadcrumb>
<x-messages></x-messages>
<div class="row g-0  ms-4 me-4 d-flex flex-grow-1">
    <div class="col-lg-12 ">
        <p>Compila il form per aggiornare i tuoi dati</p>
        <form class="row col-lg-4" method="post" action="{{route('user-profile-information.update')}}">
            @csrf
            @method('put')

            <div class="mb-3 form-group">
                <label class="form-label">Email</label>
                <input type="text" value="{{request()->user()->email}}" class="form-control" readonly />
                <div id="emailHelp" class="form-text">L'indirizzo email non è modificabile</div>

            </div>

            <div class="mb-3 form-group">
                <label class="form-label">Nome</label>
                <input type="text" name="firstname" value="{{old('firstname') ?? request()->user()->firstname}}" class="form-control @error('firstname') is-invalid @enderror" />
                @error('firstname')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <label class="form-label">Cognome</label>
                <input type="text" name="lastname" value="{{old('lastname')?? request()->user()->lastname}}" class="form-control @error('lastname') is-invalid @enderror" />
                @error('lastname')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 form-group">
                <button type="submit" class="btn btn-success"><i class="bi bi-pencil-square me-2"></i>Aggiorna informazioni</button>
            </div>
        </form>
    </div>
</div>
@endsection
