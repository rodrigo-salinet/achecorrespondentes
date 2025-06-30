<?php 
header("Content-type: text/html; charset=iso-8859-1\r\n",true);
/*
Inclui arquivo PHP de conexão ao banco de dados
*/
include_once('lib/conecta.php');

/*
Inclui arquivo PHP de funções PHP
*/
include_once('lib/funcoes.php');

/*
Inclui arquivo PHP de consultas MySQL
*/
include_once('lib/consultas_mysql.php');

$header = <<<END
	<link rel="stylesheet" type="text/css" href="lib/multizoom/multizoom.css">
	<script type="text/javascript" src="lib/multizoom/multizoom.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#product-image').addimagezoom({ magnifiersize: [370,370] });
		});
	</script>
END;

$noticia = anti_injection($_GET['noticia']); 

$protocolo = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === false) ? 'http' : 'https';
$host = $_SERVER['HTTP_HOST'];
$script = $_SERVER['SCRIPT_NAME'];
$parametros = $_SERVER['QUERY_STRING'];
$UrlAtual = $protocolo . '://' . $host . $script . '?' . $parametros;

$script = $_SERVER['SCRIPT_NAME'];

if ($noticia <> "0"){
	$consultameta = mysqli_query($conn,"SELECT * FROM `$banco_de_dados`.`noticias` WHERE `id` = '$noticia';");
		while($dadosmeta = mysqli_fetch_object($consultameta)) { ; 
			$title = $dadosmeta->titulo;
			$metadescription = substr($dadosmeta->noticia,0,160);
			$metakeywords = $dadosmeta->tags;
		}
} else {		
	$seo = mysqli_query($conn,"SELECT * FROM `$banco_de_dados`.`metatags` WHERE `pagina` = '$script';");
	while($dadoseo = mysqli_fetch_object($seo)) { ; 
		$title = $dadoseo->title;
		$metadescription = $dadoseo->metadescription;
		$metakeywords = $dadoseo->metakeywords;
	}
}

/*
Inclui arquivo PHP de tags iniciais HTML
*/
include_once('lib/html_msg.php');

/*
Inclui arquivo PHP de configurações de cabeçalho <head>
*/
include_once('lib/configuracoes.php');
?>

</head>
<body>

<?php
/*
Inclui arquivo PHP do topo da página
*/
include_once('lib/topo.php');
?>

<section id="conteudo_interno">
<div class="center">
<h2>Blog AcheJus</h2>
<?php if ($noticia <> ""){ 
	/******* *******
	 ******* *******
	 ******* BLOCO DA NOTICIA COMPLETA *******
	 ******* *******
	 ******* ******* */
	
 
	$consulta = mysqli_query($conn,"SELECT * FROM `$banco_de_dados`.`noticias` WHERE `id` = '$noticia';");
	$quantreg = mysqli_num_rows($consulta);
	if ($quantreg == "0"){ 
	 header("Location:blog.php"); 
	}
	while($noticias = mysqli_fetch_object($consulta)) { ; 
	$fotonoticia = "imagens/noticias/".$noticias->imagem; 
	//$fotonoticia = $noticias->imagem;
	
	
	?>
	
	

		<h3><?php echo $noticias->titulo; ?>
		<h5><?php echo substr($noticias->data_cadastro,8,2)."/".substr($noticias->data_cadastro,5,2)."/".substr($noticias->data_cadastro,0,4); ?></h5>
		</h3><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $UrlAtual; ?>&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21&amp;appId=145490288949678" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe><br>
			<?php if (file_exists($fotonoticia)) { ?>
				<img src="<?php echo $fotonoticia; ?>" align="left" style="width:250px, margin:5px; padding:10px;" />
			<?php } ?>
		<p><?php echo nl2br($noticias->noticia); //echo $noticias->noticia; ?></p><br>
		<div id="fb-root"></div>
						<script>(function(d, s, id) {
						 var js, fjs = d.getElementsByTagName(s)[0];
						 if (d.getElementById(id)) return;
						 js = d.createElement(s); js.id = id;
						 js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=145490288949678&version=v2.0";
						 fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-comments" data-href="<?php echo $UrlAtual; ?>" data-width="100%" data-numposts="10" data-colorscheme="light"></div> 
	<?php }
	
	} else { 
	/******* *******
	 ******* *******
	 ******* BLOCO DA NOTICIA RESUMIDA *******
	 ******* *******
	 ******* ******* */
 
	
	
	$consulta = mysqli_query($conn,"SELECT * FROM `$banco_de_dados`.`noticias` ORDER BY `data_cadastro` DESC;");
	while($noticias = mysqli_fetch_object($consulta)) { ; 
	//$fotonoticia = "imagens/noticias/".$noticias->imagem; 
	//$fotonoticia = $noticias->imagem; 
	?>
		<h3><?php echo $noticias->titulo; ?></h3>
		<h5><?php echo substr($noticias->data_cadastro,8,2)."/".substr($noticias->data_cadastro,5,2)."/".substr($noticias->data_cadastro,0,4); ?></h5>
		<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $UrlAtual; ?>&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21&amp;appId=145490288949678" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe><br>
			<?php if (file_exists($fotonoticia)) { ?>
				<img src="<?php echo $fotonoticia; ?>" align="left" style="width:120px"/>
			<?php } ?>
		<p><?php echo substr($noticias->noticia,0,250)."..." ; ?> </p>
		<a href="blog.php?noticia=<?php echo $noticias->id; ?>"><span>Leia Mais ... </span></a><br><br><br>
	<?php } ?>
<?php } ?>	
</div> 
</section>

<?php
/*
Inclui arquivo PHP do rodapé da página
*/
include_once('lib/rodape.php');
?>

</body>
</html>

<?php
/*
Inclui arquivo PHP de desconexão
*/
include_once('lib/desconecta.php');
?>
