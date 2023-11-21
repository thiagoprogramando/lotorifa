@extends('cliente.layout')
@section('conteudo')
    <section id="hero" class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="video-container">
                        <video id="my-video" controls="controls" autoplay="autoplay" poster="lotorifa/img/banner-video.png">
                            <source src="lotorifa/video/banner.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main id="main">
        <section id="concursos" class="concursos">
            <div class="container">
                <div class="row content">
                    @foreach ($gamers as $gamer)
                        <div class="col-sm-12 col-lg-4">
                            <div class="data">
                                <h2>{{ $gamer->title }}</h2>
                            </div>
                            <p> Previsão de sorteio 10/11/2023 </p>
                            <div class="mb-3">
                                <a href="{{ route('numeros', ['id' => $gamer->id]) }}" class="btn btn-get-started" type="submit">Escolha seus números</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="descricao" class="descricao">
            <div class="container">

                <div class="row content d-flex align-items-center">
                    <div class="col-lg-6">
                        <h2>Como funciona?</h2>
                        <div class="video-container">
                            <video id="my-video" controls loop>
                                <source src="lotorifa/video/descricao.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card-afiliado">
                            <h2>Seja nosso Afiliado!</h2>
                            <p>Indique a LOTORIFA para seus amigos, familiares, seguidores e ganhe 20% de comissão,
                                por cada número comprado por um apostador.</p>

                            <h3>Exemplo:</h3>
                            <p>Compra mínima por jogador a cada
                                <br>concurso: R$ 10,00
                                <br>Comissão: R$ 2,00
                            </p>

                            <p>Compra máxima por jogador a cada
                                <br>concurso: R$ 100,00
                                <br>Comissão: R$ 20,00
                            </p>

                            <div class="mt-4">
                                <a href="afiliado.php" class="btn btn-get-started" type="submit">Quero ser afiliado</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="about">
            <div class="container">

                <div class="row content">
                    <div class="col-lg-7">
                        <h2>Lotorifa</h2>
                        <p>Este é um jogo para quem gosta de loteria e rifas, onde cada apostador pode comprar números
                            de 01 a 500, com um prêmio total de R$ 700,00. O sorteio acontecerá assim que todos os 500
                            números forem vendidos, e haverá 3 ganhadores: o 1º, o 2º e o 3º sorteados.</p>

                        <div class="infos">
                            <h2>Regras do Jogo:</h2>
                            <ol>
                                <li>Neste jogo, cada apostador pode comprar números de 01 a 500;</li>
                                <li>O valor por número é de R$ 2,00</li>
                                <li>O apostador pode comprar até 50 números (R$ 100,00) por CPF. O jogador escolhe os
                                    números
                                    disponíveis
                                    e faz a sua aposta.</li>
                                <li>Aposta mínima R$ 10,00, ou seja, 5 números</li>
                                <li>O prêmio total do jogo é de R$ 700,00.</li>
                            </ol>
                            <h2>Portal de transparência:</h2>
                            <p>
                                Todo apostador terá seu nome associado aos números que escolheu, e no portal de
                                transparência, todos os possíveis apostadores terão acesso para verificar quais números
                                estão disponíveis e quais números foram escolhidos, juntamente com a identificação do
                                respectivo apostador.
                                <br><br>
                                Exemplo: Número 99 escolhido por ***Alves***Silva, CPF: xxx.123.456-xx
                                Número 24 escolhido por ***Souza***Medeiros, CPF: xxx.789.321-xx
                                <br><br>
                                A comunicação será explicita sobre a clareza das regras do jogo e a distribuição de
                                prêmios aos
                                participantes antes do início de cada sorteio.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-5 pt-4 pt-lg-0">
                        <div class="card">
                            <h2>Distribuição dos Prêmios:</h2>
                            <p>
                                1º Sorteado:
                                <span>R$ 400</span>
                            </p>
                            <p>
                                2º Sorteado:
                                <span>R$ 200</span>
                            </p>
                            <p>
                                3º Sorteado:
                                <span>R$ 100</span>
                            </p>
                        </div>

                        <div class="card-ranking">
                            <h2>Super Prêmio - Acumulado do mês</h2>
                            <p>Terá uma tabela de classificação (ranking) mostrando quem foi o apostador mais premiado.
                                O 1º lugar no ranking ganhará o super prêmio acumulado que será sorteado todos os meses.
                            </p>

                            <div class="mt-4">
                                <a href="ranking.php" class="btn btn-get-started" type="submit">Acompanhar Ranking</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
