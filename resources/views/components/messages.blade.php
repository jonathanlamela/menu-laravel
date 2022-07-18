<div class="row g-0 ps-4 pt-4 pe-4">
    @if(session()->has('success_message'))
    <div class="alert alert-success" role="alert">
        {{session('success_message')}}
    </div>
    @endif

    @if(session()->has('error_message'))
    <div class="alert alert-success" role="alert">
        {{session('error_message')}}
    </div>
    @endif

    @if(session()->has('info_message'))
    <div class="alert alert-success" role="alert">
        {{session('info_message')}}
    </div>
    @endif


    @if(session()->has('status'))
    @if(session('status')==="password-updated")
    <div class="alert alert-success" role="alert">
        Password cambiata con successo
    </div>
    @elseif(session('status')==="profile-information-updated")
    <div class="alert alert-success" role="alert">
        Informazioni profilo aggiornate
    </div>
    @else
    <div class="alert alert-info" role="alert">
        {{session('status')}}
    </div>
    @endif

    @endif

</div>
