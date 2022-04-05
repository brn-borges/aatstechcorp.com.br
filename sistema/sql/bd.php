<?php

$host = "localhost";
$user = "USER_AATSTECH";
$pass = "Bruno10*";
$dbname = "BD_AATSTECH";
$port = 3306;

$connect = mysqli_connect($hostname, $user, $pass, $dbname);

if(mysqli_connect_error()):
    echo "Falha na conexão: ".mysqli_connect_error();
endif;

try{
    //Conexão com a porta
    $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);   

    //echo "Conexão com banco de dados realizado com sucesso!";
}  catch(PDOException $err){
    echo "Erro: Conexão com banco de dados não foi realizada com sucesso. Erro gerado " . $err->getMessage();
}

?>