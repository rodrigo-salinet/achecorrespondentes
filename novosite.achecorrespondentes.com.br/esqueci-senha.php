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
Inclui arquivo PHP de tags iniciais HTML
*/
include_once('lib/html_msg.php');

/*
Inclui arquivo PHP de configurações de cabeçalho <head>
*/
include_once('lib/configuracoes.php');
?>
<script language="javascript" type="text/javascript">
	$(document).ready (function(){ 
		$("#SENnasc").mask("99/99/9999");
		$("#SENcpf").mask("999.999.999-99"); 
	});
</script>
<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$('#form_senha').validate({
			rules:{
				SENemail:{
					required: true
				},
				SENnasc:{
					required: true
				},
				SENcpf:{
					required: true
				},
				soma:{
					required: true
				},
			},
			messages:{
				SENemail:{
					required: "Ops! Digite um email válido."
				},
				SENnasc:{
					required: "Ops! Digite a data de nascimento respectiva."
				},
				SENcpf:{
					required: "Ops! Digite o CPF respectivo."
				},
				soma:{
					required: "Ops! Digite a soma dos número acima."
				},
			}
		});
	});
</script>
<script language="javascript" type="text/javascript">
$(function () {
	$('#SENcpf').focusout(function () {
		if ($(this).val()) {
			var txt_cpf = $(this).val();
			var CPF = "";
			for (nn = 1; nn <= txt_cpf.length; nn++) {
				if (isNaN(txt_cpf.substring(nn-1,nn)) == false) {
					CPF += txt_cpf.substring(nn-1,nn);
				}
			}
			if (CPF.length < 11) {
				document.getElementById("SENcpf").value = "";
				$(this).focus();
				alert("Ops! CPF incompleto. \n\n Por favor, digite os 11 dígitos do CPF.");
				return false;
			}
			if (CPF.length == 11 && TestaCPF(CPF) == false) {
				document.getElementById("SENcpf").value = "";
				$(this).focus();
				alert("Ops! CPF (" + txt_cpf + ") inválido. \n\n Por favor, verifique e digite novamente.");
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
Inclui arquivo PHP do topo da página
*/
include_once('lib/topo.php');

$n1 = rand(1,10);
$n2 = rand(1,10);
?>

<section id="conteudo_interno">
	<div class="center">
		<h2>Esqueci Minha Senha</h2>
		<p style="margin-top:10px;">Insira abaixo os dados para receber sua senha por e-mail.</p>

		<form action="recupera-senha.php" method="post" id="form_senha" class="form">
			<input type="hidden" name="n1" value="<?php echo $n1; ?>" />
			<input type="hidden" name="n2" value="<?php echo $n2; ?>" />
			<p><label for="SENemail">E-mail</label><br/>
				<input type="text" name="SENemail" id="SENemail" /></p>
			<p class="menor" style="width: 50%"><label for="SENnasc">Data de Nascimento</label><br/>
				<input type="text" name="SENnasc" id="SENnasc" /></p>
			<p class="menor" style="width: 50%"><label for="SENcpf">CPF</label><br/>
				<input type="text" name="SENcpf" id="SENcpf"/></p>
			<p><label for="soma">Some* <?php echo $n1; ?> + <?php echo $n2; ?></label><br/>
				<input type="text" name="soma" id="soma"/><br/>
				<span style="font-size: 10px;">*Não sou um robô.</span></p>
			<p style="margin-top:30px;"><input type="submit" value="RECUPERAR SENHA" class="bt_form"/></p>
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
