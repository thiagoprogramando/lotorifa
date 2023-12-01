@extends('cliente.layout')
@section('conteudo')
    <main id="main">

        <section id="carteira" class="carteira">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-4">
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

                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Pontos</h5>
                                    <a href="#modal-apostas">Ver Premiações</a>
                                </div>
                                <p> @if($points) {{ $points }} @else 0 @endif</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Link para indicação</h5>
                                    <a href="#modal-indicados">Ver Indicações</a>
                                </div>
                                <p>Indicados: {{ count($users) }}</p>
                                <div class="mt-3">
                                    <a class="btn btn-get-started" href="{{ route('cadastro', ['coupon' => $coupon]) }}" target="_blank">Abrir Link</a>
                                    <a class="btn btn-get-started" id="linkParaCopiar" data-url="{{ url('/cadastro/' . $coupon) }}" onclick="copiaLink()">Copiar Link</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-4">
                        <div class="card h-100" style="max-height: 400px; overflow-y: auto;">
                            <div class="card-body">
                                <h5>Meus números</h5>
                                <div class="numeros">
                                    @foreach($gamers as $award)
                                        @if($award->bets->count() > 0)
                                            <p>Title Game: {{ $award->title }}</p>
                                            <table>
                                                <tbody>
                                                    @if($award->bets->count() > 0)
                                                        <ul>
                                                            @foreach($award->bets as $betItem)
                                                                <li class="ind">{{ $betItem->number }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </tbody>
                                            </table>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <div id="modal-extrato" class="modal-carteira pt-5">
        <div class="modal-content-carteira">
            <h5>Extrato</h5>
            <table class="table table-striped table-borderless">
                <tbody>
                    @foreach ($extract as $extract)
                        <tr>
                            <td><i class="bi bi-arrow-up-circle-fill bi-entrou"></i> {{ $extract->message }}</td>
                            <td>
                                <div>{{ $extract->created_at->format('d/m/Y') }}</div>
                                <div>R$ {{ number_format($extract->value, 2, ',', '.') }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-end align-items-end mt-4">
                <button class="btn btn-get-started" type="button">Baixar Extrato</button>
            </div>

            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
    
    <div id="modal-apostas" class="modal-carteira pt-5">
        <div class="modal-content-carteira">
            <h5>Apostas</h5>
            <table class="table table-striped table-borderless">
                <tbody>
                    @foreach ($awards as $award)
                        <tr>
                            <td>{{ $award->title }}</td>
                            <td>
                                <div>{{ $award->created_at->format('d/m/Y') }}</div>
                                <div>
                                    @if ($award->winner_one == auth()->id())
                                        Pontos: 400
                                    @endif
                                    @if ($award->winner_two == auth()->id())
                                        Pontos: 200
                                    @endif
                                    @if ($award->winner_three == auth()->id())
                                        Pontos: 100
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-end align-items-end mt-4">
                <button class="btn btn-get-started" type="button">Baixar Apostas</button>
            </div>

            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>

    <div id="modal-indicados" class="modal-carteira pt-5">
        <div class="modal-content-carteira">
            <h5>Indicados</h5>
            <table class="table table-striped table-borderless">
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ substr_replace(substr($user->name, 0, 15), '***', 3, 6) }}
                            </td>
                            <td>
                                <div>{{ $user->created_at->format('d/m/Y') }}</div>
                                <div>
                                    {{ substr_replace($user->cpf, '******', 3, 6) }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
    
    <div id="modal-saque" class="modal-carteira pt-5">
        <div class="modal-content-carteira">
            <h5>Informe sua chave pix</h5>
            <div class="formulario">
                <form action="{{ route('saque') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <select name="type" class="form-control">
                            <option value="CPF">CPF</option>
                            <option value="CNPJ">CNPJ</option>
                            <option value="EMAIL">EMAIL</option>
                            <option value="PHONE">TELEFONE</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="key_pix" placeholder="Chave Pix:" autofocus required/>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Confirme sua senha:" required/>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Confirmar</button>
                    </div>
                </form>
            </div>

            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
@endsection
