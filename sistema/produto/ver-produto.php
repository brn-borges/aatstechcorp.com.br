<?php

include_once "../sql/bd.php";

session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: ../login.php');
endif;

$id_produt = filter_input(INPUT_GET, "id_produt", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id_produt)) {

    $query_produto = "SELECT id_produt, nome_produt, qtde_produt, valor_produt, desc_produt FROM produt WHERE id_produt =:id_produt LIMIT 1";
    $result_produto = $conn->prepare($query_produto);
    $result_produto->bindParam(':id_produt', $id_produt);
    $result_produto->execute();

    $row_produto = $result_produto->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_produto];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum Produto encontrado!</div>"];
}

echo json_encode($retorna);
