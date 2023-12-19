<div class="w-full flex flex-row p-4 space-x-4">
    <form class="w-full flex flex-col space-y-2" method='post'
        action="{{ route('admin.order.update_order_note', ['order' => $order]) }}">
        @csrf
        <div class="w-full flex">
            <label class="form-label">{{ __('order.notes') }}</label>
        </div>
        <div class="w-full flex flex-col">
            <textarea class="text-input" name="note">{{ $order->note }}</textarea>
        </div>
        <div class="w-full flex items-center justify-end">
            <button type="submit" class="btn-success flex flex-row space-x-2">
                <span>{{ __('globals.update') }}</span>
            </button>
        </div>
    </form>
</div>
