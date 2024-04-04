<?php

    require('../vendor/autoload.php');

    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    // instantiate and use the dompdf class
    $dompdf = new Dompdf(['enable_remote' => true]);

    ob_start(); //INICIA UM BUFFER DE SAIDA, CARREGA E GUARDA O CONTEUDO
    require('conteudo-pdf.php');
    $html = ob_get_clean(); // PEGA TODO O CONTEUDO RENDERIZADO, LIMPA O CONTEUDO APOS O USO

    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
?>