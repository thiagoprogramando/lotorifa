@extends('cliente.layout')
@section('conteudo')
    <section id="afiliado" class="afiliado"></section>

    <main id="main">
        <section id="cadastro-afiliado" class="cadastro-afiliado">
            <div class="container">
                <div class="row formulario d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">Bem-vindo</h4>
                                <p class="mb-4">Preencha com seus dados e se torne um afiliado!</p>

                                <form class="mb-3" action="{{ route('createUser') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="type" value="3"/>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="Nome:" autofocus/>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control cpf" name="cpf" placeholder="CPF:"/>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control celular" name="phone" placeholder="Celular:"/>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="email" placeholder="E-mail?"/>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" class="form-control" name="password" placeholder="Escolha uma senha:"/>
                                        </div>
                                    </div>
                                    <div class="mb-3"> <button class="btn btn-primary d-grid w-100" type="submit">Cadastrar-me</button> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
