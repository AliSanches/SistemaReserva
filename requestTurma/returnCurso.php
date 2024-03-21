<?php

    require_once("../conexao/conecta.php");

    $valorSelecionado = $_POST['curso'];

    $sql = "SELECT curso.nome_curso, curso.id_curso, turma.id_turma, turma.nome_turma, turma.horario_inicio, turma.horario_termino, turma.data_inicio FROM curso INNER JOIN turma ON curso.id_curso = turma.id_curso WHERE curso.id_curso = ? ORDER BY curso.nome_curso";
    $envia = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($envia, "i", $valorSelecionado);
    mysqli_stmt_execute($envia);
    mysqli_stmt_bind_result($envia, $nomeCurso, $idCurso, $idTurma, $nomeTurma, $horaInicio, $horaTermino, $dataInicio);

    while (mysqli_stmt_fetch($envia)) {
        echo "<thead>
        <tr>
        <th scope='col'>Nome do Curso</th>
        <th scope='col'>Número da Turma</th>
        <th scope='col'>Horario Inicio</th>
        <th scope='col'>Horario Final</th>
        <th scope='col'>Data Inicio</th>
        <th colspan='2' scope='col' class='text-center'><a class='btnLaranja' href='turma_insere.php'>Inserir</a></th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>$nomeCurso</td>
            <td>$nomeTurma</td>
            <td>$horaInicio</td>
            <td>$horaTermino</td>
            <td>$dataInicio</td>
            <td><a  class='btnLaranja' href='turma_altera.php?id_turma=$idTurma>Editar</a></td>
            <td><a class='btnLaranja' href='turma_exclui.php?id_turma=$idTurma>Excluir</a></td>
        </tr>";
    }
?>