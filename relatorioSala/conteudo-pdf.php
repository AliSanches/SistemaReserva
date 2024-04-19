<?php

require("../conexao/conecta.php");

$sqlPag = "SELECT sala.num_sala, sala.capacidade, sala.armario, sala.comport_notebook, tipo_sala.nome_sala, sala.id_sala FROM sala INNER JOIN tipo_sala ON sala.id_tipo_sala = tipo_sala.id_tipo_sala";
$resultadoPag = mysqli_query($conexao, $sqlPag);
$exibePag = mysqli_fetch_assoc($resultadoPag);

?>


<style>
    /* Estilo para a tabela */
    #tabelaDados {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
    }

    #tabelaDados th,
    #tabelaDados td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    #tabelaDados th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    #tabelaDados tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    #tabelaDados tbody tr:hover {
        background-color: #f2f2f2;
    }
</style>

<h4>RELATÓRIO INSTITUIÇÃO SENAC SÃO PAULO</h4>
<table id="tabelaDados" class="table w-100 table-responsive-sm conteudo mt-2 mb-2 text-center">
    <thead>
        <tr>
            <th scope="col">Tipo da Sala</th>
            <th scope="col">Sala</th>
            <th scope="col">Capacidade Alunos</th>
            <th scope="col">Case</th>
            <th scope="col">Comporta Notebook</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultadoPag as $exibir) : ?>
            <tr>
                <td><?= $exibir['nome_sala'] ?></td>
                <td><?= $exibir['num_sala'] ?></td>
                <td><?= $exibir['capacidade'] ?></td>
                <td><?= $exibir['armario'] ?></td>
                <td><?= $exibir['comport_notebook'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>