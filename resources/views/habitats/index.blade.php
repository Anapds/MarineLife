
@extends('layouts.app')

@section('content')

<section class="oceanos-hero">
    <span class="oceanos-eyebrow">
        MARINELIFE · ECOSSISTEMAS MARINHOS
    </span>

    <h1>Descubra os habitats marinhos</h1>

    <p>
        Dos recifes tropicais às profundezas do oceano,
        conheça os ambientes que abrigam a vida marinha.
    </p>
</section>

<section class="oceanos-container" id="lista-habitats">

    <div class="oceanos-intro">
        <span>VIDA EM CADA AMBIENTE</span>

        <h2>Onde a vida marinha acontece</h2>

        <p>
            Cada habitat possui condições próprias de luz,
            temperatura e profundidade, influenciando as
            espécies que vivem nele.
        </p>
    </div>

    <div class="oceanos-lista">

        <article class="oceano-item">
            <div class="oceano-numero">01</div>

            <div class="oceano-info">
                <h3>Recifes de coral</h3>

                <p>
                    Ecossistemas ricos em biodiversidade que
                    oferecem abrigo e alimento para peixes,
                    crustáceos e muitas outras espécies marinhas.
                </p>

                <span class="oceano-detalhe">
                    Alta biodiversidade
                </span>
            </div>

            <div class="oceano-seta" aria-hidden="true">↗</div>
        </article>

        <article class="oceano-item">
            <div class="oceano-numero">02</div>

            <div class="oceano-info">
                <h3>Manguezais</h3>

                <p>
                    Ambientes costeiros onde águas doces e
                    salgadas se encontram. Suas raízes servem
                    de abrigo para diversas espécies e ajudam
                    a proteger a costa.
                </p>

                <span class="oceano-detalhe">
                    Proteção costeira
                </span>
            </div>

            <div class="oceano-seta" aria-hidden="true">↗</div>
        </article>

        <article class="oceano-item">
            <div class="oceano-numero">03</div>

            <div class="oceano-info">
                <h3>Mar aberto</h3>

                <p>
                    A região oceânica distante da costa abriga
                    plâncton, tubarões, atuns, golfinhos e
                    baleias, formando complexas redes alimentares.
                </p>

                <span class="oceano-detalhe">
                    Vida em movimento
                </span>
            </div>

            <div class="oceano-seta" aria-hidden="true">↗</div>
        </article>

        <article class="oceano-item">
            <div class="oceano-numero">04</div>

            <div class="oceano-info">
                <h3>Fundos oceânicos</h3>

                <p>
                    Das plataformas continentais às grandes
                    fossas, esses ambientes abrigam organismos
                    adaptados à pressão elevada e, nas regiões
                    profundas, à ausência de luz.
                </p>

                <span class="oceano-detalhe">
                    Ecossistemas profundos
                </span>
            </div>

            <div class="oceano-seta" aria-hidden="true">↗</div>
        </article>

        <article class="oceano-item">
            <div class="oceano-numero">05</div>

            <div class="oceano-info">
                <h3>Pradarias marinhas</h3>

                <p>
                    Formadas por plantas marinhas submersas,
                    fornecem alimento e abrigo para diversos
                    organismos e contribuem para o armazenamento
                    de carbono.
                </p>

                <span class="oceano-detalhe">
                    Armazenamento de carbono
                </span>
            </div>

            <div class="oceano-seta" aria-hidden="true">↗</div>
        </article>

        <article class="oceano-item">
            <div class="oceano-numero">06</div>

            <div class="oceano-info">
                <h3>Regiões polares</h3>

                <p>
                    As águas frias do Ártico e da Antártida
                    sustentam comunidades adaptadas às baixas
                    temperaturas, incluindo krill, focas,
                    pinguins e baleias.
                </p>

                <span class="oceano-detalhe">
                    Vida em águas frias
                </span>
            </div>

            <div class="oceano-seta" aria-hidden="true">↗</div>
        </article>

    </div>

    <footer class="oceanos-footer">
        <span class="oceanos-footer-linha"></span>

        <p>MARINELIFE · CONHECER PARA PRESERVAR</p>

        <span class="oceanos-footer-linha"></span>
    </footer>

</section>

@endsection
