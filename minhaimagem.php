<?php 
// inclui o arquivo de configuração do sistema
include "adm/includes/conecta.php";

ob_start();
//INICIALIZA A SESSÃO 
session_start();

if ($_SESSION["logadoache"] == "SIM"){;

$nome = $_SESSION["nomelogado"];
$id = $_SESSION["idlogadoache"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $metadescription; ?>">
<meta name="keywords" content="<?php echo $metakeywords; ?>">
<?php include 'lib/configuracoes.php'; ?>
<link rel="stylesheet" href="css/form.css" />
<?php 
$msg = $_GET['msg'];
if ($msg == "municipioexistente"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Atenção. \n\n Este Município já foi cadastrado !! \n\n Tente Novamente.")
</SCRIPT>
<?php }; ?>

<?php 
if ($msg == "municipioincorreto"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Atenção. \n\n Este Município não consta na lista de Municípios do IBGE !! \n\n Tente Novamente.")
</SCRIPT>
<?php }; ?>
</head>


<body>
<?php include 'topo.php'; ?>

<section id="conteudo_interno">
<div class="center">
<h2>Minha Imagem</h2>
<p style="margin-top:10px;">Foto Atual</p>

<?php $correspondente = mysql_query("SELECT * FROM correspondentes WHERE Id = '$id'");
		while($dadoscorrespondente = mysql_fetch_object($correspondente)) {; 
		
		$fotocorrespondente = "foto/".$dadoscorrespondente->imagem;
		};
		
		if (file_exists($fotocorrespondente)) {;
		   $imagem = $fotocorrespondente;
		} else {
           $imagem = "foto/sem_foto.jpg";
		};
?>

<img src="<?php echo $imagem; ?>" style="max-width: 200px;"/><br>
<form action="up_minhaimagem.php" method="post" enctype="multipart/form-data" id="form_cadastro" class="form">

 <div class="box_form">  
    <p><label for="CADimagem">Foto / Logo</label><input type="file" value=""  name="foto" /><span class="obs">* O arquivo deve estar no padrão JPG, PNG ou GIF, com no máximo 500kb.</span></p>
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" size="30" />
	<div style="clear:both"></div>
	<input type="submit"  value="Atualizar Imagem" class="bt_form"/>
</div> 
</form>


    
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
