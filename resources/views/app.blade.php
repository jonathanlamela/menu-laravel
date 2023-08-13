<!DOCTYPE html>
<html lang="en" class="flex flex-col flex-grow h-full">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @routes
    @viteReactRefresh
    @vite(['resources/js/app.tsx', 'resources/css/app.css'])
    @inertiaHead
</head>

<body class="flex flex-col flex-grow bg-slate-50">
    <div class="container mx-auto flex flex-col flex-grow">
        <div class="shadow-md bg-white flex flex-col flex-grow" id="root">
            @inertia
        </div>
    </div>
</body>

</html>
