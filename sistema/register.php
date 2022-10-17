<?php
// Conexão
require_once('../sistema/sql/bd.php');

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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/system.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-12 col-md-9">
        
                <div class="card o-hidden border-0 shadow-lg my-5">
                  
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <div class="text-center"> <a href="../index.php">
                                    <img src="img/logo-b.png" width="100px" alt="" srcset=""></a>
                                <h1 class="h4 text-gray-900 mb-4">Criar Conta</h1>
                            </div>
                            <form class="user" id="cad-usuario-form">
                            <span id="msgAlertaErroCad"></span>
                            <span id="msgAlerta"></span>
                            <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nome_user"
                                        placeholder="Nome Completo" name="nome_user">
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control form-control-user" id="telefone_user" placeholder="Celular" name="telefone_user" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">
                                </div>
                            </script>
                                
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email_user"
                                        placeholder="E-mail" name="email_user">
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="senha_user" placeholder="Senha" name="senha_user">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="senha_repetir" placeholder="Repetir Senha" name="senha_repetir">
                                    </div>
                                </div>
                                <input class="btn btn-outline-dark btn-user btn-block" type="submit" id="cad-usuario-btn" value="Cria Conta">
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

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/register.js"></script>
    
</body>

</html>