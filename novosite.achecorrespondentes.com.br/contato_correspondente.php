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
<script>
jQuery(function($){
	$("#CONfone").mask("(99) 9999-9999");
	$("#CONfone").mask("(99) 9999-9999");
	$('#CONcelular').focusout(function(){
		var phone, element;
		element = $(this);
		element.unmask();
		phone = element.val().replace(/\D/g, '');
		if(phone.length > 10) {
			element.mask("(99) 99999-999?9");
		} else {
			element.mask("(99) 9999-9999?9");
		}
	}).trigger('focusout');
});
</script>

</head>
<body>
<div>
<?php
$id_destinatario = "";
if (isset($_GET['id_destinatario'])) {
	$id_destinatario = trim(anti_injection($_GET['id_destinatario']));
}

if ($id_destinatario != "") {
	$dataatual = date('Y-m-d');
	$txt_sql_correspondente_destinatario = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `id`=$id_destinatario;";
	$sql_correspondente_destinatario = mysqli_query($conn,$txt_sql_correspondente_destinatario);
	$correspondente_destinatario = mysqli_fetch_array($sql_correspondente_destinatario);
	$num_linhas_correspondente_destinatario = mysqli_num_rows($sql_correspondente_destinatario);

	if ($num_linhas_correspondente_destinatario > 0) {
		$nome_destinatario = $correspondente_destinatario['nome'];
		$email_destinatario = $correspondente_destinatario['email'];

		$nome_remetente = "";
		$email_remetente = "";
		$fone_remetente = "";
		$celular_remetente = "";
		$id_cidade_remetente = "";
		$cidade_remetente = "";
		$id_estado_remetente = "";

		if ($id_correspondente != "") {
			$txt_sql_remetente = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `id`=$id_correspondente;";
			$sql_remetente = mysqli_query($conn,$txt_sql_remetente);
			$remetente = mysqli_fetch_array($sql_remetente);
			$num_linhas_remetente = mysqli_num_rows($sql_remetente);
			
			if ($num_linhas_remetente > 0) {
				$nome_remetente = $remetente['nome'];
				$email_remetente = $remetente['email'];
				$fone_remetente = $remetente['fonefixo'];
				$celular_remetente = $remetente['fonecelular'];
				$id_cidade_remetente = $remetente['id_cidade'];
				mysqli_free_result($sql_remetente);

				if ($id_cidade_remetente != "") {
					$txt_sql_cidade_remetente = "SELECT * FROM `$banco_de_dados`.`cidades` WHERE `id`=$id_cidade_remetente;";
					$sql_cidade_remetente = mysqli_query($conn,$txt_sql_cidade_remetente);
					$cidade_remetente_sql = mysqli_fetch_array($sql_cidade_remetente);
					$num_linhas_cidade_remetente = mysqli_num_rows($sql_cidade_remetente);
					
					if ($num_linhas_cidade_remetente > 0) {
						$cidade_remetente = $cidade_remetente_sql['nome'];
						$id_estado_remetente = $cidade_remetente_sql['id_estado'];
					}
					mysqli_free_result($sql_cidade_remetente);
				}
			}
		}
		if ($msg == "emailcontatook") {
?>
		<h3>E-Mail Enviado com Sucesso!!!<br/>Em breve o(a) Correspondente entrará em contato<br/>Pode fechar esta janela/guia...</h3>
<?php
		} else {
?>
	<form action="contato_correspondente_enviar.php" method="post" id="form_fale_conosco" class="form">
		<input type="hidden" name="email_destinatario" value="<?php echo $email_destinatario; ?>" />
		<input type="hidden" name="nome_destinatario" value="<?php echo $nome_destinatario; ?>" />
		<input type="hidden" name="id_destinatario" value="<?php echo $id_destinatario; ?>" />
		Correspondente: 
		<h3 style="text-align: right; text-transform: uppercase;"><?php echo $nome_destinatario; ?></h3>
<?php
			if (isset($_SESSION['idlogadoache'])) {
?>
		<strong style="text-align: right;"><?php echo $email_destinatario; ?></strong>
<?php
			}
?>
		<div style="clear: both; text-align: right;">---</div>
		<h3>DADOS REMETENTE:</h3><br/>
		<p><label for="CONnome">Nome</label><br/>
			<input type="text" name="CONnome" id="CONnome" value="<?php echo $nome_remetente;?>"/></p>
		<p><label for="CONemail">E-mail</label><br/>
			<input type="text" name="CONemail" id="CONemail" value="<?php echo $email_remetente;?>"/></p>
		<p class="menor"><label for="CONfone">Telefone</label><br/>
			<input type="text" name="CONfone" id="CONfone" value="<?php echo $fone_remetente; ?>" /></p>
		<p class="menor"><label for="CONcelular">Celular</label><br/>
			<input type="text" name="CONcelular" id="CONcelular" value="<?php echo $celular_remetente; ?>" /></p>
		<p><label for="CONcidade">Cidade</label><br/>
			<input type="text" name="CONcidade" id="CONcidade" value="<?php echo $cidade_remetente; ?>" /></p>
		<p><label for="CONestado">Estado</label><br/>
		<select name="CONestado" id="CONestado" class="box_select_registro">
			<option disabled>vv Selecione abaixo o Estado vv</option>
			<option disabled></option>
<?php
			mysqli_data_seek($sql_estados,0);
			$algum_selecionado = ' selected';
			while ($linha = mysqli_fetch_array($sql_estados)) {
				$selecionado = '';
				if ($linha['id'] == $id_estado_remetente) {
					$selecionado = ' selected';
					$algum_selecionado = '';
				}
				echo '			<option value="' . $linha['sigla'] . '"' . $selecionado . '>' . $linha['nome'] . '</option>';
			}
?>
			<option<?php echo $algum_selecionado; ?>> >> Nenhum << </option>
		 </select>
		 </p><br/>
		 <p><label for="CONmsg">Mensagem</label><br/>
		 	<textarea name="CONmsg" id="CONmsg"></textarea></p>
		 <p><input type="submit" value="ENVIAR" class="bt_form"/></p>
	</form>
<?php
			
		}
	} else {
		mysqli_free_result($sql_correspondente_destinatario);
		header("Location:index.php?emailinvalido");
		exit();
	}
	mysqli_free_result($sql_correspondente_destinatario);
} else {
	header("Location:index.php?emailinvalido");
	exit();
}
?>
</div>
</body>
</html>

<?php
/*
Inclui arquivo PHP de desconexão
*/
include_once('lib/desconecta.php');
?>
