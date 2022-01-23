<?php
// Conexão
require_once 'bd.php';

//Sessão
session_start();

// Botão enviar
if(isset($_POST['btn-entrar'])):
    $erros = array();
    $email_user = mysqli_escape_string($connect, $_POST['email_user']);
    $senha_user = mysqli_escape_string($connect, $_POST['senha_user']);

    if(empty($email_user) or empty($senha_user)):
        $erros[] = "O campo E-mail ou Senha precisa ser preenchido!";
    else: 
        $sql = "SELECT email_user FROM user WHERE email_user = '$email_user'";
        $resultado = mysqli_query($connect, $sql);

        if(mysqli_num_rows($resultado) > 0):
            $senha_user = md5($senha_user);
            $sql = "SELECT * FROM user WHERE email_user = '$email_user' AND senha_user = '$senha_user'";
            $resultado = mysqli_query($connect, $sql);

            if(mysqli_num_rows($resultado) == 1):
                $dados = mysqli_fetch_array($resultado);
                mysqli_close($connect);
                $_SESSION['logado'] = true;
                $_SESSION['id_user'] = $dados['id_user'];
                header('Location:index.php');
            else:
                $erros[] = "E-mail ou Senha Incorreta!";
            endif;
        else:
            $erros[] = "Usuário Inexistente!";
        endif;
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

    <title>Aatstech Corporation - Login</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo-b.png"/>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/system.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!--<div class="col-lg-6 d-none d-lg-block bg-login-image login-image"></div> -->
                            <div class="col-lg-12">
                                <div class="p-4">
                                    <div class="text-center"> <a href="../index.php">
                                        <img src="img/logo-b.png" width="100px" alt="" srcset=""></a>
                                        <h1 class="h4 text-gray-900 mb-2">Acesse a Conta</h1>
                                        <?php
                                             if(!empty($erros)):
                                                foreach($erros as $erro):
                                                echo "<h6 style='color: red;'>". $erro ."</h6>";
                                            endforeach;
                                            endif;
                                        ?>
                                    </div>
                                    <form class="user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="E-mail" name="email_user">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Senha" name="senha_user">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Lembrar Senha</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-dark btn-user btn-block" type="submit" name="btn-entrar">
                                            Login
                                        </button>
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
                                        <a class="small" href="register.php">Criar conta</a>
                                    </div>
                                </div>
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