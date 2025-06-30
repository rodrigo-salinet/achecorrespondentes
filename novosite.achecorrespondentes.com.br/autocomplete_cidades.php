<?php
header("Content-type: text/html; charset=iso-8859-1\r\n",true);
/*
Inclui arquivo PHP de conexão ao banco de dados
*/
include_once('lib/conecta.php');

/*
Inclui arquivo PHP de funções PHP
*/
include_once('lib/funcoes.php');

$q = strtolower($_GET["q"]);
if (!$q) return;

$txt_sql_cidade = "SELECT DISTINCT `nome`, `id_estado` FROM `$banco_de_dados`.`cidades` WHERE `nome` LIKE '$q%' ORDER BY `nome` ASC;";
$sql_cidade = mysqli_query($conn,$txt_sql_cidade);
while($cidade = mysqli_fetch_array($sql_cidade)) {
	$nome_cidade = $cidade['nome'];
	$id_estado = $cidade['id_estado'];
	$txt_sql_estado = "SELECT * FROM `$banco_de_dados`.`estados` WHERE `id`=$id_estado;";
	$sql_estado = mysqli_query($conn,$txt_sql_estado);
	$estado = mysqli_fetch_array($sql_estado);
	$sigla_estado = $estado['sigla'];
	echo "$nome_cidade - $sigla_estado\n";
	mysqli_free_result($sql_estado);
}
mysqli_free_result($sql_cidade);
?>