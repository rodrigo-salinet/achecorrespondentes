<?php 
include("includes/conecta.php");

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
<script type="text/javascript">
$(document).ready (function(){
	$("#vlr_global").maskMoney({symbol:"",decimal:",",thousands:""});
	$("#dat_ini_vigenciam").mask("99/99/9999",{placeholder:" "});
	
});
</script>
</head>

<body>
<div id="topo_contratos">
	<?php include("includes/topo.php"); ?>
</div>	<div id="frame">
<?php 
ob_start();
//INICIALIZA A SESSÃO 
session_start();

if ($_SESSION["logadoadmchefia"] == "SIM"){;
include("includes/conecta.php");

?>
	<div id="menu1" class="menu"> <!--Menu Primário -->
		<?php include("includes/menu.php"); ?>
   </div> 
<?php }; ?>   
<div id="conteudo">
<h1><?php echo $tituloadm; ?></h1>
          <table class="telasis">
          <thead>
            <tr>
              <th><b>Por favor, efetue seu login</b></th>
            </tr>
            </thead>
            <form action="valida_login.php" method="post" id="form_contrato" enctype="multipart/form-data">
			<tfoot>
              <tr>
                <th><div align="right">
                  <input type="submit" name="Submit" value="Fazer Login">
                </div></th>
              </tr>
			  <tbody>
              <tr>
                <td>
				  <fieldset>
                  <legend>Identifica&ccedil;&atilde;o</legend>                  
                  <label class="coluna2">
                  Usu&aacute;rio<br />
                  <input name="user" type="text" id="user" value="" size="15" maxlength="10">
                  </label>
                  <label class="coluna3"> Senha <br />
                  <input name="pass" type="password" id="pass" value="" size="15" maxlength="10" />
                  </label>
                  <br style="clear:left;" />
                  </fieldset>
				 
                
              	</td>
              </tr>
		</tbody>
            </form>
</table>

  </div>
    <br style="clear:left;" />
</div>
</body>
</html>