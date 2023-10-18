<?php 

  require_once('./conexao/conecta.php');

  $sql = "SELECT id_turma FROM turma";
  $resultado = mysqli_query($conexao, $sql);
  $linha = mysqli_fetch_assoc($resultado);
  $quantidade = mysqli_num_rows($resultado);

  //ROTINA DE PAGINAÇÃO
  if(isset($_GET['pagina']) && !empty($_GET['pagina'])){
    $paginaatual = $_GET['pagina'];
  }else{
    $paginaatual = 1;
  }

  $url = "?pagina=";

  //QUANTIDADE DE REGISTROS EXIBIDOS POR PÁGINA
  $paginaqtdd = 5;

  //VALOR INICIAL PARA A CLÁUSULA LIMIT
  $valorinicial = ($paginaatual * $paginaqtdd) - $paginaqtdd;
  $paginafinal = ceil($quantidade/$paginaqtdd);
  $paginainicial = 1;
  $paginaproxima = $paginaatual + 1;
  $paginaanterior = $paginaatual - 1;
  $status = true;

  //SQL PARA TRAZER AS NOTÍCIAS GERAIS
  $sqlpag = "SELECT turma.id_turma, turma.nome_turma, turma.horario_inicio, turma.horario_termino, turma.status, turma.codigo_Oferta, curso.nome_curso FROM turma INNER JOIN curso ON turma.id_curso = curso.id_curso WHERE turma.status = $status LIMIT $valorinicial, $paginaqtdd";
  $resultadopag = mysqli_query($conexao, $sqlpag);
  $linhapag = mysqli_fetch_assoc($resultadopag);

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
        <a class="nav-link mr-4 linkmenu" href="index.html">Home</a>
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
      <select id="reserva" class="form-select filtro">
        <option selected>Nome da turma</option>
        <option>...</option>
      </select>
    </div>
                
    <div class="col-lg-4 mb-3 mb-lg-0">
      <select id="reserva" class="form-select filtro">
        <option selected>Selecionar por curso</option>
        <option>...</option>
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
  <?php if($quantidade > 0) {?>
  <table class="table w-100 table-responsive-sm conteudo mt-3 mb-3 text-center">
    <thead>
        <tr>
            <th scope="col">Curso</th>
            <th scope="col">Nome da Turma</th>
            <th scope="col">Código de Oferta</th>
            <th scope="col">Data</th>
            <th colspan="2" scope="col" class="text-center"><a class="btnLaranja" href="turma_insere.php">Inserir</a></th>
          </tr>
    </thead>
        <tbody>
                  <?php do { ?>
                  <tr>
                    <td><?php echo $linhapag['nome_curso'] ?></td>
                    <td><?php echo $linhapag['nome_turma'] ?></td>
                    <td><?php echo $linhapag['horario_inicio'] ?></td>
                    <td><?php echo $linhapag['horario_termino'] ?></td>
                    <td><a  class="btnLaranja" href="turma_altera.php?id_turma=<?php echo $linhapag['id_turma'] ?>">Editar</a></td>
                    <td><a class="btnLaranja" href="turma_exclui.php?id_turma=<?php echo $linhapag['id_turma'] ?>">Excluir</a></td>
                  </tr>
                  <?php } while($linhapag = mysqli_fetch_assoc($resultadopag))  ?>
        </tbody>
  </table>

        <!-- PAGINAÇÃO -->
        <nav aria-label="paginacao">
            <ul class="pagination justify-content-center">
              <?php if($paginaatual != $paginainicial) { ?>
                <li class="page-item">
                  <a class="page-link" href="<?php echo $url . $paginainicial ?>">Início</a>
                </li>
              <?php } ?>

              <?php if($paginaatual >= 2) { ?>
                <li class="page-item">
                  <a class="page-link" href="<?php echo $url . $paginaanterior?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
              <?php } ?>

              <?php if($paginaatual != $paginafinal) { ?>
                <li class="page-item">
                  <a class="page-link" href="<?php echo $url . $paginaproxima?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>

                <li class="page-item">
                  <a class="page-link" href="<?php echo $url . $paginafinal?>">Final</a>
                </li>
              <?php } ?>
            </ul>
          </nav>
          <?php }  ?>
  <!-- FINAL CONTEUDO -->
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