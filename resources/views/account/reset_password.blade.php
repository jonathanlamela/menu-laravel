@extends('layout')

@section('title') Reset password @stop

@section('topbar')
    <div class="w-full bg-red-900 flex flex-col md:flex-row p-1">
        <div class="w-full md:w-3/4 flex p-2 justify-center md:justify-start">
            <x-home-button></x-home-button>
        </div>
        <div class="w-full md:w-1/4 flex flex-row p-2 justify-center md:justify-end">
            <x-cart-button></x-cart-button>
            <x-account-manage></x-account-manage>
        </div>
    </div>
@stop

@section('navHeader')
    <ol class="flex flex-row space-x-2 items-center pl-8 text-white h-16">
        <li>
            <a class="breadcrumb-link" href="{{ route('login') }}">Profilo</a>
        </li>
        <li>::</li>
        <li>Reset password</li>
    </ol>
@stop

@section('content')
    <div class="px-8 py-4">
        <x-messages></x-messages>
        <div class="w-full">
            <p class="text-2xl antialiased font-bold">Reset password</p>
        </div>
        <form class="w-full p-16 md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2" action="{{ route('password.email') }}"
            method='post'>
            @csrf
            <div class="flex flex-col space-y-2">
                <label class="form-label">Email</label>
                <input name="email" type="text"
                    class="@if ($errors->has('email')) text-input-invalid @else text-input @endif" />
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex flex-row space-x-2">
                <button type="submit" class="btn-primary">
                    Reset password
                </button>
            </div>
        </form>
    </div>
@stop
