<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/images/logo/favicon.png">

@vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>MarineLife</title>
</head>

<body>

    <header>
        <a href="/" class="logo">
            <span>MarineLife</span>
        </a>
        <nav>
            <a href="/animais">Animais</a>
            <a href="/especies">Espécies</a>
            <a href="/oceanos">Oceanos</a>
            <a href="/habitats">Habitats</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>