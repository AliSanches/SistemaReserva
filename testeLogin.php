<?php

    session_start();

    // REQUEST É UMA VARIAVEL PASSADA QUE RECEBE OS VALORES PASSADOS POR POST, GET
    // print_r($_REQUEST);

    if(isset($_POST['Enviar']) && !empty($_POST['usuario']) && !empty($_POST['senha']) )
    {
        // Acessa
        include_once('./conexao/conecta.php');

        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        // print_r('Usuario: ' . $usuario);
        // print_r('<br>');
        // print_r('Senha: '. $senha);

        $sql = "SELECT usuario, senha, tipo FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";
        $result = $conexao->query($sql);

        // print_r($result);


        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['usuario']);
            unset($_SESSION['senha']);
            header("Location: login.php");
        }
        else
        {
            $coluna = $result->fetch_assoc();
            
            if($coluna['tipo'] == 'com')
            {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['senha'] = $senha;
                $_SESSION['tipo'] = 'com';
                header('Location: index.php');
            }
            elseif($coluna['tipo'] == 'adm')
            {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['senha'] = $senha;
                $_SESSION['tipo'] = 'adm';
                header('Location: index.php');
            }
            else
            {
                unset($_SESSION['usuario']);
                unset($_SESSION['senha']);
                header('Location: login.php');
            }
        }

    }
    else
    {
        // Não Acessa
        header('Location:login.php');
    }
    
?>