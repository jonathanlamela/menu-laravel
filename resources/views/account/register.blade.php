@extends('layouts')

@section('title', 'Crea account')

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
                <a class="breadcrumb-link" href="{{ route('login') }}">
                    Profilo
                </a>
            </li>
            <li>::</li>
            <li>Crea account</li>
        </ol>
    </div>
@endsection



@section('content')

    <x-messages></x-messages>
    <div class='flex flex-grow justify-center items-center'>
        <form method="post" class="w-full p-16 md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2">
            @csrf
            <div class="flex flex-col space-y-2">
                <label class="form-label">Nome</label>
                <input type="text" value="{{ old('firstname') }}" name="firstname"
                    class="text-input @error('firstname') text-input-invalid @enderror" />
                @error('firstname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col space-y-2">
                <label class="form-label">Cognome</label>
                <input type="text" value="{{ old('lastname') }}" name="lastname"
                    class="text-input @error('lastname') text-input-invalid @enderror" />
                @error('lastname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col space-y-2">
                <label class="form-label">Email</label>
                <input type="text" value="{{ old('email') }}" name="email"
                    class="text-input @error('email') text-input-invalid @enderror" />
                @error('email')
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
            <div class="flex flex-row space-x-2 pt-4">
                <button type="submit" class="btn-primary">Crea account</button>
            </div>
        </form>
    </div>
@endsection
