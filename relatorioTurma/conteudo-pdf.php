<?php

require("../conexao/conecta.php");

$sql = "SELECT curso.nome_curso, curso.id_curso, turma.id_turma, turma.nome_turma, turma.codigo_oferta, turma.horario_inicio, turma.horario_termino, turma.data_inicio FROM curso INNER JOIN turma ON curso.id_curso = turma.id_curso ORDER BY curso.nome_curso";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

?>
<style>
  /* Estilo para a tabela */
  #tabelaDados {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
  }

  #tabelaDados th,
  #tabelaDados td {
    padding: 10px;
    border: 1px solid #ddd;
  }

  #tabelaDados th {
    background-color: #f2f2f2;
    font-weight: bold;
  }

  #tabelaDados tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  #tabelaDados tbody tr:hover {
    background-color: #f2f2f2;
  }
</style>

<h4>RELATÓRIO INSTITUIÇÃO SENAC SÃO PAULO</h4>
<table id="tabelaDados" class="table w-100 table-responsive-sm conteudo mt-3 mb-3 text-center">
  <thead>
    <tr>
      <th scope="col">Nome do Curso</th>
      <th scope="col">Número da Turma</th>
      <th scope="col">Horario Inicio</th>
      <th scope="col">Horario Final</th>
      <th scope="col">Data Inicio</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $dados) : ?>
      <tr>
        <td><?= $dados['nome_curso'] ?></td>
        <td><?= $dados['nome_turma'] ?></td>
        <td><?= $dados['horario_inicio'] ?></td>
        <td><?= $dados['horario_termino'] ?></td>
        <td><?= date('d/m/Y', strtotime($dados['data_inicio'])); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>