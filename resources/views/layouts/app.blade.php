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

<footer class="site-footer">
    <div class="footer-content">

        <div class="footer-about">
            <a href="/" class="footer-logo">MarineLife</a>

            <p>
                Conheça a diversidade da vida marinha e descubra
                os oceanos, as espécies e os habitats do nosso planeta.
            </p>
        </div>

        <div class="footer-navigation">
            <h3>Explore</h3>

            <a href="/animais">Animais</a>
            <a href="/especies">Espécies</a>
            <a href="/oceanos">Oceanos</a>
            <a href="/habitats">Habitats</a>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} MarineLife. Projeto educativo sobre a vida marinha.</p>
    </div>
</footer>

</html>