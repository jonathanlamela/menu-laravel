<div class="w-full bg-slate-600 p-4">

    <form action="{{ route('change_language') }}" class="flex flex-col" method="get">
        <label class="text-white">{{ __('globals.language') }}</label>
        <select class="w-full lg:w-1/4" name="lang" onchange="this.form.submit()">
            @foreach ($languages as $lang)
                <option value="{{ $lang['code'] }}" @if ($lang['code'] == $currentLang) selected @endif>
                    {{ $lang['label'] }}
                </option>
            @endforeach
        </select>
    </form>
</div>
