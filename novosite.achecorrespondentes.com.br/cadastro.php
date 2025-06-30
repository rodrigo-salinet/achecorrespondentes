<?php
header("Content-type: text/html; charset=iso-8859-1\r\n",true);
/*
Inclui arquivo PHP de conex�o ao banco de dados
*/
include_once('lib/conecta.php');

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
Inclui arquivo PHP de configura��es de cabe�alho <head></head>
*/
include_once('lib/configuracoes.php');
?>

<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$('#form_cadastro').validate({
		rules:{
			// O campo Nome � de preenchimento obrigat�rio (required)
			CADnome:{
				required: true
			},
			// O campo CEP � de preenchimento obrigat�rio (required) e tamanho m�nimo de 8 caracteres
			CADcep:{
				required: true,
				minlength: 8
			},
			// O campo Email � de preenchimento obrigat�rio (required) e o email precisa ser v�lido
			CADemail:{
				required: true,
				email: true
			},
			// O campo Senha � de preenchimento obrigat�rio (required)
			CADsenha: {
				required: true
			},
			CADcpf: {
				required: true
			},
			// O campo Confirma Senha � de preenchimento obrigat�rio (required) 
			// e deve ser igual ao campo Senha (equalTo)
			CADconfsenha:{
				required: true,
				equalTo: "#CADsenha"
			},
			// O campo Termo � de preenchimento obrigat�rio (required) 
			//termo: "required"
		},
		// Aqui ficam as mensagens de erro das regras acima,
		// que ser�o apresentadas caso alguma regra seja desobedecida
		messages:{
			CADnome:{
				required: "Ops! Nome obrigat�rio."
			},
			CADcep:{
				required: "Ops! CEP obrigat�rio.",
				minlength: "M�nimo 8 caracteres."
			},
			CADemail: {
				required: "Ops! Email obrigat�rio.",
				email: "Digite um email valido."
			},
			CADsenha: {
				required: "Senha obrigat�ria."
			},
			CADcpf: {
				required: "CPF obrigat�rio."
			},
			CADconfsenha:{
				required: "Confirma Senha obrigat�ria.",
				equalTo: "Ops! Senhas n�o conferem."
			},
			termo: "� necess�rio aceitar os termos de uso."
		}

	});
});
</script>
<!-- HTML - Fun��o javascript de m�scara de campos de formul�rios -->
<script language="javascript" type="text/javascript">
jQuery(function ($) {
	$("#CADnasc").mask("99/99/9999");
	$("#CADfone").mask("(99) 9999-9999");

	$("#CADcpf").mask("999.999.999-99");
	$("#CADcnpj").mask("99.999.999/9999-99");
	$("#CADcep").mask("99999999");

	$("#CADcelular").focusout(function () {
		var phone, element;
		element = $(this);
		element.unmask();
		phone = element.val().replace(/\D/g, '');
		if (phone.length > 10) {
			element.mask("(99) 99999-999?9");
		} else {
			element.mask("(99) 9999-9999?9");
		}
	}).trigger('focusout');
});
</script>
<script language="javascript" type="text/javascript">
	$(function () {
		$('#CADestado').change(function () {
			if ($(this).val()) {
				$('#CADcidade').hide();
				$('.carregando').show();
				$.getJSON('cidades.ajax.php?search=', {
					id_estado: $(this).val(),
					ajax: 'true',
				}, function (j) {
					var options = '<option ></option>';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].id_cidade + '">' + j[i].nome + '</option>';
					}
					$('#CADcidade').html(options).show();
					$('.carregando').hide();
				});
			} else {
				$('#CADcidade').html('<option > >> Escolha um estado v�lido << </option>');
			}
		});
	});
</script>
<script language="javascript" type="text/javascript">
$(function () {
	$('#CADcpf').focusout(function () {
		if ($(this).val()) {
			var txt_cpf = $(this).val();
			var CPF = "";
			for (nn = 1; nn <= txt_cpf.length; nn++) {
				if (isNaN(txt_cpf.substring(nn-1,nn)) == false) {
					CPF += txt_cpf.substring(nn-1,nn);
				}
			}
			if (CPF.length < 11) {
				document.getElementById("CADcpf").value = "";
				$(this).focus();
				alert("Ops! CPF incompleto. \n\n Por favor, digite os 11 d�gitos do CPF.");
				return false;
			}
			if (CPF.length == 11 && TestaCPF(CPF) == false) {
				document.getElementById("CADcpf").value = "";
				$(this).focus();
				alert("Ops! CPF (" + txt_cpf + ") inv�lido. \n\n Por favor, verifique e digite novamente.");
				return false;
			}
		}
	}).trigger('focusout');
});
</script>
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
			<h2>Cadastro de Correspondente</h2>
<?php
if ($id_correspondente == "") {
?>
			<p style="margin-top:10px;">Cadastro para Advogados, Bachareis em Direito e Estagi�rios. Inclua seus dados e ofere�a agora mesmo seus servi�os!</p>
<?php
} else {
?>
			<p style="margin-top:10px;">Confira seus dados para oferecer melhor os seus servi�os!</p>
<?php
}
//Define dados do formul�rio
$pagina = "contato";
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
$numendereco = "";
$CADcomp = "";
$CADcep = "";
$CADbairro = "";
$CADcidade = "";
$CADestado = "";

//Atribui vari�vel
$id_correspondente = $_SESSION['idlogadoache'];

if ($id_correspondente > 0) {
	$txt_sql_correspondente = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `id` = " . $id_correspondente . ";";
	$sql_correspondente = mysqli_query($conn, $txt_sql_correspondente);
	while ($tbl_correspondente = mysqli_fetch_array($sql_correspondente)) {
		$CADnome = $tbl_correspondente['nome'];
		$CADemail = $tbl_correspondente['email'];
		$CADsenha = $tbl_correspondente['senha'];
		$CADconfsenha = $tbl_correspondente['senha'];
		$CADnasc = date('d/m/Y', strtotime($tbl_correspondente['dtnascimento']));
		$CADfone = $tbl_correspondente['fonefixo'];
		$CADcelular = $tbl_correspondente['fonecelular'];
		$CADcpf = $tbl_correspondente['cpf'];
		$CADcnpj = $tbl_correspondente['cnpj'];
		$CADend = $tbl_correspondente['endereco'];
		$numendereco = $tbl_correspondente['numendereco'];
		$CADcomp = $tbl_correspondente['complemento'];
		$CADcep = $tbl_correspondente['cep'];
		$CADbairro = $tbl_correspondente['bairro'];
		$CADcidade = $tbl_correspondente['id_cidade'];
	}
}
?>
			<form action="dados_profissionais.php" method="post" id="form_cadastro" class="form">
				<input type="hidden" id="pagina" name="pagina" value="<?=$pagina;?>"/>
				<div class="box_form">
					<p><label for="CADnome">Nome</label><br/>
					<input type="text" id="CADnome" name="CADnome" value="<?=$CADnome;?>"/>
					</p><br/>
					<p class="menor" style="width: 50%;"><label for="CADcpf">CPF</label><br/>
					<input type="text" id="CADcpf" name="CADcpf" value="<?=$CADcpf;?>"/>
					</p>
					<p class="menor" style="width: 50%;"><label for="CADcnpj">CNPJ</label><br/>
					<input type="text" id="CADcnpj" name="CADcnpj" value="<?=$CADcnpj;?>"/>
					</p><br/>
					<p><label for="CADemail">E-mail</label><br/>
					<input type="text" id="CADemail" name="CADemail" value="<?=$CADemail;?>"/>
					</p><br/>
					<p class="menor" style="width: 50%;"><label for="CADsenha">Senha</label><br/>
					<input type="password" id="CADsenha" name="CADsenha" value="<?=$CADsenha;?>"/>
					</p>
					<p class="menor" style="width: 50%;"><label for="CADconfsenha">Confirmar de Senha</label><br/>
					<input type="password" id="CADconfsenha" name="CADconfsenha" value="<?=$CADconfsenha;?>"/>
					</p><br/>
					<p><label for="CADnasc">Data Nascimento</label><br/>
					<input type="text" name="CADnasc" id="CADnasc" value="<?=$CADnasc;?>"/>
					</p><br/>
					<p class="menor" style="width: 50%;"><label for="CADfone">Telefone</label><br/>
					<input type="text" id="CADfone" name="CADfone" value="<?=$CADfone;?>"/>
					</p>
					<p class="menor" style="width: 50%;"><label for="CADcelular">Celular</label><br/>
					<input type="text" id="CADcelular" name="CADcelular" value="<?=$CADcelular;?>"/>
					</p>
				</div>

				<div class="box_form">
					<p class="menor" style="width: 85%;"><label for="CADend">Endere�o</label><br/>
					<input type="text" id="CADend" name="CADend" value="<?=$CADend;?>"/>
					</p>
					<p class="menor" style="width: 15%;"><label for="numendereco">N�mero</label><br/>
					<input type="text" name="numendereco" id="numendereco" maxlength="7" value="<?=$numendereco;?>"/>
					</p><br/><br/>
					<p class="menor" style="width: 70%;"><label for="CADcomp">Complemento</label><br/>
					<input type="text" id="CADcomp" name="CADcomp" value="<?=$CADcomp;?>"/>
					</p>
					<p class="menor" style="width: 30%;"><label for="CADcep">CEP</label><br/>
					<input type="text" id="CADcep" name="CADcep" value="<?=$CADcep;?>"/>
					</p><br/><br/>
					<p><label for="CADbairro">Bairro</label><br/>
					<input type="text" id="CADbairro" name="CADbairro" value="<?=$CADbairro;?>"/>
					</p><br/>
					<p class="menor" style="width: 70%;"><label for="CADcidade">Cidade *</label><br/>
					<select name="CADcidade" id="CADcidade" class="box_select_registro">
						<option disabled>vv Selecione abaixo a Cidade vv</option>
						<option disabled></option>
<?php
$txt_sql_cidade_correspondente = "SELECT * FROM `$banco_de_dados`.`cidades` WHERE `id`=$CADcidade;";
$sql_cidade_correspondente = mysqli_query($conn,$txt_sql_cidade_correspondente);
$cidade_correspondente = mysqli_fetch_array($sql_cidade_correspondente);
$id_estado_cidade = $cidade_correspondente['id_estado'];

$txt_sql_cidades_estado_correspondente = "SELECT * FROM `$banco_de_dados`.`cidades` WHERE `id_estado`=$id_estado_cidade ORDER BY `nome`;";
$sql_cidades_estado_correspondente = mysqli_query($conn,$txt_sql_cidades_estado_correspondente);

$txt_vazio = ">> Nenhum <<";
if ($id_estado_cidade == "") {
	$txt_vazio = ">> Selecione um Estado primeiro <<";
}
$algum_selecionado = " selected";
while ($cidades_estado_correspondente = mysqli_fetch_array($sql_cidades_estado_correspondente)) {
	$id_cidade_estado_correspondente = $cidades_estado_correspondente['id'];
	$nome_cidade_estado_correspondente = $cidades_estado_correspondente['nome'];
	$selecionado = "";
	if ($id_cidade_estado_correspondente == $CADcidade) {
		$selecionado = " selected";
		$algum_selecionado = "";
	}
	echo '						<option value="' . $id_cidade_estado_correspondente . '"' . $selecionado . '>' . $nome_cidade_estado_correspondente . '</option>';
}
?>
						<option value=""<?php echo $algum_selecionado; ?>> <?php echo $txt_vazio; ?> </option>
					</select><br/>
					<span class="obs"><a href="contato.php" target="_blank">* Minha cidade n�o est� aqui.</a></span>
					</p>
					<p class="menor" style="width: 30%;"><label for="CADestado">Estado</label><br/>
					<select name="CADestado" id="CADestado" class="box_select_registro">
						<option disabled>vv Selecione abaixo o Estado vv</option>
						<option disabled></option>
<?php
$algum_selecionado = " selected";
while ($linha = mysqli_fetch_array($sql_estados)) {
	$selecionado = '';
	if ($id_estado_cidade == $linha['id']) {
		$selecionado = ' selected';
		$algum_selecionado = "";
	}
	echo '						<option value="' . $linha['id'] . '"' . $selecionado . '>' . $linha['nome'] . '</option>';
}
?>
						<option value=""<?php echo $algum_selecionado; ?>> >> Nenhum << </option>
					</select>
					</p><br/>
					<p style="margin-top:30px;"><input type="submit" value="CONTINUAR*" class="bt_form"/></p>
					<?php echo $termos_de_uso; ?>
				</div>
			</form>
		</div>
	</section><br/>
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
