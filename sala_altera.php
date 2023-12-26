<?php  

    require_once('./conexao/conecta.php');

        $sqlselect = "SELECT * FROM tipo_sala";
        $resultadoselect = mysqli_query($conexao, $sqlselect);
        $linhaselect = mysqli_fetch_assoc($resultadoselect);


        if(isset($_GET['id_sala'])){

            $idSala = $_GET['id_sala'];

            $sqlCon = "SELECT num_sala, capacidade FROM sala WHERE id_sala = $idSala";
            $return = mysqli_query($conexao, $sqlCon);
            $exibirSalaCap = mysqli_fetch_assoc($return);
        }

        if(isset($_GET['id_sala'])){

            $idSala = $_GET['id_sala'];

            $sqlCon = "SELECT comport_notebook FROM sala WHERE id_sala = $idSala";
            $return = mysqli_query($conexao, $sqlCon);
            $exibirNote = mysqli_fetch_assoc($return);
        }

        // RECEBENDO INFORMACOES DA TURMA
        if(isset($_GET['id_sala']) && $_GET['id_sala'] != '') {

            $id = $_GET['id_sala'];
        
            $sqlSala = "SELECT * FROM sala WHERE id_sala = $id";
            $resultadoSala = mysqli_query($conexao, $sqlSala);
            $exibeSala = mysqli_fetch_assoc($resultadoSala);
        }

        if(isset($_POST['alterar']) && $_POST['alterar'] === 'confirmar')
    {
        $idSala = $_GET['id_sala'];

        $numero_de_sala = mysqli_real_escape_string($conexao, $_POST['num_sala']);
        $capacidade = mysqli_real_escape_string($conexao, $_POST['capacidade']);
        $suporte_case = $_POST['armario'];
        $suporte_notebook = $_POST['comport_notebook'];

        $sql = "UPDATE sala SET num_sala = '$numero_de_sala', capacidade = '$capacidade', armario = '$suporte_case', comport_notebook = '$suporte_notebook' WHERE id_sala = $idSala";

        if(mysqli_query($conexao, $sql)) {

        header('location:sala.php');
        }
        else 
        {
            die("Erro: " . $sql . "<br>" . mysqli_error($conexao));
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
                    <label for="nometipoAltera" class="col-sm-4 col-form-label">Tipo da Sala</label>
                    <div class="col-sm-4 ">
                        <select class="custom-select" id="nome_tipo" name="id_tipo_sala">
                            <?php do { ?>
                                <option value="<?php $linhaselect['id_tipo_sala'] ?>" <?php if($linhaselect['id_tipo_sala'] == $exibeSala['id_tipo_sala']) echo "selected" ?> ><?php echo $linhaselect['nome_sala'] ?></option>
                            <?php } while ($linhaselect = mysqli_fetch_assoc($resultadoselect)) ?>
                          </select>
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <label for="armarioAltera" class="col-sm-4 col-form-label">Case</label>
                    <div class="col-sm-4 ">
                        <select class="custom-select" id="armario" name="armario">
                            <?php do { ?>
                                <option value="sim" <?php if($exibeSala['armario'] === 'sim') echo "selected" ?>>Sim</option>
                                <option value="nao" <?php if($exibeSala['armario'] === 'nao') echo "selected" ?>>Não</option>
                            <?php } while ($exibeSala = mysqli_fetch_assoc($resultadoSala)) ?>
                          </select>
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <label for="comportaAltera" class="col-sm-4 col-form-label">Comporta Notebook</label>
                    <div class="col-sm-4">
                        <select class="custom-select" id="comport_notebook" name="comport_notebook">
                            <?php do { ?>
                                <option value="sim" <?php if($exibirNote['comport_notebook'] === 'sim') echo "selected" ?>>Sim</option>
                                <option value="nao" <?php if($exibirNote['comport_notebook'] === 'nao') echo "selected" ?>>Não</option>
                            <?php } while ($exibirNote = mysqli_fetch_assoc($return)) ?>
                          </select>
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <label for="numeroAltera" class="col-sm-4 col-form-label">Número Sala</label>
                    <div class="col-sm-4">
                        <input type="number" name="num_sala" id="num_sala" class="form-control" value="<?php echo $exibirSalaCap['num_sala']?>">         
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <label for="capacidadeAltera" class="col-sm-4 col-form-label">Capacidade</label>
                    <div class="col-sm-4">
                        <input type="number" id="capacidade" name="capacidade" class="form-control" value="<?php echo $exibirSalaCap['capacidade']?>">         
                    </div>
                </div>


                <div class="botao d-flex justify-content-center mt-5">
                <input type="hidden" name="id_sala" value="<?= isset($exibeSala['id_sala']) ? htmlspecialchars($exibeSala['id_sala']) : '' ?>">
                    <button type="submit" name="alterar" value="confirmar" class="btn botaoLaranja btn-lg mr-5">
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