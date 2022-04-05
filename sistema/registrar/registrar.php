<?php

include_once "../sql/bd.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nome_user'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Nome!</div>"];
} elseif (empty($dados['telefone_user'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Telefone!</div>"];
}elseif (empty($dados['email_user'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo E-mail!</div>"];
} elseif (empty($dados['senha_user'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Senha!</div>"];
} elseif (empty($dados['senha_repetir'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Repetir Senha!</div>"];
} elseif (($dados['senha_repetir']) !== ($dados['senha_user'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher os campos Senha e Repetir seja Iguais!</div>"];
} else {
    $query_usuario = "INSERT INTO user (nome_user, telefone_user, email_user, senha_user) VALUES (:nome_user, :telefone_user, :email_user, md5(:senha_user))";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome_user', $dados['nome_user']);
    $cad_usuario->bindParam(':telefone_user', $dados['telefone_user']);
    $cad_usuario->bindParam(':email_user', $dados['email_user']);
    $cad_usuario->bindParam(':senha_user', $dados['senha_user']);
    $cad_usuario->execute();

    if ($cad_usuario->rowCount()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Conta cadastrada com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Conta não cadastrada com sucesso!</div>"];
    }
}

echo json_encode($retorna);
