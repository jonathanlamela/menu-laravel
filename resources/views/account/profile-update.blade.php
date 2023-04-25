@extends('layouts')

@section('title', 'Aggiorna profilo')

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
    <div class="flex">
        <ol class="breadcrumb-container">
            <li>
                <a class="breadcrumb-link" href="{{ route('account.dashboard') }}">
                    Profilo
                </a>
            </li>
            <li>::</li>
            <li>Informazioni personali</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="p-8">
        <x-messages></x-messages>
        <div class="w-full">
            <h4 class='text-2xl antialiased font-sans'>Informazioni personali</h4>
        </div>
        <form method="post" action="{{ route('user-profile-information.update') }}"
            class="w-full md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2">
            @csrf
            @method('put')
            <input type="hidden" name="email" value="{{ request()->user()->email }}" />
            <div class="flex flex-col space-y-2">
                <label class="form-label">Nome</label>
                <input type="text" name="firstname" value="{{ old('firstname') ?? request()->user()->firstname }}"
                    class="text-input @error('firstname') text-input-invalid @enderror" />
                @error('firstname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col space-y-2">
                <label class="form-label">Cognome</label>
                <input type="text" name="lastname" value="{{ old('lastname') ?? request()->user()->lastname }}"
                    class="text-input @error('lastname') text-input-invalid @enderror" />
                @error('lastname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-row space-x-2">
                <button type="submit" class="btn-primary">

                    <span>Aggiorna informazioni</span>
                </button>
            </div>
        </form>
    </div>

@endsection
