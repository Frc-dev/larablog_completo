<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">

    <title>Módulo de administracion</title>

</head>

<body>
    <div id="app">
        @include('web.partials.nav-header-main')

        <div class="container mb-3 mt-3" id="app">
            @yield('content')
        </div>

         @include('web.partials.footer-main')
    </div>
    <script src="{{ asset("js/app.js") }}"></script>

</body>
</html>
