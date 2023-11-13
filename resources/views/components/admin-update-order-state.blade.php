<div class="w-full flex flex-row p-6 space-x-4">
    <form class="w-full flex flex-col space-y-2" method="post"
        action="{{ route('admin.order.update_order_state', ['order' => $order]) }}">
        @csrf
        <div class="w-full flex">
            <label class="form-label">Stato ordine</label>
        </div>
        <div class="w-full flex">
            <select name="order_state_id"
                class="w-full @if ($errors->has('order_state_id')) text-input-invalid @else text-input @endif">
                @foreach ($order_states as $state)
                    <option value="{{ $state->id }}" @if ($state->id == $order->order_state_id) selected @endif>
                        {{ $state->name }}</option>
                @endforeach
            </select>
            @error('order_state_id')
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
