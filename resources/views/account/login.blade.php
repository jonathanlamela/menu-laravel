@extends('layouts')

@section('title', 'Accedi')

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
            <a class="breadcrumb-link" href="/">
                Profilo
            </a>
        </li>
        <li>::</li>
        <li>Accedi</li>
    </ol>
</div>
@endsection

@section('content')
<div class="px-8 pt-4">
    <x-messages></x-messages>
</div>
<div class='flex flex-grow justify-center items-center'>
    <form method="post" class="w-full p-16 md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2">
        @csrf
        <div class="flex flex-col space-y-2">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="text-input @error('email') text-input-invalid @enderror" />
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="flex flex-col space-y-2">
            <label>Password</label>
            <input type="password" name="password" class="text-input @error('password') text-input-invalid @enderror" />
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="flex flex-col space-y-0.5">
            <a href="{{route('password.request')}}" class=" hover:text-red-900">Ho dimenticato la
                password</a>
        </div>
        <div class="flex flex-row space-x-2">
            <button type="submit" class="btn-primary">Accedi</button>
            <a href="{{route('register')}}" class="btn-secondary-outlined">Crea account</a>
        </div>
    </form>

</div>


@endsection
