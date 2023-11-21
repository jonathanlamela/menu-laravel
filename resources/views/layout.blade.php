<!DOCTYPE html>
<html lang="en" class="flex flex-col flex-grow h-full">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title') :: {{ $settings['site_title'] }}</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col flex-grow bg-slate-50">
    <div class="container mx-auto flex flex-col flex-grow">
        <div class="shadow-md bg-white flex flex-col flex-grow">
            @section('topbar')
            @show
            <x-header></x-header>
            <div class="bg-gray-800 md:h-16 flex">
                @section('navHeader')
                @show
            </div>
            <div class="flex flex-grow w-full">
                @yield('content')
            </div>
            <x-language-selector></x-language-selector>
        </div>
    </div>
</body>

</html>
