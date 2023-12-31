@extends('cliente.layout')
@section('conteudo')
    <main id="main">

        <section id="jogos" class="jogos">
            <div class="container">
                <div class="row content">
                    <div class="col-lg-12">

                        <div class="data">
                            <h2>Números - {{ $game->title }}</h2>
                        </div>

                        <div class="numeros">
                            <p> Sorteio será realizado após aquisição de todos os números disponiveis. </p>

                            <table>
                                <tbody>
                                    <ul>
                                        @foreach($numbers as $number)
                                            @if($number->id_user == null)
                                                <li class="dis" data-number-id="{{ $number->id }}" data-game-name="{{ $game->title }}" data-game-id="{{ $number->id_game }}" data-number-value="{{ $number->value }}" data-number="{{ $number->number }}">
                                                    {{ $number->number }}
                                                </li>
                                            @else
                                                <li class="ind">{{ $number->number }}</li> 
                                            @endif
                                        @endforeach
                                    </ul>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="valor">
                        <br>
                        <p>Prêmiação total</p>
                        <span>R$ 700,00</span>
                        <br><br>

                        <p>Acumulado do mês</p>
                        <span style="font-size: 18px;">R$ 10.000,00</span>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
