<div class="w-full">
    <h4 class='text-2xl antialiased font-sans'>Amministrazione</h4>
</div>
<div class='w-full pb-2 pt-4 flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0'>
    <div class='dashboard-button'>
        <a class='dashboard-button-link' href="{{ route('admin.category.list') }}">
            <div class="dashboard-button-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>

            </div>
            <p class="text-center">Categorie</p>
        </a>
    </div>
    <div class='dashboard-button'>
        <a class='dashboard-button-link' href="{{ route('admin.food.list') }}">
            <div class="dashboard-button-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                </svg>

            </div>
            <p class="text-center">Cibi</p>
        </a>
    </div>
</div>
<div class="w-full">
    <h4 class='text-2xl antialiased font-sans'>Vendite</h4>
</div>
<div class='w-full pb-2 pt-4 flex flex-col space-y-4 md:flex-row  md:space-x-4 md:space-y-0'>
    <div class='dashboard-button'>
        <a class='dashboard-button-link' href="{{ route('admin.order-state.list') }}">
            <div class="dashboard-button-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                    stroke="currentColor" class="w-6 h-6">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                </svg>

            </div>
            <p class="text-center">Stati ordine</p>
        </a>
    </div>
</div>
<div class="w-full">
    <h4 class='text-2xl antialiased font-sans'>Impostazioni</h4>
</div>
<div class='w-full pb-2 pt-4 flex flex-col space-y-4 md:flex-row  md:space-x-4 md:space-y-0'>
    <div class='dashboard-button'>
        <a class='dashboard-button-link' href="{% url 'admin_impostazionigenerali_updateview' %}">
            <div class="dashboard-button-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                    stroke="currentColor" class="w-6 h-6">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5" />
                </svg>
            </div>
            <p class="text-center">Generali</p>
        </a>
    </div>
    <div class='dashboard-button'>
        <a class='dashboard-button-link' href="{% url 'admin_impostazionispedizioni_updateview' %}">
            <div class="dashboard-button-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>

            </div>
            <p class="text-center">Spedizione</p>
        </a>
    </div>
    <div class='dashboard-button'>
        <a class='dashboard-button-link' href="{% url 'admin_impostazionivendite_updateview' %}">
            <div class="dashboard-button-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>


            </div>
            <p class="text-center">Ordini</p>
        </a>
    </div>
</div>
