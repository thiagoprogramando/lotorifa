@extends('cliente.layout')
@section('conteudo')
    <main id="main">

        <section id="login" class="login">
            <div class="container">
                <div class="row formulario d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">Bem-vindo(a)</h4>
                                <p class="mb-4">Faça login</p>

                                <form class="mb-3" action="{{ route('loginCliente') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="email" placeholder="Email"/>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" name="password" placeholder="Senha"/>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Entrar</button>
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
