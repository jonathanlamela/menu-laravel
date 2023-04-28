@extends('layouts')

@section('title', 'Modifica cibo ' . $item->name)







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


    <div class="flex flex-col p-8 flex-grow">
        <x-messages></x-messages>

        <form class="flex-col space-y-2" method="post" enctype="multipart/form-data">
            @csrf
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">Nome</label>
                <input type="text" name="name" name="name" value="{{ old('name') ?? $item->name }}"
                    class="text-input @error('name') text-input-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">Ingredienti</label>
                <input type="text" name="ingredients" value="{{ old('ingredients') ?? $item->ingredients }}"
                    class="text-input @error('ingredients') text-input-invalid @enderror">
                @error('ingredients')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">Prezzo</label>
                <input type="text" name="price" value="{{ old('price') ?? number_format($item->price, 2) }}"
                    class="text-input @error('price') text-input-invalid @enderror">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">Categoria</label>
                <select name="category_id" class="text-input @error('category_id') text-input-invalid first-line:@enderror">
                    <option></option>
                    @foreach ($categories as $cat)
                        @if ($cat->id == $item->category_id)
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
            <div class="w-1/3 flex flex-col space-y-2 items-start">
                <button type="submit" class="btn btn-success">Salva</button>
            </div>
        </form>
    </div>

@endsection




@section('nav')
    <div class="flex h-16">
        <ol class="breadcrumb-container">
            <li>
                <a class="breadcrumb-link" href="{{ route('admin.food.list') }}">Cibi</a>
            </li>
            <li>::</li>
            <li>
                Modifica
            </li>
        </ol>
    </div>
@endsection
