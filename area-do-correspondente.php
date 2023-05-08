<?php 
include 'lib/configuracoes.php'; 
include("adm/includes/conecta.php"); 
//phpinfo();

/*error_reporting( E_ALL ); 
ini_set( 'display_errors', 1);*/

//ob_start();
//INICIALIZA A SESSÃO 
session_start();



//$_SESSION[logadoache] = "SIM";

if ($_SESSION["logadoache"] == "SIM"){;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $metadescription; ?>">
<meta name="keywords" content="<?php echo $metakeywords; ?>">
</head>


<body>
<?php include 'topo.php'; ?>

<section id="conteudo_interno">
<div class="center">
<h2>Área do Correspondente</h2>

<p><a href="meusdados.php">> MEUS DADOS</a></p>
<!--<p><a href="meuspedidos.php">> MEUS PEDIDOS</a></p>-->
<p><a href="minhaimagem.php">> MINHA IMAGEM</a></p>
<p><a href="minhasenha.php">> MINHA SENHA</a></p>
<p><a href="excluicookies.php">> FAZER LOGOFF</a></p>
</div>   
</section>

<?php include 'rodape.php'; ?>

</body>
</html>
<?php
$ip=$_SERVER['REMOTE_ADDR'];
} else {
	header("Location:index.php?msg=errologin"); 
}
?>
