@extends('layouts')

@section('title', 'Stati ordine')

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
                <a class="breadcrumb-link" href="{{ route('account.dashboard') }}">
                    Profilo
                </a>
            </li>
            <li>::</li>
            <li>Stati ordine</li>
        </ol>
    </div>
@endsection



@section('content')
    <div class="flex flex-col p-8 flex-grow">
        <x-messages></x-messages>
        <div class="flex flex-col flex-grow">
            <div class="w-full bg-slate-500 p-4">
                <p class="text-xl antialiased text-white">Stati ordine</p>
            </div>
            <div class="flex w-full bg-gray-100 p-2">
                <div class="w-1/2">
                    <div class="flex">

                        <a class="btn-primary" href="{{ route('admin.order-state.create') }}">Crea</a>
                    </div>
                </div>
                <div class="w-1/2
                                flex justify-end">
                    <form class="m-0 flex space-x-2">
                        <input type="text" class="text-input bg-white" name="search" placeHolder="Cerca uno stato"
                            value="{{ request('search') }}">
                        <button type="submit" class="btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class=" w-full flex flex-grow">
                <table class="w-full flex flex-col flex-grow">
                    <thead>
                        <tr class="h-10 flex flex-row items-center">
                            <th class="w-1/12 text-center">#</th>
                            <th class="w-6/12 lg:w-5/12 text-left">Nome</th>
                            <th class="w-2/12 text-center hidden lg:block">Classe CSS Badge</th>
                            <th class="w-6/12 md:w-4/12 text-center">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr class="h-10 w-full odd:bg-gray-100 flex-row flex flex-grow">
                                <td class="w-1/12 text-center flex items-center justify-center">{{ $item->id }}</td>
                                <td class="w-6/12 md:w-5/12 text-left flex items-center">{{ $item->description }}</td>
                                <td class="w-2/12 text-center hidden lg:flex items-center justify-center">
                                    <span class="{{ $item->css_badge_class }}">Esempio di testo</span>
                                </td>
                                <td
                                    class="w-6/12 lg:w-4/12 text-center flex flex-row space-x-2 items-center content-center justify-center">
                                    <a class="flex flex-row space-x-2 items-center justify-center p-2 hover:bg-green-700 hover:text-white"
                                        href="{{ route('admin.order-state.edit', ['orderState' => $item->id]) }}"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        <span>Modifica</span></a>

                                    <a class="flex flex-row space-x-2 items-center justify-center p-2 hover:bg-red-700 hover:text-white"
                                        href="{{ route('admin.order-state.delete', ['orderState' => $item->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>

                                        <span>Elimina</span></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="w-full flex px-4 py-4">
                <x-select-per-page :elementsPerPage=$elementsPerPage></x-select-per-page>
            </div>
            {{ $items->appends(request()->input())->links() }}

        </div>
    </div>


@endsection
