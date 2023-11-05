<?php 

    require_once('./conexao/conecta.php');


    // SQL PARA MOSTRAR O NOME DO CURSO NO BOTAO SELECT
    $sqlcurso = "SELECT id_curso, nome_curso FROM curso";
    $resultadocurso = mysqli_query($conexao, $sqlcurso);
    $linhacurso = mysqli_fetch_assoc($resultadocurso);

    // RECEBENDO INFORMACOES DA TURMA
    if(isset($_GET['id_turma']) && $_GET['id_turma'] != '') {

        $id = $_GET['id_turma'];
    
        $sql = "SELECT * FROM turma WHERE id_turma = $id";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_assoc($resultado);
    
    }

    //REALIZANDO A EXCLUSÃO
    if(isset($_POST['remove']) && $_POST['remove'] === 'sim') {
       
        $id = $_POST['id_turma'];

        $sql = "DELETE FROM turma WHERE id_turma = $id";

        if(mysqli_query($conexao, $sql)) {
        header('Location:turma.php');
        }
    }
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exclusão de turma</title>
    
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
            <h1 class="text-center mt-3 mb-5 tituloCadastro">Exclusão de Turma</h1>

            <form class="col-lg-8" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-4">
                            <label for="curso_insere">Curso</label>
                            <select id="curso_insere" class="form-select" disabled>
                                <option selected>Escolher...</option>
                                <?php do { ?>

                                <option value="<?php echo $linhacurso['id_curso'] ?>" <?php if($linhacurso['id_curso'] == $linha['id_curso']) echo "selected" ?> ><?php echo $linhacurso['nome_curso'] ?></option>

                                <?php } while($linhacurso = mysqli_fetch_assoc($resultadocurso))  ?>
                            </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="nomeTurma_insere">Nome da Turma</label>
                        <input type="text" class="form-control" id="nome_turma" name="nome_turma" value="<?php echo $linha['nome_turma'] ?>" readonly>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="codOferta_insere">Código Oferta</label>
                        <input type="text" class="form-control" id="codigo_Oferta" name="codigo_Oferta" value="<?php echo $linha['codigo_Oferta'] ?>" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-check col-md-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Segunda-Feira
                        </label>
                        <input type="checkbox" id="segunda-feira" name="segunda" value="1" <?php if($linha['segunda'] === '1') echo "checked"?> disabled>
                    </div>

                    <div class="form-check col-md-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Terça-Feira
                        </label>
                        <input type="checkbox" id="segunda-feira" name="terca" value="1" <?php if($linha['terca'] === '1') echo "checked"?> disabled>
                    </div>

                    <div class="form-check col-md-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Quarta-Feira
                        </label>
                        <input type="checkbox" id="segunda-feira" name="quarta" value="1" <?php if($linha['quarta'] === '1') echo "checked"?> disabled>
                    </div>
                    <div class="form-check col-md-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Quinta-Feira
                        </label>
                        <input type="checkbox" id="segunda-feira" name="quinta" value="1" <?php if($linha['quinta'] === '1') echo "checked"?> disabled>
                    </div>

                    <div class="form-check col-md-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Sexta-Feira
                        </label>
                        <input type="checkbox" id="segunda-feira" name="sexta" value="1" <?php if($linha['sexta'] === '1') echo "checked"?> disabled>
                    </div>

                    <div class="form-check col-md-2">
                        <label class=" small " for="disabledFieldsetCheck">
                            Sábado
                        </label>
                        <input type="checkbox" id="segunda-feira" name="sabado" value="1" <?php if($linha['sabado'] === '1') echo "checked"?> disabled>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-6">
                        <label for="dataInicio_insere" class="d-flex">Data Início</label>
                        <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo $linha['data_inicio'] ?>" readonly>
                    </div>

                    <div class="col-6">
                        <label for="hora_inicio" class="d-flex mt-0">Hora Início</label>
                        <input type="time" class="mt-0 centro form-control" id="horario_inicio" name="horario_inicio" value="<?php echo $linha['horario_inicio'] ?>" readonly>
                    </div>

                    <div class="col-6 mt-3">
                        <label for="data_termino" class="d-flex">Data Término</label>
                        <input type="date" class="form-control" id="data_termino" name="data_termino" value="<?php echo $linha['data_termino'] ?>" readonly>
                    </div>

                    <div class="col-6">
                        <label for="hora_termino" class="d-flex mt-3">Hora Término</label>
                        <input type="time" class="mt-2 centro form-control" id="horario_termino" name="horario_termino" value="<?php echo $linha['horario_termino'] ?>" readonly>
                    </div>
                </div>
               
                <div class="d-flex justify-content-center mt-5 mb-3">
                     <!-- Botão para acionar modal -->
                    <input type="hidden" name="id_turma" value="<?php echo $linha['id_turma'] ?>">
                    <button class="btn botaoLaranja btn-lg mr-5" type="submit" value="sim" name="remove">Excluir</button>

                    <!-- Botão para voltar a home -->
                    <a href="turma.php" class="btn botaoCinza btn-lg">Voltar</a>
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