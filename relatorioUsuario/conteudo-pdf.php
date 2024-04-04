<?php

require("../conexao/conecta.php");

$sql = "SELECT nome, usuario, tipo FROM usuario ORDER BY nome";
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

  tbody {
    text-align: center;
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
      <th scope="col">Nome</th>
      <th scope="col">Nome de Usuário</th>
      <th scope="col">Permissão</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $dados) : ?>
      <tr>
        <td><?= $dados['nome'] ?></td>
        <td><?= $dados['usuario'] ?></td>
        <td><?= $dados['tipo'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>