<?php
if (!isset($_POST['id_cidade'])) {
	header("Location:cidades_atendidas.php?msg=errocadcidat");
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

/*
Inclui arquivo PHP de consultas MySQL
*/
include_once('lib/consultas_mysql.php');

$id_cidade = "";
$destaque = "";
$sessao = "";

if (isset($_POST['id_cidade'])) {
	$id_cidade = $_POST['id_cidade'];
}
if (isset($_POST['destaque'])) {
	$destaque = $_POST['destaque'];
}
if (isset($_POST['sessao'])) {
	$sessao = $_POST['sessao'];
}

$txt_sql_pagamentos_correspondente = "SELECT * FROM `$banco_de_dados`.`pagamentos`  WHERE `id_correspondente`=$id_correspondente ORDER BY `vigencia` DESC;";
$sql_pagamentos_correspondente = mysqli_query($conn,$txt_sql_pagamentos_correspondente);
$num_linhas_pagamentos_correspondente = mysqli_num_rows($sql_pagamentos_correspondente);

if ($num_linhas_pagamentos_correspondente > 0) {
	$total_cidades = 0;
	$cidades_destaque = 0;
	$data_atual = date('Y-m-d');
	mysqli_data_seek($sql_pagamentos_correspondente,0);
	$id_pagamento_vigente = "";
	while ($pagamento = mysqli_fetch_array($sql_pagamentos_correspondente)) {
		$id_plano = $pagamento['id_plano'];
		$vigencia = $pagamento['vigencia'];
		$txt_sql_plano = "SELECT * FROM `$banco_de_dados`.`planos` WHERE `id`=$id_plano;";
		$sql_plano = mysqli_query($conn,$txt_sql_plano);
		$num_linhas_plano = mysqli_num_rows($sql_plano);

		if ($num_linhas_plano > 0) {
			$plano = mysqli_fetch_array($sql_plano);
			if ($vigencia != "" && $vigencia >= $data_atual) {
				$total_cidades += intval($plano['total_cidades']);
				$cidades_destaque += intval($plano['cidades_destaque']);
				if ($id_pagamento_vigente == "") {
					$id_pagamento_vigente = $pagamento['id'];
				}
			}
		} else {
			header("Location:planos.php?msg=planoinvalido");
			exit();
		}
		mysqli_free_result($sql_plano);
	}

	if ($total_cidades > 0) {
		$txt_sql_cidades_total = trim("
			SELECT * FROM `$banco_de_dados`.`cidades_atendidas` ca 
			INNER JOIN `$banco_de_dados`.`pagamentos` pa 
			ON ca.`id_pagamento` = pa.`id` 
			WHERE ca.`id_correspondente` = $id_correspondente 
			AND pa.`vigencia` >= '$data_atual' 
			ORDER BY ca.`id` DESC;
		");
		$sql_cidades_total = mysqli_query($conn,$txt_sql_cidades_total);
		$num_linhas_cidades_total = mysqli_num_rows($sql_cidades_total);
		mysqli_free_result($sql_cidades_total);

		if ($num_linhas_cidades_total < $total_cidades) {
			$txt_sql_cidade_atendida = trim("
				SELECT * FROM `$banco_de_dados`.`cidades_atendidas` ca 
				INNER JOIN `$banco_de_dados`.`pagamentos` pa 
				ON ca.`id_pagamento` = pa.`id` 
				WHERE ca.`id_cidade` = $id_cidade 
				AND ca.`id_correspondente` = $id_correspondente
				AND pa.`vigencia` >= '$data_atual';
			");
			$sql_cidade_atendida = mysqli_query($conn,$txt_sql_cidade_atendida);
			$num_linhas_cidade_atendida = mysqli_num_rows($sql_cidade_atendida);
			mysqli_free_result($sql_cidade_atendida);

			if ($num_linhas_cidade_atendida == 0) {
				$txt_sql_cidades_destaque = trim("
					SELECT * FROM `$banco_de_dados`.`cidades_atendidas` ca 
					INNER JOIN `$banco_de_dados`.`pagamentos` pa 
					ON ca.`id_pagamento` = pa.`id` 
					WHERE ca.`id_correspondente` = $id_correspondente 
					AND ca.`destaque` = 'Sim' 
					AND pa.`vigencia` >= '$data_atual';
				");
				$sql_cidades_destaque = mysqli_query($conn,$txt_sql_cidades_destaque);
				$num_linhas_cidades_destaque = mysqli_num_rows($sql_cidades_destaque);
				mysqli_free_result($sql_cidades_destaque);

				$campo_destaque = "";
				$valor_destaque = "";
				if ($num_linhas_cidades_destaque < $cidades_destaque) {
					if ($destaque != "") {
						$campo_destaque = ",`destaque`";
						$valor_destaque = ",'$destaque'";
					}
				} elseif ($destaque != "") {
					header("Location:planos.php?msg=maxdest");
					exit();
				}

				if ($id_correspondente != "" && $id_cidade != "" && $id_pagamento_vigente != "") {
					$txt_inserir_cidade_atendida = "INSERT INTO `$banco_de_dados`.`cidades_atendidas` (`id_correspondente`,`id_pagamento`,`id_cidade`$campo_destaque,`sessao`) VALUES ($id_correspondente,$id_pagamento_vigente,$id_cidade $valor_destaque,'$sessao');";
					if (mysqli_query($conn,$txt_inserir_cidade_atendida)) {
						header("Location:cidades_atendidas.php?msg=cadcidatok");
						exit();
					} else {
						header("Location:cidades_atendidas.php?msg=errocadcidat");
						exit();
					}
				} else {
					header("Location:cidades_atendidas.php?msg=errocadcidat");
					exit();
				}
			} else {
				header("Location:cidades_atendidas.php?msg=cidadecadastrada");
				exit();
			}
		} else {
			header("Location:planos.php?msg=maxcidade");
			exit();
		}
	} else {
		header("Location:planos.php?msg=vencido");
		exit();
	}
} else {
	header("Location:planos.php?msg=semplano");
	exit();
}
?>
