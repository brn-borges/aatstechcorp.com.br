<?php

include_once "bd.php";

session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: login.php');
endif;

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nome_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Produto!</div>"];
} elseif (empty($dados['qtde_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Quantidade!</div>"];
}elseif (empty($dados['valor_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Valor Unitário!</div>"];
} elseif (empty($dados['desc_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Descrição do Produto!</div>"];
} else {
    $query_produto = "INSERT INTO produt (nome_produt, qtde_produt, valor_produt, desc_produt) VALUES (:nome_produt, :qtde_produt, :valor_produt, :desc_produt)";
    $cad_produto = $conn->prepare($query_produto);
    $cad_produto->bindParam(':nome_produt', $dados['nome_produt']);
    $cad_produto->bindParam(':qtde_produt', $dados['qtde_produt']);
    $cad_produto->bindParam(':valor_produt', $dados['valor_produt']);
    $cad_produto->bindParam(':desc_produt', $dados['desc_produt']);
    $cad_produto->execute();

    if ($cad_produto->rowCount()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Produto cadastrado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Produto não cadastrado com sucesso!</div>"];
    }
}

echo json_encode($retorna);
