<?php
header('Cache-Control: no-cache');
//header('Content-type: application/xml; charset=iso-8859-1\r\n',true);
header("Content-type: text/html; charset=iso-8859-1\r\n",true);

include_once('lib/conecta.php');

/*
Inclui arquivo PHP de funções PHP
*/
include_once('lib/funcoes.php');

$id_estado = trim($_REQUEST['id_estado']);

$txt_sql_cidades_selecionadas = "SELECT `id`, `nome` FROM `$banco_de_dados`.`cidades` WHERE `id_estado`=$id_estado ORDER BY `nome`;";
$sql_cidades_selecionadas = mysqli_query($conn, $txt_sql_cidades_selecionadas);

$cidades = array();
//$num = 1;
while ($linha = mysqli_fetch_array($sql_cidades_selecionadas)) {
	$cidades[] = array('id_cidade' => $linha['id'],'nome' => $linha['nome']);
//	echo($num.". - ".json_encode($cidades)."<br/><br/>\n");
//	$num++;
}
echo(json_encode($cidades));
include_once('lib/desconecta.php');
?>