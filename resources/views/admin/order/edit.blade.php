@extends('layouts')

@section('title', 'Modifica categoria')

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

@section('nav')
    <div class="flex h-16">
        <ol class="breadcrumb-container">
            <li>
                <a class="breadcrumb-link" href="{{ route('admin.category.list') }}">Categorie</a>
            </li>
            <li>::</li>
            <li>
                Modifica
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="flex flex-col p-8 flex-grow">
        <x-messages></x-messages>

        <form class="flex-col space-y-2" method="post" enctype="multipart/form-data">
            @csrf
            <div class="w-1/3 flex flex-col space-y-2">
                <label class=" form-label">Nome</label>
                <input type="text" name="name" value="{{ $item->name }}"
                    class="text-input @error('name') text-input-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">Immagine</label>
                <input type="file" name="image" class="form-control" />
            </div>
            @if ($item->image)
                <div class="w-1/3 flex flex-col space-y-2">
                    <label class="form-label">Immagine corrente</label>

                    <img class="w-[120px] h-full" src="{{ url($item->image) }}" />
                </div>
            @endif
            <div class="w-1/3 flex flex-col space-y-2 items-start">
                <button type="submit" class="btn-success">Salva</button>
            </div>
        </form>
    </div>
@endsection
