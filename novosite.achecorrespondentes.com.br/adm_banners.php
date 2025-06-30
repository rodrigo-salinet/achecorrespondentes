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
?>

<section id="conteudo_interno">
	<div class="center">
		<h2 align="center"></h2>
		<h3 align="center"></h3><br/>
		<p align="center"></p><br/>
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
