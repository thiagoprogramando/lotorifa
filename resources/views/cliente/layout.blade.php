<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Lotorifa</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="{{ asset('lotorifa/img/favicon.svg') }}" rel="icon">
    <link href="{{ asset('lotorifa/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lotorifa/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('lotorifa/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lotorifa/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('lotorifa/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lotorifa/css/style.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="{{ route('inicio') }}" class="logo"><img src="{{ asset('lotorifa/img/logo.svg') }}" class="img-fluid"></a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="{{ route('inicio') }}">Início</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('resultado') }}">Resultados</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('ranking') }}">Ranking</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('inicio') }}#portal-transparencia">Transparência</a></li>
                    
                    @if (auth()->check())
                        <li><a class="cart" href="#" id="cartButton"><i class="bi bi-cart fs-4 text"></i></a></li>
                        <li><a class="cart" href="{{ route('sairCliente') }}"><i class="bi bi-box-arrow-right fs-4"></i></a></li>
                    @else
                        <li><a class="nav-link scrollto" href="{{ route('afiliado') }}">Seja um Afiliado</a></li>
                        <li><a class="nav-link scrollto " href="{{ route('cadastro') }}">Cadastra-se</a></li>
                        <li><a class="getstarted scrollto" href="{{ route('acesso') }}">Entrar</a></li>
                        <li><a class="cart" href="#" id="cartButton"><i class="bi bi-cart fs-4 text"></i></a></li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>

    @yield('conteudo')

    <section id="instituicao" class="instituicao">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h2>Você pode ajudar a Comunidade Fanuel comprando os números da sorte.</h2>
                    <p>É proibida a participação de menores nos concursos da LOTORIFA.</p>

                    <div class="infos">
                        <p>
                            Razão Social: Comunidade Fanuel
                            <br>
                            CNPJ: 05.469.409/0001-75
                            <br>
                            Endereço: R. Golfo de San Matias, 174 - Intermares<br> - Cabedelo/PB, CEP: 58.102-052
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: `{{ session('success') }}`,
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Atenção',
                text: `{{ session('error') }}`,
            })
        </script>
    @endif

    <footer id="footer">
        <div class="container py-4">
            <div class="text-center">
                <div class="copyright"> &copy; Copyright <strong><span>Lotorifa</span></strong>. Todos os direitos
                    reservados </div>
            </div>
        </div>
    </footer>

    <div class="cart-modal" id="cartModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Carrinho de Compras</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="item">
                    <div class="number">1</div>
                    <div class="name">Concurso 001</div>
                    <i class="bi bi-trash icon-right"></i>
                </div>
                <div class="total">
                    R$ 2,00
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Finalizar Compra</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('lotorifa/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lotorifa/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('lotorifa/js/main.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var cpfInputs = document.querySelectorAll('.cpf');

            cpfInputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    var value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos
                    if (value.length > 3) {
                        value = value.substring(0, 3) + '.' + value.substring(3);
                    }
                    if (value.length > 7) {
                        value = value.substring(0, 7) + '.' + value.substring(7);
                    }
                    if (value.length > 11) {
                        value = value.substring(0, 11) + '-' + value.substring(11);
                    }
                    input.value = value;
                });
            });

            var phoneInputs = document.querySelectorAll('.celular');

            phoneInputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    var value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos
                    var formattedValue = '';

                    if (value.length > 0) {
                        formattedValue = '(' + value.substring(0, 2);
                    }
                    if (value.length > 2) {
                        formattedValue += ') ' + value.substring(2, 7);
                    }
                    if (value.length > 7) {
                        formattedValue += '-' + value.substring(7, 11);
                    }
                    input.value = formattedValue;
                });
            });
        });
    </script>
</body>

</html>
