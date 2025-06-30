<?php 
header("Content-type: text/html; charset=iso-8859-1\r\n",true);
/*
Inclui arquivo PHP de conex�o ao banco de dados
*/
include_once('lib/conecta.php');

/*
Fun��o de redirecionamento para a p�gina inicial de login
*/
if (!isset($_SESSION['idlogadoache']) || $id_correspondente == "") {
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
<style type="text/css">
td {
	text-align: center;
}
</style>
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
		<h2>Meus Pagamentos</h2>
<?php
$txt_sql_pagamentos_correspondente = "SELECT * FROM `$banco_de_dados`.`pagamentos` WHERE `id_correspondente`=$id_correspondente;";
$sql_pagamentos_correspondente = mysqli_query($conn,$txt_sql_pagamentos_correspondente);
$num_linhas_pagamentos_correspondente = mysqli_num_rows($sql_pagamentos_correspondente);

if ($num_linhas_pagamentos_correspondente == 0) {
	echo '			<p align="center">Parece que voc� ainda n�o adquiriu algum Plano.<br/>
		Clique no link abaixo para se tornar um Correspondente.</p>';
} elseif ($num_linhas_pagamentos_correspondente > 0) {
	$cor1 = '$fff';
	$cor2 = '#a5c7ff';
?>
		<table width="100%">
			<tr style="text-transform: uppercase; font-weight: bold; background-color: <?php echo $cor2; ?>;">
				<td>N�</td>
				<td>Plano</td>
				<td>Identificador</td>
				<td>Cadastro</td>
				<td>Vig�ncia</td>
				<td>Valor</td>
				<td>Situa��o</td>
				<td>A��o</td>
			</tr>
<?php
	$cor = $cor1;
	$num = 1;
	while ($pagamento = mysqli_fetch_array($sql_pagamentos_correspondente)) {
		$id_plano = $pagamento['id_plano'];
		$txt_sql_plano = "SELECT * FROM `$banco_de_dados`.`planos` WHERE `id`=$id_plano;";
		$sql_plano = mysqli_query($conn,$txt_sql_plano);
		$plano = mysqli_fetch_array($sql_plano);
		$titulo_plano = $plano['titulo'];
		mysqli_free_result($sql_plano);

		$id_situacao = $pagamento['id_situacao'];
		$txt_sql_situacao = "SELECT * FROM `$banco_de_dados`.`pagamentos_situacoes` WHERE `id`=$id_situacao;";
		$sql_situacao = mysqli_query($conn,$txt_sql_situacao);
		$situacao = mysqli_fetch_array($sql_situacao);
		$txt_situacao = $situacao['situacao'];
		mysqli_free_result($sql_situacao);

		$opcao = "";
		if ($txt_situacao != "Pago") {
			$pagar = '<a href="pag_seguro.php?id_pagamento=' . $pagamento['id'] . '">Pagar*</a>';
		}
		
		$vigencia = "Indefinida";
		if ($pagamento['vigencia'] != "") {
			$vigencia = date('d/m/Y',strtotime($pagamento['vigencia']));
		}
?>
			<tr style="background-color: <?php echo $cor; ?>">
				<td><?php echo $num; ?></td>
				<td><?php echo $titulo_plano; ?></td>
				<td><?php echo $pagamento['id']; ?></td>
				<td><?php echo date('d/m/Y',strtotime($pagamento['data_cadastro'])); ?></td>
				<td><?php echo $vigencia; ?></td>
				<td style="text-align: right;">R$<?php echo number_format($pagamento['valor'], 2, ",", "."); ?></td>
				<td><?php echo $txt_situacao; ?></td>
				<td><?php echo $pagar; ?></td>
			</tr>
<?php
		if ($cor == $cor1) {
			$cor = $cor2;
		} else {
			$cor = $cor1;
		}
		$num++;
	}
?>
		</table>
<?php
}
?>
		<br/><p align="center"><a href="planos.php" class="bt_form">&nbsp;&nbsp;COMPRAR PLANO&nbsp;&nbsp;</a></p><br/>
		<p style="font-size: 10px;">
			*Obs: Ao pagar novamente, caso voc� j� tenha realizado algum pagamento, referente ao Plano selecionado, ainda n�o conclu�do pelo UOL-PagSeguro, o valor poder� ser debitado duas vezes, com possibilidade de cancelamento do pagamento duplicado.<br/>
			Caso isso tenha acontecido, por favor <a href="contato.php">clique aqui</a> para nos informar o pagamento em dobro, mencionando tamb�m o "Identificador" respectivo, para tomarmos as provid�ncias necess�rias e a devolu��o do excedente.
		</p>
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
