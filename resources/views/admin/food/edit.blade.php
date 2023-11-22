@extends('layout')

@section('title') {{ __('food.edit_title') }} @stop

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
            <a class="breadcrumb-link" href="{{ route('admin.food.list') }}">{{ __('food.list_title') }}</a>
        </li>
        <li>::</li>
        <li>
            {{ __('food.edit_title') }}
        </li>
    </ol>
@stop

@section('content')
    <div class="pl-8 pr-8 pt-8 flex flex-col space-y-2 pb-8 w-full">
        <x-messages></x-messages>
        <div class="w-full">
            <p class="text-2xl antialiased font-bold">{{ __('globals.create') }} "{{ $food->name }}"</p>
        </div>
        <form class="flex-col space-y-4" method="post" action="{{ route('admin.food.update', ['food' => $food]) }}">
            @csrf
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">{{ __('food.name') }}</label>
                <input type="text" name="name" value="{{ old('name') ?? $food->name }}"
                    class="@if ($errors->has('name')) text-input-invalid @else text-input @endif" />
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">{{ __('food.name') }}</label>
                <textarea class="text-input" name="ingredients">{{ old('ingredients') ?? $food->ingredients }}</textarea>
            </div>
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">{{ __('food.price') }}</label>
                <input type="text" name="price" value="{{ number_format(old('price') ?? $food->price, 2) }}"
                    class="@if ($errors->has('price')) text-input-invalid @else text-input @endif" />
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col space-y-2">
                <label class="form-label">{{ __('food.category') }}</label>
                <select name="category_id"
                    class="@if ($errors->has('category_id')) text-input-invalid @else text-input @endif">
                    <option value="">{{ __('food.pick_a_category') }}</option>
                    @foreach ($categories as $category)
                        @if ($category->deleted)
                            <option value="" @if ($category->id == (old('category_id') ?? $food->category->id)) selected @endif>
                                {{ $category->name }} ({{ __('category.deleted') }})
                            </option>
                        @else
                            <option value="{{ $category->id }}" @if ($category->id == (old('category_id') ?? $food->category->id)) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col space-y-2 items-start">
                <button type="submit" class="btn-success ">
                    {{ __('globals.update') }}
                </button>
            </div>
        </form>
    </div>
@stop
