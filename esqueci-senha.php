<?php 
include 'lib/configuracoes.php'; 
include("adm/includes/conecta.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $metadescription; ?>">
<meta name="keywords" content="<?php echo $metakeywords; ?>">

<link rel="stylesheet" href="css/form.css" />

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready (function(){   
	   $("#SENnasc").mask("99/99/9999");
       $("#SENcpf").mask("999.999.999-99");   
});


</script>
<?php 
$msg = $_GET['msg'];
if ($msg == "erro"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Atencao. \n\n Dados informados nao conferem \n\n Tente Novamente.")
</SCRIPT>
<?php }; ?>

<?php 
$msg = $_GET['msg'];
if ($msg == "emailsenhaok"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Atencao. \n\n Seus dados foram enviados ao endereco de e-mail informado.")
</SCRIPT>
<?php }; ?>
</head>


<body>
<?php include 'topo.php'; ?>

<section id="conteudo_interno">
<div class="center">
<h2>Esqueci Minha Senha</h2>
<p style="margin-top:10px;">Insira abaixo os dados para receber sua senha por e-mail.</p>


<form action="recupera-senha.php" method="post" id="form_senha" class="form">
    <input type="hidden" name="pagina" value="senha" />

    <p><label for="SENemail">E-mail</label><input type="text" value=""  name="SENemail" /></p>
    <p class="menor"><label for="SENnasc">Data de Nascimento</label><input type="text" value="" name="SENnasc" id="SENnasc" /></p>
    <p class="menor"><label for="SENcpf">CPF</label><input type="text" value="" name="SENcpf" id="SENcpf"/></p>
    <p style="margin-top:30px;"><input type="submit"  value="RECUPERAR SENHA" class="bt_form"/></p>

    </form>

    
</div>   
</section>

<?php include 'rodape.php'; ?>

</body>
</html>
