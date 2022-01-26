<?php
include_once "bd.php";

$id_produt = filter_input(INPUT_GET, "id_produt", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id_produt)) {

    $query_usuario = "SELECT id_produt, nome_produt, qtde_produt, valor_produt, desc_produt FROM produt WHERE id_produt =:id_produt LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':id_produt', $id_produt);
    $result_usuario->execute();

    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_usuario];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
}

echo json_encode($retorna);
