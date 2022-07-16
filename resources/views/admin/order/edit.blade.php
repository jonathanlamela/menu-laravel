@extends('layouts')

@section('title', "Modifica cibo ".$item->name)

@section('topbar')
<div class="g-0 row">
    <div class="col-lg-12">
        <div class="row g-0" style="background-color:#58151c">
            <div class="col-lg-4 d-flex justify-content-start align-items-center p-2">
                <a class="btn btn-link text-light" href="{{route('admin.food.list')}}">Elenco cibi</a>

            </div>
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4 d-flex justify-content-end align-items-center p-2 ">
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

@section('nav')

@endsection

@section('content')
<div class="col-lg-12 p-4 flex-grow-1">
    @if(session()->has('success_message'))
    <div class="row g-0">
        <div class="alert alert-success" role="alert">
            {{session('success_message')}}
        </div>
    </div>
    @endif
    <div class="row">
        <h4>Modifica cibo {{$item->name}}</h4>
    </div>
    <div class="row">
        <form class="col-lg-4" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="name" value="{{old('name') ?? $item->name}}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Ingredienti</label>
                <input type="text" name="ingredients" value="{{old('ingredients') ?? $item->ingredients}}" class="form-control @error('ingredients') is-invalid @enderror">
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
                    <input type="text" name="price" value="{{old('price') ?? number_format($item->price,2)}}" class="form-control @error('price') is-invalid @enderror">
                    @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select name="categoryId" class="form-control @error('categoryId') is-invalid @enderror">
                    <option></option>
                    @foreach($categories as $cat)
                    @if($cat->id == $item->categoryId)
                    <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                    @else
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endif
                    @endforeach
                </select>
                @error('categoryId')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Immagine</label>
                <input type="file" name="immagine" class="form-control" />
            </div>
            @if($item->image)
            <div class="mb-3">
                <label class="form-label">Immagine corrente</label>
                <br />
                <img width="120px" class="rounded" src="{{url($item->image)}}" />
            </div>
            @endif
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Salva modifiche</button>
            </div>
        </form>
    </div>
</div>
@endsection
