$(function () {
    $("#selectCurso").on("change", function() {
        
        const valorSelecionado = $(this).val();

        if(valorSelecionado == "valorPadrao")
        {
            $.ajax({

                type: "POST",
                url: "./requestCurso/returnCursoPadrao.php",
                data: {valorPadrao: valorSelecionado},
                success: function(data) {
                    $("#tabelaCurso").html(data);
                }
            });
        }
        else
        {
            $.ajax({

                type: "POST",
                url: "./requestCurso/returnCurso.php",
                data: {curso: valorSelecionado},
                success: function(data)
                {
                    $("#tabelaCurso").html(data);
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