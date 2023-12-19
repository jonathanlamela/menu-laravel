<div class="flex flex-row space-x-2 h-10">
    @if ($paginator->onFirstPage())
        <button disabled class="btn-secondary-outlined">{{ __('globals.previous_page') }}</button>
    @else
        <a href="{{ $paginator->previousPageUrl() }}&perPage={{ request('perPage', 5) }}&search={{ request('search') }}&orderBy={{ request('orderBy', 'id') }}&ascending={{ request('ascending', 'true') }}"
            class="btn-secondary-outlined">{{ __('globals.previous_page') }}</a>
    @endif
    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <button class="btn-secondary-outlined-active">{{ $page }}</button>
                @else
                    <a href="{{ $url }}&perPage={{ request('perPage', 5) }}&search={{ request('search') }}&orderBy={{ request('orderBy', 'id') }}&ascending={{ request('ascending', 'true') }}"
                        class="btn-secondary-outlined">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}&perPage={{ request('perPage', 5) }}&search={{ request('search') }}&orderBy={{ request('orderBy', 'id') }}&ascending={{ request('ascending', 'true') }}"
            class="btn-secondary-outlined">{{ __('globals.next_page') }}</a>
    @else
        <button disabled class="btn-secondary-outlined">{{ __('globals.next_page') }}</button>
    @endif
</div>
