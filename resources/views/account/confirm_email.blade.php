@extends('layout')

@section('title') {{ __('account.confirm_email_title') }} @stop

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
        <li>{{ __('account.create_account') }}</li>
    </ol>
@stop

@section('content')

    <div class="px-8 pt-8">
        <x-messages></x-messages>
    </div>

    <div class='flex flex-grow flex-col justify-center items-center'>
        <div class='flex flex-grow justify-center items-center'>
            <div class="flex flex-col space-y-2 w-full md:w-1/2">
                <p>{{ __('account.email_required_message', [
                    'email' => auth()->user()->email,
                ]) }}.
                </p>
                <div class="flex flex-row space-x-2">
                    <form method="post" action="{{ route('verification.send') }}">
                        @csrf
                        <button class="btn btn-primary">{{ __('account.require_new_email') }}</button>
                    </form>
                    <form class="m-0" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-secondary-outlined">{{ __('account.logout_my_account') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
