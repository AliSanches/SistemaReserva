<?php

require_once('./conexao/conecta.php');

if (isset($_POST['curso'])) {
    $cursoSelecionado = $_POST['curso'];

    $query = "SELECT * FROM curso WHERE id_tipo_curso = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $cursoSelecionado);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $idCurso, $nomeCurso);

    echo '<table class="table w-100 table-responsive-sm conteudo mt-3 mb-3 text-center">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">Nome do Curso</th>';
    echo '<th scope="col">Tipo do Curso</th>';
    echo '<th colspan="2" scope="col"><a class="btnLaranja" href="curso_insere.php">Inserir</a></th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while (mysqli_stmt_fetch($stmt)) {
        echo '<tr>';
        echo '<td>'.$nomeCurso.'</td>';
        echo '<td>'.$nomeTipoCurso.'</td>';
        echo '<td><a class="btnLaranja" href="curso_altera.php?id_curso='.$idCurso.'">Editar</a></td>';
        echo '<td><a class="btnLaranja" href="curso_exclui.php?id_curso='.$idCurso.'">Excluir</a></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
?>