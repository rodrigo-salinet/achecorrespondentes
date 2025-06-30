<?php
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

$txt_sql_pagamento = "SELECT * FROM `$banco_de_dados`.`pagamentos` WHERE `id_correspondente`=$id_correspondente;";
$sql_pagamento = mysqli_query($conn,$txt_sql_pagamento);
if (mysqli_num_rows($sql_pagamento) == 0) {
	header("Location:planos.php?msg=semplano");
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
		$(function () {
			$('#id_estado').change(function () {
				if ($(this).val()) {
					$('#id_cidade').hide();
					$('.carregando').show();
					$.getJSON('cidades.ajax.php?search=', {
						id_estado: $(this).val(),
						ajax: 'true',
					}, function (j) {
						var options = '<option ></option>';
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].id_cidade + '">' + j[i].nome + '</option>';
						}
						$('#id_cidade').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#id_cidade').html('<option >– Escolha um estado válido –</option>');
				}
			});
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
			<h2 id="cidades">Cidades Atendidas</h2>

			<ul class="cidades_cadastradas">
<?php
$data_atual = date('Y-m-d');
$txt_sql_cidades_atendidas_correspondente = trim("
	SELECT * FROM `$banco_de_dados`.`cidades_atendidas` ca 
	INNER JOIN `$banco_de_dados`.`pagamentos` pa 
	ON ca.`id_pagamento` = pa.`id` 
	WHERE ca.`id_correspondente` = $id_correspondente 
	AND pa.`vigencia` >= '$data_atual' 
	ORDER BY ca.`id` DESC;
");
$sql_cidades_atendidas_correspondente = mysqli_query($conn,$txt_sql_cidades_atendidas_correspondente);
$num_linhas_ca = mysqli_num_rows($sql_cidades_atendidas_correspondente);
while($cidades_atendidas_correspondente = mysqli_fetch_array($sql_cidades_atendidas_correspondente)) {
	$id_cidade_atendida = $cidades_atendidas_correspondente[0];
	$id_cidade = $cidades_atendidas_correspondente['id_cidade'];
	$txt_sql_cidade = "SELECT * FROM `$banco_de_dados`.`cidades` WHERE `id`=$id_cidade;";
	$sql_cidade = mysqli_query($conn,$txt_sql_cidade);
	$cidade = mysqli_fetch_array($sql_cidade);
	$nome_cidade = $cidade['nome'];
	$id_estado = $cidade['id_estado'];
	$txt_sql_estado = "SELECT * FROM `$banco_de_dados`.`estados` WHERE `id`=$id_estado;";
	$sql_estado = mysqli_query($conn,$txt_sql_estado);
	$estado = mysqli_fetch_array($sql_estado);
	$sigla_estado = $estado['sigla'];
	$destaque = "";
	if ($cidades_atendidas_correspondente['destaque'] == "Sim"){
		$destaque = ' class="destaque"';
	}
	mysqli_free_result($sql_cidade);
	mysqli_free_result($sql_estado);
?>
				<li<?php echo $destaque; ?>>
					<?php echo "$nome_cidade - $sigla_estado"; ?><a href="cidade_atendida_excluir.php?id=<?php echo $id_cidade_atendida;?>" class="excluir_cidade"></a>
				</li>
<?php
}
?>
			</ul>
<?php
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
			}
		}
		mysqli_free_result($sql_plano);
	}
}
mysqli_free_result($sql_pagamentos_correspondente);

if ($num_linhas_ca < $total_cidades) {
?>
			<form action="cidade_atendida_incluir.php" method="post" id="form_cidade" class="form">
				<input type="hidden" name="sessao" value="<?php echo $session; ?>"/>
				<h3>ADICIONAR CIDADE DE ATENDIMENTO</h3>

				<p class="menor" style="width: 29%"><label for="id_estado" style="color: #ffffff;">Estado</label><br/>
				<select name="id_estado" id="id_estado" class="box_select_registro">
					<option disabled>vv Selecione abaixo o Estado vv</option>
					<option disabled></option>
<?php
$txt_sql_codestados = "SELECT * FROM `$banco_de_dados`.`estados` ORDER BY `sigla`;";
$sql_codestados = mysqli_query($conn, $txt_sql_codestados);
while ($linha = mysqli_fetch_array($sql_codestados)) {
	echo '					<option value="' . $linha['id'] . '">' . $linha['sigla'] . ' - ' . $linha['nome'] . "</option>\n";
}
?>
					<option value="" selected> >> Nenhum << </option>
				</select>
				</p>

				<p class="menor" style="width: 69%"><label for="id_cidade" style="color: #ffffff;">Escolha uma Cidade</label><br/>
				<select name="id_cidade" id="id_cidade" class="box_select_registro">
					<option> >> Escolha um estado primeiro << </option>
				</select>
				</p><br/>

				<p class="box_check"><label for="destaque">Em destaque</label><br/>
					<input type="checkbox" name="destaque" id="destaque" value="Sim"/><span></span>
				</p>

				<p class="menor"><input type="submit" value="ADICIONAR" class="bt_form"/></p>

			</form>
<?php
} else {
	echo '			<h3 align="center"><strong>Você cadastrou o máximo das cidades atendidas contratadas, conforme seu Plano vigente.</strong><br/><br/>
		Para incluir mais cidades atendidas, <a href="planos.php"><b>clique aqui</b></a> e compre outro Plano.<br/><br/>
		Ou exclua alguma cidade acima e substitua por outra cidade desejada.</h3>';
}
?>
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