<?php 
ob_start();
//INICIALIZA A SESSÃO 
session_start();

if ($_SESSION["logadoadmchefia"] == "SIM"){;
include("includes/conecta.php");
$texto = anti_injection($_POST['texto']); 
$tipo = anti_injection($_POST['tipo']); 

?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

</head>

<body>
<div id="topo_contratos">
	<?php include("includes/topo.php"); ?>
</div>	<div id="frame">
	<div id="menu1" class="menu"> <!--Menu Primário -->
		<?php include("includes/menu.php"); ?>
   </div>    
<div id="conteudo">
<h1>Busca por Correspondente</h1>
          <table class="telasis">
          <thead>
            <tr>
              <th><b>Informe os filtros desejados</b></th>
            </tr>
            </thead>
            <!--<form action="print_rel_doc.php" method="post" id="form_contrato" enctype="multipart/form-data" target="_blank">-->
			<form action="busca_correspondente.php" method="post" id="form_contrato" enctype="multipart/form-data">
			<tfoot>
              <tr>
                <th><div align="right">
                  <input type="submit" name="Submit" value="Buscar Informações">
                </div></th>
              </tr>
			  <tbody>
              <tr>
                <td>
				  <fieldset>
                  <legend>Localizar Correspondente</legend>                  
                  
				  
				  <label class="coluna3">Texto Procurado
                  <input name="texto" type="text" id="texto" value="" size="40" maxlength="10" />
                  </label>
				  <input type="hidden" name="tipo" value="doc">
                  <br style="clear:left;" />
				  
				  
				  
				  
				  <label class="coluna3">
                  Tipo de Busca<br />
                  <select name="tipo" id="tipo"  style="width:390px">
                    <option value="Todos" selected>TODOS</option>
					<option></option>
					<option value="nome" >Por Nome</option>
					<option value="email" >Por E-Mail</option>
            
                  </select>
                  </label>
                  <br style="clear:left;" />
				  
				  
			
				  
				  
				  
                  </fieldset>

              	</td>
              </tr>
		</tbody>
            </form>	
</table>
<table class="telasis">
  <!--DWLayoutTable-->
		<tr>
          <td width="470" height="19" valign="top"><b>Correspondente</b></td>
		  <td width="250" height="19" valign="top"><b>E-Mail</b></td>
		  <td width="67" valign="top"><b>Editar</b></td>
          <td width="67" valign="top"><b>Excluir</b></td>
        </tr>
		<?php
		 $consultacorrespondente = mysql_query("SELECT * FROM `correspondentes` WHERE `$tipo` LIKE '%$texto%' ORDER BY `$tipo` ASC");
		
			 while($correspondentes = mysql_fetch_object($consultacorrespondente)) { ; 
			 
		?>
		<tr>
          <td height="19" valign="top"><?php echo $correspondentes->nome; ?></td>
		  <td height="19" valign="top"><?php echo $correspondentes->email; ?></td>
          <td valign="top" align="center"><a href="edit_correspondente.php?id=<?php echo $correspondentes->Id."&action=edit"; ?>"><img src="img/btn_excluir.png" align="Excluir" title="Editar"></a></td>
		  <td valign="top" align="center"><a href="edit_correspondente.php?id=<?php echo $correspondentes->Id."&action=del"; ?>"><img src="img/btn_excluir.png" align="Excluir" title="Excluir"></a></td>
        </tr>	  
        <?php }; ?>
		<tr>
          <td height="22" colspan="6" valign="top" align="center"><?php include("includes/paginacao.php"); ?></td>
        </tr>
              	
</table>



  </div>
    <br style="clear:left;" />
</div>


</body>
</html>
<?php
$ip=$_SERVER['REMOTE_ADDR'];
} else {
	header("Location:login.php"); 
}
?>