<?php
header("Content-type: text/html; charset=iso-8859-1\r\n",true);
$emailsender = "contato@achecorrespondentes.com.br";

/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
 
// Passando os dados obtidos pelo formulário para as variáveis abaixo
$nome = $_POST['CONnome'];
$email = $_POST['CONemail'];
$fonefixo = $_POST['CONfone'];
$fonecelular = $_POST['CONcelular'];
$cidade = $_POST['CONcidade'];
$estado = $_POST['CADestado'];
$mensagem = $_POST['CONmsg'];
$n1 = $_POST['n1'];
$n2 = $_POST['n2'];
$somaauto = $n1 + $n2;
$soma = $_POST['soma'];

if ($somaauto <> $soma) {
	header("Location:contato.php?msg=errosoma");
	exit();
}

$nomeremetente = $nome;
$emailremetente = $email;
$emaildestinatario = "contato@achecorrespondentes.com.br";
$comcopia = "";
$comcopiaoculta = "fabio@pullindearaujo.com.br,$email";
$assunto = "Formulario de Contato - Achecorrespondentes.com.br";

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<table width="512" border="0" cellpadding="0" cellspacing="0">
<!--DWLayoutTable-->
<tr>
<td width="16" height="589" valign="top" bgcolor="#CCCCCC"><!--DWLayoutEmptyCell-->&nbsp;</td>
<td width="200" valign="top" bgcolor="#CCCCCC"><p class="style1">Ol&aacute; Dr. Fabio,</p>
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
	header("Location:index.php?msg=emailcontatook");
	exit();
} else {
	header("Location:index.php?msg=errocontato");
	exit();
}
 
/* Mostrando na tela as informações enviadas por e-mail */
/*print "Mensagem <b>$assunto</b> enviada com sucesso!<br><br>
De: $emailsender<br>
Para: $emaildestinatario<br>
Com cópia: $comcopia<br>
Com cópia Oculta: $comcopiaoculta
<p><a href='".$_SERVER["HTTP_REFERER"]."'>Voltar</a></p>"*/
?>