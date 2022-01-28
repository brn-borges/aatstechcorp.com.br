<?php
include_once "bd.php";

session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: login.php');
endif;

$id_form = filter_input(INPUT_GET, "id_form", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id_form)) {

    $query_duvida = "DELETE FROM form WHERE id_form=:id_form";
    $result_duvida = $conn->prepare($query_duvida);
    $result_duvida->bindParam(':id_form', $id_form);

    if($result_duvida->execute()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Dúvida ou Sugestão apagada com sucesso!</div>"];
    }else{
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Dúvida ou Sugestão não apagada com sucesso!</div>"];
    }    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma Dúvida ou Sugestão encontrada!</div>"];
}

echo json_encode($retorna);
