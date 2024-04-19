<?php  
    date_default_timezone_set('America/Sao_Paulo');
    require_once('./conexao/conecta.php');

    session_start();
    // print_r($_SESSION);
  
    if($_SESSION['tipo'] == 'com')
    {
      header('Location: index.php');
    }

    $sqlUsuario = "SELECT * FROM usuario";
    $resultUsuario = mysqli_query($conexao, $sqlUsuario);
    $exibeUsuario = mysqli_fetch_assoc($resultUsuario);


    if(isset($_POST['cadastro']) && $_POST['cadastro'] === 'cadastro_usuario')
    {
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
        $permissao = $_POST['tipo'];
        $senha = $_POST['senha'];

        $sql = "INSERT INTO usuario (nome, usuario, senha, tipo) 
        VALUES ('$nome', '$usuario', '$senha', '$permissao')";

        if(mysqli_query($conexao, $sql)) {
            header('Location: usuario.php');
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
    <title>Inserir Usuário</title>
    
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
            <a class="nav-link mr-4 linkmenu" href="sair.php">Sair</a>
          </li>
        </ul>
    </div>
</nav>
<!-- FINAL NAVEGAÇÃO -->

<!-- COMEÇO CONTEUDO -->
<section class="principal container">
    <h1 class="text-center mt-5 mb-5 tituloCadastro">Cadastrar Usuário</h1>

    <form method="POST">
        <div class="form-group row cadastro text-center">
        
            <div class="d-flex justify-content-center mb-4">
                <label for="tipoSala_insere" class="col-sm-4 col-form-label">Nome</label>
                <div class="col-sm-4 ">
                    <input type="text" class="form-control col-12" id="nome" name="nome">
                </div>
            </div>

            <div class="d-flex justify-content-center mb-4">
                <label for="caseSala_insere" class="col-sm-4 col-form-label">Usuário</label>
                <div class="col-sm-4 ">
                    <input type="text" class="form-control col-12" id="usuario" name="usuario">
                </div>
            </div>

            <div class="d-flex justify-content-center mb-4">
                <label for="comportaNote_insere" class="col-sm-4 col-form-label">Tipo</label>
                <div class="col-sm-4">
                    <select class="custom-select" name="tipo">

                        <?php foreach($resultUsuario as $exibir):?>
                            <option value="<?=$exibir['tipo']?>"><?=$exibir['tipo']?></option>
                        <?php endforeach; ?>

                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-center mb-3">
                <label for="numSala_insere" class="col-sm-4 col-form-label">Senha</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control col-12" name="senha" id="senha">
                </div>
            </div>

            <div class="botao d-flex justify-content-center mt-5 mb-4">
                <!-- Botão para acionar modal -->
                <input type="hidden" name="cadastro" value="cadastro_usuario">
                <button type="submit" class="btn botaoLaranja btn-lg mr-5">
                    Cadastrar
                </button>

                <!-- Botão para voltar a home -->
                <a href="usuario.php" class="btn botaoCinza btn-lg">Voltar</a>

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