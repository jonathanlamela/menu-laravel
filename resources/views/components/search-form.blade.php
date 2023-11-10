<form class="flex flex-row w-full md:w-96 space-x-2" method="get" action="{{ route('searchGlobally') }}">
    <input type="text" name="key" class="p-2 w-3/4" value="{{ request('key') ?? '' }}" />
    <button type="submit"
        class="text-white w-1/4 p-2 border-white/25 border hover:text-red-900
        hover:bg-white">Cerca</button>
</form>
