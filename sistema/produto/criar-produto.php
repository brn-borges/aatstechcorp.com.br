<?php

include_once "bd.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nome_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
} elseif (empty($dados['qtde_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Quantidade!</div>"];
}elseif (empty($dados['valor_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Valor Unitario!</div>"];
} elseif (empty($dados['desc_produt'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Descrição do Produto!</div>"];
} else {
    $query_usuario = "INSERT INTO produt (nome_produt, qtde_produt, valor_produt, desc_produt) VALUES (:nome_produt, :qtde_produt, :valor_produt, :desc_produt)";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome_produt', $dados['nome_produt']);
    $cad_usuario->bindParam(':qtde_produt', $dados['qtde_produt']);
    $cad_usuario->bindParam(':valor_produt', $dados['valor_produt']);
    $cad_usuario->bindParam(':desc_produt', $dados['desc_produt']);
    $cad_usuario->execute();

    if ($cad_usuario->rowCount()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Produto cadastrado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Produto não cadastrado com sucesso!</div>"];
    }
}

echo json_encode($retorna);
