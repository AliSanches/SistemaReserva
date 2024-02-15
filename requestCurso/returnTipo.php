<?php

    require_once("../conexao/conecta.php");

    $valorSelecionado = $_POST['tipoCurso'];

    $sql = "SELECT curso.id_curso, curso.nome_curso, tipo_curso.nome_tipo FROM curso INNER JOIN tipo_curso ON curso.id_tipo_curso = tipo_curso.id_tipo_curso WHERE tipo_curso.id_tipo_curso = ?";
    $envia = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($envia, "i", $valorSelecionado);
    mysqli_stmt_execute($envia);
    mysqli_stmt_bind_result($envia, $idCurso, $nomeCurso, $nomeTipo);
    
    echo "<thead>
        <tr>
          <th scope='col'>Tipo do Curso</th>
          <th scope='col'>Nome do Curso</th>
          <th colspan='2' scope='col'><a class='btnLaranja' href='curso_insere.php'>Inserir</a></th>
        </tr>
      </thead>
      <tbody>";

    while (mysqli_stmt_fetch($envia)) {
      echo "<tr>
        <td>$nomeTipo</td>
        <td>$nomeCurso</td>
        <td><a class='btnLaranja' href='curso_altera.php?id_curso=$idCurso'>Editar</a></td>
        <td><a class='btnLaranja' href='curso_exclui.php?id_curso=$idCurso'>Excluir</a></td>
      </tr>";

    echo "</tbody>";
    }
?>