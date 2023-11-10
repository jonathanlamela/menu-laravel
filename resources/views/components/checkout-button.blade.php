@if (auth()->user())
    <a class="bg-green-800 text-white p-4 hover:bg-green-900" href={{ route('checkout.step1') }}>Vai alla cassa</a>
@endif
