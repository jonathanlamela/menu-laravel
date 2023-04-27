@extends('layouts')

@section('title', $category->name)

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
    <x-category-list></x-category-list>
@endsection

@section('content')
    <div class="flex flex-col p-8">
        <div class="w-full pb-4">
            <h4 class="font-bold text-lg">Categoria {{ strtolower($category->name) }}</h4>
        </div>
        <div class="w-full space-y-4">

            @if (count($foods) > 0)
                @foreach ($foods as $food)
                    <x-food-item :item="$food"></x-food-item>
                @endforeach
            @else
                <p>Non ci sono cibi per questa categoria</p>
            @endif
        </div>
    </div>

@endsection
