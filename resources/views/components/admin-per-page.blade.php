<form class="m-0 flex space-x-2 items-center h-10" method='get'>
    <label class="text-sm">Elementi per pagina</label>
    <input type='hidden' name='search' value="{{ request('search') }}" />
    <input type='hidden' name='orderBy' value="{{ request('orderBy', 'id') }}" />
    <input type='hidden' name='ascending' value="{{ request('ascending', 'true') }}" />
    <select name="perPage" class="input-select" onchange="this.form.submit()">
        @foreach ($options as $option)
            <option value="{{ $option }}" @if ($option == $selected) selected @endif>{{ $option }}
            </option>
        @endforeach
    </select>
</form>
