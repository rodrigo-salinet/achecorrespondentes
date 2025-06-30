<?php
header("Content-type: text/html; charset=iso-8859-1\r\n",true);

/*
Inclui arquivo PHP de conex�o ao banco de dados
*/
include_once('lib/conecta.php');

/*
Fun��o de redirecionamento para a p�gina inicial de login
*/
if (!isset($_SESSION['idadmache'])) {
	header("Location:index.php?msg=desconectado");
	exit();
}

/*
Inclui arquivo PHP de fun��es PHP
*/
include_once('lib/funcoes.php');

/*
Inclui arquivo PHP de consultas MySQL
*/
include_once('lib/consultas_mysql.php');

/*
Inclui arquivo PHP de tags iniciais HTML
*/
include_once('lib/html_msg.php');

/*
Inclui arquivo PHP de configura��es de cabe�alho <head>
*/
include_once('lib/configuracoes.php');
?>

</head>
<body>

<?php
/*
Inclui arquivo PHP do topo da p�gina
*/
include_once('lib/topo.php');

$txt_sql_adm = "SELECT * FROM `$banco_de_dados`.`loginadm` WHERE `id`=$id_adm;";
$sql_adm = mysqli_query($conn,$txt_sql_adm);
$adm = mysqli_fetch_array($sql_adm);
$nome_adm = $adm['login'];

$hora_atual = date('G');
$saudacao = "Ol�";
if ($hora_atual >= 0 && $hora_atual <= 11) {
	$saudacao = "Bom dia";
} elseif ($hora_atual >= 12 && $hora_atual <= 17) {
	$saudacao = "Boa tarde";
} elseif ($hora_atual >= 18 && $hora_atual <= 23) {
	$saudacao = "Boa noite";
}
?>

<section id="conteudo_interno">
	<div class="center">
		<h2 align="center"><?php echo $saudacao . ' <b style="text-transform: uppercase;">' . $nome_adm . '</b>!'; ?></h2>
		<h3 align="center">Bem vindo(a) � �rea Administrativa do site www.achecorrespondentes.com.br.</h3><br/>
		<p align="center">vv Utilize as op��es abaixo para consultar/atualizar as informa��es do site vv</p><br/>
		<nav id="container_menu">
			<ul id="menu" style="background-color: #7AAEFF; text-align: center;">
				<li><a href="adm_conteudo.php" title="Visualizar ou modificar conte�dos, textos, tags e etc."> Conte�do </a></li>
				<li><a href="adm_blog.php" title="Visualizar ou modificar informa��es do Blog."> Blog </a></li>
				<li><a href="adm_correspondentes.php" title="Visualizar ou modificar correspondentes."> Correspondentes </a></li>
				<li><a href="adm_noticias.php" title="Visualizar ou modificar not�cias."> Noticias </a></li>
				<li><a href="adm_banners.php" title="Visualizar ou modificar banners."> Banners </a></li>
				<li><a href="adm_cidades.php" title="Visualizar ou modificar cidades."> Cidades </a></li>
				<li><a href="adm_pagamentos.php" title="Visualizar ou modificar pagamentos dos correspondentes."> Pagamentos </a></li>
			</ul>
		</nav>
	</div> 
</section>

<?php
/*
Inclui arquivo PHP do rodap� da p�gina
*/
include_once('lib/rodape.php');
?>

</body>
</html>

<?php
/*
Inclui arquivo PHP de desconex�o
*/
include_once('lib/desconecta.php');
?>
