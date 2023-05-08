<?php
// inclui o arquivo de configuração do sistema
include "adm/includes/conecta.php";

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "SELECT DISTINCT nome, estado FROM municipios WHERE nome LIKE '$q%' ORDER BY nome ASC";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['nome'];
	$cnameest = $rs['estado'];
	echo "$cname - $cnameest\n";
}
?>