<div class="w-full border border-gray-200 flex flex-row p-6 space-x-4">
    <form class="w-full flex flex-col space-y-2" method="post"
        action="{{ route('admin.order.update_order_delivery_info', ['order' => $order]) }}">
        @csrf
        <div class="w-full flex">
            <label class="form-label">{{ __('order.delivery_info') }}</label>
        </div>
        <div class="w-full flex flex-col">
            <label>{{ __('order.delivery_address') }}</label>
            <input type="text" name="delivery_address" value="{{ old('delivery_address') ?? $order->delivery_address }}"
                class="@if ($errors->has('delivery_address')) text-input-invalid @else text-input @endif" />
            @error('delivery_address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <label>{{ __('order.delivery_time') }}</label>
            <input type="text" name="delivery_time" value="{{ old('delivery_time') ?? $order->delivery_time }}"
                class="@if ($errors->has('delivery_time')) text-input-invalid @else text-input @endif" />
            @error('delivery_time')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="w-full flex items-center justify-end">
            <button type="submit" class="btn-success flex flex-row space-x-2">
                <span>{{ __('globals.update') }}</span>
            </button>
        </div>
    </form>
</div>
