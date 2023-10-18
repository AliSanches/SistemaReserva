<?php

date_default_timezone_set('America/Sao_Paulo');
require_once('./conexao/conecta.php');

$status = 1;

$sqlTurma = "SELECT id_turma, nome_turma FROM turma WHERE status = $status";
$resultadoTurma = mysqli_query($conexao, $sqlTurma);
$linhaturma = mysqli_fetch_assoc($resultadoTurma);

$sqlSala = "SELECT id_sala, num_sala FROM sala WHERE status = $status";
$resultadoSala = mysqli_query($conexao, $sqlSala);
$linhasala = mysqli_fetch_assoc($resultadoSala);


$sqlCurso = "SELECT id_curso, nome_curso FROM curso WHERE status = $status";
$resultadoCurso = mysqli_query($conexao, $sqlCurso);
$linhacurso = mysqli_fetch_assoc($resultadoCurso);

$sqlreserva = "SELECT * FROM reserva";
$resultadoreserva = mysqli_query($conexao, $sqlreserva);

$sqlusuario = "SELECT id_usuario FROM usuario WHERE status = $status";
$resultadousuario = mysqli_query($conexao, $sqlusuario);

// $salaR = $_POST['id_sala'];
// $dataInicio = $_POST['data_inicio'];
// $dataTermino = $_POST['data_termino'];
$horarioInicio = $_POST['hora_inicio'];
$horarioTermino = $_POST['hora_termino'];

$sqlVerificarReserva = "SELECT COUNT(*) AS total FROM reserva WHERE 
                    ((hora_inicio >= '$horarioInicio' AND hora_inicio <= '$horarioTermino') OR
                    (hora_termino >= '$horarioInicio' AND hora_termino <= '$horarioTermino'))
                    AND status = 1";

$resultadoVerificar = mysqli_query($conexao, $sqlVerificarReserva);

if ($resultadoVerificar) {
$linha = mysqli_fetch_assoc($resultadoVerificar);
$totalReservas = mysqli_num_rows($resultadoVerificar);

// if ($totalReservas > 0) {
//     echo "Já existe uma reserva para esse horário.";
// } else {
   // Continuar com o processo de reservareserva
   if(isset($_POST['cadastrar']) && $_POST['cadastrar'] === 'cadastrar_reserva') {
    // Capturar os valores do formulário aqui
    $id_turma = $_POST['id_turma'];
    // $id_curso = $_POST['id_curso'];
    $id_sala = $_POST['id_sala'];
    $id_usuario = $_POST['id_usuario'];

    $dataInicio = $_POST['data_inicio'];
    $dataTermino = $_POST['data_termino'];
    $horarioInicio = $_POST['hora_inicio'];
    $horarioTermino = $_POST['hora_termino'];

    $dataCadastro = date('Y-m-d');

    $segunda = $_POST['segunda'];
    $terca = $_POST['terca'];
    $quarta = $_POST['quarta'];
    $quinta = $_POST['quinta'];
    $sexta = $_POST['sexta'];
    $sabado = $_POST['sabado'];

    $status = 1;
    $id_reserva = $_POST['id_reserva'];

    // Primeiro, construa o SQL de inserção
    $sqlInsercao = "INSERT INTO reserva (data_cadastro, data_inicio, data_termino, hora_inicio, hora_termino, status, id_turma, id_sala) VALUES ('$dataCadastro', '$dataInicio', '$dataTermino', '$horarioInicio', '$horarioTermino', '$status', '$id_turma', '$id_sala')";

    // Executar a inserção
    $resultadoInsercao = mysqli_query($conexao, $sqlInsercao);

        if ($resultadoInsercao) {
            echo "Reserva realizada com sucesso.";
        } else {
            echo "Erro ao realizar reserva.";
        }
    }
//     }
// // } else {
// echo "Erro ao verificar reserva.";
}

?>



<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inserir reserva</title>
    
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
            <h1 class="text-center mt-3 mb-5 tituloCadastro">Inserir reserva</h1>

            <form class="col-lg-8" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-4">
                            <label for="curso_insere">Turma</label>
                            <select id="curso_insere" class="form-select">
                                <option selected>Escolher...</option>
                                <option>...</option>
                            </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="nomeTurma_insere">Sala</label>
                        <select id="curso_insere" class="form-select">
                            <option selected>Escolher...</option>
                            <option>...</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="codOferta_insere">Curso</label>
                        <select id="curso_insere" class="form-select">
                            <option selected>Escolher...</option>
                            <option>...</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-check col-md-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Segunda-Feira
                        </label>
                        <input type="checkbox">
                    </div>

                    <div class="form-check col-md-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Terça-Feira
                        </label>
                        <input type="checkbox">
                    </div>

                    <div class="form-check col-md-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Quarta-Feira
                        </label>
                        <input type="checkbox">
                    </div>
                    <div class="form-check col-md-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Quinta-Feira
                        </label>
                        <input type="checkbox">
                    </div>

                    <div class="form-check col-md-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Sexta-Feira
                        </label>
                        <input type="checkbox">
                    </div>

                    <div class="form-check col-md-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Sábado
                        </label>
                        <input type="checkbox">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-6">
                        <label for="dataInicio_insere" class="d-flex">Data Início</label>
                        <input type="date" class="form-control" id="data_inicio">
                    </div>

                    <div class="col-6">
                        <label for="hora_inicio" class="d-flex mt-0">Hora Início</label>
                        <input type="time" class="mt-0 centro form-control" id="horaInicio_insere">
                    </div>

                    <div class="col-6 mt-3">
                        <label for="data_termino" class="d-flex">Data Término</label>
                        <input type="date" class="form-control" id="dataTermino_insere">
                    </div>

                    <div class="col-6">
                        <label for="hora_termino" class="d-flex mt-3">Hora Término</label>
                        <input type="time" class="mt-2 centro form-control" id="horaTermino_insere">
                    </div>
                </div>
               
                <div class="d-flex justify-content-center mt-5 mb-3">
                     <!-- Botão para acionar modal -->
                     <button type="button" class="btn botaoLaranja btn-lg mr-5" data-toggle="modal" data-target="#Modalturma">
                        Reservar
                    </button>

                    <!-- Botão para voltar a home -->
                    <a href="reserva.php" class="btn botaoCinza btn-lg">Voltar</a>

                    <!-- Modal -->
                    <div class="modal fade" id="Modalturma" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="TituloModalCentralizado"> 
                                        <i class="fa-regular fa-circle-check"></i>
                                        Reservar
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body my-5 text-center">
                                    Reserva concluida com sucesso
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