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

$n1 = rand( 1, 10 );
$n2 = rand( 1, 10 );
$soma = $n1 + $n2;
//echo $n1."<br>".$n2."<br>".$soma;
?>
<!-- HTML - Função javascript de máscara de campos de formulários -->
<script language="javascript" type="text/javascript">
jQuery(function ($) {
	$("#CONfone").mask("(99) 9999-9999");
	$("#CONcelular").focusout(function () {
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
			<h2>Contato</h2>
			<p style="margin-top:10px;">Para entrar em contato conosco, preencha corretamente o formulário abaixo.</p>
			<form action="contato_enviar.php" method="post" id="form_contato" class="form">
				<input type="hidden" name="n1" id="n1" value="<?php echo $n1; ?>"/>
				<input type="hidden" name="n2" id="n2" value="<?php echo $n2; ?>"/>
				<p><label for="CONnome">Nome</label><br/>
					<input type="text" name="CONnome" id="CONnome"/>
				</p>
				<div style="clear:both"></div>
				<p><label for="CONemail">E-mail</label><br/>
					<input type="text" name="CONemail" id="CONemail"/>
				</p>
				<div style="clear:both"></div>
				<p class="menor"><label for="CONfone">Telefone</label><br/>
					<input type="text" name="CONfone" id="CONfone"/>
				</p>
				<p class="menor"><label for="CONcelular">Celular</label><br/>
					<input type="text" name="CONcelular" id="CONcelular"/>
				</p>
				<div style="clear:both"></div>
				<p><label for="CONcidade">Cidade</label><br/>
					<input type="text" name="CONcidade" id="CONcidade"/>
				</p>
				<div style="clear:both"></div>
				<p><label for"CADestado">Estado</label><br/>
					<select name="CADestado" id="CADestado" class="box_select_registro">
						<option disabled> vv Selecione abaixo o Estado vv</option>
						<option disabled></option>
<?php
while ( $linha = mysqli_fetch_array( $sql_estados ) ) {
	echo '						<option value="' . $linha[ 'sigla' ] . '">' . $linha[ 'nome' ] . '</option>';
}
?>

						<option selected> >> Nenhum << </option>
					</select>
				</p>
				<div style="clear:both"></div>
				<p><label for="CONmsg">Mensagem</label><br/>
					<textarea name="CONmsg" id="CONmsg"></textarea>
				</p>
				<div style="clear:both"></div>
				<p><label for="soma">Some <?php echo "$n1 + $n2"; ?>:</label><br/>
					<input type="text" name="soma" id="soma"/>
				</p>
				<div style="clear:both"></div>
				<p><input type="submit" value="ENVIAR" class="bt_form"/></p>
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
