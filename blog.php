<?php 
$header = <<<END
	<link rel="stylesheet" type="text/css" href="libs/multizoom/multizoom.css">
	<script type="text/javascript" src="libs/multizoom/multizoom.js"></script>
	<script type="text/javascript">
		jQuery(document).ready( function($) {
			$('#product-image').addimagezoom({ magnifiersize: [370,370] });
		});
	</script>
END;

include 'lib/configuracoes.php'; 
include("adm/includes/conecta.php");
$noticia = anti_injection($_GET['noticia']); 

$protocolo    = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === false) ? 'http' : 'https';
$host         = $_SERVER['HTTP_HOST'];
$script       = $_SERVER['SCRIPT_NAME'];
$parametros   = $_SERVER['QUERY_STRING'];
$UrlAtual     = $protocolo . '://' . $host . $script . '?' . $parametros;

$script       = $_SERVER['SCRIPT_NAME'];
	
if ($noticia <> "0"){
	$consultameta = mysql_query("SELECT * FROM `noticias` WHERE `Id` = '$noticia'");
		while($dadosmeta = mysql_fetch_object($consultameta)) { ; 
			$title = $dadosmeta->titulo;
			$metadescription = substr($dadosmeta->noticia,0,160);
			$metakeywords = $dadosmeta->tags;
		};
} else {;		
	$seo = mysql_query("SELECT * FROM `metatags` WHERE `pagina` = '$script'");
	while($dadoseo = mysql_fetch_object($seo)) { ; 
		$title = $dadoseo->title;
		$metadescription = $dadoseo->metadescription;
		$metakeywords = $dadoseo->metakeywords;
	};
};	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta content="343071139183070" property="fb:admins">
<head>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $metadescription; ?>">
<meta name="keywords" content="<?php echo $metakeywords; ?>">
<?php //echo $noticia; ?>
</head>


<body>
<?php include 'topo.php'; ?>

<section id="conteudo_interno">
<div class="center">
<h2>Blog AcheJus</h2>
<?php if ($noticia <> ""){ 
	/*******                            *******
	 *******                            *******
	 *******  BLOCO DA NOTICIA COMPLETA *******
	 *******                            *******
	 *******                            ******* */
	
 
	$consulta = mysql_query("SELECT * FROM `noticias` WHERE `Id` = '$noticia'");
	$quantreg = mysql_num_rows($consulta);
	if ($quantreg == "0"){ 
	  header("Location:blog.php"); 
	}
	while($noticias = mysql_fetch_object($consulta)) { ; 
	$fotonoticia = "imagens/noticias/".$noticias->imagem; 
	//$fotonoticia = $noticias->imagem;
	
	
	?>
	
	

		<h3><?php echo $noticias->titulo; ?>
		<h5><?php echo substr($noticias->data_cadastro,8,2)."/".substr($noticias->data_cadastro,5,2)."/".substr($noticias->data_cadastro,0,4); ?></h5>
		</h3><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $UrlAtual; ?>&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21&amp;appId=145490288949678" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe><br>
			<?php if (file_exists($fotonoticia)) {; ?>
				<img src="<?php echo $fotonoticia; ?>" align="left" style="width:250px, margin:5px; padding:10px;" />
			<?php }; ?>
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
	<?php };
	
	} else { 
	/*******                            *******
	 *******                            *******
	 *******  BLOCO DA NOTICIA RESUMIDA *******
	 *******                            *******
	 *******                            ******* */
 
	
	
	$consulta = mysql_query("SELECT * FROM `noticias` ORDER BY `data_cadastro` DESC");
	while($noticias = mysql_fetch_object($consulta)) { ; 
	//$fotonoticia = "imagens/noticias/".$noticias->imagem; 
	//$fotonoticia = $noticias->imagem; 
	?>
		<h3><?php echo $noticias->titulo; ?></h3>
		<h5><?php echo substr($noticias->data_cadastro,8,2)."/".substr($noticias->data_cadastro,5,2)."/".substr($noticias->data_cadastro,0,4); ?></h5>
		<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $UrlAtual; ?>&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21&amp;appId=145490288949678" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe><br>
			<?php if (file_exists($fotonoticia)) {; ?>
				<img src="<?php echo $fotonoticia; ?>" align="left" style="width:120px"/>
			<?php }; ?>
		<p><?php echo substr($noticias->noticia,0,250)."..." ; ?> </p>
		<a href="blog.php?noticia=<?php echo $noticias->Id; ?>"><span>Leia Mais ... </span></a><br><br><br>
	<?php }; ?>
<?php }; ?>	
</div>   
</section>

<?php include 'rodape.php'; ?>

</body>
</html>
