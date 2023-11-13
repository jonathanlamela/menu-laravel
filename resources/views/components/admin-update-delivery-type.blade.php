<div class="w-full flex flex-row p-6 space-x-4">
    <form class="w-full flex flex-col space-y-2" method='post'
        action="{{ route('admin.order.update_order_delivery_type', ['order' => $order]) }}">
        @csrf
        <div class="w-full flex">
            <label class="form-label">Tipologia di consegna</label>
        </div>
        <div class="w-full flex">
            <select name="delivery_type"
                class="w-full @if ($errors->has('delivery_type')) text-input-invalid @else text-input @endif">
                <option value="ASPORTO" @if (!$order->is_shipping) selected @endif>Asporto
                </option>
                <option value="DOMICILIO" @if ($order->is_shipping) selected @endif>A domicilio
                </option>
            </select>
            @error('delivery_type')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="w-full flex items-center justify-end">
            <button type="submit" class="btn-success flex flex-row space-x-2">
                <span>Aggiorna</span>
            </button>
        </div>
    </form>
</div>
