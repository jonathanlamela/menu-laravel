@if ($message)

    @if ($message['type'] == 'success')
        <div class="pb-4">
            <div class="bg-lime-700/25 border-l-lime-700 border-l-8 p-4 text-green-900">
                <span>{{ $message['text'] }}</span>
            </div>
        </div>
    @endif
    @if ($message['type'] == 'info')
        <div class="pb-4">
            <div class="bg-gray-400/25 border-l-gray-700 border-l-8 p-4 text-gray-900">
                <span>{{ $message['text'] }}</span>
            </div>
        </div>
    @endif
    @if ($message['type'] == 'error')
        <div class="pb-4">
            <div class="bg-red-700/25 border-l-red-700 border-l-8 p-4 text-red-900">
                <span>{{ $message['text'] }}</span>
            </div>
        </div>
    @endif
@endif
