<?php
    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'projeto';

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
    mysqli_set_charset($conexao, "utf8");

    if(mysqli_connect_error()){
        die('Falha na conexão: ' . mysqli_connect_error());
    }
?>