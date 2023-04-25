<li class="w-full md:w-auto flex items-center justify-center py-2">
    @if (str_ends_with(Request::url(), $item->slug))
        <a class="text-white p-4 hover:bg-slate-600 w-full text-center mx-4 md:mx-0 bg-red-900 border border-slate-50/5"
            href="{{ route('category.show', ['category' => $item->slug]) }}">{{ $item->name }}</a>
    @else
        <a class="text-white p-4 hover:bg-slate-600 w-full text-center mx-4 md:mx-0"
            href="{{ route('category.show', ['category' => $item->slug]) }}">{{ $item->name }}</a>
    @endif
</li>
