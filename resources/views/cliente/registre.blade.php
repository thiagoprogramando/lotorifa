@extends('cliente.layout')
@section('conteudo')
    <main id="main">
        <section id="cadastro" class="cadastro">
            <div class="container">
                <div class="row formulario d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">Bem-vindo(a)</h4>
                                <p class="mb-4">Faça parte da lotorifa!</p>

                                <form class="mb-3" action="{{ route('createUser') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_sponsor" value="{{ $id_sponsor }}"/>
                                    <input type="hidden" name="type" value="2"/>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="Nome:"/>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control cpf" name="cpf" placeholder="CPF:"/>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="email" placeholder="Email:"/>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control celular" name="phone" placeholder="Celular:"/>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" name="password" placeholder="Escolha uma senha:"/>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Cadastrar-me</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
