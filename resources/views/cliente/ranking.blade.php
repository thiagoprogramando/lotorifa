@extends('cliente.layout')
@section('conteudo')
    <main id="main">
        <section id="ranking" class="ranking">
            <div class="container">
                <div class="row">
                    <div class="table-responsive text-nowrap">
                        @if(count($users) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">CPF</th>
                                        <th scope="col">Pontos acumulados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ substr_replace($user->cpf, '******', 3, 6) }}</td>
                                            <td>{{ $user->points }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="mt-5 mb-5">
                                <h1 class="text-light">Faça suas apostas, ganhe e veja seu nome aqui!</h1>
                            </div>
                        @endif
                    </div>

                    <p class="mt-4"> OBS: Após a entrega do prêmio acumulado mensal, a pontuação dos apostadores é zerada e se inicia uma nova corrida para o prêmio acumulado mensal. </p>
                </div>
            </div>
        </section>
    </main>
@endsection
