<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    @vite('resources/js/app.js')
</head>

<body>
    @include('layouts.navbar')
    <div class="container mx-auto py-16">
        @yield('content')
    </div>
</body>

</html>
