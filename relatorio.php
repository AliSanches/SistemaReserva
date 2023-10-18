<?php 

  require_once('../conexao/conecta.php');

  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');
  $data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

  $tipo = $_GET['tipo'];
  $destaque = $_GET['destaque'];

  $nome_tipo = '';

  if($tipo != ''){
    $sqltipo = "SELECT label FROM tipo WHERE value = '$tipo'";
    $resultadotipo = mysqli_query($conexao, $sqltipo);
    $linhatipo = mysqli_fetch_assoc($resultadotipo);

    $nome_tipo = 'Tipo: ' . $linhatipo['label'];
  }

  $nome_destaque = '';

  if($destaque != ''){

    $nome_destaque = 'Destaque: ' . $destaque;
  }

  $texto_filtro = '';

  if($nome_tipo != '' || $nome_destaque != ''){
    $texto_filtro = 'Noticias ' . $nome_tipo . ' ' . $nome_destaque;
  }
?>

<!DOCTYPE html>
<html>
<head>

<style>

	@import url('https://fonts.cdnfonts.com/css/tw-cen-mt-condensed');
	@page { margin: 145px 20px 25px 20px; }
	#header { position: fixed; left: 0px; top: -110px; bottom: 100px; right: 0px; height: 35px; text-align: center; padding-bottom: 100px; }
	#content {margin-top: 0px;}
	#footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 80px; }
	#footer .page:after {content: counter(page, my-sec-counter);}
	body {font-family: 'Tw Cen MT', sans-serif;}

	.marca{
		position:fixed;
		left:50;
		top:100;
		width:80%;
		opacity:8%;
	}

</style>

</head>
<body>
  <!-- MARCA D'ÁGUA -->
  <img class="marca" src="<?php echo $url_sistema ?>/admin/img/senac.jpg">	

  <!-- CABEÇALHO DA PÁGINA -->
  <div id="header">
    <div style="border-style: solid; font-size: 10px; height: 50px;">
      <table style="width: 100%; border: 0px solid #ccc;">
        <tr>
          <td style="width: 45%; text-align: left;">
            <img style="margin-top: 7px; margin-left: 7px;" id="imag" src="<?php echo $url_sistema ?>/admin/img/senac.jpg" width="45px">
          </td>

          <td style="width: 40%; text-align: right; font-size: 9px;padding-right: 10px;">
              <b><big>RELATÓRIO DE NOTICIAS</big></b>
              <br>
              <?php echo mb_strtoupper($texto_filtro) ?>
              <br>
              <?php echo mb_strtoupper($data_hoje) ?>
          </td>
        </tr>		
      </table>
    </div>

    <br>

    <!-- CABEÇALHO DA TABELA -->
    <table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 8px; margin-bottom:10px; width: 100%; table-layout: fixed;">
      <thead>
        <tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
          <td style="width:8%">CÓDIGO</td>
          <td style="width:10%">DATA</td>
          <td style="width:16%">TIPO</td>
          <td style="width:48%">TÍTULO</td>
          <td style="width:10%">DESTAQUE</td>
          <td style="width:8%">STATUS</td>
        </tr>
      </thead>
    </table>
  </div>

	<!-- CONTEÚDO -->
  <div id="content" style="margin-top: 0;">
		<table style="width: 100%; table-layout: fixed; font-size:7px; text-transform: uppercase;">
			<thead>
				<tbody>
                    <?php 
                        $destaque_sim = 0;
                        $destaque_nao = 0;

                        $sql = "SELECT id_noticia, data, tipo, titulo, imagem, destaque FROM noticia WHERE tipo LIKE '%$tipo%' AND destaque LIKE '%$destaque%' ORDER BY id_noticia DESC";
                        $resultado = mysqli_query($conexao, $sql);
                        $quantidade = mysqli_num_rows($resultado);
                    
                        if($quantidade > 0) {
                            while($linha = mysqli_fetch_assoc($resultado)){
                                if($linha['destaque'] === 'sim'){
                                    $classe_destaque = 'verde.jpg';
                                    $destaque_sim += 1;
                                }
                                else{
                                    $classe_destaque = 'vermelho.jpg';
                                    $destaque_nao += 1;
                                }
                    ?>
					<tr>
						<td style="width:8%"><?php echo $linha['id_noticia'] ?></td>
						<td style="width:10%"><?php $data = date_create($linha['data']); echo date_format($data, 'd/m/Y'); ?></td>
						<td style="width:16%"><?php echo $linha['tipo'] ?></td>
						<td style="width:48%"><?php echo $linha['titulo'] ?></td>
						<td style="width:10%"><?php echo $linha['destaque'] ?></td>
						<td style="width:8%"><img src="<?php echo $url_sistema ?>admin/img/<?php echo $classe_destaque ?>" width="12px"></td>
					</tr>
                    <?php 
                            }
                        }
                    ?>
				</tbody>
			</thead>
		</table>
	</div>

	<hr>

	<table>
		<thead>
			<tbody>
				<tr>
					<td style="font-size: 10px; width:460px; text-align: left;">Total de registros: <?php echo $quantidade ?> </td>		
					<td style="font-size: 10px; width:130px; padding-right: 5px; text-align: right; color:green"><b>DESTAQUE: <?php echo $destaque_sim ?> </td>
					<td style="font-size: 10px; width:130px; padding-right: 5px; text-align: right; color:red"><b>COMUM: <?php echo $destaque_nao ?> </td>
				</tr>
			</tbody>
		</thead>
	</table>

  <!-- RODAPÉ DA PÁGINA -->
  <div id="footer">
    <hr style="margin-bottom: 0;">
    <table style="width:100%;">
      <tr style="width:100%;">
        <td style="width:60%; font-size: 10px; text-align: left;">Piracicaba, <?php echo $dataF = utf8_encode(strftime('%d de %B de %Y', strtotime('today'))) ?></td>
        <td style="width:40%; font-size: 10px; text-align: right;"><p class="page">Página  </p></td>
      </tr>
    </table>
  </div>

</body>
</html>