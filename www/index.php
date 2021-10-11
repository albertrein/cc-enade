<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CC - Enade</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/radios.css" rel="stylesheet" type="text/css">
    <script src="js/components/VisibilidadeHandler.js"></script>
    <script src="js/components/UserLogin.js"></script>
    <script src="js/components/UserRegister.js"></script>
    <script src="js/components/Questions.js"></script>
    <script src="js/components/Ranking.js"></script>
    <script src="js/components/Welcome.js"></script>
    <script src="js/components/Menu.js"></script>
    <script src="js/components/Comentarios.js"></script>
    <script src="js/components/BuscaQuestoes.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">                
                <div class="sidebar-brand-text mx-3">CC - Enade</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" style="cursor: pointer;" onclick="viewHandler.mostrarRanking();">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Ranking</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" style="cursor: pointer;" onclick="viewHandler.mostrarQuestionario();questoes.buscarQuestao();">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Questionário</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form id="formularioBuscaQuestao"
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input id="numeroQuestaoBuscaLista" type="text" class="form-control bg-light border-0 small" placeholder="Buscar pelo número da questão ..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" onclick="listagemQuestoes.buscaListaDeQuestoes();">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input id="numeroQuestaoBuscaListaMobile" type="text" class="form-control bg-light border-0 small"
                                            placeholder="Buscar número da questão ..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="listagemQuestoes.buscaListaDeQuestoes();">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a id="notificationIcon" class="nav-link dropdown-toggle" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: none;">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter" id="numero_requisicoes"></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div id="lista_notificacao" class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Requisição de ajuda nas seguintes questões ...
                                </h6>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span id="nome_usuario" class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <img id="img_usuario" class="img-profile rounded-circle"
                                    src="img/aluno.jpg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" id="logar" onclick="viewHandler.mostrarInicio();">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Login / Cadastrar
                                </a>
                                <a class="dropdown-item" id="deslogar" onclick="menuSuperior.usuarioDeslogado()">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- #inicio -->
                <div class="container-fluid" id="inicio" style="display: none;">
                    <h1 class="h3 mb-4 text-gray-800">Olá, visitante</h1>
                    <div class="row">
                        <!-- Border Left Utilities -->
                        <div class="col-lg-6">
                            <div class="card mb-4 py-3 border-bottom-primary">
                                <div class="card-body" style="text-align: center;">
                                    <a onclick="viewHandler.mostrarLogin();" class="btn btn-primary btn-icon-split btn-lg">
                                        <span class="text">Login</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Border right Utilities -->
                        <div class="col-lg-6">

                            <div class="card mb-4 py-3 border-bottom-primary">
                                <div class="card-body" style="text-align: center;">
                                    <a onclick="viewHandler.mostrarCadastro();" class="btn btn-primary btn-icon-split btn-lg">
                                        <span class="text">Cadastrar</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fim #inicio -->
                <!-- Pagina inicial -->
                <div class="container-fluid" id="home" style="display: none;">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Color System -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="...">
                                    </div>
                                    <p>Add some quality, svg illustrations to your project courtesy of <a
                                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                        constantly updated collection of beautiful svg images that you can use
                                        completely free and without attribution!</p>
                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                        unDraw &rarr;</a>
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <!-- /fim pagina inicial -->
                <!-- inicio #login -->
                <div class="container-fluid" id="login" style="display: none;">
                    <div class="row justify-content-center">

                        <div class="col-xl-10 col-lg-12 col-md-9">

                            <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body p-0">
                                    <!-- Nested Row within Card Body -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="p-5">
                                                <div class="text-center">
                                                    <h1 class="h4 text-gray-900 mb-4">Bem-vindo Novamente</h1>
                                                </div>
                                                <form id="formularioUsuarioLogin" class="user">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control form-control-user" id="login_email" aria-describedby="emailHelp" placeholder="Digite seu e-mail ...">
                                                    </div>
                                                    
                                                    <a onclick="login.loginButtonClick()" class="btn btn-primary btn-user btn-block">
                                                        Logar
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- Fim #login -->
                <!-- inicio #cadastro -->
                <div class="container-fluid" id="cadastro" style="display: none;">
                    <div class="row justify-content-center">

                        <div class="col-xl-10 col-lg-12 col-md-9">

                            <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body p-0">
                                    <!-- Nested Row within Card Body -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="p-5">
                                                <div class="text-center">
                                                    <h1 class="h4 text-gray-900 mb-4">Bem-vindo</h1>
                                                    <a id="errorMensagemUsuarioCadastro" onclick="cadastro.hideErrorMensagemUsuarioCadastro();" class="btn btn-danger btn-icon-split" style="margin-bottom: 20px; display: none;">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-window-close"></i>
                                                        </span>
                                                        <span class="text">Verifique os campos novamente!</span>
                                                    </a>
                                                </div>
                                                <form id="formularioUsuarioCadastro" class="user">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-user" id="nome" aria-describedby="emailHelp" onblur="cadastro.validaCampoInput(this);" placeholder="Digite seu nome ...">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" onblur="cadastro.validaCampoInput(this);" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Digite seu e-mail ...">
                                                    </div>
                                                    <div class="custom-control custom-checkbox medium">
                                                        <input name="tipo_usuario" type="radio" class="custom-control-input" id="tipo_aluno">
                                                        <label class="custom-control-label" for="tipo_aluno">Sou Aluno</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox medium">
                                                        <input name="tipo_usuario" type="radio" class="custom-control-input" id="tipo_professor">
                                                        <label class="custom-control-label" for="tipo_professor">Sou Professor</label>
                                                    </div>
                                                    <hr>
                                                    <a onclick="cadastro.cadastrarUsuario();" class="btn btn-primary btn-user btn-block">
                                                        Cadastrar
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- Fim #cadastro -->

                <!-- /questoes -->
                <div class="container-fluid" id="questoes" style="display: none;">
                    <div class="col-lg-12 mb-4">
                        <!-- Illustrations -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary" id="questao_titulo"></h6>
                            </div>
                            <div class="card-body">                                
                                <div class="text-center d-none d-md-inline">
                                    <button title="Pedir ajuda de um professor" class="rounded-circle border-0 questao" id="q" style="width: 2.5rem;height: 2.5rem;float: right;" onclick="questoes.requisitarAjudaDoProfessor();"></button>
                                </div>
                                <div class="text-center">
                                    <img id="questao_imagem" class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="" src="" alt="Imagem da alternativa">
                                </div>
                                <div id="options">
                                  <label>
                                    <input type="radio" class="option-input radio" name="alternativa" value="a" />
                                    A
                                  </label>
                                  <label>
                                    <input type="radio" class="option-input radio" name="alternativa" value="b" />
                                    B
                                  </label>
                                  <label>
                                    <input type="radio" class="option-input radio" name="alternativa" value="c" />
                                    C
                                  </label>
                                  <label>
                                    <input type="radio" class="option-input radio" name="alternativa" value="d" />
                                    D
                                  </label>
                                  <label>
                                    <input type="radio" class="option-input radio" name="alternativa" value="e" />
                                    E
                                  </label>
                                </div>
                                <a id="botao_responder" onclick="questoes.responder();" style="margin-top: 3em;" class="btn btn-success btn-block btn-icon-split">
                                    <span class="text">Responder</span>
                                </a>
                                <div class="card mb-4 py-3 border-left-danger" id="mensagem_erro" style="display: none; margin-top: 4em;">
                                    <div class="card-body" id="texto_mensagem_erro" ></div>
                                </div>
                                <div class="card mb-4 py-3 border-left-success" id="mensagem_sucesso" style="display: none; margin-top: 4em;">
                                    <div class="card-body" >
                                        Parabéns você acertou!
                                    </div>
                                </div>
                                <a id="botaoVoltarQuestao" onclick="questoes.voltarQuestaoAnterior();" class="btn btn-light btn-icon-split" style="display: none; float: left;margin-top: 3em;">
                                    <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-left"></i>
                                    </span>
                                    <span class="text">Questão anterior</span>
                                </a>
                                <a onclick="questoes.buscarProximaQuestao();" class="btn btn-light btn-icon-split" style="float: right;margin-top: 3em;">
                                    <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">Próxima questão</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //questoes -->

                <!-- comentarios -->
                <div class="container-fluid" id="comentarios" style="display: none;">
                    <div class="col-lg-12 mb-4">
                        <div class="card shadow mb-4" style="padding: 2% 5px;">
                            <h1 id="sem_comentarios" style="padding-left: 20px;opacity: 0.5;" class="h4 mb-4 text-gray-800">0 Comentários</h1>
                        </div>
                        <div id="container_novo_comentario" class="row" style="margin: initial;">
                            <span id="duvida_respondida" style="float: left;">Dúvida respondida?<input type="checkbox" style="width: 20px;"></span>
                            <div class="form-group" style="width: 55%;margin-left: auto;">
                                <textarea type="text" class="form-control form-control-user" id="comentario_nova_mensagem" placeholder="Deixe aqui seu comentário...">
                                </textarea>
                            </div>
                            <a id="botao_novo_comentario" onclick="comentarios.salvarNovoComentario();" style="width: 15%;height: max-content;" class="btn btn-primary btn-icon-split">
                                <span class="text">Salvar</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- //comentarios -->

                <!-- ranking -->
                <div class="container-fluid" id="ranking" style="display: none;">
                    <div class="row">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Ranking Alunos - Pontuação</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //ranking -->

                <!-- listagemQuestoes -->
                <div class="container-fluid" id="listagemQuestoes" style="display: none;">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Resultado da busca:</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTable_length"></div></div><div class="col-sm-12 col-md-6"><div id="dataTable_filter" class="dataTables_filter"></div></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row"><th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 260px;">Questão</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 388px;">Número</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 191px;">Ano</th></tr>
                                    </thead>
                                    <tbody id="listagemQuestoesCorpoTabela">    
                                        
                                    </tbody>
                                </table></div></div></div>
                            </div>
                        </div>
                    </div>

                </div>    
                <!-- //listagemQuestoes-->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; cc-enade 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script type="text/javascript">
        
        viewHandler = new VisibilidadeHandler();
        login = new UserLogin("login", viewHandler);
        cadastro = new UserRegister("cadastro", viewHandler);
        comentarios = new Comentarios("comentarios");
        questoes = new Questions("questoes", viewHandler, comentarios);
        ranking = new Ranking("ranking", viewHandler);
        inicio = new Welcome("inicio", viewHandler)
        listagemQuestoes = new BuscaQuestoes("listagemQuestoes", questoes, viewHandler)
        menuSuperior = new Menu("nome_usuario", "img_usuario", questoes, viewHandler);
        viewHandler.setComponents(login, cadastro, questoes, ranking, inicio, menuSuperior, listagemQuestoes);

        
        if (menuSuperior.isUsuarioLogado()){
            viewHandler.mostrarQuestionario();
            questoes.buscarQuestao();
            menuSuperior.logarUsuario();
        }else{
            viewHandler.mostrarInicio();
            menuSuperior.usuarioDeslogado();
        }

        document.getElementById('formularioBuscaQuestao').addEventListener("submit", function(event) {
            event.preventDefault();
            listagemQuestoes.buscaListaDeQuestoes();
        });

        document.getElementById('formularioUsuarioLogin').addEventListener("submit", function(event) {
            event.preventDefault();
            login.loginButtonClick();      
        });

        document.getElementById('formularioUsuarioCadastro').addEventListener("submit", function(event) {
            event.preventDefault();
            cadastro.cadastrarUsuario();
        });

    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="js/demo/chart-bar-demo.js"></script>


</body>

</html>