@extends('layout')

@section('title') Modifica stato ordine @stop

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
            <a class="breadcrumb-link" href="{{ route('account.index') }}">Profilo</a>
        </li>
        <li>::</li>
        <li>Catalogo</li>
        <li>::</li>
        <li>
            <a class="breadcrumb-link" href="{{ route('admin.order_state.list') }}">Stati ordine</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="pl-8 pr-8 pt-8 flex flex-col space-y-4 pb-8">
        <x-messages></x-messages>
        <div class="w-full">
            <p class="text-2xl antialiased font-bold">Modifica stato ordine</p>
        </div>
        <form method="post" action="{{ route('admin.order_state.update', ['orderState' => $orderState]) }}">
            @csrf
            <div class="flex flex-col space-y-4">
                <div class="w-1/3 flex flex-col space-y-2">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" value="{{ old('name') ?? $orderState->name }}"
                        class="@if ($errors->has('name')) text-input-invalid @else text-input @endif" />
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="w-1/3 flex flex-col space-y-2">
                    <label class="form-label">Classe CSS per il badge</label>
                    <select name="css_badge_class" class="text-input" onchange="onBadgeChange(event)">
                        @foreach ($badge_options as $key => $value)
                            <option value="{{ $key }}" @if ($key == (old('css_badge_class') ?? $orderState->css_badge_class)) selected @endif>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/3 flex flex-col space-y-2">
                    <label class="form-label">Preview</label>
                    <p id="preview_badge" class="{{ old('css_badge_class') ?? $orderState->css_badge_class }}">
                        Esempio badge
                    </p>
                </div>
                <div class="w-1/3 flex flex-col space-y-2 items-start">
                    <button type="submit" class="btn-success ">
                        Modifica
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
