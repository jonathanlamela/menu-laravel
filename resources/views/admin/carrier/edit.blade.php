@extends('layout')

@section('title') {{ __('carrier.edit_title') }} @stop

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
            <a class="breadcrumb-link" href="{{ route('account.index') }}">{{ __('account.profile') }}</a>
        </li>
        <li>::</li>
        <li>{{ __('account.sales') }}</li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('admin.carrier.list') }}">{{ __('carrier.list_title') }}</a>
        </li>
        <li>::</li>
        <li>
            {{ __('carrier.edit_title') }}
        </li>
    </ol>
@stop

@section('content')
    <div class="pl-8 pr-8 pt-8 flex flex-col space-y-4 pb-8 w-full">
        <x-messages></x-messages>
        <div class="w-full">
            <p class="text-2xl antialiased font-bold">{{ __('carrier.edit_title') }} "{{ $carrier->name }}"</p>
        </div>
        <form class="flex-col space-y-2" method="post" enctype="multipart/form-data"
            action="{{ route('admin.carrier.update', ['carrier' => $carrier]) }}">
            @csrf
            <div class="w-full lg:w-1/3 flex flex-col space-y-2">
                <label class="form-label">{{ __('carrier.name') }}</label>
                <input type="text" value="{{ old('name') ?? $carrier->name }}" name="name"
                    class="@if ($errors->has('name')) text-input-invalid @else text-input @endif" />
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-full lg:w-1/3 flex flex-col space-y-2">
                <label class="form-label">{{ __('carrier.cost') }}</label>
                <input type="text" value="{{ old('cost') ?? $carrier->cost }}" name="cost"
                    class="@if ($errors->has('cost')) text-input-invalid @else text-input @endif" />
                @error('cost')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="w-1/3 flex flex-col space-y-2 items-start">
                <button type="submit" class="btn-success ">
                    {{ __('globals.edit') }}
                </button>
            </div>
        </form>
    </div>
@stop
