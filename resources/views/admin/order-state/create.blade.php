@extends('layouts')

@section('title', 'Crea categoria')

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
                <a class="breadcrumb-link" href="{{ route('admin.order-state.list') }}">Stati ordine</a>
            </li>
            <li>::</li>
            <li>
                Crea
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="flex flex-col p-8 flex-grow">
        <x-messages></x-messages>

        <form class="flex-col space-y-2" method="post">
            @csrf
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">Descrizione</label>
                <input type="text" name="description" value="{{ old('description') }}"
                    class="text-input @error('description') text-input-invalid @enderror">
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col space-y-2" id="selector">
                <label class="form-label">Classe CSS Badge</label>
                <div class="flex flex-row items-center w-full space-x-4">
                    <div class="w-full">
                        <select name="css_badge_class" class="text-input flex w-full" v-model="selezione">
                            <option value='badge-primary'>Primary</option>
                            <option value='badge-secondary'>Secondary</option>
                            <option value='badge-info'>Info</option>
                            <option value='badge-success'>Success</option>
                            <option value='badge-danger'>Danger</option>
                        </select>
                    </div>
                    <div class="flex justify-center">
                        <span class="justify-center" :class="selezione">Esempio</span>
                    </div>
                </div>
            </div>
            <div class="w-1/3 flex flex-col space-y-2 items-start">
                <button type="submit" class="btn-success">Crea</button>
            </div>
        </form>
    </div>
@endsection


@section('extrascripts')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    selezione: "{{ old('css-badge-class') ?? 'badge-primary' }}"
                }
            }
        }).mount('#selector')
    </script>
@endsection
