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

$emailsender = "contato@achecorrespondentes.com.br";

/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

// Passando os dados obtidos pelo formulário para as variáveis abaixo
$nome_destinatario = $_POST['nome_destinatario'];
$id_destinatario = $_POST['id_destinatario'];
$email_destinatario = $_POST['email_destinatario'];
$nome = $_POST['CONnome'];
$email = $_POST['CONemail'];
$fonefixo = $_POST['CONfone'];
$fonecelular = $_POST['CONcelular'];
$cidade = $_POST['CONcidade'];
$estado = $_POST['CONestado'];
$mensagem = $_POST['CONmsg'];

$pagina = "contato_correspondente.php";
$vars = "?msg=emailcontatook";
if (isset($_GET['ativar'])) {
	$pagina = "index.php";
	$vars = "?msg=emailok";
	$ativar = trim(anti_injection($_GET['ativar']));
	$txt_sql_correspondente = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `hash`='$ativar';";
	$sql_correspondente = mysqli_query($conn,$txt_sql_correspondente);
	if (mysqli_num_rows($sql_correspondente) == 1) {
		$correspondente = mysqli_fetch_array($sql_correspondente);

		$nome_destinatario = "Correspondente.";
		$id_destinatario = $correspondente['id'];
		$email_destinatario = $correspondente['email'];
		$nome = $correspondente['nome'];
		$email = $correspondente['email'];
		$fonefixo = $correspondente['fonefixo'];
		$fonecelular = $correspondente['fonecelular'];
		$id_cidade = $correspondente['id_cidade'];

		$txt_sql_cidade_correspondente = "SELECT * FROM `$banco_de_dados`.`cidades` WHERE `id`=$id_cidade;";
		$sql_cidade_correspondente = mysqli_query($conn,$txt_sql_cidade_correspondente);
		$cidade_correspondente = mysqli_fetch_array($sql_cidade_correspondente);
		$cidade = $cidade_correspondente['nome'];
		$id_estado = $cidade_correspondente['id_estado'];
		mysqli_free_result($sql_cidade_correspondente);

		$txt_sql_estado_correspondente = "SELECT * FROM `$banco_de_dados`.`estados` WHERE `id`=$id_estado;";
		$sql_estado_correspondente = mysqli_query($conn,$txt_sql_estado_correspondente);
		$estado_correspondente = mysqli_fetch_array($sql_estado_correspondente);
		$estado = $estado_correspondente['sigla'];
		mysqli_free_result($sql_estado_correspondente);

		$mensagem = 'Para ativar seu cadastro, <a href="http://www.achecorrespondentes.com.br/novosite/dados_profissionais.php?ativar=' . $ativar . '">CLIQUE AQUI</a> ou UTILIZE (copie [e cole em seu navegador]) o link a seguir: http://www.achecorrespondentes.com.br/novosite/dados_profissionais.php?ativar=' . $ativar;
	} else {
		header("Location:index.php?msg=semcadastro");
		exit();
	}
	mysqli_free_result($sql_correspondente);
}

$emailremetente = "contato@achecorrespondentes.com.br";
$comcopia = "";
$comcopiaoculta = "fabio@pullindearaujo.com.br,$email";
$assunto = "Formulario de Contato - Achecorrespondentes.com.br";

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<table width="512" border="0" cellpadding="0" cellspacing="0">
<!--DWLayoutTable-->
<tr>
<td width="16" height="589" valign="top" bgcolor="#CCCCCC"><!--DWLayoutEmptyCell-->&nbsp;</td>
<td width="200" valign="top" bgcolor="#CCCCCC"><p class="style1">Ol&aacute; Sr(a). '.$nome_destinatario.',</p>
<p class="style1">Segue abaixo e-mail recebido pelo site www.achecorrespondentes.com.br<br />
<br />
<p>Nome: <strong>'.$nome.'</strong></p>
<p>E-Mail: <strong>'.$email.'</strong></p>
<p>Fone Fixo: <strong>'.$fonefixo.'</strong></p>
<p>Fone Celular: <strong>'.$fonecelular.'</strong></p>
<p>Cidade: <strong>'.$cidade.'</strong></p>
<p>Estado: <strong>'.$estado.'</strong></p>
<p>Mensagem: <strong>'.$mensagem.'</strong></p>
</td>
<td width="2" valign="top" bgcolor="#CCCCCC"><!--DWLayoutEmptyCell-->&nbsp;</td>
</tr>
<tr>
<td height="42" colspan="3" align="center" valign="middle" bgcolor="#CCCCCC"><span class="style5">ACHE CORRESPONDENTES<br />
<a href="http://www.achecorrespondentes.com.br">www.achecorrespondentes.com.br</a></span></td>
</tr>
</table>';

/* Montando o cabeçalho da mensagem */
$headers = "MIME-Version: 1.1" . $quebra_linha;
$headers .= "Content-type: text/html; charset=iso-8859-1" . $quebra_linha;

// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers .= "From: " . $emailsender . $quebra_linha;
$headers .= "Return-Path: " . $emailsender . $quebra_linha;

// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
// Se não houver um valor, o item não deverá ser especificado.
if(strlen($comcopia) > 0) $headers .= "Cc: " . $comcopia . $quebra_linha;
if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: " . $comcopiaoculta . $quebra_linha;
$headers .= "Reply-To: " . $email . $quebra_linha;

// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

/* Mostrando na tela as informações enviadas por e-mail */
/*print "Mensagem <b>$assunto</b> enviada com sucesso!<br><br>
De: $emailsender<br>
Para: $emaildestinatario<br>
Com cópia: $comcopia<br>
Com cópia Oculta: $comcopiaoculta
<p><a href='".$_SERVER["HTTP_REFERER"]."'>Voltar</a></p>"*/

$dataatual = date('Y-m-d');
$clique = "";
if ($id_destinatario != "") {
	$txt_sql_clique = "INSERT INTO `$banco_de_dados`.`cliques` (`id_correspondente`,`data`) VALUES ($id_destinatario,'$dataatual');";
	if (!mysqli_query($conn,$txt_sql_clique)) {
		$clique = "&clique=erro";
	}
}

if ($email_destinatario != "") {
	/* Enviando a mensagem */
	if (!mail($email_destinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender)) {
		$vars = "?msg=errocontato";
	}
}
header("Location:$pagina$vars$clique");
exit();
?>