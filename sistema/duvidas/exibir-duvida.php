<?php
include_once "bd.php";
session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: login.php');
endif;

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if (!empty($pagina)) {

    //Calcular o inicio visualização
    $qnt_result_pg = 40; //Quantidade de registro por página
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    $query_duvida = "SELECT id_form, nome_form, email_form, telefone_form, duvida_form  FROM form ORDER BY id_form DESC LIMIT $inicio, $qnt_result_pg";
    $result_duvida = $conn->prepare($query_duvida);
    $result_duvida->execute();

    $dados = "<div class='table-responsive'>
            <table class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>Protocolo</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>";
    while ($row_duvida = $result_duvida->fetch(PDO::FETCH_ASSOC)) {
        extract($row_duvida);
        $dados .= "<tr>
                    <td>$id_form</td>
                    <td>$nome_form</td>
                    <td>$telefone_form</td>
                    <td>
                        <button id='$id_form' class='btn btn-outline-dark btn-sm' onclick='visDuvida($id_form)'>Visualizar</button>
                        
                        <button id='$id_form' class='btn btn-outline-danger btn-sm' onclick='apagarDuvida($id_form)'>Apagar</button>
                    </td>
                </tr>";
    }

    $dados .= "</tbody>
        </table>
    </div>";

    //Paginação - Somar a quantidade de usuários
    $query_pg = "SELECT COUNT(id_form) AS num_result FROM form";
    $result_pg = $conn->prepare($query_pg);
    $result_pg->execute();
    $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

    //Quantidade de pagina
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    $max_links = 2;

    $dados .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';

    $dados .= "<li class='page-item'><a href='#' class='page-link' onclick='listarDuvida(1)'>Primeira</a></li>";

    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
        if($pag_ant >= 1){
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarDuvida($pag_ant)' >$pag_ant</a></li>";
        }        
    }    

    $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

    for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
        if($pag_dep <= $quantidade_pg){
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarDuvida($pag_dep)'>$pag_dep</a></li>";
        }        
    }

    $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarDuvida($quantidade_pg)'>Última</a></li>";
    $dados .=   '</ul></nav>';

    echo $dados;
} else {
    echo "<div class='alert alert-danger' role='alert'>Erro: Nenhuma Dúvida ou Sugestão encontrada!</div>";
}
