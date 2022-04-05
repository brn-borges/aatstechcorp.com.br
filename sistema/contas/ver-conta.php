<?php

include_once "../sql/bd.php";

session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: ../login.php');
endif;

$id_user = filter_input(INPUT_GET, "id_user", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id_user)) {

    $query_usuario = "SELECT id_user, nome_user, telefone_user, email_user FROM user WHERE id_user =:id_user LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':id_user', $id_user);
    $result_usuario->execute();

    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_usuario];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma Conta encontrada!</div>"];
}

echo json_encode($retorna);
