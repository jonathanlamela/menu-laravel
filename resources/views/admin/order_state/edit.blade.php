@extends('layout')

@section('title') {{ __('order_state.delete_title') }} @stop

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
        <li>{{ __('sections.catalog') }}</li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('admin.order_state.list') }}">{{ __('order_state.list_title') }}</a>
        </li>
        <li>::</li>
        <li>
            {{ __('order_state.edit_title') }}
        </li>
    </ol>
@stop

@section('content')
    <div class="pl-8 pr-8 pt-8 flex flex-col space-y-4 pb-8 w-full">
        <x-messages></x-messages>
        <div class="w-full">
            <p class="text-2xl antialiased font-bold">{{ __('order_state.update_title') }}</p>
        </div>
        <form method="post" action="{{ route('admin.order_state.update', ['orderState' => $orderState]) }}">
            @csrf
            <div class="flex flex-col space-y-4">
                <div class="w-full lg:w-1/3 flex flex-col space-y-2">
                    <label class="form-label">{{ __('order_state.name') }}</label>
                    <input type="text" name="name" value="{{ old('name') ?? $orderState->name }}"
                        class="@if ($errors->has('name')) text-input-invalid @else text-input @endif" />
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="w-full lg:w-1/3 flex flex-col space-y-2">
                    <label class="form-label">{{ __('order_state.css_badge_class') }}</label>
                    <select name="css_badge_class" class="text-input" onchange="onBadgeChange(event)">
                        @foreach ($badge_options as $key => $value)
                            <option value="{{ $key }}" @if ($key == (old('css_badge_class') ?? $orderState->css_badge_class)) selected @endif>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full lg:w-1/3 flex flex-col space-y-2">
                    <label class="form-label">{{ __('order_state.css_badge_class') }}</label>
                    <p id="preview_badge" class="{{ old('css_badge_class') ?? $orderState->css_badge_class }}">
                        Lorem ipsum
                    </p>
                </div>
                <div class="w-1/3 flex flex-col space-y-2 items-start">
                    <button type="submit" class="btn-success ">
                        {{ __('globals.update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function onBadgeChange(e) {
            document.getElementById("preview_badge").className = e.target.value;
        }
    </script>
@stop
