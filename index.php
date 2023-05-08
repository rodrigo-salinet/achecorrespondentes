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
<?php include 'topo.php'; ?>

<section id="conteudo">
<h3 class="tit_inicial">Localize um Correspondente</h3>
<div id="content">
<form action="correspondentes.php" method="post" id="form_busca">
  <input type="hidden" name="pagina" value="contato" />
  <p><label for="BUScidade">Digite o nome da cidade </label><input type="text" placeholder="Digite o nome da cidade "  name="BUScidade" id="BUScidade" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" onkeyup="this.value=retira_acentos(this.value);"></p>
  <p><input type="submit"  value="BUSCAR" class="bt_busca"/></p>
</form>
</div>

<div class="box_inicial">
<h4>Seja um Correspondente Jur�dico.</h4>
<p>Aumente sua renda e seja visualizado por profissionais de todo pa�s. Utilize os servi�os de um correspondente, ganhe tempo e diminua despesas com estadias e viagens.</p>
<a href="cadastro.php">INICIAR</a>
</div>

<div class="box_inicial">
<h4>Por que ser <br/>
um correspondente?</h4>
<p>A flexibilidade de hor�rios e a remunera��o imediata t�m sido grande atrativo para a entrada na carreira de Profissionais Correspondentes.</p>
<a href="por-que-ser-correspondente.php">SAIBA MAIS</a>
</div>

<div class="box_inicial">
<h4>Cadastre-se</h4>
<p>Correspond�ncia � uma �tima escolha para profissionais arrojados que buscam remunera��o r�pida al�m da expans�o de seus servi�os para todo o pa�s.</p>
<a href="cadastro.php">CADASTRE-SE</a>
</div>

<div class="box_horizontal">
<h4>Cidades dos Correspondentes mais Procurados</h4>
<ul>
<?php
$consultamundest = mysql_query("SELECT * FROM `municipios_home` ORDER BY RAND() LIMIT 5");
while($municipioshome = mysql_fetch_object($consultamundest)) { ; 
?>
	<li><a href="correspondentes.php?municipio=<?php echo $municipioshome->municipio; ?>"><?php echo "Advogados Correspondentes Jur�dicos em ".$municipioshome->municipio; ?></a></li>
<?php }; ?>	
</ul>

<ul style="margin-left:200px;">
<?php
$consultamundest = mysql_query("SELECT * FROM `municipios_home` ORDER BY RAND() LIMIT 5");
while($municipioshome = mysql_fetch_object($consultamundest)) { ; 
?>
	<li><a href="correspondentes.php?municipio=<?php echo $municipioshome->municipio; ?>"><?php echo "Advogados Correspondentes Jur�dicos em ".$municipioshome->municipio; ?></a></li>
<?php }; ?>	
</ul>	
</div>

<div class="noticias">
<h4>Not�cias</h4>	
<ul>
<?php
$consultanoticias = mysql_query("SELECT * FROM `noticias` ORDER BY data_cadastro DESC LIMIT 4");
while($noticias = mysql_fetch_object($consultanoticias)) { ; 
?>
<li><a href="blog.php?noticia=<?php echo $noticias->Id; ?>"><em><?php echo $noticias->titulo."<br>".substr($noticias->data_cadastro,8,2)."/".substr($noticias->data_cadastro,5,2)."/".substr($noticias->data_cadastro,0,4); ?></em><?php echo substr($noticias->noticia,0,130)."..." ;  ?><span>Leia Mais </span></a></li>
<?php }; ?>	
</ul>
</div>

</section>
<?php include 'rodape.php'; ?>
</body>
</html>
