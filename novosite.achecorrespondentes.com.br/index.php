<?php
header("Content-type: text/html; charset=iso-8859-1\r\n",true);
$pg1 = basename($_SERVER['SCRIPT_NAME']);
$pg2 = "";
if (isset($_SERVER['REDIRECT_URL'])) {
	$pg2 = basename($_SERVER['REDIRECT_URL']);
} elseif (isset($_SERVER['HTTP_REFERER'])) {
	$pg2 = basename($_SERVER['HTTP_REFERER']);
}

if ($pg1 != "index.php" && $pg2 != "" && $pg1 != $pg2) {
	header("Location:" . $pg2);
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
		$().ready(function () {
			$("#BUScidade").autocomplete("autocomplete_cidades.php", {
				width: 495,
				matchContains: true,
				//mustMatch: true,
				minChars: 3,
				//multiple: true,
				//highlight: false,
				//multipleSeparator: ",",
				selectFirst: false
			});
		});
	</script>
	<script language="javascript" type="text/javascript">
		function retira_acentos(palavra) {
			com_acento = 'áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ';
			sem_acento = 'aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC';
			nova = '';
			for (i = 0; i < palavra.length; i++) {
				if (com_acento.search(palavra.substr(i, 1)) >= 0) {
					nova += sem_acento.substr(com_acento.search(palavra.substr(i, 1)), 1);
				} else {
					nova += palavra.substr(i, 1);
				}
			}
			return nova;
		}
	</script>
	<script language="javascript" type="text/javascript">
		$(document).ready(function(){
			$('#form_busca').validate({
				rules:{
					BUScidade:{
						required: true
					},
				},
				messages:{
					BUScidade:{
						required: "Ops! Digite a cidade para continuar."
					},
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
	<section id="conteudo">
		<h3 class="tit_inicial">Localize um Correspondente</h3>
		<div id="content">
			<form action="correspondentes.php" method="post" id="form_busca" name="form_busca">
				<p><label for="BUScidade">Digite o nome da cidade </label>
				<input type="text" placeholder="Digite o nome da cidade" name="BUScidade" id="BUScidade" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" onkeyup="this.value=retira_acentos(this.value);"/>
				</p>
				<p><input type="submit" value="BUSCAR" class="bt_busca"/>
				</p>
			</form>
		</div>

		<div style="clear:both"></div><br/>
		
		<div class="box_inicial">
			<h4>Seja um Correspondente Jurídico.</h4>
			<p>Aumente sua renda e seja visualizado por profissionais de todo país. Utilize os serviços de um correspondente, ganhe tempo e diminua despesas com estadias e viagens.</p>
			<a href="cadastro.php">INICIAR</a>
		</div>

		<div class="box_inicial">
			<h4>Por que ser <br/>
			um correspondente?</h4>
			<p>A flexibilidade de horários e a remuneração imediata têm sido grande atrativo para a entrada na carreira de Profissionais Correspondentes.</p>
			<a href="por-que-ser-correspondente.php">SAIBA MAIS</a>
		</div>

		<div class="box_inicial">
			<h4>Cadastre-se</h4>
			<p>Correspondência é uma ótima escolha para profissionais arrojados que buscam remuneração rápida além da expansão de seus serviços para todo o país.</p>
			<a href="cadastro.php">CADASTRE-SE</a>
		</div>

		<div style="clear:both"></div><br/>
		
		<div class="box_horizontal">
			<h4>Cidades dos Correspondentes mais Procurados</h4>
			<ul>
<?php
$txt_sql_cidades_mais_procuradas = "SELECT * FROM `$banco_de_dados`.`cidades_procuradas` ORDER BY `qtd_consultas` DESC LIMIT 5;";
$sql_cidades_mais_procuradas = mysqli_query($conn,$txt_sql_cidades_mais_procuradas);
while ($cidades_mais_procuradas = mysqli_fetch_array($sql_cidades_mais_procuradas)) {
	$id_cidade = $cidades_mais_procuradas['id_cidade'];
	if ($id_cidade != "") {
		$txt_sql_cidade = "SELECT * FROM `$banco_de_dados`.`cidades` WHERE `id`=$id_cidade;";
		$sql_cidade = mysqli_query($conn,$txt_sql_cidade);
		$cidade = mysqli_fetch_array($sql_cidade);
		$nome_cidade = $cidade['nome'];
		$id_estado = $cidade['id_estado'];
		$txt_sql_estado = "SELECT * FROM `$banco_de_dados`.`estados` WHERE `id`=$id_estado;";
		$sql_estado = mysqli_query($conn,$txt_sql_estado);
		$estado = mysqli_fetch_array($sql_estado);
		$sigla_estado = $estado['sigla'];
		mysqli_free_result($sql_cidade);
		mysqli_free_result($sql_estado);
	}
?>
				<li>
					<a href="correspondentes.php?id_cidade=<?php echo $id_cidade; ?>">
						<?php echo "Correspondentes Jurídicos em: $nome_cidade - $sigla_estado"; ?>
					</a>
				</li>
<?php
}
?>
			</ul>
		</div>

		<div style="clear:both"></div><br/>
		
		<div class="noticias">
			<h4>Notícias</h4>
			<ul>
<?php
$consultanoticias = mysqli_query($conn, "SELECT * FROM `$banco_de_dados`.`noticias` ORDER BY `data_cadastro` DESC LIMIT 4;");
while ($noticias = mysqli_fetch_object($consultanoticias)) {;
?>
				<li><a href="blog.php?noticia=<?php echo $noticias->id; ?>"><em><?php echo $noticias->titulo."<br>".substr($noticias->data_cadastro,8,2)."/".substr($noticias->data_cadastro,5,2)."/".substr($noticias->data_cadastro,0,4); ?></em><?php echo substr($noticias->noticia,0,130)."..." ; ?><span>Leia Mais </span></a>
				</li>
<?php
}
?>
			</ul>
		</div>

	</section>
	<div style="clear:both"></div><br/>
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
