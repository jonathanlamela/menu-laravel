@if(auth()->user())
<a class="btn btn-link text-light text-decoration-none" href="{{route('account.dashboard')}}"><i class="bi bi-globe2 pe-2"></i>Profilo</a>
<form class="m-0" method="post" action="{{route('logout')}}">@csrf
    <button class="btn btn-link text-light text-decoration-none"><i class="bi-box-arrow-right pe-2"></i>Esci</a>
</form>
@else
<a class="btn btn-link text-light text-decoration-none" href="{{route('login')}}"><i class="bi bi-person pe-2"></i>Accedi</a>
@endif
