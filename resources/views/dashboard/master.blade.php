<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">

    <title>Módulo de administracion</title>

</head>

<body>

    @include('dashboard.partials.nav-header-main')
    <div class="container">

        @include('dashboard.partials.session-status')
        @yield('content')
    </div>
    <script src="{{ asset("js/app.js") }}"></script>

</body>
</html>
