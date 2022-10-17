<?php
// Conexão
require_once './sistema/sql/bd.php';

//Sessão
session_start();
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

        <title>Aatstech Corporation</title>

        <link rel="icon" type="image/x-icon" href="assets/images/logo-b.png"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />

        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    </head>
    <body id="page-top">
    
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top"><img class="" src="assets/images/logo-c.png" width="150" alt="..." /></a>
                <button class="navbar-toggler navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">Solução</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Serviços</a></li>
                        <li class="nav-item"><a class="nav-link" href="#compra">Comprar</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Dúvidas</a></li>
                        <li class="nav-item"><a class="nav-link" href="sistema/loja.php">Store</a></li>
                        <li class="nav-item"><a class="nav-link" href="sistema/index.php"><?php
                            if(!empty($dados)):
                                echo $dados['nome_user'];
                            else:
                                echo "Login";
                            endif;
                        ?></a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Vazou chamou Aatstech!</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">
                            A Aatstech é uma empresa especializada em vazamentos.<br>
                            Nosso maior obejetivo é disponibilizar um produto a preços acessivel a toda a população</p>
                        <a class="btn btn-primary btn-xl" href="#about">Conheça</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Water Leak Detector</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">O Water Leak Detector tem objetivo de procurar os vazamentos de água de forma efetiva e precisa.<br> Sua criação foi com objetivo de facilitar o acesso ao equipamento.</p>
                        <a class="btn btn-light btn-xl" href="#services">Confira!</a>
                    </div>
                </div>
            </div>
        </section>
 
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">Serviços</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">3 Meses Suporte Técnico</h3>
                            <p class="text-muted mb-0"></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Help center access</h3>
                            <p class="text-muted mb-0"></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Email support</h3>
                            <p class="text-muted mb-0"></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Estilo 
                            Black</h3>
                            <p class="text-muted mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-section bg-primary text-white" id="compra">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">Adquira já o seu <br> Water Leak Detector!</h2>
                <a class="btn btn-light btn-xl" href="./sistema/loja.php">Comprar agora</a>
            </div>
        </section>
      
        <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Possua alguma Dúvida ou Sugestão?</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Você possui dúvida ou sugestão? Envie-nos uma mensagem e entraremos em contato com você o mais breve possível!</p>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-3">
                    <div class="col-lg-6">
                        <form id="cad-duv-form">
                            <span id="msgAlertaErroCad"></span>
                            <span id="msgAlerta"></span>
                            
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nome_form" type="text" placeholder="Informe seu nome." name="nome_form"/>
                                <label for="name">Nome</label>
                            </div>
                           
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email_form" type="email" placeholder="name@example.com" name="email_form"/>
                                <label for="email">E-mail</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input class="form-control" type="tel" placeholder="(11) 99456-7890" name="telefone_form" id="telefone_form" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);"/>
                                <label for="phone">Celular</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="duvida_form" type="text" placeholder="Enter your message here..." style="height: 10rem"  name="duvida_form"></textarea>
                                <label for="message">Dúvidas ou Sugestões</label>
                                <div class="invalid-feedback">Por gentileza insira a sua Dúvida ou Sugestão!</div>
                            </div>
                            <div class="d-grid"><input class="btn btn-primary btn-xl " type="submit" id="cad-duv-btn" value="Enviar"></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
     
        <footer class="sticky-footer bg-light py-5">
            <div class="copyright text-center my-auto">Aatstech Corporation &copy; Copyright</div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>                            
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="sistema/js/index-duvida.js"></script>
    </body>
</html>
