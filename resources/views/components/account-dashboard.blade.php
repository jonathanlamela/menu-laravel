<div class="w-full">
    <h4 class='text-2xl antialiased font-sans'>Il mio profilo</h4>
</div>
<div class='w-full pb-2 pt-4 flex flex-col space-y-4 md:flex-row  md:space-x-4 md:space-y-0'>
    <div class='dashboard-button'>
        <a class='dashboard-button-link' href="{{route('account.informazioni-personali')}}">
            <div class="dashboard-button-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width={1.5} stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
            <p class="text-center">Informazioni personali</p>
        </a>
    </div>
    <div class='dashboard-button'>
        <a class='dashboard-button-link' href="{{route('account.cambia-password')}}">
            <div class="dashboard-button-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width={1.5} stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <p class="text-center">Cambia password</p>
        </a>
    </div>
    <div class='dashboard-button'>
        <a class='dashboard-button-link' href="{{route('ordini.list')}}">
            <div class="dashboard-button-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <p class="text-center">I miei ordini</p>
        </a>
    </div>
</div>
