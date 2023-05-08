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
<script src="js/jquery.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
<script language="javascript" type="text/javascript" src="js/validacao.js"></script>
<script src="js/cep.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>

<script>
jQuery(function($){
	  
	   $("#CADnasc").mask("99/99/9999");
       $("#CADfone").mask("(99) 9999-9999");
       
	   $("#CADcpf").mask("999.999.999-99");
	   $("#CADcnpj").mask("99.999.999/9999-99");
	   $("#CADcep").mask("99999999");	
	
	$('#CADcelular').focusout(function(){
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
<?php 
$msg = $_GET['msg'];
if ($msg == "erro"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Atenção. \n\n A Senha atual Não Confere. \n\n Tente Novamente !!")
</SCRIPT>
<?php }; ?>

<?php 
$msg = $_GET['msg'];
if ($msg == "sucesso"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Atenção. \n\n Senha Alterada com sucesso !!")
</SCRIPT>
<?php }; ?>
</head>


<body>
<?php include 'topo.php'; ?>

<section id="conteudo_interno">
<div class="center">
<h2>Minha Senha</h2>
<p style="margin-top:10px;">Atualize sua senha de acesso para a Área do Correspondente.</p>


<form action="up_minhasenha.php" method="post" id="form_cadastro" class="form" onsubmit="return validarSenha(this);">
    <input type="hidden" name="pagina" value="contato" />

 <div class="box_form">  
     <p class="menor"><label for="CADsenhaatual">Senha Atual</label><input type="password" value="" id="CADsenhaatual" name="CADsenhaatual" /></p>
     <p class="menor"><label for="CADnovasenha">Nova Senha</label><input type="password" value=""  id="CADnovasenha" name="CADnovasenha" /></p>
	 <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" size="30" />
	 <input type="submit"  value="Atualizar Senha" class="bt_form"/>
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

