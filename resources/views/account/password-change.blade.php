@extends('layouts')

@section('title', 'Recupera password')

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
                <a class="breadcrumb-link" href="{{ route('account.dashboard') }}">
                    Profilo
                </a>
            </li>
            <li>::</li>
            <li>Cambia password</li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="p-8">
        <x-messages></x-messages>
        <div class="w-full">
            <h4 class='text-2xl antialiased font-sans'>Cambia password</h4>
        </div>
        <form method="post" class="w-full md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2"
            action="{{ route('user-password.update') }}">
            @csrf
            @method('put')
            <div class="flex flex-col space-y-2">
                <label class="form-label">Password attuale</label>
                <input type="password" name="current_password"
                    class="text-input @error('current_password') text-input-invalid @enderror" />
                @error('current_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col space-y-2">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="text-input @error('password') text-input-invalid @enderror" />
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col space-y-2">
                <label class="form-label">Conferma password</label>
                <input type="password" name="password_confirmation"
                    class="text-input @error('password_confirmation') text-input-invalid @enderror" />
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-row space-x-2">
                <button type="submit" class="btn-primary">
                    <span>Cambia password</span>
                </button>
            </div>
        </form>
    </div>
@endsection
