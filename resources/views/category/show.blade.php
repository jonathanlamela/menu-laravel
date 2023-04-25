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
    <div class="row g-0 p-4 flex-grow-1">
        <div class="col-lg-12">
            <div class="row g-0">
                @if (count($foods) > 0)
                    @foreach ($foods as $food)
                        <x-food-item :item="$food"></x-food-item>
                    @endforeach
                @else
                    <p>Non ci sono cibi per questa categoria</p>
                @endif

            </div>

            @if (count($foods) > 5)
                <div class="row g-0">
                    <div class="col-lg-3">
                        <x-select-per-page :elementsPerPage=$elementsPerPage></x-select-per-page>
                    </div>
                </div>
            @endif
            <div class="row g-0">
                {{ $foods->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection
