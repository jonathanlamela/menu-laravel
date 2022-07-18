@extends('layouts')

@section('title', $category->name)

@section('topbar')
<x-topbar>
    <div class="col-lg-4 d-flex justify-content-start align-items-center p-2">
        <x-global-search-form></x-global-search-form>
    </div>
    <div class="col-lg-4">
    </div>
    <div class="col-lg-4 d-flex justify-content-end align-items-center p-2 ">
        <x-cart-button></x-cart-button>
        <x-login></x-login>
    </div>
</x-topbar>
@endsection

@section('header')
<x-header></x-header>
@endsection

@section('nav')
<x-category-list></x-category-list>
@endsection

@section('content')
<div class="row g-0 p-4 flex-grow-1">
    <div class="col-lg-12">
        <div class="row g-0">
            @foreach($foods as $food)
            <x-food-item :item="$food"></x-food-item>
            @endforeach
        </div>

        @if(count($foods)>5)
        <div class="row g-0">
            <div class="col-lg-3">
                <x-select-per-page :elementsPerPage=$elementsPerPage></x-select-per-page>
            </div>
        </div>
        @endif
        <div class="row g-0">
            {{$foods->appends(request()->input())->links()}}
        </div>
    </div>
</div>
@endsection
