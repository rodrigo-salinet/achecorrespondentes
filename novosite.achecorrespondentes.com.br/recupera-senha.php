<?php
header("Content-type: text/html; charset=iso-8859-1\r\n",true);

if (!isset($_POST['SENemail'])) {
	header("Location:esqueci-senha.php?msg=emailinvalido");
	exit();
} else {
	if ($_POST['SENemail'] == "") {
		header("Location:esqueci-senha.php?msg=emailinvalido");
		exit();
	}
}

/*
Inclui arquivo PHP de conexão ao banco de dados
*/
include_once('lib/conecta.php');

/*
Inclui arquivo PHP de funções PHP
*/
include_once('lib/funcoes.php');

// Passando os dados obtidos pelo formulário para as variáveis abaixo
$n1 = intval($_POST['n1']);
$n2 = intval($_POST['n2']);
$soma = intval($_POST['soma']);

if (($n1 + $n2) != $soma) {
	header("Location:esqueci-senha.php?msg=errosoma");
	exit();
}

$email = $_POST['SENemail'];
$data = explode('/',$_POST['SENnasc']);
$dtnascimento = $data[2] . '-' . $data[1] . '-' . $data[0];
$cpf = $_POST['SENcpf'];

//Verifica a existência do usuário no Banco de Dados
$txt_sql_logar = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `email` = '$email' AND `dtnascimento` = '$dtnascimento' AND `cpf` = '$cpf';";
$sql_logar = mysqli_query($conn,$txt_sql_logar);

//Verifica se n existe uma linha com o login digitado
if (mysqli_num_rows($sql_logar) == 0){
	header("Location:esqueci-senha.php?msg=cadinvalido");
	exit();
} else {
	while($dados_correspondente = mysqli_fetch_object($sql_logar)) {
		$nomecorrespondente = $dados_correspondente->nome; 	
		$senha = $dados_correspondente->senha; 	
	}
	$emailsender = "contato@achecorrespondentes.com.br";

	/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
	if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
	elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
	else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

	$nomeremetente = "Ache Correspondentes";
	$emailremetente = "contato@achecorrespondentes.com.br";
	$emaildestinatario = $email;
	$comcopia = "";
	$comcopiaoculta = "";
	$assunto = "Recuperacao de Senha - Achecorrespondentes.com.br";
	$mensagem = "";

	/* Montando a mensagem a ser enviada no corpo do e-mail. */
	$mensagemHTML = '<table width="650" border="0" cellpadding="0" cellspacing="0">
		<!--DWLayoutTable-->
		<tr>
		<td width="16" height="150" valign="top" bgcolor="#CCCCCC"><!--DWLayoutEmptyCell-->&nbsp;</td>
		<td width="200" valign="top" bgcolor="#CCCCCC"><p class="style1">Ol&aacute; '.$nomecorrespondente.',</p>
		<p class="style1">Segue abaixo sua senha cadastrada em nosso site.<br />
		<br />
		<p>Nome: <strong>'.$nomecorrespondente.'</strong></p>
			<p>E-Mail: <strong>'.$email.'</strong></p>
			<p>Senha: <strong>'.$senha.'</strong></p>
		</td>
		<td width="2" valign="top" bgcolor="#CCCCCC"><!--DWLayoutEmptyCell-->&nbsp;</td>
		</tr>
		<tr>
		<td height="42" colspan="3" align="center" valign="middle" bgcolor="#CCCCCC"><span class="style5">ACHE CORRESPONDENTES<br />
		<a href="http://www.achecorrespondentes.com.br">www.achecorrespondentes.com.br</a></span></td>
		</tr>
		</table>';

	/* Montando o cabeçalho da mensagem */
	$headers = "MIME-Version: 1.1".$quebra_linha;
	$headers .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
	// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
	$headers .= "From: ".$emailsender.$quebra_linha;
	$headers .= "Return-Path: " . $emailsender . $quebra_linha;
	// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
	// Se não houver um valor, o item não deverá ser especificado.
	if(strlen($comcopia) > 0) $headers .= "Cc: ".$comcopia.$quebra_linha;
	if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
	$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
	// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

	/* Enviando a mensagem */
	if (mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender)) {
		header("Location:esqueci-senha.php?msg=emailsenhaok");
		exit();
	} else {
		header("Location:esqueci-senha.php?msg=errocontato");
		exit();
	}

	/* Mostrando na tela as informações enviadas por e-mail */
	/*print "Mensagem <b>$assunto</b> enviada com sucesso!<br><br>
	De: $emailsender<br>
	Para: $emaildestinatario<br>
	Com cópia: $comcopia<br>
	Com cópia Oculta: $comcopiaoculta
	<p><a href='".$_SERVER["HTTP_REFERER"]."'>Voltar</a></p>"*/
}
?>