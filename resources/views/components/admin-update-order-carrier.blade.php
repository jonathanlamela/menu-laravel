<div class="w-full flex flex-row p-6 space-x-4">
    <form class="w-full flex flex-col space-y-2" method='post'
        action="{{ route('admin.order.update_order_carrier', ['order' => $order]) }}">
        @csrf
        <div class="w-full flex">
            <label class="form-label">{{ __('order.delivery_type') }}</label>
        </div>
        <div class="w-full flex">
            <select name="carrier_id"
                class="flex w-full @if ($errors->has('carrier_id')) text-input-invalid @else text-input @endif">
                <option>{{ __('order.pick_a_carrier') }}</option>
                @foreach ($carriers as $carrier)
                    <option value="{{ $carrier->id }}" @if ($carrier->id == $order->carrier_id) selected @endif>
                        {{ $carrier->name }} {{ number_format($carrier->costs, 2) }} € @if ($carrier->deleted)
                            ({{ __('order.carrier_deleted') }})
                        @endif
                    </option>
                @endforeach
            </select>
            @error('carrier_id')
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
