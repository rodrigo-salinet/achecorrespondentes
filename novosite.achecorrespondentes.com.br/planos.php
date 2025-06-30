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

$atualizou = "N";
// recebe dados do formulario
$id_tipo_profissional = anti_injection($_POST['CADprofissional']);
$oab_id_estado = anti_injection($_POST['CADestado_oab']);
$oab = anti_injection($_POST['CADregistro']);
$site = anti_injection($_POST['CADurl']);
$dadosgerais = anti_injection($_POST['CADdadosgerais']);
$atuacoes = $_POST['atuacao'];
$servicos = $_POST['servico'];
$foto = $_FILES['CADimagem']['name'];

if ($id_correspondente > 0) {
	$txt_sql_correspondente = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `id`=$id_correspondente;";
	$sql_correspondente = mysqli_query($conn,$txt_sql_correspondente);
	$correspondente = mysqli_fetch_array($sql_correspondente);

	$id_tipo_profissional_correspondente = $correspondente['id_tipo_profissional'];
	$oab_id_estado_correspondente = $correspondente['oab_id_estado'];
	$oab_numero_correspondente = $correspondente['oab_numero'];
	$site_correspondente = $correspondente['site'];
	$dadosgerais_correspondente = $correspondente['dadosgerais'];
	$imagem_correspondente = $correspondente['imagem'];
}

$atualiza_campos = "";

if ($id_tipo_profissional != "" && $id_tipo_profissional_correspondente != $id_tipo_profissional) {
	$atualiza_campos = "`id_tipo_profissional`=$id_tipo_profissional";
}

if ($oab != "" && $oab_numero_correspondente != $oab) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	$atualiza_campos .= "`oab_numero`='$oab'";
}

if ($oab_id_estado != "" && $oab_id_estado_correspondente != $oab_id_estado) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	$atualiza_campos .= "`oab_id_estado`=$oab_id_estado";
}

if ($site != "" && $site_correspondente != $site) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	$atualiza_campos .= "`site`='$site'";
}

if ($dadosgerais != "" && $dadosgerais_correspondente != $dadosgerais) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	$atualiza_campos .= "`dadosgerais`='$dadosgerais'";
}

if ($oab_id_estado != "") {
	//Verifica a existência da oab no Banco de Dados
	$txt_sql_oab = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `oab_id_estado` = '$oab_id_estado' AND `oab_numero` = '$oab';";
	$sql_oab = mysqli_query($conn, $txt_sql_oab);
	$tbl_oab = mysqli_fetch_array($sql_oab);
	$id_uf_oab = $tbl_oab['id'];
	if (mysqli_num_rows($sql_oab) > 0 && $id_uf_oab != $id_correspondente) {
		header("Location:dados_profissionais.php?msg=errooab");
		exit();
	}
	mysqli_free_result($sql_oab);
}

$dtcadastro = date('Y-m-d');

$dthrcadastro = date('Y-m-d H:i:s');
$hash = md5($ip . "" . $dthrcadastro);
$hashcad = md5(uniqid(rand(), true));

$fotomd5 = "";
if ($foto != "") {
	//Definição do local para onde as imagens serão alocadas
	$dir = "foto/";

	//Faz a Verificação para descobrir a extensão dos arquivo enviado
	$ext = explode('.', $foto);
	$extensao = $ext[1];

	if ($extensao == "jpg") {
		$extensao = "jpeg";
	}
	$mimearq = $_FILES['CADimagem']['type'];

	//Faz a verificação para descobrir o tamanho da imagem enviada. Se maior que 1Mb, irá mostrar a mensagem de erro.
	$tam = $_FILES['CADimagem']['size'];
	$kb = $tam / 1000;
	if (strstr($kb,",")) {
		$size = explode(',', $kb);
	} elseif (strstr($kb,".")) {
		$size = explode('.', $kb);
	}
	$tamanho = $size[0];

	if ($tamanho > 500) {
		header("Location:dados_profissionais.php?msg=erroimagem");
		exit();
	}

	//Inclui o arquivo de Mimes
	include_once('lib/mimes.php');

	// Atribuo o array de Mimes com a variável rLista
	$rLista = $mimes;
	// Atribuo o Mime do arquivo com variável rMimes
	$rMimes = $mimearq;

	// Aqui é verificado se a extensão do arquivo enviado é uma extensão válida 
	if (in_array($rMimes, $rLista)) {
		header("Location:dados_profissionais.php?msg=errofoto");
		exit();
	}

	$fotomd5 = md5($hash . "_" . $foto) . "_" . $foto;
	$avatarmd5 = "av_" . $fotomd5;

	//caminho com nome da imagem e local para guardar
	$caminho1 = $dir . $foto;

	//movendo a imagem à tmp_name dando caminho
	if (move_uploaded_file($_FILES['CADimagem']['tmp_name'], $caminho1)) {
		list($largura, $altura, $tipo) = @getimagesize($caminho1);
		//die("<PRE>".print_r(get_defined_functions())."</PRE>");
		if ($extensao == 'bmp') {
			$imagem = @imagecreatefrombmp($caminho1);
		} elseif ($extensao == 'gd') {
			$imagem = @imagecreatefromgd($caminho1);
		} elseif ($extensao == 'gd2') {
			$imagem = @imagecreatefromgd2($caminho1);
		} elseif ($extensao == 'gd2part') {
			$imagem = @imagecreatefromgd2part($caminho1);
		} elseif ($extensao == 'gif') {
			$imagem = @imagecreatefromgif($caminho1);
		} elseif ($extensao == 'jpeg') {
			$imagem = @imagecreatefromjpeg($caminho1);
		} elseif ($extensao == 'png') {
			$imagem = @imagecreatefrompng($caminho1);
		} elseif ($extensao == 'string') {
			$imagem = @imagecreatefromstring($caminho1);
		} elseif ($extensao == 'wbmp') {
			$imagem = @imagecreatefromwbmp($caminho1);
		} elseif ($extensao == 'webp') {
			$imagem = @imagecreatefromwebp($caminho1);
		} elseif ($extensao == 'xbm') {
			$imagem = @imagecreatefromxbm($caminho1);
		} elseif ($extensao == 'xpm') {
			$imagem = @imagecreatefromxpm($caminho1);
		} else {
			header("Location:dados_profissionais.php?msg=errofoto");
			exit();
		}

		// A imagem no caminho vai para a memória
		$Thumbnail = imagecreatetruecolor(150, 150);

		// diminuir a imagem preservado as cores e diminiudo a imagem
		@imagecopyresampled($Thumbnail, $imagem, 0, 0, 0, 0, 150, 150, $largura, $altura);
		//sample da imagem com os tamanho 150 x150

		imagejpeg($Thumbnail, $dir . '/av_' . $foto);
		//$dir esta la em cima esqueceu aqui a imagem vai pequena
		// criando a imagem
		$pequena = $caminho_mysql . 'av_' . $foto;
		$avatar = "av_" . $foto;
		/*aqui eu criei uma variavel para o mysql ja que o caminho final e la
		gere a imagem e coloco no Diretorio de imagem
		e ganhar uma nova imagem algo tipo pequena_image que veio para mim.jpg
		*/
	} else {
		header("Location:dados_profissionais.php?msg=erroupload");
		exit();
	}
	//$image=$_FILES['galeria'];

	//aqui eu recebo a imagem olha o formulario la arquivo []

	/* aqui e um for para organizar o bando */
	for ($i = 0; $i < sizeof($image); $i++)
	{
		{
			if (!move_uploaded_file($tmpname, $caminho)) {
				header("Location:dados_profissionais.php?msg=erroupload");
				exit();
			}
		}

	}

	// renomeia os arquivos enviados
	$origem = "foto/" . $foto;
	$destino = "foto/" . $fotomd5;
	@rename($origem, $destino);

	$origemavatar = "foto/" . $avatar;
	$destinoavatar = "foto/" . $avatarmd5;
	@rename($origemavatar, $destinoavatar);
}

if ($foto != "" && $imagem_correspondente != $fotomd5) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	$atualiza_campos .= "`imagem`='$fotomd5'";
}

if ($atualiza_campos != "") {
	$txt_sql_atualiza_correspondente = "UPDATE `$banco_de_dados`.`correspondentes` SET $atualiza_campos WHERE `id`=$id_correspondente;";
	if (!mysqli_query($conn,$txt_sql_atualiza_correspondente)) {
		header("Location:dados_profissionais.php?msg=errocad");
		exit();
	}
	$atualizou = "S";
}

if (isset($_POST['atuacao'])) {
	/*  Deleta as áreas de atuações do id correspondente */
	$txt_sql_deleta_areas_correspondente = "DELETE FROM `$banco_de_dados`.`areas_correspondentes` WHERE `id_correspondente` = $id_correspondente;";
	if (!mysqli_query($conn,$txt_sql_deleta_areas_correspondente)) {
		header("Location:dados_profissionais.php?msg=errocad");
		exit();
	}
	/* Identifica e insere as ids das áreas de atuação */
	while ($atuacao = current($atuacoes)) {
		$id_area_correspondente = key($atuacoes);
		$txt_sql_insere_area_correspondente = "INSERT INTO `$banco_de_dados`.`areas_correspondentes` (`id_area_atuacao`,`id_correspondente`) VALUES ($id_area_correspondente,$id_correspondente);";
		if (!mysqli_query($conn,$txt_sql_insere_area_correspondente)) {
			header("Location:dados_profissionais.php?msg=errocad");
			exit();
		}
		next($atuacoes);
	}
	$atualizou = "S";
}
if (isset($_POST['servico'])) {
	/*  Deleta os serviços prestados do id correspondente */
	$txt_sql_deleta_servicos_correspondente = "DELETE FROM `$banco_de_dados`.`servicos_correspondentes` WHERE `id_correspondente` = $id_correspondente;";
	if (!mysqli_query($conn,$txt_sql_deleta_servicos_correspondente)) {
		header("Location:dados_profissionais.php?msg=errocad");
		exit();
	}

	/* Identifica e insere as ids dos serviços prestados */
	while ($servico = current($servicos)) {
		$id_servico_prestado = key($servicos);
		$txt_sql_insere_servico_correspondente = "INSERT INTO `$banco_de_dados`.`servicos_correspondentes` (`id_servico_prestado`,`id_correspondente`) VALUES ($id_servico_prestado,$id_correspondente);";
		if (!mysqli_query($conn,$txt_sql_insere_servico_correspondente)) {
			header("Location:dados_profissionais.php?msg=errocad");
			exit();
		}
		next($servicos);
	}
	$atualizou = "S";
}

if ($atualizou == "S") {
	header("Location:planos.php?msg=dadosprofok");
	exit();
}
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
		$(document).ready(function(){
			$('#form_planos').validate({
				rules:{
					id_plano:{
						required: true
					},
				},
				messages:{
					id_plano:{
						required: "Ops! Selecione um plano."
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
	<section id="conteudo_interno">
		<div class="center">
			<h3 class="planos_tit" id="plano">SELECIONE UM DOS <?php echo mysqli_num_rows($sql_planos); ?> PLANOS DE PAGAMENTO</h3>
			<form action="plano_pagar.php" method="post" id="form_planos">
<?php
while ($plano = mysqli_fetch_array($sql_planos)) {
?>
				<div class="box_plano" title="<?php echo $plano['descricao']; ?>">
					<h4 align="center"><?php echo $plano['titulo']; ?> <br/> <?php echo $plano['dias_vigencia']; ?> dias</h4>
					<span>Até <?php echo $plano['total_cidades']; ?> Cidades Atendidas</span>
					<span><?php echo $plano['cidades_destaque']; ?> Cidade(s)* em destaque</span>
					<strong>R$<?php echo number_format($plano['valor'], 2, ",", "."); ?></strong>
					<input type="radio" name="id_plano" value="<?php echo $plano['id']; ?>" class="input_radio"/>
					<em></em>
				</div>
<?php
}
?>
				<p><input type="submit" value="COMPRAR PLANO" class="bt_finalizar"/></p>
			</form>
			<p class="obs">*As cidades destaques estão inclusas dentro do número máximo de cidades atendidas e não acumulam cidades extras.</p>
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