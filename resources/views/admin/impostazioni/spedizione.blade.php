@extends('layouts')

@section('title', 'Impostazioni spedizione')

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

@section('content')

    <div class="flex flex-col pt-4 px-8 flex-grow">
        <x-messages></x-messages>
        <form class="flex-col space-y-2" method="post">
            @csrf
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">Spese di consegna</label>
                <input type="text" name="shipping_costs" value="{{ $item->shipping_costs }}"
                    class="text-input @error('shipping_costs') text-input-invalid @enderror" />
                @error('shipping_costs')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="w-1/3 flex flex-col space-y-2 items-start">
                <button type="submit" class="btn-success">Salva</button>
            </div>
        </form>

    </div>
@endsection





@section('nav')
    <div class="flex h-16">
        <ol class="breadcrumb-container">
            <li>
                <a class="breadcrumb-link" href="{{ route('account.dashboard') }}">
                    Profilo
                </a>
            </li>
            <li>::</li>
            <li>
                Impostazioni
            </li>
            <li>::</li>
            <li>
                Spedizione
            </li>
        </ol>
    </div>
@endsection
