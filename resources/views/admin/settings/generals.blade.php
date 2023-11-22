@extends('layout')

@section('title') {{ __('settings.index_title') }} @stop

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
        <li>{{ __('settings.index_title') }}</li>
    </ol>
@stop

@section('content')
    <div class="pl-8 pr-8 pt-8 flex flex-col space-y-2 pb-8 w-full">
        <x-messages></x-messages>
        <div class="w-full">
            <p class="text-2xl antialiased font-bold">{{ __('settings.index_title') }}</p>
        </div>
        <form class="flex flex-col space-y-4" method="POST" action="{{ route('admin.settings.generals') }}">
            @csrf
            <div class="flex flex-col space-y-2">
                <h6 class="font-semibold uppercase">{{ __('settings.site_info') }}</h6>
                <div class="w-full md:w-1/3 flex flex-col space-y-2">
                    <label class="form-label">{{ __('settings.site_title') }}</label>
                    <input type="text" name="site_title" value="{{ old('site_title') ?? $item->site_title }}"
                        class="@if ($errors->has('site_title')) text-input-invalid @else text-input @endif" />
                    @error('site_title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="w-full md:w-1/3 flex flex-col space-y-2">
                    <label class="form-label">{{ __('settings.site_subtitle') }}</label>
                    <input type="text" name="site_subtitle" value="{{ old('site_subtitle') ?? $item->site_subtitle }}"
                        class="@if ($errors->has('site_subtitle')) text-input-invalid @else text-input @endif" />
                    @error('site_subtitle')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="flex flex-col space-y-2">
                <h6 class="font-semibold uppercase">{{ __('settings.order_settings') }}</h6>
                <div class="w-full md:w-1/3 flex flex-col space-y-2">
                    <label class="form-label">{{ __('settings.order_created_state') }}</label>
                    <select name="order_created_state_id"
                        class="@if ($errors->has('order_creted_state_id')) text-input-invalid @else text-input @endif">
                        <option>{{ __('settings.no_option_picked') }}</option>
                        @foreach ($order_states as $state)
                            <option value="{{ $state->id }}" @if ($state->id == $item->order_created_state_id) selected @endif>
                                {{ $state->name }}</option>
                        @endforeach
                    </select>
                    @error('order_created_state_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="w-full md:w-1/3 flex flex-col space-y-2">
                    <label class="form-label">{{ __('settings.order_paid_state') }}</label>
                    <select name="order_paid_state_id"
                        class="@if ($errors->has('order_paid_state_id')) text-input-invalid @else text-input @endif">
                        <option>{{ __('settings.no_option_picked') }}</option>
                        @foreach ($order_states as $state)
                            <option value="{{ $state->id }}" @if ($state->id == $item->order_paid_state_id) selected @endif>
                                {{ $state->name }}</option>
                        @endforeach
                    </select>
                    @error('order_paid_state_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="w-full md:w-1/3 flex flex-col space-y-2">
                    <label class="form-label">{{ __('settings.order_deleted_state') }}</label>
                    <select name="order_deleted_state_id"
                        class="@if ($errors->has('order_deleted_state_id')) text-input-invalid @else text-input @endif">
                        <option>{{ __('settings.no_option_picked') }}</option>
                        @foreach ($order_states as $state)
                            <option value="{{ $state->id }}" @if ($state->id == $item->order_deleted_state_id) selected @endif>
                                {{ $state->name }}</option>
                        @endforeach
                    </select>
                    @error('order_deleted_state_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="w-1/3 flex flex-col space-y-2 items-start">
                <button type="submit" class="btn-success">
                    {{ __('globals.update') }}
                </button>
            </div>
        </form>
    </div>
@stop
