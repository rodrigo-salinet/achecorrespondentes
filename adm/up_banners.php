<?php 
ob_start();
//INICIALIZA A SESSÃO 
session_start();

if ($_SESSION["logadoadmchefia"] == "SIM"){;
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
	$("#dataini").mask("99/99/9999",{placeholder:" "});
	$("#datafim").mask("99/99/9999",{placeholder:" "});
	$("#dat_assinatura").mask("99/99/9999",{placeholder:" "});
	$("#dat_relatoriofinal").mask("99/99/9999",{placeholder:" "});
	$("#dat_relatoriofinal2").mask("99/99/9999",{placeholder:" "});
	$("#dat_saicaju").mask("99/99/9999",{placeholder:" "});
	$("#data").mask("99/99/9999",{placeholder:" "});
	$("#dat_licit").mask("99/99/9999",{placeholder:" "});
	$("#cpf_embrapa").mask("999.999.999-99",{placeholder:" "});
	$("#cpf_empresa").mask("999.999.999-99",{placeholder:" "});
	$("#cpf_fundacao").mask("999.999.999-99",{placeholder:" "});
	
	$("#busca_data_inicio").mask("99/99/9999",{placeholder:" "});
	$("#busca_data_fim").mask("99/99/9999",{placeholder:" "});

$("#form_contrato").validate({
  rules: {
    cod_tip_contrato: {
      required: true,
      min: 1
	},
	num_contrato: "required",
	vlr_global: "required",
	des_objeto: "required",
    dat_ini_vigenciam: {
      required: true,
      date: true
    },
    dat_fin_vigenciam: {
      required: true,
      date: true
    },
	dat_assinatura: "date",
	dat_relatoriofinal: "date",
	dat_relatoriofinal2: "date",
	dat_saicaju: "date",
	dat_pub: "date"
  }

});


function reset_tabs(){
	$("#cont_empresas").hide();
	$("#cont_gestores").hide();
	$("#cont_historico").hide();
	$("#cont_aditivos").hide();
	
	$("#tab_empresas").removeClass("active");
	$("#tab_gestores").removeClass("active");
	$("#tab_historico").removeClass("active");
	$("#tab_aditivos").removeClass("active");
}

reset_tabs();

$("#tab_empresas").click(function() {

	reset_tabs();
	$("#cont_empresas").show();
	$("#tab_empresas").addClass("active");

});
$("#tab_gestores").click(function() {

	reset_tabs();
	$("#cont_gestores").show();
	$("#tab_gestores").addClass("active");

});
$("#tab_historico").click(function() {

	reset_tabs();
	$("#cont_historico").show();
	$("#tab_historico").addClass("active");

});
$("#tab_aditivos").click(function() {

	reset_tabs();
	$("#cont_aditivos").show();
	$("#tab_aditivos").addClass("active");
	
});


});
</script>
<?php 
$erro = $_GET['erro'];
if ($erro <> ""){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Atenção. \n\n<?php echo $erro; ?>")
</SCRIPT>
<?php }; ?>
</head>

<body>
<div id="topo_contratos">
	<?php include("includes/topo.php"); ?>
</div>	<div id="frame">
	<div id="menu1" class="menu"> <!--Menu Primário -->
		<?php include("includes/menu.php"); ?>
   </div>    
<div id="conteudo">
<h1>Atualização de Banners</h1>
          <table class="telasis">
          <thead>
            <tr>
              <th><b>Informe o arquivo desejado</b></th>
            </tr>
            </thead>
			<form action="up_minhaimagem.php" method="post" enctype="multipart/form-data" id="form1">
			<tfoot>
              <tr>
                <th><div align="right">
                  <input type="submit" name="Submit" value="Enviar Arquivo">
                </div></th>
              </tr>
			  <tbody>
              <tr>
                <td>
				  <fieldset>
                  <legend>Atualização de Banners</legend>                  
                  
				  <label class="coluna1">
				  Os banners abaixo podem ser alterados. O arquivo deve ser enviado no tamanho mencionado e com o mesmo nome informado abaixo<br><br>
                  Banner Página Inicial 960 x 202 px (banner_full_home.jpg)<br />
				  Banner Mapa Página Inicial 380 x 300 px (banner2.jpg)<br>
				  Banner Página de Cadastro 600 x 158 px (banner_free.jpg)<br>
				  Banner Página de Cadastro 294 x 500 px (banner_pgto.jpg)<br><br>
				  </label>
				  <label class="coluna1">
				  
                  <input type="file" name="banner" id="banner" />
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
<?php
$ip=$_SERVER['REMOTE_ADDR'];
} else {
	header("Location:login.php"); 
}
?>