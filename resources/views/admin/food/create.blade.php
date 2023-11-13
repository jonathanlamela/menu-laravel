@extends('layout')

@section('title') Crea cibo @stop

@section('topbar')
    <div class="w-full bg-red-900 flex flex-col md:flex-row p-1">
        <div class="w-full md:w-3/4 flex p-2 justify-center md:justify-start">
            <x-home-button></x-home-button>
        </div>
        <div class="w-full md:w-1/4 flex flex-row p-2 justify-center md:justify-end">
            <x-cart-button></x-cart-button>
            <x-account-manage></x-account-manage>
        </div>
    </div>
@stop

@section('navHeader')
    <ol class="flex flex-row space-x-2 items-center pl-8 text-white h-16">
        <li>
            <a class="breadcrumb-link" href="{{ route('account.index') }}">Profilo</a>
        </li>
        <li>::</li>
        <li>Catalogo</li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('admin.food.list') }}">Cibi</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="pl-8 pr-8 pt-8 flex flex-col space-y-4 pb-8">
        <x-messages></x-messages>
        <div class="w-full">
            <p class="text-2xl antialiased font-bold">Crea cibo</p>
        </div>
        <form class="flex-col space-y-2" method="post" action="{{ route('admin.food.store') }}">
            @csrf
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">Nome</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="@if ($errors->has('name')) text-input-invalid @else text-input @endif" />
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">Ingredienti</label>
                <textarea class="text-input" name="ingredients">{{ old('ingredients') }}</textarea>
            </div>
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">Prezzo</label>
                <input type="text" name="price"
                    class="@if ($errors->has('price')) text-input-invalid @else text-input @endif" />
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">Categoria</label>
                <select name="category_id"
                    class="@if ($errors->has('category_id')) text-input-invalid @else text-input @endif">
                    <option>Seleziona una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col space-y-2 items-start">
                <button type="submit" class="btn-success ">
                    Crea
                </button>
            </div>
        </form>
    </div>
@stop
