@extends('layouts.app')

@section('content')
    <section class="oceanos-hero">
        <span class="oceanos-eyebrow">MARINELIFE · VIDA MARINHA</span>

        <h1>Conheça os animais marinhos</h1>

        <p>
            Descubra espécies, habitats, alimentação e curiosidades
            fascinantes sobre os animais que habitam os oceanos.
        </p>
    </section>

    <section class="oceanos-container">
        <form action="{{ url('/animais') }}" method="GET" class="especies-busca">
            <input type="search" name="q" value="{{ $busca }}" placeholder="Pesquisar um animal marinho..."
                aria-label="Pesquisar animais marinhos" maxlength="100">

            <button type="submit">Pesquisar</button>
        </form>

        @if ($erroApi)
            <p class="especies-mensagem" role="alert">
                Não foi possível obter uma resposta neste momento.
                Tente novamente dentro de alguns instantes.
            </p>

        @elseif ($busca !== '' && $resposta)
            @if ($imagemAnimal)
                <img class="animal-resposta-imagem" src="{{ $imagemAnimal }}" alt="Fotografia de {{ $busca }}" loading="lazy">
            @endif
            <article class="animal-resposta">
                <span class="animal-card-categoria">
                    MARINELIFE · RESULTADO DA PESQUISA
                </span>

                <h2>{{ $busca }}</h2>

                <div class="animal-resposta-texto">
                    {!! \Illuminate\Support\Str::markdown($resposta, [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ]) !!}
                </div>

                <p class="animal-resposta-nota">
                    As informações são geradas por inteligência artificial
                    e podem conter imprecisões.
                </p>
            </article>

        @elseif ($busca !== '')
            <p class="especies-mensagem">
                Não foi possível encontrar uma resposta para esta pesquisa.
                Tente novamente.
            </p>

        @else
            <div class="animais-introducao">
                <h2>Explore a biodiversidade marinha</h2>

                <p>
                    Escreva o nome de um animal marinho para conhecer
                    as suas características, o habitat, a alimentação
                    e algumas curiosidades.
                </p>

                <div class="animais-sugestoes">
                    <a href="{{ url('/animais?q=tartaruga-marinha') }}">
                        Tartarugas marinhas
                    </a>

                    <a href="{{ url('/animais?q=golfinho') }}">
                        Golfinhos
                    </a>

                    <a href="{{ url('/animais?q=tubarão-branco') }}">
                        Tubarões
                    </a>

                    <a href="{{ url('/animais?q=polvo') }}">
                        Polvos
                    </a>

                    <a href="{{ url('/animais?q=estrela-do-mar') }}">
                        Estrelas-do-mar
                    </a>

                    <a href="{{ url('/animais?q=cavalo-marinho') }}">
                        Cavalos-marinhos
                    </a>
                </div>
            </div>
        @endif
    </section>
@endsection