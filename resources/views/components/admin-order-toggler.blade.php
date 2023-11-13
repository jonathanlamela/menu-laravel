@if ($isCurrent)
    <form method='get' class="{{ $class }}">
        {{ request('ascending', true) ? false : true }}
        <input type='hidden' name='search' value="{{ request('search') }}" />
        <input type='hidden' name='orderBy' value="{{ $field }}" />
        <input type='hidden' name='ascending' value="{{ $ascending == 'true' ? 'false' : 'true' }}" />
        <input type='hidden' name='perPage' value="{{ request('perPage', 5) }}" />
        <button class="items-center {{ $class }}">
            <span>{{ $label }}</span>
            <div class="bg-slate-900 rounded-full p-1 text-white">
                @if ($ascending == 'false')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                        stroke="currentColor" class="w-3 h-3">
                        <path strokeLinecap="round" strokeLinejoin="round" d=" M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                        stroke="currentColor" class="w-3 h-3">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                    </svg>
                @endif
            </div>
        </button>
    </form>
@else
    <form method='get' class="{{ $class }}">
        <input type='hidden' name='search' value="{{ request('search') }}" />
        <input type='hidden' name='orderBy' value="{{ $field }}" />
        <input type='hidden' name='ascending' value="true" />
        <input type='hidden' name='perPage' value="{{ request('perPage', 5) }}" />
        <button>
            <span>{{ $label }}</span>
        </button>
    </form>
@endif
