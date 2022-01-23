<?php
// Conexão
require_once './sistema/bd.php';

//Sessão
session_start();
$id_user = $_SESSION['id_user'];
$sql = "SELECT * FROM user WHERE id_user = '$id_user'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);

// Botão enviar
if(isset($_POST['btn-duvida'])):
    $erros = array();
    $msg = array();
    $nome_form = mysqli_escape_string($connect, $_POST['nome_form']);
    $email_form = mysqli_escape_string($connect, $_POST['email_form']);
    $telefone_form = mysqli_escape_string($connect, $_POST['telefone_form']);
    $duvida_form = mysqli_escape_string($connect, $_POST['duvida_form']);

    if(empty($nome_form) or empty($telefone_form) or empty($email_form) or empty($duvida_form)):
        $erros[] = "Há campos que precisam ser preenchido!";
    else: 
        $sql = "INSERT INTO form (nome_form, email_form, telefone_form, duvida_form) VALUES ('$nome_form', '$email_form','$telefone_form', '$duvida_form')";
        /*if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }*/
        
        mysqli_query($connect, $sql);
        $msg [] =  "Recebemos a sua solicitação! <br> Em breve entraremos em contato!";
        mysqli_close($connect);
        session_unset();
        session_destroy();
    endif;
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Aatstech Corporation</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/images/logo-b.png"/>
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    </head>
    <body id="page-top">
        <!-- Navigation-->
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
        <!-- Masthead-->
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
        <!-- Services-->
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
        <!-- Call to action-->
        <section class="page-section bg-primary text-white" id="compra">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">Adquira já o seu <br> Water Leak Detector!</h2>
                <a class="btn btn-light btn-xl" href="./sistema/loja.php">Comprar agora</a>
            </div>
        </section>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Possua alguma Dúvida ou Sugestão?</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Você possui dúvida ou sugestão? Envie-nos uma mensagem e entraremos em contato com você o mais breve possível!</p>
                        <?php
                                    if(!empty($erros)):
                                        foreach($erros as $erro):
                                            header('Location:index.php#contact');
                                        echo "<h6 style='color: red;'>". $erro ."</h6>";
                                        endforeach;
                                    endif;
                                    if(!empty($msg)):
                                        foreach($msg as $info):
                                        echo "<h6 style='color: black;'>". $info ."</h6>";
                                        endforeach;
                                    endif;
                        ?>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-3 duvida">
                    <div class="col-lg-6">
                        <form id="contactForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Informe seu nome." name="nome_form"/>
                                <label for="name">Nome</label>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" name="email_form"/>
                                <label for="email">E-mail</label>
                            </div>
                            <!-- Phone number input-->
                            
                            <div class="form-floating mb-3">
                                <input class="form-control" type="tel" placeholder="(11) 99456-7890" name="telefone_form" id="cel"/>
                                <label for="phone">Celular</label>

                            </div>
                            <script type="text/javascript">$("#cel").mask("(00) 00000-0000");</script>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem"  name="duvida_form"></textarea>
                                <label for="message">Dúvidas ou Sugestões</label>
                                <div class="invalid-feedback">Por gentileza insira a sua Dúvida ou Sugestão!</div>
                            </div>
                            <div class="d-grid"><button class="btn btn-primary btn-xl " type="submit" name="btn-duvida">Enviar</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="sticky-footer bg-light py-5">
            <div class="copyright text-center my-auto">Aatstech Corporation &copy; Copyright</div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>                            
        <script src="js/scripts.js"></script>
    </body>
</html>
