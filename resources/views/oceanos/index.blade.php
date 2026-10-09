
@extends('layouts.app')

@section('content')

    <section class="oceanos-hero">
        <h1>Conheça os oceanos</h1>

        <p>
            Explore os cinco oceanos do nosso planeta e descubra
            os ambientes que sustentam a vida marinha.
        </p>
    </section>

    <section class="oceanos-lista">

        <article class="oceano-item">
            <div class="oceano-info">
                <span class="oceano-numero">01</span>

                <h2>Oceano Pacífico</h2>

                <p>
                    É o maior e mais profundo oceano do planeta.
                    Abriga uma enorme diversidade de espécies,
                    recifes de coral e ecossistemas de águas profundas.
                </p>
            </div>

            <div class="oceano-visual">
                <!-- Sua imagem do Oceano Pacífico entrará aqui -->
            </div>
        </article>

        <article class="oceano-item">
            <div class="oceano-info">
                <span class="oceano-numero">02</span>

                <h2>Oceano Atlântico</h2>

                <p>
                    Separa as Américas da Europa e da África.
                    Suas correntes oceânicas influenciam o clima
                    e conectam diferentes ecossistemas marinhos.
                </p>
            </div>

            <div class="oceano-visual">
                <!-- Sua imagem do Oceano Atlântico entrará aqui -->
            </div>
        </article>

        <article class="oceano-item">
            <div class="oceano-info">
                <span class="oceano-numero">03</span>

                <h2>Oceano Índico</h2>

                <p>
                    Abriga águas tropicais, manguezais e recifes
                    de coral que servem de habitat para inúmeras
                    espécies marinhas.
                </p>
            </div>

            <div class="oceano-visual">
                <!-- Sua imagem do Oceano Índico entrará aqui -->
            </div>
        </article>

        <article class="oceano-item">
            <div class="oceano-info">
                <span class="oceano-numero">04</span>

                <h2>Oceano Ártico</h2>

                <p>
                    Localizado ao redor do Polo Norte, possui águas
                    frias e ecossistemas adaptados às condições
                    extremas das regiões polares.
                </p>
            </div>

            <div class="oceano-visual">
                <!-- Sua imagem do Oceano Ártico entrará aqui -->
            </div>
        </article>

        <article class="oceano-item">
            <div class="oceano-info">
                <span class="oceano-numero">05</span>

                <h2>Oceano Austral</h2>

                <p>
                    Circunda a Antártida e desempenha um papel
                    importante na circulação global das águas.
                    É habitat de pinguins, focas e baleias.
                </p>
            </div>

            <div class="oceano-visual">
                <!-- Sua imagem do Oceano Austral entrará aqui -->
            </div>
        </article>

    </section>

@endsection
