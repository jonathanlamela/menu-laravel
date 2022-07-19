@extends('layouts')

@section('title', 'Cibi')

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
    <li class="breadcrumb-item active text-light" aria-current="page">Amministrazione cibi</li>
</x-breadcrumb>
<x-messages></x-messages>
<div class="row g-0 ps-4 pe-4">
    <div class="col-lg-12">
        <h4>Cibi</h4>
    </div>
</div>
<div class="row g-0 bg-light ms-4 me-4 mb-4 p-2 rounded-2 shadow-sm d-flex flex-row justify-content-end align-items-center">
    <div class="col-lg-9 mt-md-0">
        <a class="btn btn-secondary text-decoration-none" href="{{route('admin.food.create')}}">Crea nuovo cibo</a>
    </div>
    <div class="col-lg-3 mt-3 mt-md-0">
        <form class="m-0">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeHolder="Cerca un cibo" value="{{request('search')}}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<div class="row g-0 ms-4 me-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Categoria</th>
                <th scope="col">Prezzo</th>
                <th class="text-center" scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td class="">{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->category->name}}</td>
                <td>{{number_format($item->price,2)}} €</td>
                <td class="text-center">
                    <a href="{{route('admin.food.edit',["food"=>$item->id])}}">Modifica</a>
                    <a href="{{route('admin.food.delete',["food"=>$item->id])}}">Elimina</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="row g-0 ps-4 pe-4">
    <div class="col-lg-3">
        <x-select-per-page :elementsPerPage=$elementsPerPage></x-select-per-page>
    </div>
</div>
<div class="row g-0 ps-4 pe-4">
    {{$items->appends(request()->input())->links()}}
</div>


@endsection
