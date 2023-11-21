@extends('layout')

@section('title') {{ ucfirst(__('account.change_password')) }} @stop

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
            <a class="breadcrumb-link" href="{{ route('account.index') }}">{{ ucfirst(__('account.profile')) }}</a>
        </li>
        <li>::</li>
        <li>{{ ucfirst(__('account.change_password')) }}</li>
    </ol>
@stop

@section('content')
    <div class="px-8 py-4">
        <x-messages></x-messages>
        <div class="w-full">
            <p class="text-2xl antialiased font-bold">{{ ucfirst(__('account.change_password')) }}</p>
        </div>
        <form class="w-full md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-4" method="POST"
            action="{{ route('user-password.update') }}">
            @csrf
            @method('put')
            <input type="hidden" name="email" value="{{ auth()->user()->email }}" />
            <div class="flex flex-col space-y-2">
                <label class="form-label">{{ ucfirst(__('account.current_password')) }}</label>
                <input type="password" name="current_password"
                    value="{{ old('current_password') ?? auth()->user()->current_password }}"
                    class="@if ($errors->has('current_password')) text-input-invalid @else text-input @endif" />
                @error('current_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col space-y-2">
                <label class="form-label">{{ ucfirst(__('account.new_password')) }}</label>
                <input type="password" name="password" value="{{ old('password') }}"
                    class="@if ($errors->has('password')) text-input-invalid @else text-input @endif" />
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col space-y-2">
                <label class="form-label">{{ ucfirst(__('account.new_password_repeat')) }}</label>
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                    class="@if ($errors->has('password_confirmation')) text-input-invalid @else text-input @endif" />
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-row space-x-2">
                <button type="submit" class="btn-primary space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>

                    <span>{{ ucfirst(__('account.change_password')) }}</span>
                </button>
            </div>
        </form>
    </div>
@stop
