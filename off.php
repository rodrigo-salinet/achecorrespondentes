<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
include 'lib/configuracoes.php'; 
include("adm/includes/conecta.php");
?>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $metadescription; ?>">
<meta name="keywords" content="<?php echo $metakeywords; ?>">

<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src="js/jquery.autocomplete.js"></script>
<!--<link rel="stylesheet" type="text/css" href="css/autocomplete.css" />-->
<script type="text/javascript">
            $().ready(function() {
                $("#BUScidade").autocomplete("autocomplete_cidades.php", {
                    width: 495,
                    matchContains: true,
                    //mustMatch: true,
                    //minChars: 0,
                    //multiple: true,
                    //highlight: false,
                    //multipleSeparator: ",",
                    selectFirst: false
                });
            });
</script>
<SCRIPT LANGUAGE="javascript" TYPE="text/javascript">
		function retira_acentos(palavra) { 
			com_acento = '����������������������������������������������'; 
			sem_acento = 'aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC'; 
			nova = ''; 
		for(i=0;i<palavra.length;i++) { 
			if (com_acento.search(palavra.substr(i,1))>=0) { 
				nova+=sem_acento.substr(com_acento.search(palavra.substr(i,1)),1); 
			} else { 
			nova+=palavra.substr(i,1); 
		} } 
		return nova; 
		}
</script>
<?php 
$msg = $_GET['msg'];
if ($msg == "erro"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Aten��o. \n\n Login ou Senha inv�lidos \n\n Tente Novamente.")
</SCRIPT>
<?php }; ?>

<?php 
$msg = $_GET['msg'];
if ($msg == "cadastrofree"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
//alert ("Aten��o. \n\n Seu Cadastro foi finalizado com sucesso por 20 dias gratuitamente.\n Enviamos um e-mail para voc� ! \n\n Acesse para ativar seu cadastro.")
alert ("Aten��o. \n\n Seu Cadastro foi finalizado com sucesso por 20 dias gratuitamente.\n Obrigado por se cadastrar no site achechecorrespondentes.com.br")
</SCRIPT>
<?php }; ?>

<?php 
$msg = $_GET['msg'];
if ($msg == "erroemail"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Aten��o. \n\n J� existem dados similares em nosso banco de dados (CPF, CNPJ ou E-MAIL \n\n N�o ser� poss�vel prosseguir com seu cadastro.")
</SCRIPT>
<?php }; ?>

<?php 
$msg = $_GET['msg'];
if ($msg == "errocpf"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Aten��o. \n\n N�mero de CPF j� existe em nosso banco de dados \n\n N�o � poss�vel prosseguir.")
</SCRIPT>
<?php }; ?>

<?php 
$msg = $_GET['msg'];
if ($msg == "errocnpj"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Aten��o. \n\n N�mero de CNPJ j� existe em nosso banco de dados \n\n N�o � poss�vel prosseguir.")
</SCRIPT>
<?php }; ?>

<?php 
$msg = $_GET['msg'];
if ($msg == "errologin"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Aten��o. \n\n Para acessar a �rea do Correspondente, � necess�rio estar Logado \n\n Informe seus dados e tente novamente.")
</SCRIPT>
<?php }; ?>

<?php 
$msg = $_GET['msg'];
if ($msg == "emailcontatook"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Aten��o. \n\n Seu E-mail foi enviado com sucesso !! \n\n Em breve ele ser� respondido.")
</SCRIPT>
<?php }; ?>

<?php 
if ($msg == "semcadastro"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Aten��o. \n\n Seu registro n�o foi localizado em nosso banco de dados. Ele pode ter sido excluido. \n\n Registre-se Novamente.")
</SCRIPT>
<?php }; ?>

<?php 
if ($msg == "cadastrook"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Aten��o. \n\n Seu cadastro foi ativado com sucesso ! \n\n Logue-se para editar seus dados.")
</SCRIPT>
<?php }; ?>

<?php 
if ($msg == "emailok"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Aten��o. \n\n Enviamos um e-mail para voc� ! \n\n Acesse para ativar seu cadastro.")
</SCRIPT>
<?php }; ?>
</head>


<body>
<?php include 'topo2.php'; ?>

<section id="conteudo">

<div id="content">
<form action="correspondentes.php" method="post" id="form_busca">
  <h3 class="tit_inicial">Estamos em fase de atualiza��o. </h3>
  <h3 class="tit_inicial">Por favor, retorne mais tarde.</h3>
</form>
</div>


</section>
</body>
</html>
