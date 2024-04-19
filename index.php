<?php

  session_start();
  // print_r($_SESSION);

  if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true))
  {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('Location: login.php');
  }
  $logado = $_SESSION['usuario'];

  require_once('./conexao/conecta.php');

  //Numero itens por página
  $itensPorPagina = 4;

  //Pagina atual
  $paginaAtual = isset($_GET['pag']) ? $_GET['pag'] : 1;

  //Calcular o indice de inicio dos itens a serem exibidos na pagina atual
  $indiceInicio = ($paginaAtual - 1) * $itensPorPagina;

  $sqlConsulta = "SELECT sala.num_sala, curso.nome_curso, turma.nome_turma, reserva.hora_inicio, reserva.hora_termino, reserva.data_inicio, reserva.data_termino FROM reserva INNER JOIN turma ON turma.id_turma = reserva.id_turma INNER JOIN sala ON sala.id_sala = reserva.id_sala INNER JOIN curso ON turma.id_curso = curso.id_curso LIMIT $indiceInicio, $itensPorPagina";
  $resultConsulta = mysqli_query($conexao, $sqlConsulta);
  $exibeConsulta = mysqli_fetch_assoc($resultConsulta);


?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Bootstrap 4.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap 4.0 -->
    <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"/>

    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>

    <!-- COMEÇO HEADER -->
    <header class="container">
      <div class="jumbotron jumbotron-fluid bg-white p-0 mt-5">
            <div class="container">
                <div class="logo d-flex justify-content-center">
                    <a href="index.html">
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
    <section class="container">

      <h1 class="text-center mt-4 mb-3 tituloCadastro">Home</h1>

      <div class="btn-group filtro ml-5">
        <button type="button" class="btn pr-5 btn-outline-dark text-left">Selecione</button>
        <button type="button" class="btn btn-secondary px-3 btn-outline-dark dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
          <span class="sr-only">Dropdown</span>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
        <a class="dropdown-item" href="index.php">Salas Reservadas</a>
        <a class="dropdown-item" href="salasDisponiveis.php">Salas Disponiveis</a>
        </div>
    </section>
    <!-- FILTRO FILTRO SELECT -->

    <!-- COMEÇO CONTEUDO -->
    <section class=" principal container">
    <table class="table w-100 table-responsive-sm conteudo mt-3 mb-3 text-center">
    <thead>
        <th scope="col">Sala</th>
        <th scope="col">Curso</th>
        <th scope="col">Turma</th>
        <th scope="col">Horário Início</th>
        <th scope="col">Horário Término</th>
        <th scope="col">Data Início</th>
        <th scope="col">Data Término</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($resultConsulta as $exibir): ?>
      <tr>
        <td><?=$exibir['num_sala'];?></td>
        <td><?=$exibir['nome_curso'];?></td>
        <td><?=$exibir['nome_turma'];?></td>
        <td><?=$exibir['hora_inicio'];?></td>
        <td><?=$exibir['hora_termino'];?></td>
        <td><?=date('d/m/Y', strtotime($exibir['data_inicio']));?></td>
        <td><?=date('d/m/Y', strtotime($exibir['data_termino']));?></td>
      </tr>
      <?php endforeach; ?>
      
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
<!-- FINAL PAGINAÇÃO -->

</section>
<!-- FINAL CONTEUDO -->

    <!-- COMEÇO RODAPÉ -->
    <footer class="rodape fixacao">
      Copyright &copy; 2023. Todos os Direitos Reservados
    </footer>
    <!-- FINAL RODAPÉ -->

    <!-- Bootstrap 4.1 -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Bootstrap 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>