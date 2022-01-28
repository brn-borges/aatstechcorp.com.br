<?php
include_once "bd.php";

session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: login.php');
endif;

$id_produt = filter_input(INPUT_GET, "id_produt", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id_produt)) {

    $query_produto = "DELETE FROM produt WHERE id_produt=:id_produt";
    $result_produto = $conn->prepare($query_produto);
    $result_produto->bindParam(':id_produt', $id_produt);

    if($result_produto->execute()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Produto apagado com sucesso!</div>"];
    }else{
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Produto não apagado com sucesso!</div>"];
    }    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum Produto encontrado!</div>"];
}

echo json_encode($retorna);
