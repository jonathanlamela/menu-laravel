<form class="flex flex-row w-full md:w-96 space-x-2" method="get" action="{{ route('search_globally') }}">
    <input type="text" name="search" class="p-2 w-3/4" value="{{ request('search') ?? '' }}" />
    <button type="submit"
        class="text-white w-1/4 p-2 border-white/25 border hover:text-red-900
        hover:bg-white">Cerca</button>
</form>
