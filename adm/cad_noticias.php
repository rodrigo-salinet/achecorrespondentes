<?php 
ob_start();
//INICIALIZA A SESS�O 
session_start();

if ($_SESSION["logadoadmchefia"] == "SIM"){;
include("includes/conecta.php");

//In�cio da Pagina��o de Resultados<br>
//######### INICIO Pagina��o
        $numreg = 50; // Quantos registros por p�gina vai ser mostrado
        if (!isset($pg)) {
                $pg = 0;
        }
        $inicial = $_GET['pg'] * $numreg; 
		//$inicial = $pg * $numreg;
        
//######### FIM dados Pagina��o
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
<script src="js/ckeditor/ckeditor.js"></script>


<script type="text/javascript" src="js/jquery.validate.pack.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.min.js"></script>
<script type="text/javascript" src="js/jquery.maskMoney.0.2.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>

<?php 
$erro = $_GET['erro'];
if ($erro <> ""){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Aten��o. \n\n<?php echo $erro; ?>")
</SCRIPT>
<?php }; ?>
</head>

<body>
<div id="topo_contratos">
	<?php include("includes/topo.php"); ?>
</div>	<div id="frame">
	<div id="menu1" class="menu"> <!--Menu Prim�rio -->
		<?php include("includes/menu.php"); ?>
   </div>    
<div id="conteudo">
<h1>Cadastro de Not�cias Home</h1>
          <table class="telasis">
          <thead>
            <tr>
              <th><b>Cadastro de Not�cias</b></th>
            </tr>
            </thead>
			<form action="insere_cad_noticia.php" method="post" enctype="multipart/form-data" id="form1">
			<tfoot>
              <tr>
                <th><div align="right">
                  <input type="submit" name="Submit" value="Cadastrar Not�cia">
                </div></th>
              </tr>
			  <tbody>
              <tr>
                <td>
				  <fieldset>
                  <legend>Not�cias do Site</legend>

                 
                  <label class="coluna3">T�tulo
                  <input name="titulo" type="text" id="titulo" value="" size="40" />
                  </label>
                  <br style="clear:left;" />
				  
				  <label class="coluna3">Not�cia
				  <textarea name="noticia" id="noticia" rows="10" cols="51"></textarea>
                  </label>
                  <br style="clear:left;" />
				  
                                
                  
				  <label class="coluna3">Foto da Not�cia
                  <input type="file" name="foto" id="foto" />
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
          <td width="470" height="19" valign="top"><b>Titulo</b></td>
		  <td width="130" height="19" valign="top"><b>Data</b></td>         
          <td width="67" valign="top"><b>Excluir</b></td>
        </tr>
		<?php
		// Faz o Select pegando o registro inicial at� a quantidade de registros para p�gina
		 $consultanoticias = mysql_query("SELECT * FROM noticias ORDER BY data_cadastro DESC LIMIT $inicial, $numreg");

		// Serve para contar quantos registros voc� tem na seua tabela para fazer a pagina��o
		$sql_conta = mysql_query("SELECT * FROM noticias ORDER BY data_cadastro DESC");
        
		$quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra pagina��o
		 //$consultamaterias = mysql_query("SELECT * FROM `sigif_materiasjornalisticas` ORDER BY `titulo` ASC");
 		while($noticias = mysql_fetch_object($consultanoticias)) { ;
	 
		?>
	
		<tr>
          <td height="19" valign="top"><?php echo $noticias->titulo; ?></td>
		  <td height="19" valign="top"><?php echo substr($noticias->data_cadastro,8,2)."/".substr($noticias->data_cadastro,5,2)."/".substr($noticias->data_cadastro,0,4); ?></td>
          <td valign="top" align="center"><a href="edit_noticias.php?id=<?php echo $noticias->Id."&action=del"; ?>"><img src="img/btn_excluir.png" align="Excluir" title="Excluir"></a></td>
        </tr>	  
        <?php }; ?>
		<tr>
          <td height="22" colspan="4" valign="top" align="center"><?php include("includes/paginacao.php"); ?></td>
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