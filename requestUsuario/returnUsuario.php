<?php

    require_once("../conexao/conecta.php");

    $valorSelecionado = $_POST['usuario'];
    var_dump($valorSelecionado);

    $sql = "SELECT id_usuario, nome, usuario, tipo FROM usuario WHERE id_usuario = ? ORDER BY nome";
    $envia = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($envia, "i", $valorSelecionado);
    mysqli_stmt_execute($envia);
    mysqli_stmt_bind_result($envia, $idUsuario, $nome, $nomeUsuario, $tipo);

    while (mysqli_stmt_fetch($envia)) {
        echo "<thead>
        <tr>
            <th scope='col'>Nome</th>
            <th scope='col'>Usuario</th>
            <th scope='col'>Permissão</th>
            <th colspan='2' scope='col'><a class='btnLaranja' href='usuario_insere.php'>Inserir</a></th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>$nome</td>
            <td>$nomeUsuario</td>
            <td>$tipo</td>
            <td><a class='btnLaranja' href='usuario_altera.php?id_usuario=$idUsuario'>Editar</a></td>
            <td><a class='btnLaranja' href='usuario_exclui.php?id_usuario=$idUsuario'>Excluir</a></td>
        </tr>";
    }
?>