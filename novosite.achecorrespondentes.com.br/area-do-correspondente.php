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
	*nenhuma definida*
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

$txt_sql_correspondente = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `id`=$id_correspondente;";
$sql_correspondente = mysqli_query($conn,$txt_sql_correspondente);
$correspondente = mysqli_fetch_array($sql_correspondente);
$nome_correspondente = explode(' ',$correspondente['nome']);
$nome_correspondente = $nome_correspondente[0];
mysqli_free_result($sql_correspondente);

$hora_atual = date('G');
$saudacao = "Olá";
if ($hora_atual >= 0 && $hora_atual <= 11) {
	$saudacao = "Bom dia";
} elseif ($hora_atual >= 12 && $hora_atual <= 17) {
	$saudacao = "Boa tarde";
} elseif ($hora_atual >= 18 && $hora_atual <= 23) {
	$saudacao = "Boa noite";
}
?>

<section id="conteudo_interno">
	<div class="center">
		<h2 align="center"><?php echo $saudacao . ' <b style="text-transform: uppercase;">' . $nome_correspondente . '</b>!'; ?></h2>
		<h3 align="center">Bem vindo(a) à Área do Correspondente.</h3><br/>
		<p align="center">vv Utilize as opções abaixo para consultar/atualizar suas informações vv</p><br/>
		<nav id="container_menu">
			<ul id="menu" style="background-color: #7AAEFF; text-align: center;">
				<li><a href="cadastro.php" title="Visualizar ou modificar meu cadastro, senha e etc."> Cadastro/Senha </a></li>
				<li><a href="dados_profissionais.php" title="Visualizar ou modificar meus dados profissionais."> Dados Profissionais </a></li>
				<li><a href="cidades_atendidas.php" title="Visualizar ou modificar minhas cidades atendidas."> Cidades Atendidas </a></li>
				<li><a href="planos.php" title="Comprar planos."> Comprar Plano </a></li>
				<li><a href="pagamentos.php" title="Consultar meu(s) pagamento(s)."> Pagamentos </a></li>
			</ul>
		</nav>
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
Inclui arquivo PHP de desconexão -->
*/
include_once('lib/desconecta.php');
?>
