<?php

require("../conexao/conecta.php");

session_start();
// print_r($_SESSION);

// Verifica se a variável de sessão 'usuario' está definida
if (isset($_SESSION['usuario'])) {
  // Imprime o valor da variável de sessão 'usuario'
  echo $_SESSION['usuario'];
} else {
  // Se a variável de sessão 'usuario' não estiver definida, imprime uma mensagem de erro
  echo "A variável de sessão 'usuario' não está definida.";
}

$sqlConsulta = "SELECT curso.nome_curso, turma.id_turma, sala.num_sala, turma.nome_turma, turma.id_turma, reserva.id_reserva, reserva.data_inicio, reserva.data_termino, reserva.hora_inicio, reserva.hora_termino FROM reserva INNER JOIN sala ON sala.id_sala = reserva.id_sala INNER JOIN turma ON turma.id_turma = reserva.id_turma INNER JOIN curso ON reserva.id_curso = curso.id_curso";
$resultConsulta = mysqli_query($conexao, $sqlConsulta);
$exibeConsulta = mysqli_fetch_assoc($resultConsulta);

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
      <th scope="col">Curso</th>
      <th scope="col">Turma</th>
      <th scope="col">Sala</th>
      <th scope="col">Data Inicio</th>
      <th scope="col">Data Término</th>
      <th scope="col">Horario Inicio</th>
      <th scope="col">Horario Término</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($resultConsulta as $exibir) : ?>
      <tr>
        <td><?= $exibir['nome_curso'] ?></td>
        <td><?= $exibir['nome_turma'] ?></td>
        <td><?= $exibir['num_sala'] ?></td>
        <td><?= date('d/m/Y', strtotime($exibir['data_inicio'])); ?></td>
        <td><?= date('d/m/Y', strtotime($exibir['data_termino'])); ?></td>
        <td><?= $exibir['hora_inicio'] ?></td>
        <td><?= $exibir['hora_termino'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>