<?php
include_once "bd.php";

$id_produt = filter_input(INPUT_GET, "id_produt", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id_produt)) {

    $query_usuario = "DELETE FROM produt WHERE id_produt=:id_produt";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':id_produt', $id_produt);

    if($result_usuario->execute()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Produto apagado com sucesso!</div>"];
    }else{
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Produto não apagado com sucesso!</div>"];
    }    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
}

echo json_encode($retorna);
