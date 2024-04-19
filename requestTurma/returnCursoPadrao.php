<?php

    require_once("../conexao/conecta.php");

    $pag = 1;
    $pagLimite = 4;
    $pagInicial = ($pag * $pagLimite) - $pagLimite;

    // Consulta para contar o número total de registros
    $contagemQuery = mysqli_query($conexao, "SELECT COUNT(id_turma) AS count FROM turma");
    $contagemResultado = mysqli_fetch_assoc($contagemQuery);
    $contagemRegistros = $contagemResultado['count'];

    // Calcular o número total de páginas
    $qtdPaginas = ceil($contagemRegistros / $pagLimite);

    // Consulta utilizando MySQLi com limite de paginação
    $sql = "SELECT curso.nome_curso, curso.id_curso, turma.id_turma, turma.nome_turma, turma.horario_inicio, turma.horario_termino, turma.data_inicio FROM curso INNER JOIN turma ON curso.id_curso = turma.id_curso ORDER BY curso.nome_curso LIMIT ?, ?";

    $envia = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($envia, "ii", $pagInicial, $pagLimite);
    mysqli_stmt_execute($envia);
    mysqli_stmt_bind_result($envia, $nomeCurso, $idCurso, $idTurma, $nomeTurma, $horaInicio, $horaTermino, $dataInicio);

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
      <tbody>";

    while (mysqli_stmt_fetch($envia)) {
        echo "<tr>
            <td>$nomeCurso</td>
            <td>$nomeTurma</td>
            <td>$horaInicio</td>
            <td>$horaTermino</td>
            <td>$dataInicio</td>
            <td><a class='btnLaranja' href='turma_altera.php?id_turma=$idTurma'>Editar</a></td>
            <td><a class='btnLaranja' href='turma_exclui.php?id_turma=$idTurma'>Excluir</a></td>
        </tr>";
    }

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
?>