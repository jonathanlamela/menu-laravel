<!DOCTYPE html>
<html lang="en" class="flex flex-col flex-grow h-full">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @routes
    @viteReactRefresh
    @vite('resources/css/app.css')
    @vite('frontend/app.tsx')
    @inertiaHead
</head>

<body class="flex flex-col flex-grow bg-slate-50">
    <div class="container mx-auto flex flex-col flex-grow">
        <div class="shadow-md bg-white flex flex-col flex-grow">
            @inertia
        </div>
    </div>
</body>

</html>
