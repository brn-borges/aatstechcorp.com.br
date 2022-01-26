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

$host = "localhost";
$user = "USER_AATSTECH";
$pass = "Bruno10*";
$dbname = "BD_AATSTECH";
$port = 3306;

try{
    //Conexão com a porta
    $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);   

    //echo "Conexão com banco de dados realizado com sucesso!";
}  catch(PDOException $err){
    echo "Erro: Conexão com banco de dados não foi realizada com sucesso. Erro gerado " . $err->getMessage();
}


?>