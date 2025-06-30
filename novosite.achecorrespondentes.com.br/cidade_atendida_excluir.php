<?php
if (!isset($_GET['id'])) {
	header("Location:cidades_atendidas.php?msg=errodelcidat");
	exit();
}
header("Content-type: text/html; charset=iso-8859-1\r\n",true);
/*
Inclui arquivo PHP de conexão ao banco de dados
*/
include_once('lib/conecta.php');

/*
Função de redirecionamento para a página inicial de login
*/
if (!isset($_SESSION['idlogadoache']) || $id_correspondente == "") {
	header("Location:index.php?msg=desconectado");
	exit();
}

/*
Inclui arquivo PHP de funções PHP
*/
include_once('lib/funcoes.php');

$id = anti_injection($_GET['id']);

if ($id != "") {
	$txt_sql_excluir_cidade_atendida = "DELETE FROM `$banco_de_dados`.`cidades_atendidas` WHERE `id`=$id;";
	if (mysqli_query($conn,$txt_sql_excluir_cidade_atendida)) {
		header("Location:cidades_atendidas.php?msg=cidatexcok");
		exit();
	} else {
		header("Location:cidades_atendidas.php?msg=errodelcidat");
		exit();
	}
} else {
	header("Location:cidades_atendidas.php?msg=errodelcidat");
	exit();
}

?>
