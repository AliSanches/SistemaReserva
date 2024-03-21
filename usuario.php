<?php 
  session_start();
  // print_r($_SESSION);

  if($_SESSION['tipo'] == 'com')
  {
    header('Location: index.php');
  }

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
  $sql = $pdo->query("SELECT * FROM usuario ORDER BY nome LIMIT $pagInicial, $pagLimite");

  //NUMEROS DE REGISTROS DENTRO DA TABELA
  $contagemRegistros = $pdo->query("SELECT COUNT(id_usuario) count FROM usuario")->fetch()['count'];
  
  //CEIL CONVERTE SEMPRE PARA UM VALOR INTEIRO | QUANTIDADE TOTAL DE PAGINAS QUE POSSUO
  $qtdPaginas = ceil($contagemRegistros / $pagLimite);

  //PDO::fetch_assoc diz ao PDO para retornar os resultados como uma matriz associativa
  $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
  //FINAL -- CONSULTA PARA BUSCAR INFORMACOES 

  //ATUALIZAR COM TODAS AS INFORMACOES
  $conAll = $pdo->query("SELECT * FROM usuario ORDER BY nome");
  $resultadoAll = $conAll->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuario</title>
    
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Bootstrap 4.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap 4.0 -->
    <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"/>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="./js/" defer></script>
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
        <a class="nav-link mr-4 linkmenu" href="sair.php">Sair</a>
      </li>
    </ul>
  </div>
</nav>
<!-- FINAL NAVEGAÇÃO -->

<!-- COMEÇO FILTRO SELECT -->
  <section class="principal container">
    <h1 class="text-center mt-4 mb-3 tituloCadastro">Usuario</h1>

    <div class="row align-items-center">
                
      <div class="col-lg-5 mb-3 mb-lg-0">
        <select id="selectCurso" class="form-select filtro">
          <option value="valorPadrao">Nome do Usuario</option>
            <?php foreach($resultadoAll as $exibirNome):?>
              <option value="<?php echo $exibirNome['id_usuario']?>"><?=$exibirNome['nome']?></option>
            <?php endforeach;?>
        </select>
      </div>
                
      <div class="col-lg-5 mb-3 mb-lg-0">
        <select id="selectTipoCurso" class="form-select filtro">
          <option value="valorPadraoTipo">Tipo do Usuario</option>
            <?php foreach($resultadoAll as $exibirNome):?>
              <option value="<?php echo $exibirNome['id_usuario']?>"><?=$exibirNome['tipo']?></option>
            <?php endforeach;?>
        </select>
      </div>
    <!-- FILTRO FILTRO SELECT -->
    

<!-- COMEÇO CONTEUDO -->
  <table  id="tabelaCurso" class="table w-100 table-responsive-sm conteudo mt-3 mb-3 text-center">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Usuario</th>
        <th scope="col">Permissão</th>
        <th colspan="2" scope="col"><a class="btnLaranja" href="usuario_insere.php">Inserir</a></th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($resultados as $exibir): ?>
      <tr>
        <td><?=$exibir['nome'];?></td>
        <td><?=$exibir['usuario'];?></td>
        <td><?=$exibir['tipo'];?></td>
        <td><a class="btnLaranja" href="usuario_altera.php?id_usuario=<?=$exibir['id_usuario']?>">Editar</a></td>
        <td><a class="btnLaranja" href="usuario_exclui.php?id_usuario=<?=$exibir['id_usuario']?>">Excluir</a></td>
      </tr>
      <?php endforeach; ?>
      
    </tbody>

  </table>
<!-- FINAL CONTEUDO -->

<!-- PAGINAÇÃO -->
  <section class="navegacao mt-3">
    <nav aria-label="Navegação de paginas">
      <ul class="pagination d-flex justify-content-center">
        <li class="page-item">
          <?php if($pag>1):?>
          <a class="page-link" href="?pag=<?=$pag-1?>" aria-label="Anterior">
            <span aria-hidden="true">&laquo;</span>
            <?php endif;?>  
            <span class="sr-only">Anterior</span>
          </a>
        </li>
        <li class="page-item"><a class="page-link" href="#"><?=$pag?></a></li>
        <li class="page-item">
          <?php if($pag<$qtdPaginas):?>
          <a class="page-link" href="?pag=<?=$pag+1?>" aria-label="Próximo">
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