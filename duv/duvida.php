<?php

include_once "../sistema/sql/bd.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nome_form'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Nome!.</div>"];
} elseif (empty($dados['email_form'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo E-mail!</div>"];
}elseif (empty($dados['telefone_form'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Celular!</div>"];
} elseif (empty($dados['duvida_form'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Dúvida ou Sugestão!</div>"];
} else {
    $query_duvida = "INSERT INTO form (nome_form, email_form, telefone_form, duvida_form) VALUES (:nome_form, :email_form, :telefone_form, :duvida_form)";
    $cad_duvida = $conn->prepare($query_duvida);
    $cad_duvida->bindParam(':nome_form', $dados['nome_form']);
    $cad_duvida->bindParam(':email_form', $dados['email_form']);
    $cad_duvida->bindParam(':telefone_form', $dados['telefone_form']);
    $cad_duvida->bindParam(':duvida_form', $dados['duvida_form']);
    $cad_duvida->execute();

    if ($cad_duvida->rowCount()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Recebemos a sua solicitação! <br> Em breve entraremos em contato!!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Dúvida ou Sugestão não cadastrada com sucesso!</div>"];
    }
}

echo json_encode($retorna);
