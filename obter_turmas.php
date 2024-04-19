<?php

require_once('./conexao/conecta.php');

if (isset($_POST['curso'])) {
    $cursoSelecionado = $_POST['curso'];

    $query = "SELECT id_turma, nome_turma FROM turma WHERE id_curso = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $cursoSelecionado);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $idTurma, $nomeTurma);

    while (mysqli_stmt_fetch($stmt)) {
        echo "<option value='{$idTurma}'>{$nomeTurma}</option>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
?>