$(function () {
    $("#selectCurso").on("change", function() {
        
        const valorSelecionado = $(this).val();

        if(valorSelecionado == "valorPadrao")
        {
            $.ajax({

                type: "POST",
                url: "./requestTurma/returnCursoPadrao.php",
                data: {valorPadrao: valorSelecionado},
                success: function(data) {
                    $("#tabelaTurma").html(data);
                }
            });
        }
        else
        {
            $.ajax({

                type: "POST",
                url: "./requestTurma/returnCurso.php",
                data: {curso: valorSelecionado},
                success: function(data)
                {
                    $("#tabelaTurma").html(data);
                }
            });
        }
    });
});

$(function () {
    $("#selectTurma").on("change", function() {

        const valorSelecionado = $(this).val();

        if(valorSelecionado == "valorPadraoTurma")
        {
            $.ajax({

                type: "POST",
                url: "./requestTurma/returnTurmaPadrao.php",
                data: {turma: valorSelecionado},
                success: function(data)
                {
                    $("#tabelaTurma").html(data);
                }
            });
        }
        else
        {
            $.ajax({

                type: "POST",
                url: "./requestTurma/returnTurma.php",
                data: {turma: valorSelecionado},
                success: function(data)
                {
                    $("#tabelaTurma").html(data);
                }
            });
        }
    });
});