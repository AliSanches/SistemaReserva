$(function () {
    $("#selectCurso").on("change", function() {
        var cursoSelecionado = $(this).val();

        $.ajax({
            url: 'update_curso.php',
            data: {curso: cursoSelecionado},
            success: function(date) {
                $("#selectTipoCurso").html(date);
            }
        });
    });
})