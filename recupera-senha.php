<?php
include("adm/includes/conecta.php");

// Passando os dados obtidos pelo formulário para as variáveis abaixo
$email = $_POST['SENemail'];
$dtnascimento = $_POST['SENnasc'];
$dtnascimento = substr($dtnascimento,6,4)."-".substr($dtnascimento,3,2)."-".substr($dtnascimento,0,2); 		
$cpf = $_POST['SENcpf'];

//Verifica a existência do usuário no Banco de Dados
$sql_logar = "SELECT * FROM `correspondentes` WHERE email = '$email' && dtnascimento = '$dtnascimento' && cpf = '$cpf'";
$exe_logar = mysql_query($sql_logar) or die (mysql_error());
$num_logar = mysql_num_rows($exe_logar);

while($dados_correspondente = mysql_fetch_object($exe_logar)) {;
$nomecorrespondente = $dados_correspondente->nome; 	
$senha = $dados_correspondente->senha; 	
};

//Verifica se n existe uma linha com o login digitado
if ($num_logar == 0){
header("Location:esqueci-senha.php?msg=erro");
} else {

$emailsender = "contato@achecorrespondentes.com.br";
 
/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
 


$nomeremetente     = "Ache Correspondentes";
$emailremetente    = "contato@achecorrespondentes.com.br";
$emaildestinatario = $email;
$comcopia          = "";
$comcopiaoculta    = "";
$assunto           = "Recuperacao de Senha - Achecorrespondentes.com.br";
$mensagem          = "";
 
 
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
mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
 
/* Mostrando na tela as informações enviadas por e-mail */
/*print "Mensagem <b>$assunto</b> enviada com sucesso!<br><br>
De: $emailsender<br>
Para: $emaildestinatario<br>
Com cópia: $comcopia<br>
Com cópia Oculta: $comcopiaoculta
<p><a href='".$_SERVER["HTTP_REFERER"]."'>Voltar</a></p>"*/
header("Location:esqueci-senha.php?msg=emailsenhaok");
};
?>