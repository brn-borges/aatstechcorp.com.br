<?php
// Conexão com banco de dados

$servername = "localhost";
$username = "USER_AATSTECH";
$password = "Bruno10*";
$db_name = "BD_AATSTECH";

$connect = mysqli_connect($servername, $username, $password, $db_name);

if(mysqli_connect_error()):
    echo "Falha na conexão: ".mysqli_connect_error();
endif;

?>