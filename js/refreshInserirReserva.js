$(function () {
    $("#cursoSelect").on("change", function() {
        
        const valorSelecionado = $(this).val();

        $.ajax({
            type: 'POST',
            url: './requestReserva/returnCurso.php',
            data: {curso: valorSelecionado},
            success: function (data) {
                console.log(data); //Exibe o retorno no console
                // Atualiza as opções do select de turma
                $('#turmaSelect').html(data);

                // Limpa as opções do select de sala
                // $('#salaSelect').html('<option value="">Selecione a Sala</option>');
            }
        }); 
    });
});