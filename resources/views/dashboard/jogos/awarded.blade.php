@extends('dashboard.layout')
@section('conteudo')
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Premiados</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success"><i class="fas fa-plus text-white-50"></i> Gerar relatório</a>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 p-5">
                <div class="table-responsive">
                    <table class="table table-striped" id="tabela" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Jogo</th>
                                <th>Usuário</th>
                                <th class="text-center">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($premiados as $key =>$premiado)
                            <tr>
                                <td>{{ $premiado->id }}</td>
                                <td>{{ $premiado->game }}</td>
                                <td>{{ $premiado->user }}</td>
                                <td class="text-center">{{ $premiado->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection