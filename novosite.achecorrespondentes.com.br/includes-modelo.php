<?php
header("Content-type: text/html; charset=iso-8859-1\r\n",true);
/*
Inclui arquivo PHP de conexão ao banco de dados
*/
include_once('lib/conecta.php');
?>

<?php
/*
Função de redirecionamento para a página inicial de login
*/
if (!isset($_SESSION['idlogadoache']) || $id_correspondente == "") {
	header("Location:index.php?msg=desconectado");
	exit();
}

?>

<?php
/*
Inclui arquivo PHP de funções PHP
*/
include_once('lib/funcoes.php');
?>

<?php
/*
Inclui arquivo PHP de consultas MySQL
*/
include_once('lib/consultas_mysql.php');
?>

<?php
/*
Inclui arquivo PHP de tags iniciais HTML
*/
include_once('lib/html_msg.php');
?>

<?php
/*
Inclui arquivo PHP de configurações de cabeçalho <head>
*/
include_once('lib/configuracoes.php');
?>

</head>
<body>

<?php
/*
Inclui arquivo PHP do topo da página
*/
include_once('lib/topo.php');
?>

<?php
/*
Inclui arquivo PHP do rodapé da página
*/
include_once('lib/rodape.php');
?>

</body>
</html>

<?php
/*
Inclui arquivo PHP de desconexão
*/
include_once('lib/desconecta.php');
?>
