<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Lotorifa</title>

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="{{ asset('lotorifa/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lotorifa/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('lotorifa/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lotorifa/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('lotorifa/css/style.css') }}" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>

        <header id="header" class="fixed-top ">
            <div class="container d-flex align-items-center justify-content-between">

                <a href="{{ route('inicio') }}" class="logo"><img src="{{ asset('lotorifa/img/logo.svg') }}" class="img-fluid"></a>

                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link scrollto active" href="{{ route('inicio') }}">Início</a></li>
                        <li><a class="nav-link scrollto" href="{{ route('inicio') }}#descricao">Como funciona</a></li>
                        <li><a class="nav-link scrollto" href="{{ route('resultado') }}">Resultados</a></li>
                        @if(auth()->check())
                            <li><a class="cart" href="#" id="cartButton"><i class="bi bi-cart fs-4 text"></i></a></li>
                            <li><a class="cart" href="{{ route('sairCliente') }}"><i class="bi bi-cart fs-4 text"></i></a></li>
                        @else
                            <li><a class="nav-link scrollto" href="afiliado.php">Seja um Afiliado</a></li>
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

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: `{{session('success')}}`,
                })
            </script>
        @endif

        @if(session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: `{{session('error')}}`,
                })
            </script>
        @endif

        <footer id="footer">
            <div class="container py-4">

                <div class="text-center">
                    <div class="copyright">
                        &copy; Copyright <strong><span>Lotorifa</span></strong>. Todos os direitos reservados
                    </div>
                </div>
            </div>
        </footer>
        
        <script src="{{ asset('lotorifa/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('lotorifa/js/main.js') }}"></script>
    </body>
</html>
