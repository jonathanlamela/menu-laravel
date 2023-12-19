@extends('layout')

@section('title') {{ __('account.login') }} @stop

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
            <a class="breadcrumb-link">{{ __('account.profile') }}</a>
        </li>
        <li>::</li>
        <li>{{ __('account.login') }}</li>
    </ol>
@stop

@section('content')

    <div class="px-8 pt-8">
        <x-messages></x-messages>
    </div>

    <div class='flex flex-grow flex-col justify-center items-center'>
        <form class="w-full p-16 md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2" action="{{ route('login') }}"
            method='post'>
            @csrf
            @if (request('backUrl'))
                <input type="hidden" name="backUrl" value="{{ request('backUrl') }}" />
            @endif
            <div class="flex flex-col space-y-2">
                <label class="form-label">{{ __('account.email') }}</label>
                <input name="email" type="text"
                    class="@if ($errors->has('email')) text-input-invalid @else text-input @endif" />
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col space-y-2">
                <label class="form-label">{{ __('account.password') }}</label>
                <input name="password" type="password"
                    class="@if ($errors->has('password')) text-input-invalid @else text-input @endif" />
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col space-y-0.5">
                <a href={{ route('password.request') }} class="hover:text-red-900">
                    {{ __('account.password_recovery_link') }}
                </a>
            </div>
            <div class="flex flex-row space-x-2">
                <button type="submit" class="btn-primary">
                    {{ __('account.login') }}
                </button>
                <a href={{ route('register') }} class="btn-secondary-outlined">
                    {{ __('account.signin') }}
                </a>
            </div>
        </form>
    </div>
@stop
