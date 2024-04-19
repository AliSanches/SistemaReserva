<?php

    require_once("../conexao/conecta.php");

    $pag = isset($_GET['pag']) ? $_GET['pag'] : 1;
    $pagLimite = 4;
    $pagInicial = ($pag * $pagLimite) - $pagLimite;

    // Consulta para contar o número total de registros
    $contagemQuery = mysqli_query($conexao, "SELECT COUNT(id_tipo_curso) AS count FROM tipo_curso");
    $contagemResultado = mysqli_fetch_assoc($contagemQuery);
    $contagemRegistros = $contagemResultado['count'];

    // Calcular o número total de páginas
    $qtdPaginas = ceil($contagemRegistros / $pagLimite);

    // Consulta utilizando MySQLi com limite de paginação
    $sql = "SELECT curso.id_curso, curso.nome_curso, tipo_curso.nome_tipo FROM curso INNER JOIN tipo_curso ON curso.id_tipo_curso = tipo_curso.id_tipo_curso ORDER BY curso.nome_curso LIMIT $pagInicial, $pagLimite";

    $envia = mysqli_prepare($conexao, $sql);
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