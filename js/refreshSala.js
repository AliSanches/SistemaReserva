$(function () {
    $("#selectSala").on("change", function() {
        
        const valorSelecionado = $(this).val();

        if(valorSelecionado == "valorPadrao")
        {
            $.ajax({
                type: "POST",
                url: "./requestSala/returnSalaPadrao.php",
                data: {sala: valorSelecionado},
                success: function(data) {
                    $("#tabelaSala").html(data);
                }
            });
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "./requestSala/returnSala.php",
                data: {sala: valorSelecionado},
                success: function(data)
                {
                    $("#tabelaSala").html(data);
                }
            });
        }
    });
});