<?php
$emailsender = "contato@achecorrespondentes.com.br";

 
/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
 
// Passando os dados obtidos pelo formulário para as variáveis abaixo
$nome = $_POST['nome'];
$email = $_POST['CONemail'];
$fonefixo = $_POST['CONfone'];
$fonecelular = $_POST['CONcelular'];
$cidade = $_POST['CONcidade'];
$estado = $_POST['CONestado'];
$msg = $_POST['CONmsg'];
$emailcorrespondente = $_POST['emailcorrespondente'];
$nomecorrespondente = $_POST['nomecorrespondente'];
$id = $_POST['id'];

$nomeremetente     = $nome;
$emailremetente    = "contato@achecorrespondentes.com.br";
$emaildestinatario = $emailcorrespondente;
$comcopia          = "";
$comcopiaoculta    = "";
$assunto           = "Formulario de Contato - Achecorrespondentes.com.br";
$mensagem          = $_POST['mensagem'];
 
 
/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<table width="512" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="16" height="589" valign="top" bgcolor="#CCCCCC"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="200" valign="top" bgcolor="#CCCCCC"><p class="style1">Ol&aacute; Dr.(a) '.$nomecorrespondente.',</p>
      <p class="style1">Segue abaixo e-mail recebido pelo site www.achecorrespondentes.com.br<br />
      <br />
      <p>Nome: <strong>'.$nome.'</strong></p>
	  <p>E-Mail: <strong>'.$email.'</strong></p>
	  <p>Fone Fixo: <strong>'.$fonefixo.'</strong></p>
	  <p>Fone Celular: <strong>'.$fonecelular.'</strong></p>
	  <p>Cidade: <strong>'.$cidade.'</strong></p>
	  <p>Estado: <strong>'.$estado.'</strong></p>
	  <p>Mensagem: <strong>'.$msg.'</strong></p>
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
$headers .= "Reply-To: ".$email.$quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

/* Enviando a mensagem */
mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
 
/* Mostrando na tela as informações enviadas por e-mail */
/*print "Mensagem <b>$assunto</b> enviada com sucesso!<br><br>
De: $emailsender<br>
Para: $emaildestinatario<br>
Com cópia: $comcopia<br>
Com cópia Oculta: $comcopiaoculta
<p><a href='".$_SERVER["HTTP_REFERER"]."'>Voltar</a></p>"*/


// inclui o arquivo de configuração do sistema
include "adm/includes/conecta.php";
$dataatual = date('Y-m-d');
$sql = "INSERT INTO `cliques` (id_correspondente, data) VALUES ('$id', '$dataatual')";
$consulta = mysql_query($sql);

header("Location:contato_correspondente.php?msg=emailcontatook");
?>