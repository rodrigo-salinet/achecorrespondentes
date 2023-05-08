<?php 
ob_start();
//INICIALIZA A SESSÃO 
session_start();

if ($_SESSION["logadoadmchefia"] == "SIM"){;
include("includes/conecta.php");

//Início da Paginação de Resultados<br>
//######### INICIO Paginação
        $numreg = 50; // Quantos registros por página vai ser mostrado
        if (!isset($pg)) {
                $pg = 0;
        }
        $inicial = $_GET['pg'] * $numreg; 
		//$inicial = $pg * $numreg;
        
//######### FIM dados Paginação

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
		$(function(){
			$('#cod_estados').change(function(){
				if( $(this).val() ) {
					$('#cod_cidades').hide();
					$('.carregando').show();
					$.getJSON('../cidades.ajax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value=""></option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
						}	
						$('#cod_cidades').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#cod_cidades').html('<option value="">– Escolha um estado –</option>');
				}
			});
		});
</script>
</head>

<body>
<div id="topo_contratos">
	<?php include("includes/topo.php"); ?>
</div>	<div id="frame">
	<div id="menu1" class="menu"> <!--Menu Primário -->
		<?php include("includes/menu.php"); ?>
   </div>    
<div id="conteudo">
<h1>Cadastro de cidades em destaque</h1>
          <table class="telasis">
          <thead>
            <tr>
              <th><b>Informe os dados desejados</b></th>
            </tr>
            </thead>
            <form action="add_cidades_cad.php" method="post" id="form_contrato" enctype="multipart/form-data">
			<tfoot>
              <tr>
                <th><div align="right">
                  <input type="submit" name="Submit" value="Cadastrar Município">
                </div></th>
              </tr>
			  <tbody>
              <tr>
                <td>
				  <fieldset>
                  <legend>Cadastro de Municípios em Destaque HOME</legend>                  
                  
		          <label class="coluna1">		  
					  <p>Estado<br>
						<select name="cod_estados" id="cod_estados">
						<option value=""></option>
						<?php
							$sql = "SELECT cod_estados, sigla
									FROM estados
									ORDER BY sigla";
							$res = mysql_query( $sql );
							while ( $row = mysql_fetch_assoc( $res ) ) {
								echo '<option value="'.$row['cod_estados'].'">'.$row['sigla'].'</option>';
							}
						?>
					</select>
					</label>
					<br style="clear:left;" />
		
					<label class="coluna1">
					<p>Município<br>
					<select name="cod_cidades" id="cod_cidades">
						<option value="">-- Escolha um estado --</option>
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
          <td width="470" height="19" valign="top"><b>Município</b></td>
		  <td width="150" height="19" valign="top"><b>Data de Cadastro</b></td>
          <td width="67" valign="top"><b>Excluir</b></td>
        </tr>
		<?php
		// Faz o Select pegando o registro inicial até a quantidade de registros para página
		 $consultamundest = mysql_query("SELECT * FROM `municipios_home` ORDER BY `Id` DESC LIMIT $inicial, $numreg");

		// Serve para contar quantos registros você tem na seua tabela para fazer a paginação
		$sql_conta = mysql_query("SELECT * FROM `municipios_home`");
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
 		     
			 while($municipioshome = mysql_fetch_object($consultamundest)) { ; 
		?>
		<tr>
          <td height="19" valign="top"><?php echo $municipioshome->municipio; ?></td>
		  <td height="19" valign="top"><?php echo substr($municipioshome->data_cadastro,8,2)."/".substr($municipioshome->data_cadastro,5,2)."/".substr($municipioshome->data_cadastro,0,4); ?></td>
          <td valign="top" align="center"><a href="edit_cidades_dest.php?id=<?php echo $municipioshome->Id."&action=del"; ?>"><img src="img/btn_excluir.png" align="Excluir" title="Excluir"></a></td>
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