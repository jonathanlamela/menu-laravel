@extends('layouts')

@section('title', 'Impostazioni ordini')

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
                <label class=" form-label">Stato di default per gli ordini creati</label>
                <select name="order_created_state_id"
                    class="text-input @error('order_created_state_id') text-input-invalid @enderror">
                    @foreach ($orderStates as $state)
                        @if ($state->id == old('order_created_state_id') || $state->id == $item->order_created_state_id)
                            )
                            <option value="{{ $state->id }}" selected>{{ $state->description }}</option>
                        @else
                            <option value="{{ $state->id }}">{{ $state->description }}</option>
                        @endif
                    @endforeach
                </select>

            </div>
            <div class="w-1/3 flex flex-col space-y-2">
                <label class=" form-label">Stato di default per gli ordini pagati</label>
                <select name="order_paid_state_id"
                    class="text-input @error('order_paid_state_id') text-input-invalid @enderror">
                    @foreach ($orderStates as $state)
                        @if ($state->id == old('order_paid_state_id') || $state->id == $item->order_paid_state_id)
                            <option value="{{ $state->id }}" selected>{{ $state->description }}</option>
                        @else
                            <option value="{{ $state->id }}">{{ $state->description }}</option>
                        @endif
                    @endforeach
                </select>
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
                Ordini
            </li>
        </ol>
    </div>
@endsection
