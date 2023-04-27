@if ($paginator->hasPages())

    <ul class="flex flex-row space-x-2">

        @if ($paginator->onFirstPage())
            <button class="btn-secondary-outlined" disabled>Precedente</button>
        @else
            <a class="btn-secondary-outlined" href="{{ $paginator->previousPageUrl() }}">Precedente</a>
        @endif

        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="btn-secondary-outlined-active" href="{{ $url }}">{{ $page }}</a>
                    @else
                        <a class="btn-secondary-outlined" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a class="btn-secondary-outlined" href="{{ $paginator->nextPageUrl() }}">Successivo</a>
        @else
            <button class="btn-secondary-outlined" disabled>Successivo</button>
        @endif
    </ul>

@endif
