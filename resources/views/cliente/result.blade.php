@extends('cliente.layout')
@section('conteudo')
    <main id="main">
        <section id="resultados" class="resultados">
            <div class="container">
                <div class="row content">

                    <div class="col-lg-12 row">

                        <div class="col-lg-12">
                            <div class="data">
                                <h2>Resultados</h2>
                            </div>
                            <hr>
                        </div>

                        @foreach ($games as $game)
                            <div class="col-lg-6 mt-3">
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
                                    <br>
                                    <p>Acumulado total do mês:</p>
                                    <span style="font-size: 18px;">R$ 10.000,00</span>
                                </div>
                            </div>

                            <div class="col-lg-6 mt-3">
                                <div class="card">
                                    <h2>Distribuição dos Prêmios:</h2>
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>1º Sorteado: {{ optional($game->winnerOne)->name ?? 'Não indentificado' }} - R$ 400</td>
                                                <td>400 pontos</td>
                                            </tr>
                                            <tr class="custom-row-color">
                                                <td>2º Sorteado: {{ optional($game->winnerTwo)->name ?? 'Não indentificado' }} - R$ 200</td>
                                                <td>200 pontos</td>
                                            </tr>
                                            <tr class="custom-row-color">
                                                <td>3º Sorteado: {{ optional($game->winnerThree)->name ?? 'Não indentificado' }} - R$ 100</td>
                                                <td>100 pontos</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
