<?php

session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: ../login.php');
endif;

include_once "../sql/bd.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Tente mais tarde!</div>"];
} elseif (empty($dados['nome_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Nome!</div>"];
} elseif (empty($dados['qtde_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Quantidade!</div>"];
} elseif (empty($dados['valor_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Valor Unitário!</div>"];
} elseif (empty($dados['desc_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Duvida!</div>"];
} else {
    $query_produto= "UPDATE produt SET nome_produt=:nome_produt, qtde_produt=:qtde_produt, valor_produt=:valor_produt, desc_produt=:desc_produt WHERE id_produt=:id_produt";
    
    $edit_produto = $conn->prepare($query_produto);
    $edit_produto->bindParam(':nome_produt', $dados['nome_produt']);
    $edit_produto->bindParam(':qtde_produt', $dados['qtde_produt']);
    $edit_produto->bindParam(':valor_produt', $dados['valor_produt']);
    $edit_produto->bindParam(':desc_produt', $dados['desc_produt']);
    $edit_produto->bindParam(':id_produt', $dados['id_produt']);

    if ($edit_produto->execute()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Produto editado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Produto não editado com sucesso!</div>"];
    }
}

echo json_encode($retorna);
