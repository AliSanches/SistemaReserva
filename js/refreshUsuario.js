$(function () {
    $("#selectUsuario").on("change", function() {
        
        const valorSelecionado = $(this).val();

        if(valorSelecionado == "valorPadrao")
        {
            $.ajax({

                type: "POST",
                url: "./requestUsuario/returnUsuarioPadrao.php",
                data: {valorPadrao: valorSelecionado},
                success: function(data) {
                    $("#tabelaUsuario").html(data);
                }
            });
        }
        else
        {
            $.ajax({

                type: "POST",
                url: "./requestUsuario/returnUsuario.php",
                data: {usuario: valorSelecionado},
                success: function(data)
                {
                    $("#tabelaUsuario").html(data);
                }
            });
        }
    });
});