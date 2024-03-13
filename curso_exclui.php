<?php 

    require_once('./conexao/conecta.php');

    $sqltipo = "SELECT * FROM tipo_curso";
    $resultadotipo = mysqli_query($conexao, $sqltipo);
    $linhatipo = mysqli_fetch_assoc($resultadotipo);

    //RECUPERAR INFORMACOES
    if(isset($_GET['id_curso']) && $_GET['id_curso'] != ''){

        $id = $_GET['id_curso'];
    
        $sql = "SELECT * FROM curso WHERE id_curso = $id";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_assoc($resultado);
      }

    //COD PARA ENVIAR INFORMACOES
    if (isset($_POST['exclui']) && $_POST['exclui'] === 'sim') {

        $id = $_POST['id_curso'];

        $sql = "DELETE FROM curso WHERE id_curso=$id";
    
        if (mysqli_query($conexao, $sql)) {
            header('Location: curso.php');
        } else {
            die("Erro: " . $sql . "<br>" . mysqli_error($conexao));
        }
    }

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exclusão de curso</title>
    
    <!-- Font awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    <button class="navbar-toggler" type="button" data-target="#barranavegacao" aria-controls="barranavegacao"
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
            <a class="nav-link mr-4 linkmenu" href="login.php">Sair</a>
          </li>
        </ul>
    </div>
</nav>
<!-- FINAL NAVEGAÇÃO -->

<!-- COMEÇO CONTEUDO -->
    <section class="principal container">
        <div class="row">
            <h1 class="text-center mt-5 mb-5 tituloCadastro">Excluir Curso</h1>

            <form method="POST">
                <div class="fs-18">
                    <div class="col-12 col-md-4 m-auto">
                        <label for="nomeCurso_exclui">Nome do curso</label>
                        <input type="name" class="form-control mb-3" id="nome" name="nome_curso" value="<?php echo $linha['nome_curso'] ?>" readonly>
                    </div>

                    <div class="col-12 col-md-4 m-auto">
                        <label name="tipo_curso" id="tipo_curso">Tipo do curso</label>
                        <select name="tipo" id="tipo_curso" class="form-select" disabled>
                        <?php do { ?>

                            <option value="<?php echo $linhatipo['id_tipo_curso']?>" <?php if($linhatipo['id_tipo_curso'] == $linha['id_tipo_curso'] ) echo "selected" ?>><?php echo $linhatipo['nome_tipo'] ?></option>

                        <?php } while($linhatipo = mysqli_fetch_assoc($resultadotipo)) ?>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-5">
                <input type="hidden" name="id_curso" value="<?= $linha['id_curso']?>">
                <button type="submit" name="exclui" value="sim" class="btn btn-lg botaoLaranja mr-5">
                    Excluir
                </button>

                    <!-- Botão para voltar a home -->
                    <a class="btn btn-lg botaoCinza" href="curso.php">Voltar</a>

                </div>
            </form>
        </div>
    </section>
    <!-- FINAL CONTEUDO -->

    <!-- COMEÇO RODAPÉ -->
    <footer class="rodape fixed-bottom">
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