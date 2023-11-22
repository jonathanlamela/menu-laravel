<div class="w-full flex flex-row p-4">
    <div class="w-full flex flex-col space-y-2">
        <div class="w-full flex">
            <label class="form-label">{{ __('order.summary') }}</label>
        </div>
        <div class="w-full flex flex-col">
            <p>{{ __('order.total') }}: {{ number_format($order->total_paid, 2) }} €</p>
        </div>
    </div>
</div>
