<?php
// Conexão
require_once '../sistema/sql/bd.php';

//Sessão
session_start();

//Verificação
// if(!isset($_SESSION['logado'])):
//     header('Location: login.php');
// endif;

//Dados
$id_user = (isset($_SESSION['id_user']) ? intval($_SESSION['id_user']): -1);
$sql = "SELECT * FROM user WHERE id_user = '$id_user'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Aatstech Corporation - Store</title>
        <link rel="icon" type="image/x-icon" href="../assets/images/logo-b.png"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="css/system.css" rel="stylesheet">
    </head>
    <body >
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="../index.php"><img src="../assets/images/logo-c.png" width="150" alt="" srcset=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <!-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!"></a></li>
                        <li class="nav-item"><a class="nav-link" href="#!"></a></li> -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Produtos</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">Todos Produtos</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Mais Vendidos</a></li>
                                <li><a class="dropdown-item" href="#!">Produtos Novos</a></li>
                            </ul>
                        </li> -->
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Carrinho
                            <span class="badge btn-primary text-white ms-1 rounded-pill">0</span>
                        </button>
                        <a class="btn btn-outline-dark space" href="index.php"><i class="fas fa-fw fa-user"></i>
                        <?php
                            if(!empty($dados)):
                                echo $dados['nome_user'];
                            else:
                                echo "Login";
                            endif;
                        ?>
                        </a>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-primary py-1" style="background:#04cb9a !important;">
            <div class="container px-2 px-lg-3 my-4">
                <div class="text-center text-white">
                    <img src="../assets/images/logo-branca-a.png" width="100" height="100" alt="" srcset=""> 
                    <h1 class="display-5 fw-bolder">Store</h1>
                    <p class="lead fw-normal text-white mb-0">Vazou chamou Aatstech!</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4 text-dark">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Water Leak Detector</h5>
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                   R$100,00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Adicionar ao Carrinho</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div> -->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">Produto Indisponivel</h5>
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <!-- <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div> -->
                                    </div>
                                    <!-- <span class="text-muted text-decoration-line-through">R$0,00</span> -->
                                    R$0,00
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Adicionar ao Carrinho</a></div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-light">
            <div class="container"><p class="m-0 text-center text-black">Aatstech Corporation &copy; Copyright</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>
        <script src="../js/scripts.js"></script>
    </body>
</html>
