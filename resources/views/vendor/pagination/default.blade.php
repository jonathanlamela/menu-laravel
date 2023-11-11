<div class="flex flex-row space-x-2 h-10">
    @if ($paginator->onFirstPage())
        <button disabled class="btn-secondary-outlined">Precedente</button>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="btn-secondary-outlined">Precedente</a>
    @endif
    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <button class="btn-secondary-outlined-active">{{ $page }}</button>
                @else
                    <a href="{{ $url }}" class="btn-secondary-outlined">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="btn-secondary-outlined">Prossima</a>
    @else
        <button disabled class="btn-secondary-outlined">Prossima</button>
    @endif
</div>
