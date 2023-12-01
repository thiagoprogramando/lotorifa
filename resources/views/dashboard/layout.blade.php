<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>LotoRifa - Portal de Gestão</title>

        <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    </head>

    <body id="page-top">

        <div id="wrapper">
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fab fa-slack"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">LotoRifa</div>
                </a>

                <hr class="sidebar-divider my-0">

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('dashboard') }}"> <i class="fas fa-fw fa-chart-area"></i> <span>Dashboard</span></a>
                </li>

                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    Gestão
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-dice-six"></i>
                        <span>Jogos</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Gestão de Jogos:</h6>
                            <a class="collapse-item" href="{{ route('jogos') }}">Jogos</a>
                            <a class="collapse-item" href="{{ route('premiados') }}">Premiados</a>
                        </div>
                    </div>
                </li>

                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    Financeiro
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-wallet"></i>
                        <span>Carteira</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Gestão de Carteiras:</h6>
                            <a class="collapse-item" href="">Usuários</a>
                            <a class="collapse-item" href="">Saques</a>
                            <a class="collapse-item" href="">Dépositos</a>
                            <div class="collapse-divider"></div>
                            <h6 class="collapse-header">Outros:</h6>
                            <a class="collapse-item" href="">Afiliados</a>
                            <a class="collapse-item" href="">Jogos</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Gráficos</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sair') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Sair</span></a>
                </li>

                <hr class="sidebar-divider d-none d-md-block">

                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"> <i class="fa fa-bars"></i> </button>

                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Procurar..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button"> <i class="fas fa-search fa-sm"></i> </button>
                                </div>
                            </div>
                        </form>

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Procurar..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button"> <i class="fas fa-search fa-sm"></i> </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <span class="badge badge-danger badge-counter">3+</span>
                                </a>
                                
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header"> Notificações </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary"> <i class="fas fa-file-alt text-white"></i> </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 12, 2019</div>
                                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500">Não há mais notificações</a>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ implode(' ', array_slice(explode(' ', auth()->user()->name), 0, 2)) }}</span>
                                    <img class="img-profile rounded-circle" src="{{ asset('assets/img/undraw_profile.svg') }}">
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Perfil
                                    </a>
                                    <a class="dropdown-item" href="{{ route('sair') }}">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Sair
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>

                    <div class="container-fluid">
                        @yield('conteudo')
                    </div>
                </div>

                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; LotoRifa 2023</span>
                        </div>
                    </div>
                </footer>
                
            </div>
        </div>
        
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                var tabela = $('#tabela').DataTable({
                    "language": {
                        "sEmptyTable":     "Nenhum registro encontrado",
                        "sInfo":           "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered":   "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sInfoThousands":  ".",
                        "sLengthMenu":     "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing":     "Processando...",
                        "sZeroRecords":    "Nenhum registro encontrado",
                        "sSearch":         "Pesquisar",
                        "oPaginate": {
                            "sNext":     "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst":    "Primeiro",
                            "sLast":     "Último"
                        },
                        "oAria": {
                            "sSortAscending":  ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                        }
                    },
                    "pagingType": "simple"
                });

                tabela.on('init', function () {
                    $('div.dataTables_filter input').addClass('form-control');
                }).DataTable();
            });
        </script>
        
    </body>
</html>