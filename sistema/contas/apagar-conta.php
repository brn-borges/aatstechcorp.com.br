<?php
include_once "../sql/bd.php";

session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: ../login.php');
endif;

$id_user = filter_input(INPUT_GET, "id_user", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id_user)) {

    $query_usuario = "DELETE FROM user WHERE id_user=:id_user";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':id_user', $id_user);

    if($result_usuario->execute()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Conta apagada com sucesso!</div>"];
    }else{
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Conta não apagada com sucesso!</div>"];
    }    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma Conta encontrada!</div>"];
}

echo json_encode($retorna);
