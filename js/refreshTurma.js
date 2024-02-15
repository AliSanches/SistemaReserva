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
    $("#selectTipoCurso").on("change", function() {

        const valorSelecionado = $(this).val();

        if(valorSelecionado == "valorPadraoTipo")
        {
            $.ajax({

                type: "POST",
                url: "./requestCurso/returnTipoPadrao.php",
                data: {tipoCurso: valorSelecionado},
                success: function(data)
                {
                    $("#tabelaCurso").html(data);
                }
            });
        }

        $.ajax({

            type: "POST",
            url: "./requestCurso/returnTipo.php",
            data: {tipoCurso: valorSelecionado},
            success: function(data)
            {
                $("#tabelaCurso").html(data);
            }
        });

    });
});