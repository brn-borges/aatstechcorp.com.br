<?php

session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: ../login.php');
endif;

include_once "../sistema/sql/bd.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['id_form'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: ID vazio por gentileza verificar!</div>"];
} elseif(empty($dados['resposta_form'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Resposta!</div>"];
} else {
    $query_duvida= "UPDATE form SET resposta_form=:resposta_form WHERE id_form=:id_form";

    $edit_duvida = $conn->prepare($query_duvida);
    $edit_duvida->bindParam(':resposta_form', $dados['resposta_form']);
    $edit_duvida->bindParam(':id_form', $dados['id_form']);

    if ($edit_duvida->execute()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Dúvida ou Sugestão Respondida com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Falha ao responder a Dúvida ou Sugestão!</div>"];
    }
}

echo json_encode($retorna);
