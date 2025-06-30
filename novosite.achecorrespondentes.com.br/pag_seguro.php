<?php 
header("Content-type: text/html; charset=iso-8859-1\r\n",true);

if (!isset($_GET['id_pagamento'])) {
	header("Location:pagamentos.php?msg=sempag");
	exit();
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

/*
Inclui arquivo PHP de tags iniciais HTML
*/
include_once('lib/html_msg.php');

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

$id_pagamento = anti_injection(trim($_GET['id_pagamento']));

$txt_sql_pagamento = "SELECT * FROM `$banco_de_dados`.`pagamentos` WHERE `id`=$id_pagamento AND `id_correspondente`=$id_correspondente;";
$sql_pagamento = mysqli_query($conn,$txt_sql_pagamento);
$pagamento = mysqli_fetch_array($sql_pagamento);

if (mysqli_num_rows($sql_pagamento) == 0) {
	header("Location:pagamentos.php?msg=sempag");
	exit();
}

$id_plano = $pagamento['id_plano'];
$txt_sql_plano = "SELECT * FROM `$banco_de_dados`.`planos` WHERE `id`=$id_plano;";
$sql_plano = mysqli_query($conn,$txt_sql_plano);
$plano = mysqli_fetch_array($sql_plano);
$titulo_plano = $plano['titulo'];
$valor_plano = $plano['valor'];
$dias_vigencia = $plano['dias_vigencia'];
$cidades_sem_destaque = $plano['total_cidades'];
$cidades_com_destaque = $plano['cidades_destaque'];

$txt_sql_correspondente = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `id`=$id_correspondente;";
$sql_correspondente = mysqli_query($conn,$txt_sql_correspondente);
$correspondente = mysqli_fetch_array($sql_correspondente);
$nome_correspondente = $correspondente['nome'];
$fone_celular = $correspondente['fonecelular'];

if ($fone_celular == "") {
	$ddd_correspondente = "43";
	$fone_correspondente = "3026-9010";
} else {
	$ddd_correspondente = substr($fone_celular,1,2);
	if (count($fone_celular) == 14) {
		$fone_correspondente = substr($fonecelular,5,9);
	} else {
		$fone_correspondente = substr($fonecelular,5,10);
	}
}
$email_correspondente = $correspondente['email'];
?>

<section id="conteudo_interno">
	<div class="center">
		<ul class="cidades_cadastradas">
			<h3>Revise os dados abaixo para continuar:</h3><br/>
			<p style="text-indent: 20px;"><?php echo $titulo_plano; ?></p>
			<p style="text-indent: 20px;">Período*: <?php echo $dias_vigencia; ?> dias de vigência após confirmação do pagamento.</p>
			<p style="text-indent: 20px;">Total de Cidades Atendidas: <?php echo $cidades_sem_destaque; ?></p>
			<p style="text-indent: 20px;">Até <?php echo $cidades_com_destaque; ?> Cidades com destaque do total de Cidades Atendidas</p>
			<p style="text-indent: 20px;">Valor: R$<?php echo number_format($valor_plano, 2, ",", "."); ?></p><br/>
			<p style="text-align: center;">Clique no botão abaixo para realizar o pagamento pelo UOL-PagSeguro:</p><br/>
		</ul>

		<!-- Declaração do formulário -->
		<form method="post" target="pagseguro" action="https://pagseguro.uol.com.br/v2/checkout/payment.html" name="PagSeguro" id="PagSeguro" target="new">

			<!-- Campos obrigatórios -->
			<input name="receiverEmail" type="hidden" value="correspondentes@pullindearaujo.com.br">
			<input name="currency" type="hidden" value="BRL">

			<!-- Itens do pagamento (ao menos um item é obrigatório) -->
			<input name="itemId1" type="hidden" value="0001">
			<input name="itemDescription1" type="hidden" value="<?=$titulo_plano;?>">
			<input name="itemAmount1" type="hidden" value="<?=number_format($valor_plano, 2, ".", "");?>">
			<input name="itemQuantity1" type="hidden" value="1">
			<input name="itemWeight1" type="hidden" value="1000">

			<!-- Código de referência do pagamento no seu sistema (opcional) -->
			<input name="reference" type="hidden" value="<?="REF".$id_correspondente;?>">

			<!-- Dados do comprador (opcionais) -->
			<input name="senderName" type="hidden" value="<?=$nome_correspondente;?>">
			<input name="senderAreaCode" type="hidden" value="<?=$ddd_correspondente;?>">
			<input name="senderPhone" type="hidden" value="<?=$fone_correspondente;?>">
			<input name="senderEmail" type="hidden" value="<?=$email_correspondente;?>">

			<!-- submit do form (obrigatório) -->  
			<center><input alt="Pague com PagSeguro" name="submit" type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/120x53-pagar.gif" /></center>
		</form><br/>
		<p style="font-size: 10px;">*Obs: A vigência do seu cadastro permanecerá a mesma, até a confirmação do pagamento deste Plano.</p>
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
