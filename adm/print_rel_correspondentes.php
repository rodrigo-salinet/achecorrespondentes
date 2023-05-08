<?php 
ob_start();
//INICIALIZA A SESSÃO 
session_start();

if ($_SESSION["logadoadmchefia"] == "SIM"){;
include("includes/conecta.php");


$colaborador = $_POST['func'];


$dadoscolaborador = mysql_query("SELECT * FROM `rh_tb_funcionario` WHERE `cod_func` = '$colaborador'");
while($nomecolaborador = mysql_fetch_object($dadoscolaborador)) {
$funcionario = $nomecolaborador->nome_func;
};


			  
$dataini = $_POST['dataini'];
$datainicial = substr($dataini,6,4)."-".substr($dataini,3,2)."-".substr($dataini,0,2);


$datafim = $_POST['datafim'];
$datafinal = substr($datafim,6,4)."-".substr($datafim,3,2)."-".substr($datafim,0,2);


if ($dataini == ""){;
	  $consulta = mysql_query("SELECT * FROM `correspondentes` ORDER BY nome ASC");
} else {;
	$consulta = mysql_query("SELECT * FROM `correspondentes` WHERE `dtcadastro` BETWEEN '$datainicial' AND '$datafinal' ORDER BY `nome` ASC");  			  
}

$num_reg = mysql_num_rows($consulta);

//echo $tipodoc;

?>
<html>
<head>
<link rel="shortcut icon" href="/favicon.ico">
<title><?php echo $tituloadm; ?></title>
<link href="css/ccd.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>

<script type="text/javascript">
   var GB_ROOT_DIR = "./sigif/";
</script>
<script type="text/javascript" src="js/ajs.js"></script>
<script type="text/javascript" src="js/ajs_fx.js"></script>
<script type="text/javascript" src="js/gb_scripts.js"></script>
<link href="js/gb_styles.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.validate.pack.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.min.js"></script>
<script type="text/javascript" src="js/jquery.maskMoney.0.2.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body leftmargin="0" rightmargin="0" bottommargin="0">
<table width="1100" border="0" cellpadding="0" cellspacing="0" align="center">
  <!--DWLayoutTable-->
  <tr>
    <td width="1100" height="25" valign="top"><p><b>RELAT&Oacute;RIO POR TIPO DE DOCUMENTO</b> - <?php echo " Período de  ".$dataini." até ".$datafim; ?></p>
	<!--<p>Funcionário - <?php //echo $funcionario; ?></p>-->
    <!--<p><b>Por Tipo de Documento -</b> <?php //echo $tipodoc; ?></p>-->
	Existem <b> <?php echo $num_reg; ?> </b> registros de corrrespondentes com os filtros informados</p>
  </tr>

  
 
  <tr>
    <td height="57" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td height="19" colspan="4" valign="top"><b>Correspondentes</b></td>
        </tr>
      <tr>
        <td width="400" height="19" valign="top">Nome</td>
          <td width="200" valign="top">E-Mail</td>
          <!--<td width="250" valign="top">Empregado</td>-->
          <td width="150" valign="top">Cidade / UF</td>
          <td width="80" valign="top">Cadastro</td>
        </tr>
       <?php while($mostracorrespondentes = mysql_fetch_object($consulta)) {;?>		  
      <tr>
        <td height="19" valign="top"><?php echo $mostracorrespondentes->nome; ?></td>
          <td valign="top"><?php echo $mostracorrespondentes->email; ?></td>
          <!--<td valign="top"><?php echo $mostracorrespondentes->nome_func; ?></td>-->
          <td valign="top"><?php echo $mostracorrespondentes->cidade." / ".$mostracorrespondentes->uf; ?></td>
          <td valign="top"><?php echo substr($mostracorrespondentes->dtcadastro,8,2)."/".substr($mostracorrespondentes->dtcadastro,5,2)."/".substr($mostracorrespondentes->dtcadastro,0,4); ?></td>
        </tr>
        <?php }; ?>
    </table></td>
  </tr>

  <tr>
    <td height="19" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
$ip=$_SERVER['REMOTE_ADDR'];
} else {
	header("Location:login.php"); 
}
?>