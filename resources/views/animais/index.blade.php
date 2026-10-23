@extends('layouts.app')

@section('content')
    <section class="oceanos-hero">
        <span class="oceanos-eyebrow">MARINELIFE · VIDA MARINHA</span>

        <h1>Conheça os animais marinhos</h1>

        <p>
            Explore as espécies que habitam nossos oceanos
            e descubra a diversidade da vida marinha.
        </p>
    </section>

    <section class="oceanos-container">
        <form action="{{ url('/animais') }}" method="GET" class="especies-busca">
            <input type="search" name="q" value="{{ $busca }}" placeholder="Buscar por nome popular ou científico..."
                aria-label="Buscar animais marinhos">

            <button type="submit">Pesquisar</button>
        </form>

        @if ($erroApi)
            <p class="especies-mensagem">
                Não foi possível consultar os animais.
                Tente novamente.
            </p>

        @elseif ($busca !== '' && $animais->isEmpty())
            <p class="especies-mensagem">
                Nenhum resultado encontrado para "{{ $busca }}".
            </p>

        @elseif ($animais->isNotEmpty())
            <div class="animais-grid">
                @foreach ($animais as $animal)

                    <article class="animal-card">
                        @php
                            $foto = data_get($animal, 'default_photo.medium_url')
                                ?? data_get($animal, 'default_photo.url');
                        @endphp

                        @if ($foto)
                            <img class="animal-card-imagem" src="{{ $foto }}"
                                alt="{{ $animal['preferred_common_name'] ?? $animal['name'] ?? 'Animal marinho' }}" loading="lazy">
                        @else
                            <div class="animal-card-sem-imagem">
                                <span>Imagem indisponível</span>
                            </div>
                        @endif

                        <div class="animal-card-conteudo">
                            <span class="animal-card-categoria">
                                {{ $animal['rank'] ?? 'Organismo marinho' }}
                            </span>

                            <h2>
                                {{ $animal['preferred_common_name'] ?? $animal['name'] ?? 'Nome indisponível' }}
                            </h2>

                            @if (!empty($animal['preferred_common_name']) && !empty($animal['name']))
                                <p class="animal-nome-cientifico">
                                    {{ $animal['name'] }}
                                </p>
                            @endif
                        </div>
                    </article>

                @endforeach
            </div>

        @else
            <div class="animais-introducao">
                <h2>Explore a biodiversidade marinha</h2>

                <p>
                    Pesquise um animal para descobrir seu nome
                    científico e outras informações disponíveis.
                </p>

                <div class="animais-sugestoes">
                    <a href="{{ url('/animais?q=tartaruga-marinha') }}">
                        Tartarugas
                    </a>

                    <a href="{{ url('/animais?q=dolphin') }}">
                        Golfinhos
                    </a>

                    <a href="{{ url('/animais?q=shark') }}">
                        Tubarões
                    </a>

                    <a href="{{ url('/animais?q=octopus') }}">
                        Polvos
                    </a>
                </div>
            </div>
        @endif
    </section>
@endsection