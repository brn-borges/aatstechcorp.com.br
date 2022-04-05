<?php
include_once "../sql/bd.php";

session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: ../login.php');
endif;

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if (!empty($pagina)) {

    //Calcular o inicio visualização
    $qnt_result_pg = 4; //Quantidade de registro por página
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    $query_usuario = "SELECT id_user, nome_user, telefone_user, email_user FROM user ORDER BY id_user DESC LIMIT $inicio, $qnt_result_pg";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->execute();

    $dados = "<div class='table-responsive'>
            <table class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>";
    while ($row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC)) {
        extract($row_usuario);
        $dados .= "<tr>
                    <td>$nome_user</td>
                    <td>$email_user</td>
                    <td>$telefone_user</td>
                    <td>
                        <button id='$id_user' class='btn btn-outline-dark btn-sm' onclick='visConta($id_user)'>Visualizar</button>

                        <button id='$id_user' class='btn btn-outline-dark btn-sm' onclick='editConta($id_user)'>Editar</button>

                        <button id='$id_user' class='btn btn-outline-danger btn-sm' onclick='apagarConta($id_user)'>Apagar</button>
                    </td>
                </tr>";
    }

    $dados .= "</tbody>
        </table>
    </div>";

    //Paginação - Somar a quantidade de usuários
    $query_pg = "SELECT COUNT(id_user) AS num_result FROM user";
    $result_pg = $conn->prepare($query_pg);
    $result_pg->execute();
    $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

    //Quantidade de pagina
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    $max_links = 2;

    $dados .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';

    $dados .= "<li class='page-item'><a href='#' class='page-link' onclick='listarConta(1)'>Primeira</a></li>";

    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
        if($pag_ant >= 1){
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarConta($pag_ant)' >$pag_ant</a></li>";
        }        
    }    

    $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

    for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
        if($pag_dep <= $quantidade_pg){
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarConta($pag_dep)'>$pag_dep</a></li>";
        }        
    }

    $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarConta($quantidade_pg)'>Última</a></li>";
    $dados .=   '</ul></nav>';

    echo $dados;
} else {
    echo "<div class='alert alert-danger' role='alert'>Erro: Nenhuma Conta encontrada!</div>";
}
