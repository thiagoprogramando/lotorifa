@extends('dashboard.layout')
@section('conteudo')
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Concurso: {{ $game->title }} - Situação: {{ $game->status }}</h1>
        @if ($number_approved == $number)
            <form action="{{ route('createResult') }}" method="POST">
                @csrf
                <input type="hidden" name="game" value="{{ $game->id }}">
                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-dice"></i> Gerar Premiação</button>
            </form>  
        @else
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-user-slash"></i> Não disponível para Premiação
            </a>
        @endif
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Apostas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bets_approved }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chess-knight fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Arrecação</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ number_format($value, 2, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Apostadores</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $bettors }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                                <th>Usuário</th>
                                <th class="text-center">Número</th>
                                <th>Situação</th>
                                <th class="text-center">Valor</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bet as $key =>$bet)
                            <tr>
                                <td>{{ $bet->id }}</td>
                                <td>
                                    @if($bet->user)
                                        {{ $bet->user->name }}
                                    @endif
                                </td>
                                <td class="text-center">{{ $bet->number }}</td>
                                <td>
                                    @if ($bet->status == 'PAYMENT_CONFIRMED')  
                                        <span class="badge badge-success">Aprovado</span>
                                    @else 
                                        <span class="badge badge-danger">Pendente</span>
                                    @endif
                                </td>
                                <td class="text-center">R$ {{ $bet->value }}</td>
                                <td class="text-center">
                                    <form action="{{ route('blocksBet') }}" method="POST">
                                        <input type="hidden" name="id" value="{{ $bet->id }}">
                                        <input type="hidden" value={{  csrf_token() }} name="_token">
                                        @if($bet->id_user == null && $bet->status != 'BLOCK')
                                            <input type="hidden" name="status" value="BLOCK">
                                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-lock"></i></button>
                                        @else
                                            <input type="hidden" name="status" value="UNLOCKED">
                                            <button type="submit" class="btn btn-outline-success"><i class="fas fa-lock-open"></i></button>
                                        @endif
                                        <a class="btn btn-outline-success" target="_blank" href="{{ $bet->invoiceUrl }}">Comprovante</a>
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
