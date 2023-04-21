@extends('layouts')

@section('title', 'Home')

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
<div class="row g-0 flex-grow-1 p-4">

</div>
@endsection

@section('nav')
<x-category-list></x-category-list>
@endsection
