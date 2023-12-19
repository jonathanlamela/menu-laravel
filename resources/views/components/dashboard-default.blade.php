<div class="w-full">
    <h4 class='text-2xl antialiased font-sans'>{{ __('account.my_profile') }}</h4>
</div>
<div class='w-full flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0'>
    <div
        class='w-full md:w-1/2 lg:w-1/6 bg-slate-50 lg:max-w-xs hover:bg-slate-500  hover:text-white border-b-red-900  border-b-8 text-red-900'>
        <a class="flex flex-col space-y-8 p-8 justify-center items-center" href="{{ route('account.my_account') }}">
            <div class="w-full flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                    stroke="currentColor" class="w-6 h-6">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
            <p class="text-center">{{ __('account.personal_info') }}</p>
        </a>
    </div>
    <div
        class='w-full md:w-1/2 lg:w-1/6 bg-slate-50 lg:max-w-xs hover:bg-slate-500  hover:text-white border-b-red-900  border-b-8 text-red-900'>
        <a class="flex flex-col space-y-8 p-8 justify-center items-center"
            href="{{ route('account.change_password') }}">
            <div class="w-full flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                    stroke="currentColor" class="w-6 h-6">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <p class="text-center">{{ __('account.change_password') }}</p>
        </a>
    </div>
    <div
        class='w-full md:w-1/2 lg:w-1/6 bg-slate-50 lg:max-w-xs hover:bg-slate-500  hover:text-white border-b-red-900  border-b-8 text-red-900'>
        <a class="flex flex-col space-y-8 p-8 justify-center items-center" href="{{ route('order.list') }}">
            <div class="w-full flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <p class="text-center">{{ __('account.my_orders') }}</p>
        </a>
    </div>
</div>
