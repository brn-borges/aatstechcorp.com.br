<?php

session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: ../login.php');
endif;

include_once "../sql/bd.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id_user'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Tente mais tarde!</div>"];
} elseif (empty($dados['nome_user'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Nome!</div>"];
} elseif (empty($dados['senha_user'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Senha!</div>"];
} elseif (empty($dados['senha_repetir'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Repetir Senha!</div>"];
} elseif (($dados['senha_repetir']) !== ($dados['senha_user'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher os campos Senha e Repetir seja Iguais!</div>"];
} else {
    $query_usuario= "UPDATE user SET nome_user=:nome_user, senha_user=md5(:senha_user) WHERE id_user=:id_user";
    
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':nome_user', $dados['nome_user']);
    $edit_usuario->bindParam(':senha_user', $dados['senha_user']);
    $edit_usuario->bindParam(':id_user', $dados['id_user']);

    if ($edit_usuario->execute()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Conta editada com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Conta não editada com sucesso!</div>"];
    }
}

echo json_encode($retorna);
