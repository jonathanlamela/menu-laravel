    @if (session()->has('success_message'))
        <div class="pb-4">
            <div class="bg-lime-700/25 border-l-lime-700 border-l-8 p-4 text-green-900">
                {{ session('success_message') }}
            </div>
        </div>
    @endif

    @if (session()->has('error_message'))
        <div class="pb-4">
            <div className="bg-red-700/25 border-l-red-700 border-l-8 p-4 text-red-900">
                {{ session('error_message') }}

            </div>
        </div>
    @endif

    @if (session()->has('info_message'))
        <div class="pb-4">
            <div class="bg-gray-400/25 border-l-gray-700 border-l-8 p-4 text-gray-900">
                {{ session('info_message') }}
            </div>
        </div>
    @endif


    @if (session()->has('status'))
        @if (session('status') === 'password-updated')
            <div class="pb-4">
                <div class="bg-lime-700/25 border-l-lime-700 border-l-8 p-4 text-green-900">
                    Password cambiata con successo
                </div>
            </div>
        @elseif(session('status') === 'profile-information-updated')
            <div class="pb-4">
                <div class="bg-lime-700/25 border-l-lime-700 border-l-8 p-4 text-green-900">
                    Informazioni profilo aggiornate
                </div>
            </div>
        @elseif(session('status') === 'verification-link-sent')
            <div class="pb-4">
                <div class="bg-lime-700/25 border-l-lime-700 border-l-8 p-4 text-green-900">
                    Ti abbiamo inviato un nuovo link di verifica alla tua email
                </div>
            </div>
        @else
            <div class="pb-4">
                <div class="bg-gray-400/25 border-l-gray-700 border-l-8 p-4 text-gray-900">
                    {{ session('status') }}

                </div>
            </div>
        @endif

    @endif
