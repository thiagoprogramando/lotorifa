@extends('cliente.layout')
@section('conteudo')
    <div class="hero" id="hero">
        <div class="container">
            <div class="row">
                <div class="swiper heroSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('lotorifa/img/slide/1.jpg') }}" width="100%">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('lotorifa/img/slide/2.jpg') }}" width="100%">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('lotorifa/img/slide/3.jpg') }}" width="100%">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('lotorifa/img/slide/4.jpg') }}" width="100%">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('lotorifa/img/slide/5.jpg') }}" width="100%">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('lotorifa/img/slide/6.jpg') }}" width="100%">
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>

    <section id="concursos" class="concursos">
        <div class="container">
            <div class="row">
                @foreach ($gamers as $gamer)
                    <div class="col-sm-4 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Concurso {{ $gamer->title }}</h5>
                                <p class="card-text">Previsão de sorteio 10/11/2023</p>
                                <a href="{{ route('numeros', ['id' => $gamer->id]) }}" class="btn btn-get-started"
                                    type="submit">Escolha seus números</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section id="descricao" class="descricao">
        <div class="container">

            <div class="row content d-flex align-items-center">
                <h2 class="text">Como funciona?</h2>
                <div class="col-lg-6">
                    <div class="video-container">
                        <video id="my-video" controls playsinline>
                            <source src="{{ asset('lotorifa/video/descricao.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card-afiliado">
                        <h2>Seja nosso Afiliado!</h2>
                        <p>
                            Indique a LOTORIFA para seus amigos, familiares, seguidores e ganhe 20% de comissão,
                            por cada número comprado por um apostador.
                        </p>

                        <h3>Exemplo:</h3>

                        <div class="card">
                            <div class="card-body">
                                <p>
                                    Anunciou seu link nas redes sociais e seus seguidores, amigos e familiares compraram 10
                                    mil números você ganha na hora R$ 2.000,00 em comissão.
                                </p>
                                <p>Veja a tabela de ganhos abaixo:</p>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Quantidade de números vendidos</th>
                                            <th scope="col">Comissão - Ganhos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>50 mil</td>
                                            <td>R$ 10.000,00</td>
                                        </tr>
                                        <tr class="custom-row-color">
                                            <td>100 mil</td>
                                            <td>R$ 20.000,00</td>
                                        </tr>
                                        <tr class="custom-row-color">
                                            <td>200 mil</td>
                                            <td>R$ 40.000,00</td>
                                        </tr>
                                        <tr class="custom-row-color">
                                            <td>500 mil</td>
                                            <td>R$ 100.000,00</td>
                                        </tr>
                                        <tr class="custom-row-color">
                                            <td>1 milhão</td>
                                            <td>R$ 200.000,00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

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
                    <p>Este é um jogo para quem gosta de loteria e rifas, onde cada apostador pode comprar números de 01 a
                        500, com um prêmio total de R$ 700,00. O sorteio acontecerá assim que todos os 500 números forem
                        vendidos, e haverá 3 ganhadores: o 1º, o 2º e o 3º sorteados.</p>

                    <div class="infos">
                        <h2>Regras do Jogo:</h2>
                        <ol>
                            <li>Neste jogo, cada apostador pode comprar números de 01 a 500;</li>
                            <li>O valor por número é de R$ 2,00</li>
                            <li>O apostador pode comprar até 50 números (R$ 100,00) por CPF. O jogador escolhe os números disponíveis
                                e faz a sua aposta.</li>
                            <li>Aposta mínima R$ 10,00, ou seja, 5 números</li>
                            <li>O prêmio total do jogo é de R$ 700,00.</li>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-5 pt-4 pt-lg-0">
                    <div class="card">
                        <h2>Distribuição dos Prêmios:</h2>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>1º Sorteado: R$ 400</td>
                                    <td>Acumula 400 pontos</td>
                                </tr>
                                <tr class="custom-row-color">
                                    <td>2º Sorteado: R$ 200</td>
                                    <td>Acumula 200 pontos</td>
                                </tr>
                                <tr class="custom-row-color">
                                    <td>3º Sorteado: R$ 100</td>
                                    <td>Acumula 100 pontos</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="portal-transparencia" id="portal-transparencia">
        <div class="container">
            <div class="row">
                <h2>Portal de transparência:</h2>
                <p>
                    Todo apostador terá seu nome associado aos números que escolheu, e no portal de transparência, todos os
                    possíveis apostadores terão acesso para verificar quais números estão disponíveis e quais números foram
                    escolhidos, juntamente com a identificação do respectivo apostador.
                    <br><br>
                    Exemplo: Número 99 escolhido por ***Alves***Silva, CPF: xxx.123.456-xx
                    Número 24 escolhido por ***Souza***Medeiros, CPF: xxx.789.321-xx
                    <br><br>
                    A comunicação será explícita sobre a clareza das regras do jogo e a distribuição de prêmios aos
                    participantes antes do início de cada sorteio.
                </p>
            </div>
        </div>
    </section>

    <div id="banner-ranking" class="banner-ranking"></div>

    <section class="acumulado" id="acumulado">
        <div class="container">
            <div class="row">
                <div class="card-acumulado">
                    <h2>Super Prêmio - Acumulado do mês</h2>
                    <p>Terá uma tabela de classificação (ranking) mostrando quem foi o apostador mais premiado.<br>
                        O 1º lugar no ranking ganhará o super prêmio acumulado que será sorteado todos os meses.</p>

                    <div class="mt-4">
                        <a href="ranking.php" class="btn btn-get-started" type="submit">Acompanhar classificação</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="instituicao" class="instituicao">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h2>Você pode ajudar a Comunidade Fanuel comprando os números da sorte.</h2>
                    <p>É proibida a participação de menores nos concursos da LOTORIFA.</p>

                    <div class="infos">
                        <p>
                            Razão Social: Comunidade Fanuel
                            <br>
                            CNPJ: 05.469.409/0001-75
                            <br>
                            Endereço: R. Golfo de San Matias, 174 - Intermares<br> - Cabedelo/PB, CEP: 58.102-052
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
