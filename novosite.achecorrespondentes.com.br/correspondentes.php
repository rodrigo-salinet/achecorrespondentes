<?php
set_time_limit(0);
header("Content-type: text/html; charset=iso-8859-1\r\n",true);

if (!isset($_POST['BUScidade']) && !isset($_GET['id_cidade'])) {
	header("Location:index.php?msg=semcidade");
	exit();
}

/*
Inclui arquivo PHP de conexão ao banco de dados
*/
include_once('lib/conecta.php');

/*
Inclui arquivo PHP de funções PHP
*/
include_once('lib/funcoes.php');

/*
Inclui arquivo PHP de consultas MySQL
*/
include_once('lib/consultas_mysql.php');

$cidade = "";
if (isset($_POST['BUScidade'])) {
	$cidade = anti_injection($_POST['BUScidade']);
}
$id_cidade = "";
if (isset($_GET['id_cidade'])) {
	$id_cidade = anti_injection($_GET['id_cidade']); 
}

$dataatual = date('Y-m-d');

$ext = explode(' - ', $cidade);

$nome_cidade = $cidade;
if (count($ext) > 1) {
	$nome_cidade = strval($ext[0]);
}

if ($cidade != "") {
	$txt_sql_pre_consulta = "SELECT * FROM `$banco_de_dados`.`cidades` WHERE `nome` LIKE '%$nome_cidade%';";
	$sql_pre_consulta = mysqli_query($conn,$txt_sql_pre_consulta);
	$pre_consulta = mysqli_fetch_array($sql_pre_consulta);
	$num_linhas_pre_consulta = mysqli_num_rows($sql_pre_consulta);
	if ($num_linhas_pre_consulta == 1) {
		$id_cidade = $pre_consulta['id'];
	}
	mysqli_free_result($sql_pre_consulta);
}

if ($id_cidade == "") {
	$txt_sql_cidade = "SELECT * FROM `$banco_de_dados`.`cidades` WHERE `nome` LIKE '%$nome_cidade%' ORDER BY `nome` ASC;";
	$txt_sql_cidade_procurada = "SELECT * FROM `$banco_de_dados`.`cidades_procuradas` WHERE `txt_busca` LIKE '%$cidade%';";
} else {
	$txt_sql_cidade = "SELECT * FROM `$banco_de_dados`.`cidades` WHERE `id`=$id_cidade;";
	$txt_sql_cidade_procurada = "SELECT * FROM `$banco_de_dados`.`cidades_procuradas` WHERE `id_cidade`=$id_cidade;";
}

$sql_cidade = mysqli_query($conn,$txt_sql_cidade);
$sql_cidade_procurada = mysqli_query($conn,$txt_sql_cidade_procurada);

$num_linhas_cidade = mysqli_num_rows($sql_cidade);
$num_linhas_cidade_procurada = mysqli_num_rows($sql_cidade_procurada);

if ($num_linhas_cidade_procurada == 1) {
	$linha_cidade_procurada = mysqli_fetch_array($sql_cidade_procurada);
	$id_cidade_procurada = $linha_cidade_procurada['id'];
	$qtd_consultas = intval($linha_cidade_procurada['qtd_consultas']) + 1;
	$txt_sql_atualiza_cidade_procurada = "UPDATE `$banco_de_dados`.`cidades_procuradas` SET `qtd_consultas`=$qtd_consultas WHERE `id`=$id_cidade_procurada;";
	if ($cidade != "" || $id_cidade != "") {
		if (!mysqli_query($conn,$txt_sql_atualiza_cidade_procurada)) {
?>
<script language="javascript" type="text/javascript">
	window.alert("Ops! Não foi possível atualizar a tabela cidades_procuradas.");
</script>
<?php
		}
	}
}

if ($num_linhas_cidade_procurada == 0) {
	$hoje = strval($dataatual);
	
	$campo_id_cidade = "";
	$valor_id_cidade = "";
	if ($id_cidade != "") {
		$campo_id_cidade = "`id_cidade`,";
		$valor_id_cidade = "$id_cidade,";
	}
	
	$txt_sql_inserir_cidade_procurada = "INSERT INTO `$banco_de_dados`.`cidades_procuradas` ($campo_id_cidade`txt_busca`,`data_cadastro`,`qtd_consultas`,`ip`) VALUES ($valor_id_cidade'$cidade','$hoje',1,'$ip');";
	if ($cidade != "" || $id_cidade != "") {
		if (!mysqli_query($conn,$txt_sql_inserir_cidade_procurada)) {
?>
<script language="javascript" type="text/javascript">
	window.alert("Ops! Não foi possível inserir na tabela cidades_procuradas.");
</script>
<?php		
		}
	}
}
mysqli_free_result($sql_cidade_procurada);

/*
Inclui arquivo PHP de tags iniciais HTML
*/
include_once('lib/html_msg.php');

/*
Inclui arquivo PHP de configurações de cabeçalho <head>
*/
include_once('lib/configuracoes.php');

?>
<script language="javascript" type="text/javascript">
	Shadowbox.loadSkin('classic', 'lib/shadowbox/skin');
	Shadowbox.loadLanguage('en', 'lib/shadowbox/lang');
	Shadowbox.loadPlayer(['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'], 'lib/shadowbox/player');

	window.onload = function() {
		Shadowbox.init();

		/**
		* Note: The following function call is not necessary in your own project.
		* It is only used here to set up the demonstrations on this page.
		*/
		initDemos();
	}
</script>
<script language="javascript" type="text/javascript">
	$(document).ready(function() {
		$(".bt_telefone").click(function() {
			$(this).parent().find(".box_tel").slideToggle(400);
		});
		function open() {
			$(".open_box").fadeToggle(400);
		}
		/*$(".bt_contato").click(function() {
			open();
			$("body").css('overflow', 'hidden');
		});
		$(".fechar").click(function() {
			open();
			$("body").css('overflow', 'visible');
		});*/
	});
</script>

</head>
<body>

<?php
/*
Inclui arquivo PHP do topo da página
*/
include_once('lib/topo.php');
?>

<section id="conteudo_interno">
<div class="center">
<ul class="lista_correspondentes">

<?php 
if ($num_linhas_cidade == 0) {
?>
	<strong class="nome"><p>Ops! Não foram encontrados correspondentes ativos em <?php echo $nome_cidade; ?>.</p></strong>
<?php
} elseif ($num_linhas_cidade > 1) {
	if ($cidade != "") {
?>
	<strong class="nome"><p>VOCÊ QUIS DIZER:</p></strong><br/><br/>
<?php
		while($cidade_sql = mysqli_fetch_array($sql_cidade)) {
			$id_cidade = $cidade_sql['id'];
			$cidade_nome = $cidade_sql['nome'];
			$id_estado = $cidade_sql['id_estado'];
			$txt_sql_estado = "SELECT * FROM `$banco_de_dados`.`estados` WHERE `id`=$id_estado;";
			$sql_estado = mysqli_query($conn,$txt_sql_estado);
			$estado = mysqli_fetch_array($sql_estado);
			$sigla_estado_busca = $estado['sigla'];
			mysqli_free_result($sql_estado);
?>
	<a href="correspondentes.php?id_cidade=<?=$id_cidade;?>"><span style="padding-left:20px; padding-right:20px" class="bt_form"><?php echo "$cidade_nome - $sigla_estado_busca"; ?></span></a>
<?php
		}
	} else {
?>
	<strong class="nome"><p>Ops! É necessário digitar o nome da cidade primeiro. <br/><br/>Por favor, <a href="index.php">clique aqui</a> para voltar à página inicial e fazer a busca corretamente.</p></strong>
<?php
	}
} elseif ($num_linhas_cidade == 1) {
	mysqli_data_seek($sql_cidade,0);
	$cidade_sql = mysqli_fetch_array($sql_cidade);
	$cidade_nome = $cidade_sql['nome'];
	$id_estado = $cidade_sql['id_estado'];
	$txt_sql_estado = "SELECT * FROM `$banco_de_dados`.`estados` WHERE `id`=$id_estado;";
	$sql_estado = mysqli_query($conn,$txt_sql_estado);
	$estado = mysqli_fetch_array($sql_estado);
	$sigla_estado_busca = $estado['sigla'];
	mysqli_free_result($sql_estado);

	$txt_sql_correspondentes_destaque = trim("
		SELECT * FROM `$banco_de_dados`.`correspondentes` AS co 
		INNER JOIN `$banco_de_dados`.`cidades_atendidas` AS ca 
		ON ca.`id_correspondente` = co.`id` 
		INNER JOIN `$banco_de_dados`.`pagamentos` AS pa 
		ON ca.`id_pagamento` = pa.`id` 
		WHERE co.`ativo`='S' 
		AND ca.`id_cidade` = $id_cidade 
		AND ca.`destaque` = 'Sim' 
		AND pa.`vigencia` >= '$dataatual' 
		ORDER BY RAND();");
	$correspondentes_destaque = mysqli_query($conn,$txt_sql_correspondentes_destaque);
	$num_reg_destaque = mysqli_num_rows($correspondentes_destaque);
	//die("$txt_sql_correspondentes_destaque<br/><br/>");

	$txt_sql_correspondentes_semdestaque = trim("
		SELECT * FROM `$banco_de_dados`.`correspondentes` AS co 
		INNER JOIN `$banco_de_dados`.`cidades_atendidas` AS ca 
		ON ca.`id_correspondente` = co.`id` 
		INNER JOIN `$banco_de_dados`.`pagamentos` AS pa 
		ON ca.`id_pagamento` = pa.`id` 
		WHERE co.`ativo`='S' 
		AND ca.`id_cidade` = $id_cidade 
		AND ca.`destaque` IS NULL 
		AND pa.`vigencia` >= '$dataatual' 
		ORDER BY RAND();");
	$correspondentes_semdestaque = mysqli_query($conn,$txt_sql_correspondentes_semdestaque);									 
	$num_reg_semdestaque = mysqli_num_rows($correspondentes_semdestaque);
	//die ("$txt_sql_correspondentes_semdestaque<br/><br/>");

	if ($num_reg_destaque == 0 && $num_reg_semdestaque == 0) {
?>
	<strong class="nome"><p>Ops! Não foram encontrados correspondentes ativos em <b><?php echo "$cidade_nome - $sigla_estado_busca"; ?></b>.</p></strong>
<?php
	} else {
?>
<h2>Correspondente(s) que atende(m) a cidade de <?php echo $cidade_nome; ?> - <?php echo $sigla_estado_busca; ?>:</h2>
<?php
		$num_resultado = 1;
		while($dadoscorrespondentes_dest = mysqli_fetch_object($correspondentes_destaque)) {
			//exit(print_r($dadoscorrespondentes_dest));
			$id_crpdt = $dadoscorrespondentes_dest->id_correspondente;
			$nome_crpdt = $dadoscorrespondentes_dest->nome;
			$email_crpdt = $dadoscorrespondentes_dest->email;
			$fonefixo_crpdt = $dadoscorrespondentes_dest->fonefixo;
			$fonecelular_crpdt = $dadoscorrespondentes_dest->fonecelular;
			$cep_crpdt = $dadoscorrespondentes_dest->cep;
			$endereco_crpdt = $dadoscorrespondentes_dest->endereco;
			$numendereco_crpdt = $dadoscorrespondentes_dest->numendereco;
			$complemento_crpdt = $dadoscorrespondentes_dest->complemento;
			$bairro_crpdt = $dadoscorrespondentes_dest->bairro;
			$id_cidade_crpdt = $dadoscorrespondentes_dest->id_cidade;
			$id_tipo_profissional_crpdt = $dadoscorrespondentes_dest->id_tipo_profissional;
			$oab_id_estado_crpdt = $dadoscorrespondentes_dest->oab_id_estado;
			$oab_numero_crpdt = $dadoscorrespondentes_dest->oab_numero;
			$imagem_crpdt = $dadoscorrespondentes_dest->imagem;
			
			$fotocorrespondente = "foto/".$imagem_crpdt;
			if (file_exists($fotocorrespondente)) {
				$imagem = $fotocorrespondente;
			} else {
				$imagem = "foto/no_image.jpg";
			} 
?>
	<li>
<?php
			if (file_exists($fotocorrespondente)) {
?>
		<span class="img_corres"><img src="<?php echo $imagem; ?>" /></span>
<?php
			}
			$txt_sql_tipo_profissional = "SELECT * FROM `$banco_de_dados`.`tipos_profissional` WHERE `id`=$id_tipo_profissional_crpdt;";
			$sql_tipo_profissional = mysqli_query($conn,$txt_sql_tipo_profissional);
			$tipo_profissional = mysqli_fetch_array($sql_tipo_profissional);
			$tipo = $tipo_profissional['tipo'];
			mysqli_free_result($sql_tipo_profissional);

			$txt_sql_estado_oab = "SELECT * FROM `$banco_de_dados`.`estados` WHERE `id`=$oab_id_estado_crpdt;";
			$sql_estado_oab = mysqli_query($conn,$txt_sql_estado_oab);
			$estado_oab = mysqli_fetch_array($sql_estado_oab);
			$sigla_estado_oab = $estado_oab['sigla'];
			mysqli_free_result($sql_estado_oab);

			if ($tipo == "Advogado" or $tipo == "Advogada" or $tipo == "Advogado(a)") {
				$tipo .= " | OAB/$sigla_estado_oab Nº: $oab_numero_crpdt";
			}
?>
		<span class="info">
		<strong class="nome" title="<?php echo $id_crpdt; ?>" style="text-transform: uppercase;"><?php echo "$num_resultado. $nome_crpdt"; ?></strong>
		<span><?php echo $tipo; ?></span>
		<strong>Áreas de Atuação:</strong>
		<span>
<?php
			$divisor_area = "";
			mysqli_data_seek($sql_areas_atuacao,0);
			while ($areas_atuacao = mysqli_fetch_object($sql_areas_atuacao)) {
				$txt_sql_area_correspondente = "SELECT * FROM `$banco_de_dados`.`areas_correspondentes` WHERE `id_area_atuacao`=$areas_atuacao->id AND `id_correspondente`=$id_crpdt;";
				$sql_area_correspondente = mysqli_query($conn,$txt_sql_area_correspondente);
				if (mysqli_num_rows($sql_area_correspondente) > 0) {
					echo " $divisor_area $areas_atuacao->area";
					$divisor_area = "|";
				}
				mysqli_free_result($sql_area_correspondente);
			}
?>
		</span>
		<strong>Serviços Prestados:</strong>
		<span>
<?php
			$divisor_servico = "";
			mysqli_data_seek($sql_servicos_prestados,0);
			while ($servicos_prestados = mysqli_fetch_object($sql_servicos_prestados)) {
				$txt_sql_servico_correspondente = "SELECT * FROM `$banco_de_dados`.`servicos_correspondentes` WHERE `id_servico_prestado`=$servicos_prestados->id AND `id_correspondente`=$id_crpdt;";
				$sql_servico_correspondente = mysqli_query($conn,$txt_sql_servico_correspondente);
				if (mysqli_num_rows($sql_servico_correspondente) > 0) {
					echo " $divisor_servico $servicos_prestados->servico";
					$divisor_servico = "|";
				}
				mysqli_free_result($sql_servico_correspondente);
			}

			$txt_sql_cidade_correspondente = "SELECT * FROM `$banco_de_dados`.`cidades` WHERE `id`=$id_cidade_crpdt;";
			$sql_cidade_correspondente = mysqli_query($conn,$txt_sql_cidade_correspondente);
			$cidade_correspondente = mysqli_fetch_array($sql_cidade_correspondente);
			$nome_cidade = $cidade_correspondente['nome'];
			$id_estado_cidade = $cidade_correspondente['id_estado'];
			$txt_sql_estado_correspondente = "SELECT * FROM `$banco_de_dados`.`estados` WHERE `id`=$id_estado_cidade;";
			$sql_estado_correspondente = mysqli_query($conn,$txt_sql_estado_correspondente);
			$estado_correspondente = mysqli_fetch_array($sql_estado_correspondente);
			$sigla_estado = $estado_correspondente['sigla'];
			mysqli_free_result($sql_cidade_correspondente);
			mysqli_free_result($sql_estado_correspondente);
?>
		</span>
		<strong>Contato:</strong>
		<span><?php echo " $endereco_crpdt, Nº $numendereco_crpdt | $complemento_crpdt - CEP $cep_crpdt"; ?></span>
		<span><?php echo "$bairro_crpdt | $nome_cidade - $sigla_estado"; ?></span>
		</span>
		<a href="#id=<?php echo $id_crpdt; ?>"class="bt_telefone">Ver Telefones</a>
		<span class="box_tel" id="<?php echo $id_crpdt; ?>" >
		<strong> Telefones:</strong>
		<em><?php echo $fonefixo_crpdt; ?></em>
		<em><?php echo $fonecelular_crpdt; ?></em>
		</span>
		<a href="contato_correspondente.php?id_destinatario=<?php echo $id_crpdt; ?>" rel="shadowbox;height=800;width=600" class="bt_contato">Entrar em contato</a>
	</li>
<?php
			$num_resultado++;
		} 

		while($dadoscorrespondentes_semdest = mysqli_fetch_object($correspondentes_semdestaque)) {
			//exi(print_r($dadoscorrespondentes_semdest));
			$id_crpdt = $dadoscorrespondentes_semdest->id_correspondente;
			$nome_crpdt = $dadoscorrespondentes_semdest->nome;
			$email_crpdt = $dadoscorrespondentes_semdest->email;
			$fonefixo_crpdt = $dadoscorrespondentes_semdest->fonefixo;
			$fonecelular_crpdt = $dadoscorrespondentes_semdest->fonecelular;
			$cep_crpdt = $dadoscorrespondentes_semdest->cep;
			$endereco_crpdt = $dadoscorrespondentes_semdest->endereco;
			$numendereco_crpdt = $dadoscorrespondentes_semdest->numendereco;
			$complemento_crpdt = $dadoscorrespondentes_semdest->complemento;
			$bairro_crpdt = $dadoscorrespondentes_semdest->bairro;
			$id_cidade_crpdt = $dadoscorrespondentes_semdest->id_cidade;
			$id_tipo_profissional_crpdt = $dadoscorrespondentes_semdest->id_tipo_profissional;
			$oab_id_estado_crpdt = $dadoscorrespondentes_semdest->oab_id_estado;
			$oab_numero_crpdt = $dadoscorrespondentes_semdest->oab_numero;
			$imagem_crpdt = $dadoscorrespondentes_semdest->imagem;

			$txt_sql_tipo_profissional = "SELECT * FROM `$banco_de_dados`.`tipos_profissional` WHERE `id`=$id_tipo_profissional_crpdt;";
			$sql_tipo_profissional = mysqli_query($conn,$txt_sql_tipo_profissional);
			$tipo_profissional = mysqli_fetch_array($sql_tipo_profissional);
			$tipo = $tipo_profissional['tipo'];
			mysqli_free_result($sql_tipo_profissional);

			$txt_sql_estado_oab = "SELECT * FROM `$banco_de_dados`.`estados` WHERE `id`=$oab_id_estado_crpdt;";
			$sql_estado_oab = mysqli_query($conn,$txt_sql_estado_oab);
			$estado_oab = mysqli_fetch_array($sql_estado_oab);
			$sigla_estado_oab = $estado_oab['sigla'];
			mysqli_free_result($sql_estado_oab);

			if ($tipo == "Advogado" or $tipo == "Advogada" or $tipo == "Advogado(a)") {
				$tipo .= " | OAB/$sigla_estado_oab Nº: $oab_numero_crpdt";
			}
?>
	<li>
		<span class="info">
		<strong class="nome" title="<?php echo $id_crpdt; ?>" style="text-transform: uppercase;"><?php echo "$num_resultado. $nome_crpdt"; ?></strong>
		<span><?php echo $tipo; ?></span>
		<strong>Áreas de Atuação:</strong>
		<span>
<?php
			$divisor_area = "";
			mysqli_data_seek($sql_areas_atuacao,0);
			while ($areas_atuacao = mysqli_fetch_object($sql_areas_atuacao)) {
				$txt_sql_area_correspondente = "SELECT * FROM `$banco_de_dados`.`areas_correspondentes` WHERE `id_area_atuacao`=$areas_atuacao->id AND `id_correspondente`=$id_crpdt;";
				$sql_area_correspondente = mysqli_query($conn,$txt_sql_area_correspondente);
				if (mysqli_num_rows($sql_area_correspondente) > 0) {
					echo " $divisor_area $areas_atuacao->area";
					$divisor_area = "|";
				}
				mysqli_free_result($sql_area_correspondente);
			}
?>
		</span>
		<strong>Serviços Prestados:</strong>
		<span>
<?php
			$divisor_servico = "";
			mysqli_data_seek($sql_servicos_prestados,0);
			while ($servicos_prestados = mysqli_fetch_object($sql_servicos_prestados)) {
				$txt_sql_servico_correspondente = "SELECT * FROM `$banco_de_dados`.`servicos_correspondentes` WHERE `id_servico_prestado`=$servicos_prestados->id AND `id_correspondente`=$id_crpdt;";
				$sql_servico_correspondente = mysqli_query($conn,$txt_sql_servico_correspondente);
				if (mysqli_num_rows($sql_servico_correspondente) > 0) {
					echo " $divisor_servico $servicos_prestados->servico";
					$divisor_servico = "|";
				}
				mysqli_free_result($sql_servico_correspondente);
			}
?>
		</span>
		</span>
		<a href="#id=<?php echo $id_crpdt; ?>" class="bt_telefone">Ver Telefones</a>
		<span class="box_tel" id="<?php echo $id_crpdt; ?>">
		<strong> Telefones:</strong>
		<em><?php echo $fonefixo_crpdt; ?></em>
		<em><?php echo $fonecelular_crpdt; ?></em>
		</span>
		<a href="contato_correspondente.php?id_destinatario=<?php echo $id_crpdt; ?>" rel="shadowbox;height=800;width=600" class="bt_contato">Entrar em contato</a>
	</li>
<?php
			$num_resultado++;
		}
	}
	mysqli_free_result($correspondentes_destaque);
	mysqli_free_result($correspondentes_semdestaque);
}
?>

</ul>
</div> 
</section>

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