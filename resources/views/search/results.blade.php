@extends('layouts')

@section('title', "Risultato di ricerca")

@section('topbar')
<div class="g-0 row">
    <div class="col-lg-12">
        <div class="row g-0" style="background-color:#58151c">
            <div class="col-lg-4 d-flex justify-content-start align-items-center p-2">
                <x-search-form></x-search-form>
            </div>
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4 d-flex justify-content-end align-items-center p-2 ">
                <x-cart-button></x-cart-button>
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
<hr class="ms-4 me-2 m-0">
@endsection

@section('content')
<div class="my-3">
    <div class="col-lg-12 p-4 flex-grow-1">
        <div class="row g-0">
            <p>Risultati di ricerca</p>
        </div>
        <div class="row g-0">
            @foreach($foods as $food)
            <x-food-item :item="$food"></x-food-item>
            @endforeach
        </div>
        <div class="row g-0">
            {{$foods->appends(request()->query())->links()}}
        </div>
        <div class="row g-0">
            <div class="col-lg-3">
                <form method="get">
                    <label>Elementi per pagina</label>
                    <input type="hidden" name="search" value="{{request('search')}}" />
                    <select name="elementsPerPage" class="form-control" onchange="this.form.submit()">
                        <option value="5" @if(request('elementsPerPage')=="5" ) selected @endif>5</option>
                        <option value="10" @if(request('elementsPerPage')=="10" || request('elementsPerPage')==null ) selected @endif>10</option>
                        <option value="50" @if(request('elementsPerPage')=="50" ) selected @endif>50</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
