@extends('dashboard.layout')
@section('conteudo')
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jogo: {{ $game->title }}</h1>
        @if ($number_approved == $number)
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-dice"></i> Gerar Premiação
            </a>
        @else
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-user-slash"></i> Não disponível para Premiação
            </a>
        @endif
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Apostas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $number_approved }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chess-knight fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Arrecação</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ $value }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card border-left-dark shadow h-100 p-5">
                <div class="table-responsive">
                    <table class="table table-striped" id="tabela" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Número</th>
                                <th>Usuário</th>
                                <th class="text-center">Valor</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bet as $key =>$bet)
                            <tr>
                                <td>{{ $bet->id }}</td>
                                <td>{{ $bet->number }}</td>
                                <td> @if($bet->id_user === 0) Bloqueado @else {{ $bet->id_user }} @endif</td>
                                <td class="text-center">R$ {{ $bet->value }}</td>
                                <td class="text-center">
                                    <form action="{{ route('blocksBet') }}" method="POST">
                                        <input type="hidden" name="id" value="{{ $bet->id }}">
                                        <input type="hidden" value={{  csrf_token() }} name="_token">
                                        @if($bet->id_user == null)
                                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-ban"></i></button>
                                        @endif
                                        <a class="btn btn-outline-success" href="{{ $bet->token }}">Comprovante</a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
