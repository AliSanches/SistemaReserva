<?php  

    require_once('./conexao/conecta.php');

        $sqlselect = "SELECT * FROM tipo_sala";
        $resultadoselect = mysqli_query($conexao, $sqlselect);
        $linhaselect = mysqli_fetch_assoc($resultadoselect);

      // RECEBENDO INFORMACOES DA TURMA
        if(isset($_GET['id_sala']) && $_GET['id_sala'] != '') {

        $id = $_GET['id_sala'];
    
        $sql = "SELECT * FROM sala WHERE id_sala = $id";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_assoc($resultado);
    
        }

      // SQL PARA ALTERAR INFORMAÇÃO
    if(isset($_POST['alterar']) && $_POST['alterar'] === 'altera_sala') {

        $id = $_POST['id_sala'];

        $tipoSala = $_POST['tipoSala'];
        $suportaCase = $_POST['suportaCase'];
        $suportaNotebook = $_POST['suportaNotebook'];
        $numeroSala = mysqli_real_escape_string($conexao, $_POST['numeroSala']);
        $capacidade = mysqli_real_escape_string($conexao, $_POST['capacidade']);              
    
        $sql = "UPDATE sala SET tipo_sala = '$tipoSala', armario = '$suportaCase', comport_notebook = '$suportaNotebook', num_sala = '$numeroSala', capacidade = '$capacidade' WHERE id_sala = $id";
    
        if(mysqli_query($conexao, $sql)) {
          header('Location:editar_sala.php');
        }
      }
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar sala</title>
    
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
        </ul>
    </div>
</nav>
<!-- FINAL NAVEGAÇÃO -->

    <!-- COMEÇO CONTEUDO -->
    <section class="principal container">
        <h1 class="text-center mt-5 mb-5 tituloCadastro">Editar Sala</h1>

        <form method="POST">
            <div class="form-group row cadastro text-center">
            
                <div class="d-flex justify-content-center mb-3">
                    <label for="tipoSala_insere" class="col-sm-4 col-form-label">Tipo da Sala</label>
                    <div class="col-sm-4 ">
                        <select class="custom-select" id="tipoSala" name="tipoSala" aria-label="Exemplo de select com botão addon">
                            <option>Selecione</option>
                            <?php do { ?>
                            <option value="<?php $linhaselect['id_tipo_sala'] ?>" <?php if($linhaselect['id_tipo_sala'] == $linha['id_tipo_sala']) echo "selected" ?> ><?php echo $linhaselect['nome_sala'] ?></option>
                            <?php } while ($linhaselect = mysqli_fetch_assoc($resultadoselect)) ?>
                          </select>
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <label for="caseSala_insere" class="col-sm-4 col-form-label">Case</label>
                    <div class="col-sm-4 ">
                        <select class="custom-select" id="armario" name="armario" aria-label="Exemplo de select com botão addon">
                            <option>Selecione</option>
                            <?php do { ?>
                            <option value="sim" <?php if($linha['armario'] === 'sim') echo "selected" ?>>Sim</option>
                            <option value="nao" <?php if($linha['armario'] === 'nao') echo "selected" ?>>Não</option>
                            <?php } while ($linha = mysqli_fetch_assoc($resultado)) ?>
                          </select>
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <label for="comportaNote_insere" class="col-sm-4 col-form-label">Comporta Notebook</label>
                    <div class="col-sm-4">
                        <select class="custom-select" id="comport_notebook" name="comport_notebook" aria-label="Exemplo de select com botão addon">
                            <option>Selecione</option>
                            <?php do { ?>
                            <option value="sim" <?php if($linha['comport_notebook'] === 'sim') echo "selected" ?>>Sim</option>
                            <option value="nao" <?php if($linha['comport_notebook'] === 'nao') echo "selected" ?>>Não</option>
                            <?php } while ($linha = mysqli_fetch_assoc($resultado)) ?>
                          </select>
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <label for="numSala_insere" class="col-sm-4 col-form-label">Número da Sala</label>
                    <div class="col-sm-4">
                        <input type="name" class="form-control col-12" name="numeroSala" id="numeroSala" value="<?php echo $linha['num_sala'] ?>">
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <label for="capacidadeSala_insere" class="col-sm-4 col-form-label">Capacidade Aluno</label>
                    <div class="col-sm-4 ">
                        <input type="text" class="form-control col-12" id="capacidade" name="capacidade" value="<?php echo $linha['capacidade'] ?>">
                    </div>
                </div>

                <div class="botao d-flex justify-content-center mt-5">
                    <!-- Botão para acionar modal -->
                    <input type="hidden" name="alterar" value="altera_sala">
                    <button type="submit" class="btn botaoLaranja btn-lg mr-5">
                        Editar
                    </button>

                    <!-- Botão para voltar a home -->
                    <a href="sala.php" class="btn botaoCinza btn-lg">Voltar</a>

                </div>
            </div>
          </form>
    </section>
    <!-- FINAL CONTEUDO -->

    <!-- COMEÇO RODAPÉ -->
    <footer class="rodape mt-5">
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