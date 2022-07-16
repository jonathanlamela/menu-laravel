@extends('layouts')

@section('title', 'Cibi')


@section('topbar')
<div class="g-0 row">
    <div class="col-lg-12">
        <div class="row g-0" style="background-color:#58151c">
            <div class="col-lg-4 d-flex justify-content-start align-items-center p-2">
                <x-home-button></x-home-button>
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

@section('content')
@if(session()->has('success_message'))
<div class="row g-0">
    <div class="col-lg-12 ps-4 pe-4 pt-4">
        <div class="alert alert-success" role="alert">
            {{session('success_message')}}
        </div>
    </div>
</div>
@endif
<div class="row g-0">
    <div class="col-lg-12 mt-4 ms-4">
        <h4>Cibi</h4>
    </div>
</div>
<div class="row g-0 bg-light m-4 p-2 rounded-2 shadow-sm d-flex flex-row justify-content-end align-items-center">
    <div class="col-lg-9">
        <a class="btn btn-secondary text-decoration-none" href="{{route('admin.food.create')}}">Crea nuovo cibo</a>
    </div>
    <div class="col-lg-3 ">
        <form class="row d-flex flex-row justify-content-end align-items-center m-0">
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
                <th scope="col">Immagine</th>
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
                <td>
                    @if($item->image)
                    <img width="120px" class="rounded" src="{{url($item->image)}}" />
                    @endif
                </td>
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

<div class="row g-0 ms-4 me-4">
    <div class="col-lg-3">
        <x-select-per-page :elementsPerPage=$elementsPerPage></x-select-per-page>
    </div>
</div>
<div class="row g-0 ms-4 me-4">
    {{$items->appends(request()->input())->links()}}
</div>


@endsection
