<?php

  $pag = 1;

  //INICIO -- VERIFICACAO DE PAGINA
  if(isset($_GET['pag'])) 
    $pag = filter_input(INPUT_GET, "pag", FILTER_VALIDATE_INT);
  if(!$pag)
    $pag = 1;
  //FINAL -- VERIFICACAO DE PAGINA
  
  $pagLimite = 4;
  $pagInicial = ($pag * $pagLimite) - $pagLimite;

  //INICIO -- CONSULTA PARA BUSCAR INFORMACOES 
  $pdo = new PDO("mysql:host=localhost;dbname=projeto;charset=utf8", "root", "");
  $sql = $pdo->query("SELECT * FROM curso INNER JOIN tipo_curso ON curso.id_tipo_curso = tipo_curso.id_tipo_curso ORDER BY curso.nome_curso LIMIT $pagInicial, $pagLimite");
  //NUMEROS DE REGISTROS DENTRO DA TABELA
  $contagemRegistros = $pdo->query("SELECT COUNT(id_curso) count FROM curso")->fetch()['count'];
  //CEIL CONVERTE SEMPRE PARA UM VALOR INTEIRO | QUANTIDADE TOTAL DE PAGINAS QUE POSSUO
  $qtdPaginas = ceil($contagemRegistros / $pagLimite);
  //PDO::fetch_assoc diz ao PDO para retornar os resultados como uma matriz associativa
  $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
  //FINAL -- CONSULTA PARA BUSCAR INFORMACOES 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagina Teste NAVEGACAO</title>

  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <!-- Bootstrap 4.1 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- Bootstrap 4.0 -->
  <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"/>
</head>
<body>

  <!-- INICIO TABELA -->
  <table class="table w-100 table-responsive-sm conteudo mt-3 mb-3 text-center">
    <h1 class="text-center mt-5 mb-5" >TESTE NAVEGAÇÃO COM PHP</h1>
    <thead>
      <tr>
        <th scope="col">Nome do Curso</th>
        <th scope="col">Tipo do Curso</th>
        <th colspan="2" scope="col"><a class="btnLaranja" href="curso_insere.php">Inserir</a></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($resultados as $exibir): ?>
      <tr>
        <td><?=$exibir["nome_curso"]?></td>
        <td><?=$exibir["nome_tipo"]?></td>
        <td><a class="btnLaranja" href="curso_altera.php?id_curso=<?$exibir['id_curso']?>">Editar</a></td>
        <td><a class="btnLaranja" href="curso_exclui.php?id_curso=<?$exibir['id_curso']?>">Excluir</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <!-- FINAL TABELA -->

  <!-- PAGINAÇÃO -->
  <section class="navegacao mt-3">
    <nav aria-label="Navegacao de pagina">
      <ul class="pagination d-flex justify-content-center">
        <li class="page-item">
          <?php if($pag>1): ?>
          <a class="page-link" href="?pag=<?=$pag-1?>" aria-label="Anterior">
          <span aria-hidden="true">&laquo;</span>
          <?php endif;?>
          <span class="sr-only">Anterior</span>
          </a>
        </li>
        <li class="page-item"><a class="page-link" href="#"><?=$pag?></a></li>
        <!-- <li class="page-item"><a class="page-link" href="?pag=<?=$qtdPaginas?>"><?=$qtdPaginas?></a></li>   QUANTIDADE FINAL DE PAGINAS DISPONIVEIS -->
        <li class="page-item">
          <?php if($pag<$qtdPaginas):?>
          <a class="page-link" href="?pag=<?=$pag+1?>" aria-label="Proxima">
          <span aria-hidden="true">&raquo;</span>
          <?php endif;?>
          <span class="sr-only">Proxima</span>
          </a>
        </li>
      </ul>
    </nav>
  </section>
  <!-- FINAL PAGINAÇÃO -->
</body>
</html>