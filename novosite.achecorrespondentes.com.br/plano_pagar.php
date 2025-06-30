<?php
header("Content-type: text/html; charset=iso-8859-1\r\n",true);
$id_plano = "";
if (!isset($_POST['id_plano'])) {
	header("Location:planos.php?msg=semplano");
	exit();
} else {
	$id_plano = trim($_POST['id_plano']);
}
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

if ($id_plano != "") {
	$txt_sql_plano = "SELECT * FROM `$banco_de_dados`.`planos` WHERE `id`=$id_plano;";
	$sql_plano = mysqli_query($conn,$txt_sql_plano);
	$plano = mysqli_fetch_array($sql_plano);
	$valor_plano = $plano['valor'];

	$data = date('Y-m-d');
	$hash = md5($data);
	$sessao = md5($_SESSION['idlogadoache']);
	
	$txt_sql_pagamento = "SELECT * FROM  `$banco_de_dados`.`pagamentos` WHERE `id_correspondente`=$id_correspondente AND `id_plano`=$id_plano;";
	$sql_pagamento = mysqli_query($conn,$txt_sql_pagamento);
	$num_linhas_pagamento = mysqli_num_rows($sql_pagamento);
	mysqli_free_result($sql_pagamento);

	if ($num_linhas_pagamento > 0 && $id_plano == 1) {
		header("Location:planos.php?msg=planog");
		exit();
	} else {
		$campo_vigencia = "";
		$valor_vigencia = "";
		$id_situacao = "1";
		if ($id_plano == 1) {
			$campo_vigencia = ",`vigencia`";
			$valor_vigencia = ",'" . date('Y-m-d', strtotime("+$diasfree days")) . "'";
			$id_situacao = "5";
		}
		
		$txt_sql_inserir_pagamento = "INSERT INTO `$banco_de_dados`.`pagamentos` (`id_correspondente`, `id_plano`, `valor`, `data_cadastro`, `id_situacao`, `sessao`$campo_vigencia) VALUES ($id_correspondente, $id_plano, '$valor_plano', '$data', $id_situacao, '$sessao'$valor_vigencia);";
		if(mysqli_query($conn,$txt_sql_inserir_pagamento)) {
			$txt_sql_ultima_id_inserida = "SELECT LAST_INSERT_ID();";
			$sql_ultima_id_inserida = mysqli_query($conn,$txt_sql_ultima_id_inserida);
			$ultima_id_inserida = mysqli_fetch_array($sql_ultima_id_inserida);
			$ultima_id = $ultima_id_inserida[0];
			if ($ultima_id != "") {
				if ($id_plano == 1) {
					header("Location:cidades_atendidas.php?msg=cadastrofree");
					exit();
				} else {
					header("Location:pag_seguro.php?id_pagamento=$ultima_id");
					exit();
				}
			} else {
				header("Location:planos.php?msg=semplano");
				exit();
			}
		} else {
			header("Location:planos.php?msg=errocadplano");
			exit();
		}
	}
}
?>