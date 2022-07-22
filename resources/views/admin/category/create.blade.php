@extends('layouts')

@section('title', "Crea categoria")

@section('header')
<x-header></x-header>
@endsection

@section('topbar')
<x-topbar>
    <x-topbar-left>
        <x-global-search-form></x-global-search-form>
    </x-topbar-left>
    <x-topbar-right>
        <x-login></x-login>
    </x-topbar-right>
</x-topbar>
@endsection

@section('content')
<x-breadcrumb>
    <li class="breadcrumb-item">
        <a class='text-light' href="{{route('account.dashboard')}}">Profilo</a>
    </li>
    <li class="breadcrumb-item">
        <a class='text-light' href="{{route('admin.category.list')}}">Categorie</a>
    </li>
    <li class="breadcrumb-item active text-light" aria-current="page">Crea categoria</li>
</x-breadcrumb>
<x-messages></x-messages>
<div class="row g-0 ps-4 pe-4">
    <h4>Crea una nuova categoria</h4>
</div>
<div class="row g-0 ps-4 pe-4 flex-grow-1">
    <form class="col-lg-4" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Immagine</label>
            <input type="file" name="image" class="form-control" />
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">Crea</button>
        </div>
    </form>
</div>
@endsection
