@extends('layouts')

@section('title', 'Crea cibo')

@section('topbar')
    <x-topbar>
        <x-topbar-left>
        </x-topbar-left>
        <x-topbar-right>
            <x-account-manage></x-account-manage>
        </x-topbar-right>
    </x-topbar>
@endsection


@section('header')
    <div class="g-0 row">
        <x-header></x-header>
    </div>
@endsection

@section('nav')

@endsection

@section('content')
    <div class="col-lg-12 p-4 flex-grow-1">
        <div class="row">
            <h4>Crea un nuovo cibo</h4>
        </div>
        <div class="row">
            <form class="col-lg-4" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Ingredienti</label>
                    <input type="text" name="ingredients" value="{{ old('ingredients') }}"
                        class="form-control @error('ingredients') is-invalid @enderror">
                    @error('ingredients')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 ">

                    <label class="form-label">Prezzo</label>
                    <div class="input-group">
                        <span class="input-group-text">€</span>
                        <input type="text" name="price" value="{{ old('price') }}"
                            class="form-control @error('price') is-invalid @enderror">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Categoria</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        <option></option>
                        @foreach ($categories as $cat)
                            @if ($cat->id == old('category_id'))
                                <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                            @else
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Immagine</label>
                    <input type="file" name="immagine" class="form-control" />
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Crea</button>
                </div>
            </form>
        </div>
    </div>
@endsection
