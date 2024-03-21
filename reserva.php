<?php
  require_once('./conexao/conecta.php');

  session_start();
  // print_r($_SESSION);

  if($_SESSION['tipo'] == 'com')
  {
    header('Location: index.php');
  }

  //Numero itens por página
  $itensPorPagina = 4;

  //Pagina atual
  $paginaAtual = isset($_GET['pag']) ? $_GET['pag'] : 1;

  //Calcular o indice de inicio dos itens a serem exibidos na pagina atual
  $indiceInicio = ($paginaAtual - 1) * $itensPorPagina;

  $sqlCurso = "SELECT nome_curso, id_curso FROM curso";
  $resultCurso = mysqli_query($conexao, $sqlCurso);
  $exibeCurso = mysqli_fetch_assoc($resultCurso);

  //Consulta SQL para obter os dados
  $sqlConsulta = "SELECT curso.nome_curso, turma.id_turma, sala.num_sala, turma.nome_turma, turma.id_turma, reserva.id_reserva, reserva.data_inicio, reserva.data_termino, reserva.hora_inicio, reserva.hora_termino FROM reserva INNER JOIN sala ON sala.id_sala = reserva.id_sala INNER JOIN turma ON turma.id_turma = reserva.id_turma INNER JOIN curso ON reserva.id_curso = curso.id_curso LIMIT $indiceInicio, $itensPorPagina";
  $resultConsulta = mysqli_query($conexao, $sqlConsulta);
  $exibeConsulta = mysqli_fetch_assoc($resultConsulta);

  // Contar o número total de registros
  $totalRegistros = $conexao->query("SELECT COUNT(*) AS total FROM sala")->fetch_assoc()['total'];

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserva</title>
    
    <!-- Font awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Bootstrap 4.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap 4.0 -->
    <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"/>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./css/style.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  </head>
  <body>

<!-- COMEÇO HEADER -->
<header class="container">
  <div class="jumbotron jumbotron-fluid bg-white p-0 mt-5">
        <div class="container">
            <div class="logo d-flex justify-content-center">
                <a href="index.php">
                    <img src="./imagens/Senac_logo.svg.png" alt="Logo-Senac">
                </a>
            </div>
        </div>
  </div>
</header>
<!-- FINAL HEADER -->
            
<!-- COMEÇO NAVEGAÇÃO -->
<nav class="navbar navbar-expand-lg navbar-dark bgNavegacao">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#barranavegacao" aria-controls="barranavegacao"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-md-center" id="barranavegacao">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link mr-4 linkmenu" href="index.php">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link mr-4 linkmenu" href="curso.php">Curso</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link mr-4 linkmenu" href="turma.php">Turma</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link mr-4 linkmenu" href="sala.php">Sala</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link mr-4 linkmenu" href="reserva.php">Reserva</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link mr-4 linkmenu" href="usuario.php">Usuário</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link mr-4 linkmenu" href="sair.php">Sair</a>
      </li>
    </ul>
  </div>
</nav>
<!-- FINAL NAVEGAÇÃO -->

<!-- COMEÇO FILTRO SELECT -->
<section class="container text-left">
  <h1 class="text-center mt-4 mb-3 tituloCadastro">Reserva</h1>
        
  <div class="row align-items-center">

    <div class="col-lg-2 mb-3 mb-lg-0">
      <select id="nomeCurso" class="form-select filtro">
      <option>Curso</option>
      <?php foreach($resultCurso as $exibir):?>
        <option value="<?php echo $exibeCurso['id_curso']?>">
          <?=$exibir['nome_curso']?>
        </option>
        <?php endforeach;?>
      </select>
    </div>

    <div class="col-lg-2 mb-3 mb-lg-0">
      <select id="nomeTurma" class="form-select filtro">
      <option>Turma</option>
      <?php foreach($resultConsulta as $exibir):?>
        <option value="<?php echo $exibeConsulta['id_turma']?>">
          <?=$exibir['nome_turma']?>
        </option>
        <?php endforeach;?>
      </select>
    </div>
                
    <div class="col-lg-2 mb-3 mb-lg-0">
      <select id="numSala" class="form-select filtro">
      <option>Sala</option>
      <?php foreach($resultConsulta as $exibir):?>
        <option>
          <?=$exibir['num_sala']?>
        </option>
        <?php endforeach;?>
      </select>
    </div>
                                
    <div class="col-lg-2 mb-3 mb-lg-0">
      <input type="date" name="data" required class="form-control filtro">
    </div>
                
                
    <div class="col-lg-2 mb-3 mb-lg-0 d-flex justify-content-center justify-content-lg-end">
      <!-- Botão para Relatório -->
      <button type="button" class="btn btn-outline-dark py-1 btn-lg m-0 editEsp">
        <i class="fa-solid fa-file-pdf"></i>
        <a type="button" class="text-dark">Relatorio</a>
      </button>
    </div>
  </div>
</section>
<!-- FILTRO FILTRO SELECT -->

<!-- COMEÇO CONTEUDO -->
<section class="principal container">
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
        <th colspan="2" scope="col" class="text-center"><a class="btnLaranja" href="reserva_insere.php">Inserir</a></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($resultConsulta as $exibir):?>
        <tr>
        <td><?=$exibir['nome_curso']?></td>
        <td><?=$exibir['nome_turma']?></td>
        <td><?=$exibir['num_sala']?></td>
        <td><?=date('d/m/Y', strtotime($exibir['data_inicio']));?></td>
        <td><?=date('d/m/Y', strtotime($exibir['data_termino']));?></td>
        <td><?=$exibir['hora_inicio']?></td>
        <td><?=$exibir['hora_termino']?></td>
        <td scope="col"><a class="btnLaranja" href="reserva_altera.php?id_reserva=<?=$exibir['id_reserva']?>">Editar</a></td>
        <td scope="col"><a class="btnLaranja" href="reserva_exclui.php?id_reserva=<?=$exibir['id_reserva']?>">Excluir</a></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>

  <!-- PAGINAÇÃO -->
  <section class="navegacao mt-3">
    <nav aria-label="Navegação de paginas">
      <ul class="pagination d-flex justify-content-center">
        <li class="page-item">
          <?php if($indiceInicio>1):?>
          <a class="page-link" href="?pag=<?=$paginaAtual-1?>" aria-label="Anterior">
            <span aria-hidden="true">&laquo;</span>
            <?php endif;?>  
            <span class="sr-only">Anterior</span>
          </a>

        </li>

        <li class="page-item"><a class="page-link" href="#"><?=$paginaAtual?></a></li>

        <li class="page-item">
          <?php if($indiceInicio<$itensPorPagina):?>
          <a class="page-link" href="?pag=<?=$paginaAtual+1?>" aria-label="Próximo">
            <span aria-hidden="true">&raquo;</span>
            <?php endif;?>
            <span class="sr-only">Próximo</span>
          </a>
        </li>
      </ul>
    </nav>
  </section>
<!-- FINAL CONTEUDO -->
</section>

    <!-- COMEÇO RODAPÉ -->
    <footer class="rodape fixacao">
      Copyright &copy; 2023. Todos os Direitos Reservados
    </footer>
    <!-- FINAL RODAPÉ -->

    

</body>
</html>