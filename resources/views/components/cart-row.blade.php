<tr class="flex border-b justify-center items-center py-2">

    @if ($actions)
        <td class="w-3/6">{{ $cartItem['item']['name'] }}</td>
        <td class="w-1/6 text-center">{{ $cartItem['quantity'] }}</td>
        <td class="w-1/6 text-center">{{ number_format($cartItem['item']['price'], 2) }} €</td>
        <td class="w-1/6 text-center">
            <div
                class="flex flex-col content-center items-center md:flex-row justify-center space-x-0 space-y-2
        md:space-x-2 md:space-y-0">
                <form method="post" action="{{ route('cart.increase_qty') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $cartItem['item']['id'] }}" />
                    <button class="p-2 bg-gray-300 hover:text-white hover:bg-gray-700 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path fillRule="evenodd"
                                d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                            <path
                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                        </svg>
                    </button>
                </form>
                <form method="post" action="{{ route('cart.decrease_qty') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $cartItem['item']['id'] }}" />
                    <button class="p-2 bg-gray-300 hover:text-white hover:bg-gray-700  rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path fillRule="evenodd"
                                d="M5.5 10a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                            <path
                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                        </svg>
                    </button>
                </form>
                <form method="post" action="{{ route('cart.remove_item') }}">
                    <input type="hidden" name="id" value="{{ $cartItem['item']['id'] }}" />
                    @csrf
                    <button type="submit" class="p-2 bg-gray-300 hover:text-white hover:bg-gray-700  rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path fillRule="evenodd"
                                d="M6.146 8.146a.5.5 0 0 1 .708 0L8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 0 1 0-.708z" />
                            <path
                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                        </svg>
                    </button>
                </form>
            </div>
        </td>
    @else
        <td class="w-4/6">{{ $cartItem['item']['name'] }}</td>
        <td class="w-1/6 text-center">{{ $cartItem['quantity'] }}</td>
        <td class="w-1/6 text-center">{{ number_format($cartItem['item']['price'], 2) }} €</td>
    @endif

</tr>
