<?php 

require_once('./conexao/conecta.php');

  //Numero itens por página
  $itensPorPagina = 4;

  //Pagina atual
  $paginaAtual = isset($_GET['pag']) ? $_GET['pag'] : 1;

  //Calcular o indice de inicio dos itens a serem exibidos na pagina atual
  $indiceInicio = ($paginaAtual - 1) * $itensPorPagina;

  //Consulta SQL para obter os dados
  $sql = "SELECT curso.nome_curso, curso.id_curso, turma.id_turma, turma.nome_turma, turma.codigo_oferta, turma.horario_inicio, turma.horario_termino, turma.data_inicio FROM curso INNER JOIN turma ON curso.id_curso = turma.id_curso ORDER BY curso.nome_curso LIMIT $indiceInicio, $itensPorPagina";
  $result = mysqli_query($conexao, $sql);
  $row = mysqli_fetch_assoc($result);

  $sqlConsulta = "SELECT curso.nome_curso, curso.id_curso, turma.id_turma, turma.nome_turma, turma.codigo_oferta, turma.horario_inicio, turma.horario_termino, turma.data_inicio FROM curso INNER JOIN turma ON curso.id_curso = turma.id_curso";
  $resultConsulta = mysqli_query($conexao, $sqlConsulta);

  // Contar o número total de registros
  $totalRegistros = $conexao->query("SELECT COUNT(*) AS total FROM turma")->fetch_assoc()['total'];

  $sqlTipo = "SELECT nome_tipo FROM tipo_curso";
  $resultTipo = mysqli_query($conexao, $sqlTipo);
  $exibeTipo = mysqli_fetch_assoc($resultTipo);
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Turma</title>
    
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Bootstrap 4.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap 4.0 -->
    <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"/>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="./js/refreshTurma.js" defer></script>
    <script src="./js/jquery.js" defer></script>

    <link rel="stylesheet" href="./css/style.css">
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
        <a class="nav-link mr-4 linkmenu" href="login.html">Sair</a>
      </li>
  </div>
</nav>
<!-- FINAL NAVEGAÇÃO -->

<!-- COMEÇO FILTRO SELECT -->
<section class="container principal">
  <h1 class="text-center mt-4 mb-3 tituloCadastro">Turma</h1>

  <div class="row align-items-center">
                
    <div class="col-lg-4 mb-3 mb-lg-0">
      <select id="selectCurso" class="form-select filtro">
        <option selected>Nome do Curso</option>
        <?php foreach($resultConsulta as $exibir):?>
          <option value="<?php echo $exibirNome['id_curso']?>" ><?=$exibir['nome_curso']?></option>
        <?php endforeach;?>
      </select>
    </div>
                
    <div class="col-lg-4 mb-3 mb-lg-0">
      <select id="selectTurmas" class="form-select filtro">
        <option selected>Turmas</option>
        <?php foreach($result as $executa):?>
          <option><?=$executa['nome_turma']?></option>
        <?php endforeach;?>
      </select>
    </div>
                
    <div class="col-lg-2 mb-3 mb-lg-0">
      <input type="time" name="time" class="form-control filtro">
    </div>
                
    <div class="col-lg-2 mb-3 mb-lg-0 d-flex justify-content-center justify-content-lg-end">
      <!-- Botão para Relatório -->
      <button type="button" class="btn btn-outline-dark py-1 btn-lg m-0 editEsp">
        <i class="fa-solid fa-file-pdf"></i>
        <a type="button" class="text-dark">Relatorio</a>
      </button>
    </div>
  </div>
  <!-- FILTRO FILTRO SELECT -->
    
  <!-- COMEÇO CONTEUDO -->
  <table id="tabelaTurma" class="table w-100 table-responsive-sm conteudo mt-3 mb-3 text-center">
    <thead>
        <tr>
            <th scope="col">Nome do Curso</th>
            <th scope="col">Nome da Turma</th>
            <th scope="col">Horario Inicio</th>
            <th scope="col">Horario Final</th>
            <th scope="col">Data Inicio</th>
            <th colspan="2" scope="col" class="text-center"><a class="btnLaranja" href="turma_insere.php">Inserir</a></th>
          </tr>
    </thead>
        <tbody>
          <?php foreach($result as $dados):?>
            <tr>
              <td><?=$dados['nome_curso'] ?></td>
              <td><?=$dados['nome_turma'] ?></td>
              <td><?=$dados['horario_inicio'] ?></td>
              <td><?=$dados['horario_termino'] ?></td>
              <td><?=$dados['data_inicio'] ?></td>
              <td><a  class="btnLaranja" href="turma_altera.php?id_turma=<?= $dados['id_turma'] ?>">Editar</a></td>
              <td><a class="btnLaranja" href="turma_exclui.php?id_turma=<?= $dados['id_turma'] ?>">Excluir</a></td>
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
  <!-- FINAL PAGINAÇÃO -->
</section>

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