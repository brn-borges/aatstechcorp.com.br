<?php
// Conexão
require_once 'bd.php';

//Sessão
session_start();

// Botão enviar
if(isset($_POST['btn-registrar'])):
    $erros = array();
    $msg = array();
    $nome_user = mysqli_escape_string($connect, $_POST['nome_user']);
    $telefone_user = mysqli_escape_string($connect, $_POST['telefone_user']);
    $email_user = mysqli_escape_string($connect, $_POST['email_user']);
    $senha_user = mysqli_escape_string($connect, $_POST['senha_user']); 
    $senha_repetir = mysqli_escape_string($connect, $_POST['senha_repetir']);

    if(empty($nome_user) or empty($telefone_user) or empty($email_user) or empty($senha_user) or empty($senha_repetir)):
        $erros[] = "Há campos que precisam ser preenchido!";

    elseif($senha_user != $senha_repetir): 
        $erros[] = "Senhas não coincide!";
    else: 
        $sql = "INSERT INTO user (nome_user, telefone_user, email_user,senha_user) values ('$nome_user', '$telefone_user','$email_user', MD5('$senha_user'))";
        mysqli_query($connect, $sql);
        $msg [] =  "Cadastro realizado com sucesso!";
        mysqli_close($connect);
        session_unset();
        session_destroy();
    endif;
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aatstech Corporation - Criar Conta</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo-b.png"/>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/system.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-12 col-md-9">
                <!-- Nested Row within Card Body -->
                <div class="card o-hidden border-0 shadow-lg my-5">
                   <!--<div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <div class="text-center"> <a href="../index.php">
                                    <img src="img/logo-b.png" width="100px" alt="" srcset=""></a>
                                <h1 class="h4 text-gray-900 mb-4">Criar Conta</h1>
                                <?php
                                    if(!empty($erros)):
                                        foreach($erros as $erro):
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
                            <form class="user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleName"
                                        placeholder="Nome Completo" name="nome_user">
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control form-control-user" id="cel" placeholder="Celular" name="telefone_user">
                                </div>
                                <script type="text/javascript">$("#cel").mask("(00) 00000-0000");
                            </script>
                                
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="E-mail" name="email_user">
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Senha" name="senha_user">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repetir Senha" name="senha_repetir">
                                    </div>
                                </div>
                                <button class="btn btn-outline-dark btn-user btn-block" type="submit" name="btn-registrar">Registrar Conta</button>
                               <!--
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> -->
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Esqueceu sua Senha?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Já possui uma conta? Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    
    
</body>

</html>