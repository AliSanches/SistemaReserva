<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserva</title>
    
    
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
    <section class="principal container fs-18">
        <div class="row justify-content-center">
            <h1 class="text-center mt-5 mb-5 tituloCadastro">Exclusão de Reserva</h1>

            <form class="col-lg-8" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-4">
                            <label for="reservaTurma_exclui">Turma</label>
                            <select id="reservaTurma_exclui" class="form-control" readonly>
                                <option selected>Escolher...</option>
                                <option>...</option>
                            </select>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="reservaSala_exclui">Sala</label>
                        <select id="reservaSala_exclui" class="form-control" readonly>
                            <option selected>Escolher...</option>
                            <option>...</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="reservaCurso_exclui">Curso</label>
                        <select id="reservaCurso_exclui" class="form-control" readonly>
                            <option selected>Escolher...</option>
                            <option>...</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-check col-lg-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Segunda-Feira
                        </label>
                        <input type="checkbox" disabled>
                    </div>

                    <div class="form-check col-lg-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Terça-Feira
                        </label>
                        <input type="checkbox" disabled>
                    </div>

                    <div class="form-check col-lg-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Quarta-Feira
                        </label>
                        <input type="checkbox" disabled>
                    </div>
                    <div class="form-check col-lg-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Quinta-Feira
                        </label>
                        <input type="checkbox" disabled>
                    </div>

                    <div class="form-check col-lg-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Sexta-Feira
                        </label>
                        <input type="checkbox" disabled>
                    </div>

                    <div class="form-check col-lg-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Sábado
                        </label>
                        <input type="checkbox" disabled>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-6">
                        <label for="dataInicio_exclui" class="d-flex">Data Início</label>
                        <input type="date" class="form-control" readonly>
                    </div>

                    <div class="col-6">
                        <label for="horaInicio_exclui" class="d-flex mt-0">Hora Início</label>
                        <input type="time" class="mt-0 centro form-control" readonly>
                    </div>

                    <div class="col-6 mt-3">
                        <label for="dataTermino_exclui" class="d-flex">Data Término</label>
                        <input type="date" class="form-control" readonly>
                    </div>

                    <div class="col-6">
                        <label for="horaTermino_exclui" class="d-flex mt-3">Hora Término</label>
                        <input type="time" class="mt-2 centro form-control" readonly>
                    </div>
                </div>
               
                <div class=" d-flex justify-content-center mt-5">
                    <!-- Botão para acionar modal -->
                    <button type="button" class="btn botaoLaranja btn-lg mr-5" data-toggle="modal" data-target="#Modalsala_Exclui">
                        Excluir
                    </button>

                    <!-- Botão para voltar a home -->
                    <a href="reserva.php" class="btn botaoCinza btn-lg">Voltar</a>

                    <!-- Modal -->
                    <div class="modal fade" id="Modalsala_Exclui" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="TituloModalCentralizado"> 
                                        <i class="fa-regular fa-trash-can"></i>
                                        Exclusão
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body my-5 text-center">
                                    Deseja realmente EXCLUIR este curso
                                </div>

                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn botaoLaranja px-3" data-toggle="modal" data-target="#Modalsala_excluido">Excluir</button>
                                    <button type="button" class="btn px-3" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="Modalsala_excluido" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="TituloModalCentralizado"> 
                                        <i class="fa-regular fa-trash-can"></i>
                                        Exclusão
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body my-5 text-center">
                                    Excluido com sucesso!
                                </div>

                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn botaoLaranja px-5" data-dismiss="modal">OK</button>
                                </div>
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