<?php
include_once "../sql/bd.php";

session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: ../login.php');
endif;

$id_form = filter_input(INPUT_GET, "id_form", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id_form)) {

    $query_duvida = "SELECT id_form, nome_form, email_form, telefone_form, duvida_form, resposta_form FROM form WHERE id_form =:id_form LIMIT 1";
    $result_duvida = $conn->prepare($query_duvida);
    $result_duvida->bindParam(':id_form', $id_form);
    $result_duvida->execute();

    $row_duvida = $result_duvida->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_duvida];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma Dúvida ou Sugestão encontrada!</div>"];
}

echo json_encode($retorna);
