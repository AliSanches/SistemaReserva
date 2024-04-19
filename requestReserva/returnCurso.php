<?php

    require_once("../conexao/conecta.php");

    $valorSelecionado = $_POST['curso'];

    $query = "SELECT id_turma, nome_turma FROM turma WHERE id_curso = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $valorSelecionado);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $idTurma, $nomeTurma);

    while (mysqli_stmt_fetch($stmt)) {
        echo "<option value='{$idTurma}'>{$nomeTurma}</option>";
        print_r($idTurma);
    }

?>