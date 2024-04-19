<?php

    require_once("../conexao/conecta.php");

    $valorSelecionado = $_POST['sala'];
    var_dump($valorSelecionado);

    $sql = "SELECT sala.num_sala, sala.capacidade, sala.armario, sala.comport_notebook, tipo_sala.id_tipo_sala, tipo_sala.nome_sala, sala.id_sala FROM sala INNER JOIN tipo_sala ON sala.id_tipo_sala = tipo_sala.id_tipo_sala WHERE sala.id_sala = ?";
    $envia = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($envia, "i", $valorSelecionado);
    mysqli_stmt_execute($envia);
    mysqli_stmt_bind_result($envia, $salaNum, $salaCapacidade, $salaArmario, $salaComportNote, $idTipoSala, $tipoSalaNome, $idSala);
    
    while (mysqli_stmt_fetch($envia)) {
        echo "<thead>
        <tr>
            <th scope='col'>Sala</th>
            <th scope='col'>Tipo da Sala</th>
            <th scope='col'>Capacidade Alunos</th>
            <th scope='col'>Case</th>
            <th scope='col'>Comporta Notebook</th>
            <th colspan='2' scope='col' class='text-center'><a class='btnLaranja' href='sala_insere.php'>Inserir</a></th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>$salaNum</td>
            <td>$tipoSalaNome</td>
            <td>$salaCapacidade</td>
            <td>$salaArmario</td>
            <td>$salaComportNote</td>
            <td><a class='btnLaranja' href='sala_altera.php?id_sala=$idSala'>Editar</a></td>
            <td><a class='btnLaranja' href='sala_exclui.php?id_sala=$idSala'>Excluir</a></td>
        </tr>";
    }
?>