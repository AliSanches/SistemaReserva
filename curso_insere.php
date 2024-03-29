<?php 
    require_once('./conexao/conecta.php');

    session_start();
    // print_r($_SESSION);
  
    if($_SESSION['tipo'] == 'com')
    {
      header('Location: index.php');
    }

    $sqltipo = "SELECT * FROM tipo_curso ORDER BY nome_tipo ASC";
    $resultadotipo = mysqli_query($conexao, $sqltipo);
    $linhatipo = mysqli_fetch_assoc($resultadotipo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //COLETA OS DADOS DO FORMULARIO
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $tipo = mysqli_real_escape_string($conexao, $_POST['tipo']);

        //SQL PARA INSERIR NO BANCO
        $sqlInserirCurso = "INSERT INTO curso (nome_curso, id_tipo_curso) VALUES ('$nome', $tipo)";

        //EXIBE O RETORNO DAS SQL'S ENVIADAS JUNTAMENTE COM UMA VERIFICACAO
        if(mysqli_query($conexao, $sqlInserirCurso)) {
            header('Location:curso.php');
        }
        else {
            die("Erro: " . $sqlInserirCurso . "<br>" . mysqli_error($conexao));
        }
    }

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inserir curso</title>
    
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
            <a class="nav-link mr-4 linkmenu" href="sair.php">Sair</a>
          </li>
        </ul>
    </div>
</nav>
<!-- FINAL NAVEGAÇÃO -->

<!-- COMEÇO CONTEUDO -->
    <section class="principal container">
        <div class="row">
            <h1 class="text-center mt-5 mb-5 tituloCadastro">Cadastrar Curso</h1>

            <form method="POST">
                <div class="fs-18">
                    <div class="col-12 col-md-4 m-auto">
                        <label for="nome">Nome do curso</label>
                        <input type="text" class="form-control mb-3" name="nome" id="nome" required>
                    </div>

                    <div class="col-12 col-md-4 m-auto">
                        <label for=tipo>Tipo do curso</label>
                        <select class="form-select" name="tipo" id="tipo" required>
                            <?php foreach ($resultadotipo as $exibir): ?>
                                <!-- value é o valor que é enviado para o servidor -->
                            <option value="<?=$exibir['id_tipo_curso']?>"><?= $exibir['nome_tipo'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-5">
                    <!-- Botão para acionar modal -->
                    <input type="hidden" value="Enviar">
                    <button type="submit" class="btn btn-lg botaoLaranja mr-5" data-toggle="modal" data-target="#ModalCurso">
                        Cadastrar
                    </button>

                    <!-- Botão para voltar a home -->
                    <a class="btn btn-lg botaoCinza" href="curso.php">Voltar</a>

                        <!-- Modal -->
                        <div class="modal fade" id="ModalCurso" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="TituloModalCentralizado"> 
                                            <i class="fa-regular fa-circle-check"></i>
                                            Cadastro
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body my-5 text-center">
                                        Cadastro concluido com sucesso
                                    </div>

                                    <div class="modal-footer justify-content-center">                                        
                                        <button type="submit" class="btn botaoLaranja px-5" data-dismiss="modal">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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