<?php
// Conexão
require_once 'bd.php';

//Sessão
session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: login.php');
endif;

//Dados
$id_user = $_SESSION['id_user'];
$sql = "SELECT * FROM user WHERE id_user = '$id_user'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);

$sql = "SELECT COUNT(id_form) AS total FROM form";
$qtdeduvida = mysqli_query($connect, $sql);
$qtde = mysqli_fetch_assoc($qtdeduvida);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Produtos - Aatstech</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo-b.png"/>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/system.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dash sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-icon"> 
                    <i class="fas"><img src="../assets/images/logo-branca-a.png" width="40" alt="" srcset=""></i>
                </div>
               <!--<div class="sidebar-brand-text mx-3">Aatstech</div>-->
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            Gerenciar Vendas e Produtos
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-bars"></i>
                    <span>Produtos</span>
                </a>
                <!-- <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opções:</h6>
                        <a class="collapse-item" href="#" data-toggle="modal" data-target="#criarProdutoModal">Criar Produto</a>
                        <a class="collapse-item" href="#" data-toggle="modal" data-target="#exibirProdutoModal">Exbir Produtos</a>
                    </div>
                </div> -->
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Vendas</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opções:</h6>
                        <a class="collapse-item" href="utilities-color.html">Vendas Realizadas</a>
                        <a class="collapse-item" href="utilities-border.html">Vendas Não Finalizadas</a>
                        <a class="collapse-item" href="utilities-animation.html">Vendas em Andamento</a>
                        <a class="collapse-item" href="utilities-other.html">Vendas Finalizadas</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Adicionais
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Dúvidas ou Sugestões</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opções</h6>
                        <a class="collapse-item" href="login.html">Dúvidas</a>
                        <a class="collapse-item" href="register.html">Sugestões</a>
                        <a class="collapse-item" href="solicitacao.php">Exbir Dúvidas/Sugestões</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="conta.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Contas</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-exclamation-triangle"></i>
                    <span>Integrações</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Pesquisar..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-dark" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $dados['nome_user']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configurações
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logs | Atividade
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
 
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Produtos</h1>
                        <a type="button" class="d-none d-sm-inline-block btn btn-sm btn-outline-dark shadow-sm" data-toggle="modal" data-target="#criarProdutoModal">
                        Cadastrar Produto</a>
                    </div>

                    <div class="row">
                       
                    <div class="modal-body">
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <span class="listar-Produtos"></span>
                                </div>
                            </div>    
                    </div>

                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Aatstech Corporation</span>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deseja realmente sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Sair" caso realmente deseje sair da sua sessão atual.</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-dark" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-outline-dark" href="logout.php">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="criarProdutoModal" tabindex="-1" aria-labelledby="criarProdutoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="criarProdutoLabel">Cadastrar Produto</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cad-produto-form">
                        <span id="msgAlertaErroCad"></span>
                        <span id="msgAlerta"></span>
                        <div class="mb-3">
                            <label for="nome" class="col-form-label">Produto:</label>
                            <input type="text" name="nome_produt" class="form-control" id="nome_produt" placeholder="Digite o Nome do Produto">
                        </div>
                        <div class="mb-3">
                            <label for="nome" class="col-form-label">Qtde:</label>
                            <input type="number" name="qtde_produt" class="form-control" id="qtde_produt" placeholder="Informe a Quantidade Total">
                        </div>
                        <div class="mb-3">
                            <label for="Valor" class="col-form-label">Valor Unitario R$:</label>
                            <input type="text" name="valor_produt" class="form-control" id="valor_produt" placeholder="Digite o Valor Unitario em R$.">
                        </div>
                        <div class="mb-3">
                            <label for="text" class="col-form-label">Descrição Produto:</label>
                            <textarea type="text" name="desc_produt" class="form-control" id="desc_produt" placeholder="Digite a Descrição do Produto"></textarea>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-outline-success" id="cad-produto-btn" value="Cadastrar" />
                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="visProdutoModal" tabindex="-1" aria-labelledby="visProdutoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visProdutoLabel">Detalhes do Produto</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <span id="msgAlertaErroVis"></span>
                    <dl class="row">
                        <dt class="col-sm-3">Cod.:</dt>
                        <dd class="col-sm-9"><span id="idProduto"></span></dd>

                        <dt class="col-sm-3">Produto:</dt>
                        <dd class="col-sm-9"><span id="nomeProduto"></span></dd>

                        <dt class="col-sm-3">Qtde:</dt>
                        <dd class="col-sm-9"><span id="qtdeProduto"></span></dd>

                        <dt class="col-sm-3">Valor: R$</dt>
                        <dd class="col-sm-9"><span id="valorProduto"></span></dd>

                        <dt class="col-sm-3">Descrição do Produto:</dt>
                        <dd class="col-sm-9"><span id="descricaoProduto"></span></dd>

                    </dl>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editProdutoModal" tabindex="-1" aria-labelledby="editProdutoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProdutoModalLabel">Editar Produto</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <form id="edit-produto-form">
                        <span id="msgAlertaErroEdit"></span>

                        <input type="hidden" name="id_produt" id="editid">
                        <div class="mb-3">
                            <label for="nome" class="col-form-label">Produto:</label>
                            <input type="text" name="nome_produt" class="form-control" id="editnome" placeholder="Digite o Nome do Produto">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Qtde.:</label>
                            <input type="number" name="qtde_produt" class="form-control" id="editqtde" placeholder="Digite a Quantidade">
                        </div>
                        <div class="mb-3">
                            <label for="tel" class="col-form-label">Valor Unitario R$:</label>
                            <input type="text" name="valor_produt" class="form-control" id="editvalor" placeholder="Digite o Valor Unitario" >
                        </div>
                        <div class="mb-3">
                            <label for="text" class="col-form-label">Descrição Produto:</label>
                            <textarea type="text" name="desc_produt" class="form-control" id="editdesc" placeholder="Digite a Descrição do Produto"></textarea>
                        </div>
                        <div class="modal-footer">
                             <input type="submit" class="btn btn-outline-dark btn-sm" id="edit-produto-btn" value="Salvar" />
                            <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Fechar</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="ApagarProdutoModal" tabindex="-1" role="dialog" aria-labelledby="ApagarProdutoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" id="apagarProduto">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ApagarProdutoModalLabel">Deseja realmente sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Apagar" caso realmente deseje excluir o Produto seleciona.</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-dark" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-dark" id="excluir-produto-btn">Apagar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>

</body>

</html>