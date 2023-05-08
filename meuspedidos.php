<?php 
include 'lib/configuracoes.php'; 
include("adm/includes/conecta.php"); 

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
<link rel="stylesheet" href="css/form.css" />
</head>


<body>
<?php include 'topo.php'; ?>

<section id="conteudo_interno">
<div class="center">
<h2>Meus Pedidos</h2>
<div>
<form method="post" action="meuspedidos_add_new.php" class="bt_form">
	<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
	<input type="hidden" name="nome" id="nome" value="<?php echo $nome; ?>" />
	<input type="hidden" name="sessao" id="sessao" value="<?php echo $sessao; ?>" />
	<input type="submit"  value="NOVO PEDIDO" class="bt_form"/>			
</form> 
</div>		
	  <div>
		<table>
			  <tr>
			    <td width="250px">
				  <strong>PEDIDO</strong><br />
				</td>
				<td width="150px">
				  <strong>VALOR</strong> <br />
				</td>
				<td width="150px">
				  <strong>SITUAÇÃO</strong> <br />
				</td>
			  </tr>
		</table> 
		<table>
			<?php $querypedidos = mysql_query("SELECT * FROM pedidos WHERE id_correspondente = '$id' ORDER BY Id DESC"); 
		    while($pedidos = mysql_fetch_object($querypedidos)) {; 
			
			$valor = str_replace(",", ".", $pedidos->valor);
			
			if ($pedidos->plano == ""){
			  $plano = "Pedido Não Finalizado";
			  $valor = "0,00";
			} else {
			  $plano = $pedidos->plano;
			  $valor = $pedidos->valor;
			}; 
			$sessao = $pedidos->sessao;
			
			?>
			
			  <tr>
			    <td width="250px"><?php echo $plano; ?></td>
				<td width="150px"><?php echo $valor; ?></td>
				<td width="150px"><?php if ($pedidos->situacao == "Aprovada") {;
										echo $pedidos->situacao;
								  } else {; ?>
										<form method="post" action="meuspedidos_add.php">
										<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
										<input type="hidden" name="nome" id="nome" value="<?php echo $nome; ?>" />
										<input type="hidden" name="sessao" id="sessao" value="<?php echo $sessao; ?>" />
										<input name="submit" type="submit" id="submit" value="VERIFICAR PEDIDO" class="" /> 
          
										</form> 								  
								  <?php }; ?></td>
			  </tr>
			<?php }; ?>
		</table> 
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
