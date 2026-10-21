@extends('layouts.app')

@section('content')
<section class="oceanos-hero especies-hero">
    <span class="oceanos-eyebrow">MARINELIFE · CATÁLOGO MARINHO</span>

    <h1>Qual espécie você quer descobrir?</h1>

    <p>
        Explore a biodiversidade dos oceanos. Pesquise pelo nome popular
        ou científico e descubra os organismos que habitam o planeta.
    </p>
</section>

<section class="oceanos-container especies-container">

    <form
        action="{{ route('especies.index') }}"
        method="GET"
        class="especies-busca"
    >
        <input
            type="search"
            name="q"
            value="{{ $busca }}"
            placeholder="Ex.: tubarão, golfinho, Chelonia mydas..."
            aria-label="Buscar espécies marinhas"
            maxlength="100"
        >

        <button type="submit">Pesquisar</button>
    </form>

    @if ($erroApi)

        <div class="especies-mensagem">
            <h2>Não foi possível realizar a pesquisa</h2>
            <p>Tente novamente em alguns instantes.</p>
        </div>

    @elseif ($busca !== '' && $especies->isEmpty())

        <div class="especies-mensagem">
            <h2>Nenhuma espécie encontrada</h2>
            <p>
                Não encontramos resultados para
                <strong>{{ $busca }}</strong>.
                Tente outro nome ou pesquise em inglês.
            </p>
        </div>

    @elseif ($especies->isNotEmpty())

        <div class="oceanos-intro">
            <span>RESULTADOS DA PESQUISA</span>
            <h2>Espécies encontradas</h2>
            <p>
                Resultados relacionados a
                <strong>{{ $busca }}</strong>.
            </p>
        </div>

        <div class="oceanos-lista especies-lista">

            @foreach ($especies as $especie)
                <article class="oceano-item especie-item">

                    <div class="oceano-numero">
                        {{ sprintf('%02d', $loop->iteration) }}
                    </div>

                    <div class="oceano-info">
                        <h3>
                            {{ $especie['scientificname'] ?? 'Nome indisponível' }}
                        </h3>

                        @if (!empty($especie['authority']))
                            <p>{{ $especie['authority'] }}</p>
                        @endif

                        @if (!empty($especie['rank']))
                            <span class="oceano-detalhe">
                                {{ $especie['rank'] }}
                            </span>
                        @endif
                    </div>

                    <div class="oceano-seta" aria-hidden="true">↗</div>

                </article>
            @endforeach

        </div>

        <p class="especies-total">
            Exibindo até {{ $especies->count() }} resultados desta pesquisa.
        </p>

    @else

        <div class="especies-sugestoes">
            <div class="oceanos-intro">
                <span>COMECE A EXPLORAR</span>
                <h2>O oceano está cheio de descobertas</h2>
                <p>
                    Escolha um grupo de animais para iniciar sua pesquisa.
                </p>
            </div>

            <div class="especies-sugestoes-lista">

                <a href="{{ route('especies.index', ['q' => 'shark']) }}"
                   class="especie-sugestao">
                    <span class="especie-sugestao-icone">🦈</span>
                    <span>
                        <strong>Tubarões</strong>
                        <small>Predadores dos oceanos</small>
                    </span>
                    <span aria-hidden="true">↗</span>
                </a>

                <a href="{{ route('especies.index', ['q' => 'dolphin']) }}"
                   class="especie-sugestao">
                    <span class="especie-sugestao-icone">🐬</span>
                    <span>
                        <strong>Golfinhos</strong>
                        <small>Mamíferos marinhos</small>
                    </span>
                    <span aria-hidden="true">↗</span>
                </a>

                <a href="{{ route('especies.index', ['q' => 'sea turtle']) }}"
                   class="especie-sugestao">
                    <span class="especie-sugestao-icone">🐢</span>
                    <span>
                        <strong>Tartarugas marinhas</strong>
                        <small>Viajantes dos oceanos</small>
                    </span>
                    <span aria-hidden="true">↗</span>
                </a>

                <a href="{{ route('especies.index', ['q' => 'octopus']) }}"
                   class="especie-sugestao">
                    <span class="especie-sugestao-icone">🐙</span>
                    <span>
                        <strong>Polvos</strong>
                        <small>Habitantes inteligentes do mar</small>
                    </span>
                    <span aria-hidden="true">↗</span>
                </a>

            </div>
        </div>

    @endif

    <footer class="oceanos-footer">
        <span class="oceanos-footer-linha"></span>
        <p>MARINELIFE · CONHECER PARA PRESERVAR</p>
        <span class="oceanos-footer-linha"></span>
    </footer>

</section>
@endsection
