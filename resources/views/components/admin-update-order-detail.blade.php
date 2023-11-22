<div class="w-full flex flex-row p-4 space-x-4">
    <div class="w-full flex flex-col space-y-2">
        <div class="w-full flex">
            <label class="form-label">{{ __('order.order_details') }}</label>
        </div>
        <div class="w-full flex flex-col">
            <table class="w-full flex flex-col">
                <thead>
                    <tr class="h-10 flex flex-row items-center">
                        <th class="flex w-4/12 items-center">
                            {{ __('order.detail_name') }}
                        </th>
                        <th class="flex w-1/12 items-center justify-center">
                            <span class="hidden lg:block"> {{ __('order.detail_quantity') }}
                            </span>
                            <span class="lg:hidden">{{ __('order.detail_qty') }}</span>
                        </th>
                        <th class="flex w-2/12 items-center justify-center">
                            <span class="hidden lg:block">{{ __('order.detail_unit_price') }}</span>
                            <span class="lg:hidden">{{ __('order.detail_unit') }}</span>
                        </th>
                        <th class="flex w-2/12 items-center justify-center">
                            <span class="hidden lg:block">{{ __('order.total_price') }}</span>
                            <span class="lg:hidden">{{ __('order.total') }}</span>
                        </th>
                        <th class="flex w-4/12 items-center justify-center">
                            {{ __('globals.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderDetails as $row)
                        <tr class="h-10 w-full odd:bg-gray-100 flex-row flex items-center flex-grow">

                            <td class="flex w-4/12 px-2">{{ $row->name }}</td>
                            <td class="flex w-1/12 items-center justify-center">{{ $row->quantity }}</td>
                            <td class="flex w-2/12 items-center justify-center">{{ number_format($row->price, 2) }}
                                €
                            </td>
                            <td class="flex w-2/12 items-center justify-center">
                                {{ number_format($row->price * $row->quantity, 2) }}
                                €</td>
                            <td class="flex w-4/12 items-center justify-center">
                                <div
                                    class="flex flex-col content-center items-center md:flex-row justify-center space-x-0 space-y-2
        md:space-x-2 md:space-y-0">
                                    <form method="post"
                                        action="{{ route('admin.order_details.increase_qty', ['orderDetail' => $row]) }}">
                                        @csrf
                                        <button class="p-2 bg-gray-300 hover:text-white hover:bg-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" viewBox="0 0 16 16">
                                                <path fillRule="evenodd"
                                                    d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                                <path
                                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                            </svg>
                                        </button>
                                    </form>
                                    <form method="post"
                                        action="{{ route('admin.order_details.reduce_qty', ['orderDetail' => $row]) }}">
                                        @csrf
                                        <button class="p-2 bg-gray-300 hover:text-white hover:bg-gray-700  rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" viewBox="0 0 16 16">
                                                <path fillRule="evenodd"
                                                    d="M5.5 10a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                                                <path
                                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                            </svg>
                                        </button>
                                    </form>
                                    <form method="post"
                                        action="{{ route('admin.order_details.remove_item', ['orderDetail' => $row]) }}">
                                        @csrf
                                        <button type="submit"
                                            class="p-2 bg-gray-300 hover:text-white hover:bg-gray-700  rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" viewBox="0 0 16 16">
                                                <path fillRule="evenodd"
                                                    d="M6.146 8.146a.5.5 0 0 1 .708 0L8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 0 1 0-.708z" />
                                                <path
                                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-full flex">
            <label class="form-label">{{ __('order.add_to_order') }}</label>
        </div>
        <div class="w-full flex">
            <form class="w-full flex flex-row items-center space-x-2" method='post'
                action="{{ route('admin.order.add_order_detail', ['order' => $order]) }}">
                <div class="w-3/4">
                    <select name="id"
                        class=" @if ($errors->has('delivery_type')) text-input-invalid @else text-input @endif">
                        @foreach ($foods as $food)
                            <option value="{{ $food->id }}">
                                {{ $food->name }} ({{ $food->category->name }}) -
                                {{ number_format($food->price, 2) }} €
                            </option>
                        @endforeach
                    </select>
                    @error('id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex w-1/4 items-center">
                    <button type="submit" class="btn btn-success">{{ __('order.add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
