<!DOCTYPE html>
<html lang="it" class="flex flex-col flex-grow h-full">

<head>
    <title>@yield('title') :: {{$settings['site_title']}}</title>

    @vite('resources/css/app.css')

</head>

<body class="flex flex-col flex-grow bg-gradient-to-b from-slate-100 via-slate-300 to-slate-100">
    <div class="container mx-auto flex flex-col flex-grow">
        <div class="shadow-md bg-white flex flex-col flex-grow">
            <main class="flex flex-col flex-grow">
                <div class="w-full">
                    <div class="bg-red-900 flex flex-col md:flex-row p-1">
                        <div class="w-full md:w-3/4 flex p-2 justify-center md:justify-start">
                            @section('topbarLeft')
                            @show
                        </div>
                        <div class="w-full md:w-1/4 flex flex-row p-2 justify-center md:justify-end">
                            @section('topbarRight')
                            @show
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    @section('header')
                    @show
                </div>
                <div class="bg-gray-800 md:h-16 flex">
                    @section('nav')
                    @show
                </div>
                @section('content')
                @show
            </main>
        </div>
    </div>
</body>

</html>
