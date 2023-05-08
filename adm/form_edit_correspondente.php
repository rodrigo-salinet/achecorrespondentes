<?php 
ob_start();
//INICIALIZA A SESSÃO 
session_start();

if ($_SESSION["logadoadmchefia"] == "SIM"){; 
include("includes/conecta.php");

$id = $_GET['id'];
$consultacorrespondente = mysql_query("SELECT * FROM `correspondentes` WHERE `Id` = '$id'");

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
<script>
jQuery(function($){
	   $("#dtnascimento").mask("99/99/9999",{completed:function(){alert("Essa é mesmo sua data de Nascimento?\n\n "+this.val());}});
       $("#fonefixo").mask("(99) 9999-9999");
       $("#vigencia").mask("99/99/9999");
	   $("#cpf").mask("999.999.999-99");
	   $("#cnpj").mask("99.999.999/9999-99");
	   $("#cep").mask("99999999");	
	
	$('#fonecelular').focusout(function(){
    var phone, element;
    element = $(this);
    element.unmask();
    phone = element.val().replace(/\D/g, '');
    if(phone.length > 10) {
        element.mask("(99) 99999-999?9");
    } else {
        element.mask("(99) 9999-9999?9");
    }
}).trigger('focusout');


	   
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
<h1>Cadastro de Correspondentes</h1>
          <table class="telasis">
          <thead>
            <tr>
              <th><b>Edição de Dados</b></th>
            </tr>
            </thead>
            <form action="atualiza_correspondente.php" method="post" id="form_contrato" enctype="multipart/form-data">
			
			<tfoot>
              <tr>
                <th><div align="right">
                  <input type="submit" name="Submit" value="Confirmar Edição">
                </div></th>
              </tr>
			  <tbody>
              <tr>
                <td>
				  <fieldset>
                  <legend>Identifica&ccedil;&atilde;o</legend>                  				  
				  <?php while($correspondente = mysql_fetch_object($consultacorrespondente)) { ;?>
				  
                  <label class="coluna2">Correspondente
                  <input name="correspondente" type="text" id="correspondente" value="<?php echo $correspondente->nome; ?>" size="50" maxlength="200" />
                  </label>
                  <br style="clear:left;" />
				  
				  
				  <label class="coluna2">Vigência do Cadastro
                  <input name="vigencia" type="text" id="vigencia" value="<?php echo substr($correspondente->vigencia,8,2)."/".substr($correspondente->vigencia,5,2)."/".substr($correspondente->vigencia,0,4); ?>" size="15" maxlength="200" />
                  </label>
                  <br style="clear:left;" />
				  
				  
				  
				  <label class="coluna2">
                      Situação<span class="VERMELHO"></span><br />
                      <select name="status" id="status" style="width:250px;">
					  <?php  
					    if ($correspondente->ativo == "S"){;
					      $status = "Ativo";
                        } else {
                          $status = "Inativo";	
                        };
                      ?>						
                        <option><?php echo $status; ?></option>
                        <option></option>
						<option value="S">Ativo</option>
						<option value="N">Inativo</option>
                      </select>
				  </label>
				  <br style="clear:left;" />
				  <input type="hidden" name="id" value="<?php echo $id; ?>" />
				  <?php  } ?>
				 
				  
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
<?php
$ip=$_SERVER['REMOTE_ADDR'];
} else {
	header("Location:login.php"); 
}
?>