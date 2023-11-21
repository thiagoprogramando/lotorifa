@extends('dashboard.layout')
@section('conteudo')
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jogos</h1>
        <a href="#" data-toggle="modal" data-target="#createGame" class="d-none d-sm-inline-block btn btn-sm btn-success"><i class="fas fa-plus text-white-50"></i> Novo Jogo</a>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 p-5">
                <div class="table-responsive">
                    <table class="table table-striped" id="tabela" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th class="text-center">Valor</th>
                                <th class="text-center">Números</th>
                                <th class="text-center">Situação</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($games as $key =>$game)
                            <tr>
                                <td>{{ $game->id }}</td>
                                <td>{{ $game->title }}</td>
                                <td class="text-center">R$ {{ $game->value_number }}</td>
                                <td class="text-center">{{ $game->total_number }}</td>
                                @if($game->status == 0)
                                    <td class="text-center"><span class="badge badge-danger"> Indisponível </span></td>
                                @else
                                    <td class="text-center"><span class="badge badge-success"> Disponível </span></td>
                                @endif
                                <td class="text-center">
                                    <form action="{{ route('deleteGame') }}" method="POST">
                                        <input type="hidden" name="id" value="{{ $game->id }}">
                                        <input type="hidden" value={{  csrf_token() }} name="_token">
                                        <button class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                                        <a class="btn btn-outline-primary" href="{{ route('viewGame', ['id' => $game->id]) }}"><i class="fa fa-eye"></i></a>
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

    <div class="modal fade" id="createGame" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Criar um novo Jogo?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form action="{{ route('createGame') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" placeholder="Título, nome...">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="value_number" placeholder="Valor do N°">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="total_number" placeholder="Total de N°">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <select class="form-control" name="status">
                                        <option value="0" selected>Situação</option>
                                        <option value="1">Aberto</option>
                                        <option value="0">Fechado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection