<?php
header("Content-type: text/html; charset=iso-8859-1\r\n",true);

/*
Inclui arquivo PHP de conexão ao banco de dados
*/
include_once('lib/conecta.php');

/*
Inclui arquivo PHP de funções PHP
*/
include_once('lib/funcoes.php');

if (isset($_GET['ativar'])) {
	$ativar = trim(anti_injection($_GET['ativar']));
	$txt_sql_correspondente_ativar = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `hash`='$ativar';";
	$sql_correspondente_ativar = mysqli_query($conn,$txt_sql_correspondente_ativar);
	if (mysqli_num_rows($sql_correspondente_ativar) == 1) {
		$correspondente_ativar = mysqli_fetch_array($sql_correspondente_ativar);
		$_SESSION[idlogadoache] = $correspondente_ativar['id'];
		$id_correspondente = $_SESSION['idlogadoache'];
		mysqli_free_result($sql_correspondente_ativar);
		$txt_sql_ativar = "UPDATE `$banco_de_dados`.`correspondentes` SET `ativo`='S' WHERE `id`=$id_correspondente;";
		if ($id_correspondente == "" || !mysqli_query($conn,$txt_sql_ativar)) {
			header("Location:index.php?msg=errocad");
			exit();
		} else {
			header("Location:dados_profissionais.php?msg=cadastrook");
			exit();
		}
	} else {
		header("Location:index.php?msg=semcadastro");
		exit();
	}
}

/*
Inclui arquivo PHP de consultas MySQL
*/
include_once('lib/consultas_mysql.php');

$nome = anti_injection($_POST['CADnome']);
$email = anti_injection($_POST['CADemail']);
$senha = anti_injection($_POST['CADsenha']);
$dtnascimento = "";
$data = explode('/',anti_injection($_POST['CADnasc']));
if (isset($_POST['CADnasc']) && count($data) > 0) {
	$dtnascimento = $data[2] . '-' . $data[1] . '-' . $data[0];
}
$fonefixo = anti_injection($_POST['CADfone']);
$fonecelular = anti_injection($_POST['CADcelular']);
$cpf = anti_injection($_POST['CADcpf']);
$cnpj = anti_injection($_POST['CADcnpj']);
$cep = anti_injection($_POST['CADcep']);
$endereco = anti_injection($_POST['CADend']);
$numendereco = anti_injection($_POST['numendereco']);
$complemento = anti_injection($_POST['CADcomp']);
$bairro = anti_injection($_POST['CADbairro']);
$cidade = anti_injection($_POST['CADcidade']);
$uf = anti_injection($_POST['CADestado']);

if ($email != "") {
	//Verifica a existência do email no Banco de Dados
	$txt_sql_email = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `email` = '$email';";
	$sql_email = mysqli_query($conn,$txt_sql_email);

	if (mysqli_num_rows($sql_email) > 0) {
		header("Location:cadastro.php?msg=erroemail");
		exit();
	}
}

if ($cpf != "") {
	//Verifica a existência do cpf no Banco de Dados
	$txt_sql_cpf = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `cpf` = '$cpf';";
	$sql_email = mysqli_query($conn, $txt_sql_cpf);

	if (mysqli_num_rows($sql_cpf) > 0) {
		header("Location:cadastro.php?msg=errocpf");
		exit();
	}
}

if ($cnpj != "") {
	//Verifica a existência do cnpj no Banco de Dados
	$txt_sql_cnpj = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `cnpj` = '$cnpj';";
	$sql_cnpj = mysqli_query($conn, $txt_sql_cnpj);

	if (mysqli_num_rows($sql_cnpj) > 0) {
		header("Location:cadastro.php?msg=errocnpj");
		exit();
	}
}

$CADnome = "";
$CADemail = "";
$CADsenha = "";
$CADconfsenha = "";
$CADnasc = "";
$CADfone = "";
$CADcelular = "";
$CADcpf = "";
$CADcnpj = "";
$CADend = "";
$CADnumendereco = "";
$CADcomp = "";
$CADcep = "";
$CADbairro = "";
$CADcidade = "";
$CADestado = "";
$CADprofissional = "";
$CADestado_oab = "";
$CADregistro = "";
$CADurl = "";
$CADdadosgerais = "";
$CADimagem = "";

if ($id_correspondente > 0) {
	$txt_sql_correspondente = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `id` = $id_correspondente;";
	$sql_correspondente = mysqli_query($conn, $txt_sql_correspondente);
	$tbl_correspondente = mysqli_fetch_array($sql_correspondente);
	
	$CADnome = $tbl_correspondente['nome'];
	$CADcpf = $tbl_correspondente['cpf'];
	$CADcnpj = $tbl_correspondente['cnpj'];
	$CADemail = $tbl_correspondente['email'];
	$CADsenha = $tbl_correspondente['senha'];
	$CADconfsenha = $tbl_correspondente['senha'];
	$CADnasc = $tbl_correspondente['dtnascimento'];
	$CADcelular = $tbl_correspondente['fonecelular'];
	$CADfone = $tbl_correspondente['fonefixo'];
	$CADend = $tbl_correspondente['endereco'];
	$CADnumendereco = $tbl_correspondente['numendereco'];
	$CADcomp = $tbl_correspondente['complemento'];
	$CADcep = $tbl_correspondente['cep'];
	$CADbairro = $tbl_correspondente['bairro'];
	$CADcidade = $tbl_correspondente['id_cidade'];
	$CADprofissional = $tbl_correspondente['id_tipo_profissional'];
	$CADestado_oab = $tbl_correspondente['oab_id_estado'];
	$CADregistro = $tbl_correspondente['oab_numero'];
	$CADurl = $tbl_correspondente['site'];
	$CADdadosgerais = $tbl_correspondente['dadosgerais'];
	$CADimagem = $tbl_correspondente['imagem'];
	mysqli_free_result($sql_correspondente);
}

$atualiza_campos = "";
$insere_campos = "";
$insere_valores = "";

if ($nome != "" && $CADnome != $nome) {
	$atualiza_campos = "`nome`='$nome'";

	$insere_campos = "`nome`";
	$insere_valores = "'$nome'";
}

if ($email != "" && $CADemail != $email) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`email`='$email'";

	$insere_campos .= "`email`";
	$insere_valores .= "'$email'";
}

if ($senha != "" && $CADsenha != $senha) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`senha`='$senha'";

	$insere_campos .= "`senha`";
	$insere_valores .= "'$senha'";
}

if ($dtnascimento != "" && $CADnasc != $dtnascimento) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`dtnascimento`='$dtnascimento'";

	$insere_campos .= "`dtnascimento`";
	$insere_valores .= "'$dtnascimento'";
}

if ($fonefixo != "" && $CADfone != $fonefixo) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`fonefixo`='$fonefixo'";

	$insere_campos .= "`fonefixo`";
	$insere_valores .= "'$fonefixo'";
}

if ($fonecelular != "" && $CADcelular != $fonecelular) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`fonecelular`='$fonecelular'";

	$insere_campos .= "`fonecelular`";
	$insere_valores .= "'$fonecelular'";
}

if ($cpf != "" && $CADcpf != $cpf) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`cpf`='$cpf'";

	$insere_campos .= "`cpf`";
	$insere_valores .= "'$cpf'";
}

if ($cnpj != "" && $CADcnpj != $cnpj) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`cnpj`='$cnpj'";

	$insere_campos .= "`cnpj`";
	$insere_valores .= "'$cnpj'";
}

if ($cep != "" && $CADcep != $cep) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`cep`='$cep'";

	$insere_campos .= "`cep`";
	$insere_valores .= "'$cep'";
}

if ($endereco != "" && $CADend != $endereco) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`endereco`='$endereco'";

	$insere_campos .= "`endereco`";
	$insere_valores .= "'$endereco'";
}

if ($numendereco != "" && $CADnumendereco != $numendereco) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`numendereco`='$numendereco'";

	$insere_campos .= "`numendereco`";
	$insere_valores .= "'$numendereco'";
}

if ($complemento != "" && $CADcomp != $complemento) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`complemento`='$complemento'";

	$insere_campos .= "`complemento`";
	$insere_valores .= "'$complemento'";
}

if ($bairro != "" && $CADbairro != $bairro) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`bairro`='$bairro'";

	$insere_campos .= "`bairro`";
	$insere_valores .= "'$bairro'";
}

if ($cidade != "" && $CADcidade != $cidade) {
	if ($atualiza_campos != "") {
		$atualiza_campos .= ", ";
	}
	if ($insere_campos != "") {
		$insere_campos .= ",";
	}
	if ($insere_valores != "") {
		$insere_valores .= ",";
	}
	$atualiza_campos .= "`id_cidade`='$cidade'";

	$insere_campos .= "`id_cidade`";
	$insere_valores .= "$cidade";
}

if ($id_correspondente > 0 && $atualiza_campos != "") {
	$txt_sql_atualiza_correspondente = "UPDATE `$banco_de_dados`.`correspondentes` SET $atualiza_campos WHERE `id`=$id_correspondente;";
	die($txt_sql_atualiza_correspondente);
	if (mysqli_query($conn,$txt_sql_atualiza_correspondente)) {
		header("Location:dados_profissionais.php?msg=cadok");
		exit();
	} else {
		header('Location:cadastro.php?msg=errocad');
		exit();
	}
} elseif ($insere_campos != "" && $insere_valores != "") {
	$dtcadastro = date('Y-m-d');
	$dthrcadastro = date('Y-m-d H:i:s');
	$hash = md5($ip . "" . $dthrcadastro);
	$hashcad = md5(uniqid(rand(), true));
	$data_vigencia = date('Y-m-d', strtotime("+$diasfree days",strtotime($dtcadastro)));

	$campos_obrigatorios = "`hash`, `dtcadastro`, `ipcadastro`,`ativo`";
	$valores_obrigatorios = "'$hashcad', '$dtcadastro', '$ip','N'";
	$txt_sql_inserir_correspondente = "INSERT INTO `$banco_de_dados`.`correspondentes` ($insere_campos,$campos_obrigatorios) VALUES ($insere_valores,$valores_obrigatorios);";
	//die($txt_sql_inserir_correspondente);
	if (mysqli_query($conn,$txt_sql_inserir_correspondente)) {
		header("Location:contato_correspondente_enviar.php?ativar=$hashcad");
		exit();
	} else {
		header("Location:cadastro.php?msg=errocad");
		exit();
	}

	/*/ verifica se o usuario foi cadastrado
	$txt_sql_seleciona_ultimoid = "SELECT LAST_INSERT_ID();";
	if ($sql_seleciona_ultimoid = mysqli_query($conn,$txt_sql_seleciona_ultimoid)) {
		$ultimoid = mysqli_fetch_array($sql_seleciona_ultimoid);
		$_SESSION['idlogadoache'] = $ultimoid[0];
		$id_correspondente = $_SESSION['idlogadoache'];
	}*/
}

/*
Função de redirecionamento para a página inicial de login
*/
if (!isset($_SESSION['idlogadoache']) && $id_correspondente == "") {
	header("Location:index.php?msg=desconectado");
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
			<h2>Dados Profissionais</h2>
			<p style="margin-top:10px;">Cadastro para Profissionais Jurídicos. Inclua seus dados e ofereça agora mesmo seus serviços!</p>
			<form action="planos.php" method="post" enctype="multipart/form-data" id="form_cadastro" class="form">
			<div class="box_form">
				<p class="menor" style="width: 33%;"><label for="CADprofissional">Tipo de Profissional:</label><br/>
				<select name="CADprofissional" id="CADprofissional" class="box_select_registro">
					<option disabled>vv Selecione abaixo o tipo de profissional vv</option>
					<option disabled></option>
<?php
$algum_selecionado = " selected";
$txt_sql_tipos_profissional_visiveis = "SELECT * FROM `$banco_de_dados`.`tipos_profissional` WHERE `visivel`='S' ORDER BY `tipo`;";
$sql_tipos_profissional_visiveis = mysqli_query($conn,$txt_sql_tipos_profissional_visiveis);
while ($linha = mysqli_fetch_array($sql_tipos_profissional_visiveis)) {
	$selecionado = "";
	if ($CADprofissional == $linha['id']) {
		$selecionado = " selected";
		$algum_selecionado = "";
	}
	echo '					<option value="' . $linha['id'] . '"' . $selecionado . '>' . $linha['tipo'] . '</option>';
}
?>
					<option value=""<?php echo $algum_selecionado; ?>> >> Nenhum << </option>
				</select>
				</p>
				<p class="menor" style="width: 33%;"><label for="CADestado_oab">UF/OAB</label><br/>
				<select name="CADestado_oab" id="CADestado_oab" class="box_select_registro">
					<option disabled>vv Selecione abaixo o Estado vv</option>
					<option disabled></option>
<?php
$algum_selecionado = " selected";
while ($linha = mysqli_fetch_array($sql_estados)) {
	$selecionado = '';
	if ($CADestado_oab == $linha['id']) {
		$selecionado = ' selected';
		$algum_selecionado = "";
	}
	echo '					<option value="' . $linha['id'] . '"' . $selecionado . '>' . $linha['nome'] . '</option>';
}
?>
					<option value=""<?php echo $algum_selecionado; ?>> >> Nenhum << </option>
				</select>
				</p>
				<p class="menor" style="width: 33%;"><label for="CADregistro">Registro na OAB</label><br/>
				<input type="text" id="CADregistro" name="CADregistro" value="<?php echo $CADregistro; ?>"/>
				</p><br/><br/>
				<p><label for="CADurl">Site do Escritório / Profissional</label><br/>
				<input type="text" name="CADurl" id="CADurl" value="<?php echo $CADurl; ?>"/>
				</p><br/>
				<p><label for="CADdadosgerais">Dados Gerais</label><br/>
				<textarea rows="4" cols="50" name="CADdadosgerais" id="CADdadosgerais"> <?php echo $CADdadosgerais; ?></textarea>
				</p><br/>
<?php
$fotocorrespondente = "foto/$CADimagem";
if (file_exists($fotocorrespondente)) {
	$imagem = $fotocorrespondente;
} else {
	$imagem = "foto/no_image.jpg";
} 
?>
				<p><label for="CADimagem">Foto / Logo</label><br/>
				<input type="file" name="CADimagem" id="CADimagem"/><br/>
				<span class="img_corres"><img src="<?php echo $imagem; ?>" /></span><br/>
				<span class="obs">* O arquivo deve estar no padrão JPG, PNG ou GIF, com no máximo 500kb.</span>
				</p><br/>
				<p><label for="servico">Serviços Prestados</label><br/>
<?php
while ($linha = mysqli_fetch_array($sql_servicos_prestados)) {
	$selecionado = '';
	$txt_sql_servico = "SELECT * FROM `$banco_de_dados`.`servicos_correspondentes` WHERE `id_servico_prestado` = " . $linha['id'] . " AND `id_correspondente` = " . $id_correspondente . ";";
	$sql_servico = mysqli_query($conn,$txt_sql_servico);
	if (mysqli_num_rows($sql_servico) > 0) {
		$selecionado = ' checked';
	}
?>
					<input id="servico<?php echo $linha['id']; ?>" type="checkbox" name="servico[<?php echo $linha['id']; ?>]" class="css-checkbox med"<?php echo $selecionado; ?>/>
					<label for="servico<?php echo $linha['id']; ?>" class="css-label med elegant"><?php echo $linha['servico']; ?></label>
					<br/>
<?php
}
?>
				</p>
			</div>

			<div class="box_form">
				<p><label for="atuacao">Áreas de Atuação</label><br/>
<?php
while ($linha = mysqli_fetch_array($sql_areas_atuacao)) {
	$selecionado = '';
	$txt_sql_atuacao = "SELECT * FROM `$banco_de_dados`.`areas_correspondentes` WHERE `id_area_atuacao` = " . $linha['id'] . " AND `id_correspondente` = " . $id_correspondente . ";";
	$sql_atuacao = mysqli_query($conn,$txt_sql_atuacao);
	if (mysqli_num_rows($sql_atuacao) > 0) {
		$selecionado = ' checked';
	}
	mysqli_free_result($sql_atuacao);
?>
					<input id="atuacao<?php echo $linha['id']; ?>" type="checkbox" name="atuacao[<?php echo $linha['id']; ?>]" class="css-checkbox med"<?php echo $selecionado; ?>/>
					<label for="atuacao<?php echo $linha['id']; ?>" class="css-label med elegant"><?php echo htmlspecialchars($linha['area']); ?></label>
					<br/>
<?php
}
?>
				</p><br/>
				<p><input type="submit" value="CONTINUAR*" id="bt_form" class="bt_form"/></p>
				<?php echo $termos_de_uso; ?>
			</div>
			</form>
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
