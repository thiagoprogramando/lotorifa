@extends('cliente.layout')
@section('conteudo')
    <main id="main">

        <!-- ======= Carteira Section ======= -->
        <section id="carteira" class="carteira">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Saldo Carteira</h5>
                                    <a href="#modal-extrato">Ver Extrato</a>
                                </div>
                                <p>R$ {{ number_format($wallet, 2, ',', '.') }}</p>

                                <div class="mt-3">
                                    <a href="#modal-saque" class="btn btn-get-started" type="button">Solicitar saque</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Pontos</h5>
                                    <a href="#modal-apostas">Ver Apostas</a>
                                </div>
                                <p>900</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5>Meus números</h5>
                                <div class="numeros">
                                    <table>
                                        <tbody>
                                            <ul>
                                                <li>10</li>
                                                <li>23</li>
                                                <li>24</li>
                                                <li>50</li>
                                                <li>80</li>
                                                <li>349</li>
                                                <li>350</li>
                                                <li>354</li>
                                                <li>355</li>
                                                <li>500</li>
                                            </ul>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5>Link Afiliado</h5>
                                <div class="mt-3">
                                    <p>{{ url('/cadastro/' . $coupon) }}</p>
                                    <a id="linkParaCopiar" data-url="{{ url('/cadastro/' . $coupon) }}" onclick="copiaLink()" class="btn btn-get-started" type="button">Copiar Link</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Carteira Section -->

        <!-- ======= Instituição Section ======= -->
        <section id="instituicao" class="instituicao">
            <div class="container">

                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h2>Você pode ajudar a Comunidade Fanuel comprando os números da sorte.</h2>
                        <p>É proibida a participação de menores de 18 anos nos concursos da LOTORIFA.</p>

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
        <!-- End Instituição Section -->
    </main>
    <!-- End #main -->

    <!-- Modal Extrato -->
    <div id="modal-extrato" class="modal-carteira pt-5">
        <div class="modal-content-carteira">
            <h5>Extrato</h5>
            <table class="table table-striped table-borderless">
                <tbody>
                    <tr>
                        <td><i class="bi bi-arrow-up-circle-fill bi-entrou"></i>
                            Fui aprovado no Detran #foralula</td>
                        <td>
                            <div>30/12/2023</div>
                            <div>R$ 400,00</div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-arrow-down-circle-fill bi-saiu"></i>
                            NatalCap é meu ovo</td>
                        <td>
                            <div>30/12/2023</div>
                            <div>R$ 200,00</div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-arrow-up-circle-fill bi-entrou"></i>
                            Feliz Natal</td>
                        <td>
                            <div>30/12/2023</div>
                            <div>R$ 100,00</div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-arrow-down-circle-fill bi-saiu"></i>
                            Feliz Ano Novo #vem2024</td>
                        <td>
                            <div>30/12/2023</div>
                            <div>R$ 100,00</div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-arrow-down-circle-fill bi-saiu"></i>
                            Alguma coisa</td>
                        <td>
                            <div>30/12/2023</div>
                            <div>R$ 100,00</div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-end align-items-end mt-4">
                <button class="btn btn-get-started" type="button">Baixar Extrato</button>
            </div>

            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
    <!-- Modal Extrato -->

    <!-- Modal Apostas -->
    <div id="modal-apostas" class="modal-carteira pt-5">
        <div class="modal-content-carteira">
            <h5>Apostas</h5>
            <table class="table table-striped table-borderless">
                <tbody>
                    <tr>
                        <td>
                            Fui aprovado no Detran #foralula</td>
                        <td>
                            <div>30/12/2023</div>
                            <div>400 pontos</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            NatalCap é meu ovo</td>
                        <td>
                            <div>30/12/2023</div>
                            <div>200 pontos</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Feliz Natal</td>
                        <td>
                            <div>30/12/2023</div>
                            <div>100 pontos</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Feliz Ano Novo #vem2024</td>
                        <td>
                            <div>30/12/2023</div>
                            <div>100 pontos</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Alguma coisa</td>
                        <td>
                            <div>30/12/2023</div>
                            <div>100 pontos</div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-end align-items-end mt-4">
                <button class="btn btn-get-started" type="button">Baixar Apostas</button>
            </div>

            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
    <!-- Modal Apostas -->

    <!-- Modal Saque -->
    <div id="modal-saque" class="modal-carteira pt-5">
        <div class="modal-content-carteira">
            <h5>Informe sua chave pix</h5>

            <div class="formulario">
                <form id="" action="" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="chave-pix" name="chave-pix" placeholder="Chave pix" autofocus/>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="button">Confirmar</button>
                    </div>
                </form>
            </div>

            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
@endsection
