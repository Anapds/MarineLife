
@extends('layouts.app')

@section('content')

<section class="oceanos-hero">
    <span class="oceanos-eyebrow">
        MARINELIFE · EXPLORAÇÃO MARINHA
    </span>

    <h1>Conheça os oceanos</h1>

    <p>
        Cinco oceanos. Um planeta conectado pela água.
        Descubra os ambientes que sustentam a vida marinha.
    </p>
</section>

<section class="oceanos-container" id="lista-oceanos">

    <div class="oceanos-intro">
        <span>NOSSO PLANETA AZUL</span>
        <h2>Os gigantes azuis da Terra</h2>
        <p>
            Cada oceano possui características únicas e
            desempenha um papel essencial no equilíbrio
            dos ecossistemas do planeta.
        </p>
    </div>

    <div class="oceanos-lista">

        <article class="oceano-item">
            <div class="oceano-numero">01</div>

            <div class="oceano-info">
                <h3>Oceano Pacífico</h3>
                <p>
                    É o maior e mais profundo oceano do planeta.
                    Abriga uma enorme diversidade de espécies,
                    recifes de coral e ecossistemas de águas profundas.
                </p>

                <span class="oceano-detalhe">
                    Maior extensão oceânica
                </span>
            </div>

            <div class="oceano-seta" aria-hidden="true">
                ↗
            </div>
        </article>

        <article class="oceano-item">
            <div class="oceano-numero">02</div>

            <div class="oceano-info">
                <h3>Oceano Atlântico</h3>
                <p>
                    Separa as Américas da Europa e da África.
                    Suas correntes oceânicas influenciam o clima
                    e conectam diferentes ecossistemas marinhos.
                </p>

                <span class="oceano-detalhe">
                    Correntes oceânicas
                </span>
            </div>

            <div class="oceano-seta" aria-hidden="true">
                ↗
            </div>
        </article>

        <article class="oceano-item">
            <div class="oceano-numero">03</div>

            <div class="oceano-info">
                <h3>Oceano Índico</h3>
                <p>
                    Abriga águas tropicais, manguezais e recifes
                    de coral que servem de habitat para inúmeras
                    espécies marinhas.
                </p>

                <span class="oceano-detalhe">
                    Biodiversidade tropical
                </span>
            </div>

            <div class="oceano-seta" aria-hidden="true">
                ↗
            </div>
        </article>

        <article class="oceano-item">
            <div class="oceano-numero">04</div>

            <div class="oceano-info">
                <h3>Oceano Ártico</h3>
                <p>
                    Localizado ao redor do Polo Norte, possui águas
                    frias e ecossistemas adaptados às condições
                    extremas das regiões polares.
                </p>

                <span class="oceano-detalhe">
                    Ecossistemas polares
                </span>
            </div>

            <div class="oceano-seta" aria-hidden="true">
                ↗
            </div>
        </article>

        <article class="oceano-item">
            <div class="oceano-numero">05</div>

            <div class="oceano-info">
                <h3>Oceano Austral</h3>
                <p>
                    Circunda a Antártida e desempenha um papel
                    importante na circulação global das águas.
                    É habitat de pinguins, focas e baleias.
                </p>

                <span class="oceano-detalhe">
                    Circulação oceânica global
                </span>
            </div>

            <div class="oceano-seta" aria-hidden="true">
                ↗
            </div>
        </article>

    </div>

    <footer class="oceanos-footer">
        <span class="oceanos-footer-linha"></span>
        <p>MARINELIFE · CONHECER PARA PRESERVAR</p>
        <span class="oceanos-footer-linha"></span>
    </footer>

</section>

@endsection
