<?php

    require_once("../conexao/conecta.php");

    $pag = 1;
    $pagLimite = 4;
    $pagInicial = ($pag * $pagLimite) - $pagLimite;

    $sql = "SELECT id_usuario, nome, usuario, tipo FROM usuario ORDER BY nome LIMIT ?, ?";
    $envia = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($envia, "ii", $pagInicial, $pagLimite);
    mysqli_stmt_execute($envia);
    mysqli_stmt_bind_result($envia, $idUsuario, $nome, $nomeUsuario, $tipo);

    echo "<thead>
        <tr>
            <th scope='col'>Nome</th>
            <th scope='col'>Usuario</th>
            <th scope='col'>Permissão</th>
            <th colspan='2' scope='col'><a class='btnLaranja' href='usuario_insere.php'>Inserir</a></th>
        </tr>
      </thead>
      <tbody>";

    while (mysqli_stmt_fetch($envia)) {
        echo "<tr>
            <td>$nome</td>
            <td>$nomeUsuario</td>
            <td>$tipo</td>
            <td><a class='btnLaranja' href='usuario_altera.php?id_usuario=$idUsuario'>Editar</a></td>
            <td><a class='btnLaranja' href='usuario_exclui.php?id_usuario=$idUsuario'>Excluir</a></td>
        </tr>";
    

    echo "</tbody>";

    echo "<section class='navegacao mt-3'>
        <nav aria-label='Navegação de paginas'>
            <ul class='pagination d-flex justify-content-center'>
                <li class='page-item'>";
                    if($pag > 1) {
                        echo "<a class='page-link' href='?pag=".($pag - 1)."' aria-label='Anterior'>
                            <span aria-hidden='true'>&laquo;</span>
                            <span class='sr-only'>Anterior</span>
                        </a>";
                    }
                echo "</li>
                <li class='page-item'><a class='page-link' href='#'>".$pag."</a></li>
                <li class='page-item'>";
                    if($pag < $qtdPaginas) {
                        echo "<a class='page-link' href='?pag=".($pag + 1)."' aria-label='Próximo'>
                            <span aria-hidden='true'>&raquo;</span>
                            <span class='sr-only'>Próximo</span>
                        </a>";
                    }
                echo "</li>
            </ul>
        </nav>
    </section>";
    }
?>