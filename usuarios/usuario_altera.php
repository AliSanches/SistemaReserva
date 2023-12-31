<?php 

    require_once('./conexao/conecta.php');

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edição Usuário</title>
    
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
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <h1 class="text-center mt-5 mb-5 tituloCadastro">Edição de Usuário</h1>

            <form class="fs-18">
                <div class="form-group">
                    <label for="loginUsuario_altera">Nome</label>
                    <input type="text" class="form-control" id="loginUsuario_altera" value="<?php $linhaselect['id_tipo_sala'] ?>" <?php if($linhaselect['id_tipo_sala'] == $linha['id_tipo_sala']) echo "selected" ?>>
                </div>
                <div class="form-group">
                    <label for="nomeUsuario_altera">Nome de Usuário</label>
                    <input type="text" class="form-control" id="nomeUsuario_altera" >
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="senha_altera">Senha</label>
                    <input type="email" class="form-control" id="senha_altera" >
                    </div>
                    <div class="form-group col-md-6">
                    <label for="redigiteSenha_altera">Redigite a Senha</label>
                    <input type="password" class="form-control" id="redigiteSenha_altera" >
                    </div>
                </div>

                <div class="form-row ml-5">
                    <div class="col-sm-6">
                    <div class="form-check ml-5">
                        <input class="form-check-input" type="checkbox" id="comum_altera">
                        <label class="form-check-label" for="comum_altera">
                        Comum
                        </label>
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="supervisor_altera">
                        <label class="form-check-label" for="supervisor_altera">
                            Supervisor
                        </label>
                        </div>
                    </div>
                </div>  
            </form>
        </div>
        </div>
        
        <!-- BOTÕES -->
        <div class="botao d-flex justify-content-center mt-5 fs-18">
                        <!-- Botão para acionar modal -->
                        <button type="submit" class="btn botaoLaranja btn-lg mr-5" data-toggle="modal" data-target="#Modalusuario_Edita">
                            Editar
                        </button>

                        <!-- Botão para voltar a home -->
                        <a href="usuario.php" class="btn botaoCinza btn-lg">Voltar</a>

                        <!-- Modal -->
                        <div class="modal fade" id="Modalusuario_Edita" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="TituloModalCentralizado"> 
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                            Editar
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body my-5 text-center">
                                        Tem certeza que deseja editar
                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn botaoLaranja px-3" data-toggle="modal" data-target="#Modalusuario_editado">Editar</button>
                                        <button type="button" class="btn px-3" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="Modalusuario_editado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="TituloModalCentralizado"> 
                                            <i class="fa-regular fa-circle-check"></i>
                                            Editar
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body my-5 text-center">
                                        Editado com sucesso!
                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn botaoLaranja px-5" data-dismiss="modal">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
        </div>
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