@extends('cliente.layout')
@section('conteudo')
    <main id="main">
        <section id="resultados" class="resultados">
            <div class="container">
                <div class="row content">

                    <div class="col-lg-12 row">

                        <div class="col-12">
                            <div class="data">
                                <h2>Resultados</h2>
                                <hr width="100%">
                            </div>
                        </div>

                        @foreach ($games as $game)
                            <div class="col-7">
                                <div class="numeros">
                                    <h3> Concurso: {{ $game->title }} </h3>

                                    <table>
                                        <tbody>
                                            <ul>
                                                <li>{{ $game->number_one }}</li>
                                                <li>{{ $game->number_tow }}</li>
                                                <li>{{ $game->number_three }}</li>
                                            </ul>
                                        </tbody>
                                    </table>
                                </div>
        
                                <div class="valor mt-3">
                                    <p>Arrecadação total para premiação:</p>
                                    <span>R$ 700,00</span>
                                    <br>
        
                                    <p>Acumulado do mês:</p>
                                    <span style="font-size: 18px;">R$ 10.000,00</span>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="card">
                                    <h2>Distribuição dos Prêmios:</h2>
                                    <p> 1º Ganhador: <span> {{ optional($game->winnerOne->name) }}   - R$ 400</span> </p>
                                    <p> 2º Ganhador: <span> {{ optional($game->winnerTwo->name) }}   - R$ 200</span> </p>
                                    <p> 3º Ganhador: <span> {{ optional($game->winnerThree->name) }} - R$ 100</span> </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
