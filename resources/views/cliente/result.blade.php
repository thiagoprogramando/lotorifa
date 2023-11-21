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

                        <div class="col-7">
                            <div class="numeros">
                                <h3> Concurso: XXXXXXXX </h3>

                                <table>
                                    <tbody>
                                        <ul>
                                            <?php
                                            for ($i = 1; $i <= 3; $i++) {
                                                echo "<li>$i</li>";
                                            }
                                            ?>
                                        </ul>
                                    </tbody>
                                </table>
                            </div>
    
                            <div class="valor mt-3">
                                <p>Arrecadação total para premiação:</p>
                                <span>R$ 700,00</span>
                                <br>
    
                                <p>Acumulado total para semana:</p>
                                <span style="font-size: 18px;">R$ 100,00</span>
                                <p>Acumulado total para doação:</p>
                                <span style="font-size: 18px;">R$ 100,00</span>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="card">
                                <h2>Distribuição dos Prêmios:</h2>
                                <p> 1º Ganhador: <span> João Max - R$ 400</span> </p>
                                <p> 2º Ganhador: <span> Maria Graça - R$ 200</span> </p>
                                <p> 3º Ganhador: <span> Ricardo José - R$ 100</span> </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
