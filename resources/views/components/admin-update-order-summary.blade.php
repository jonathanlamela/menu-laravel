<div class="w-full flex flex-row p-4">
    <div class="w-full flex flex-col space-y-2">
        <div class="w-full flex">
            <label class="form-label">Riepilogo</label>
        </div>
        <div class="w-full flex flex-col">
            <p>Totale: {{ number_format($order->total, 2) }} €</p>
        </div>
    </div>
</div>
