//FILTRO PARA REALIZAR A RESERVA DE SALAS
$(function () {
    $("#cursoSelect").on("change", function () {
        var cursoSelecionado = $(this).val();

        // AJAX para obter as turmas com base no curso selecionado
        $.ajax({
            type: 'POST',
            url: 'obter_turmas.php',
            data: {curso: cursoSelecionado},
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