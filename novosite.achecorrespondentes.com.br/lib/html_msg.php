<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $title; ?></title>
<?php
$txt_msg = "";
/*
Nesta se��o encontram-se as mensagens de informa��es de login ou senha
*/
if (isset($_GET['msg'])) {
	$msg = trim($_GET['msg']);
	if ($msg == "errologin") {
		$txt_msg = "Ops! E-Mail ou Senha inv�lidos. Por favor, verifique o E-Mail e Senha digitados e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n E-Mail ou Senha inv�lidos. \n\n Por favor, verifique o E-Mail e Senha digitados e tente novamente.";
	</script>
<?php
	} elseif ($msg == "saiu") {
		$txt_msg = "Aten��o: Voc� saiu de sua conta. Para acessar sua conta, digite seu e-mail e senha e clique em ACESSAR.";
?>
	<script language="javascript" type="text/javascript">
		alert("Aten��o: \n\n Voc� saiu de sua conta. \n\n Para acessar sua conta, \n digite seu e-mail e senha e clique em ACESSAR.");
	</script>
<?php
	} elseif ($msg == "semcadastro") {
		$txt_msg = "Ops! Seu registro n�o foi localizado em nosso banco de dados. Ele pode ter sido excluido por informa��es inv�lidas ou por estar vencido, ou ainda porque nunca foi cadastrado. Por favor, cadastre-se novamente ou avise-nos por email: (contato@achecorrespondentes.com.br).";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Seu registro n�o foi localizado em nosso banco de dados. \n\n Ele pode ter sido excluido por informa��es inv�lidas ou por estar vencido, \n ou ainda porque nunca foi cadastrado. \n\n Por favor, cadastre-se novamente ou avise-nos por email: \n (contato@achecorrespondentes.com.br).");
	</script>
<?php
	} elseif ($msg == "desconectado") {
		$txt_msg = "Ops! � preciso acessar sua conta para continuar. Por favor, digite seu email e senha e clique em ACESSAR para utilizar a p�gina desejada.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n � preciso acessar sua conta para continuar. \n\n Por favor, digite seu email e senha e clique em ACESSAR \n\n para utilizar a p�gina desejada.");
	</script>
<?php
	} elseif ($msg == "cadinvalido") {
		$txt_msg = "Ops! Os dados informados n�o conferem com seu cadastro. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Os dados informados n�o conferem com seu cadastro. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg == "cadinativo") {
		$txt_msg = "Ops! Seu email precisa ser validado. Para isso, por favor, verifique sua caixa de entrada de emails e ative j� seu cadastro.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Seu email precisa ser validado. \n\n Para isso, por favor, verifique sua caixa de entrada de emails e ative j� seu cadastro.");
	</script>
<?php
/*
Nesta se��o encontram-se as mensagens de informa��es bem sucedidas
*/
	} elseif ($msg == "cadastrofree") {
		$txt_msg = "Parab�ns! Aproveite seus dias gratuitos em nosso site. A equipe AcheCorrespondentes agradece.";
?>
	<script language="javascript" type="text/javascript">
		alert("Parab�ns! \n\n Aproveite seus dias gratuitos em nosso site. \n\n A equipe AcheCorrespondentes agradece.");
	</script>
<?php
	} elseif ($msg == "cidatexcok") {
		$txt_msg = "Maravilha! Deu tudo certo. A cidade atendida foi removida de seu cadastro.";
?>
	<script language="javascript" type="text/javascript">
		alert("Maravilha! Deu tudo certo. \n\n A cidade atendida foi removida de seu cadastro.");
	</script>
<?php
	} elseif ($msg == "cadcidatok") {
		$txt_msg = "Ok! A cidade atendida foi inclu�da em seu cadastro.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ok! A cidade atendida foi inclu�da em seu cadastro.");
	</script>
<?php
	} elseif ($msg == "cadastrook") {
		$txt_msg = "Muito bem! Seu cadastro foi ativado com sucesso. Agora � s� CONTINUAR e aproveitar nossos servi�os.";
?>
	<script language="javascript" type="text/javascript">
		alert("Muito bem! \n\n Seu cadastro foi ativado com sucesso. \n\n Agora � s� CONTINUAR e aproveitar nossos servi�os.");
	</script>
<?php
	} elseif ($msg == "cidadecadastrada") {
		$txt_msg = "Ops! A cidade j� est� cadastrada. Est� tudo certo.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n A cidade j� est� cadastrada. \n\n Est� tudo certo.");
	</script>
<?php
	} elseif ($msg == "sucesso") {
		$txt_msg = "Maravilha! Deu tudo certo.";
?>
	<script language="javascript" type="text/javascript">
		alert("Maravilha! Deu tudo certo.");
	</script>
<?php
	} elseif ($msg == "dadosprofok") {
		$txt_msg = "Maravilha! Deu tudo certo. Seus Dados Profissionais foram atualizados com sucesso.";
?>
	<script language="javascript" type="text/javascript">
		alert("Maravilha! Deu tudo certo. \n\n Seus Dados Profissionais foram atualizados com sucesso.");
	</script>
<?php
	} elseif ($msg == "cadok") {
		$txt_msg = "Maravilha! Deu tudo certo. Seu cadastro foi atualizado com sucesso.";
?>
	<script language="javascript" type="text/javascript">
		alert("Maravilha! Deu tudo certo. \n\n Seu cadastro foi atualizado com sucesso.");
	</script>
<?php
/*
Nesta se��o encontram-se as mensagens de erros de cadastro j� encontrado
*/
	} elseif ($msg == "erroemail") {
		$txt_msg = "Ops! O E-Mail informado j� consta em nossa base de dados. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O E-Mail informado j� consta em nossa base de dados. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg == "errocpf") {
		$txt_msg = "Ops! O CPF informado j� existe em nosso banco de dados. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O CPF informado j� existe em nosso banco de dados. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg == "errocnpj") {
		$txt_msg = "Ops! O CNPJ informado j� consta em nosso banco de dados. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O CNPJ informado j� consta em nosso banco de dados. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg == "planog") {
		$txt_msg = "Ops! O Plano Gratuito � concedido apenas uma vez. Por favor, selecione outro plano e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O Plano Gratuito � concedido apenas uma vez. \n\n Por favor, selecione outro plano e tente novamente.");
	</script>
<?php
/*
Nesta se��o encontram-se as mensagens de informa��es de email
*/
	} elseif ($msg == "emailcontatook") {
		$txt_msg = "J� foi! Seu E-mail j� est� com a equipe AcheCorrespondentes. Muito brevemente voc� ser� respondido(a).";
?>
	<script language="javascript" type="text/javascript">
		alert("J� foi! \n\n Seu E-mail j� est� com a equipe AcheCorrespondentes. \n\n Muito brevemente voc� ser� respondido(a).");
	</script>
<?php
	} elseif ($msg == "emailok") {
		$txt_msg = "Pronto! Enviamos um e-mail pra voc�. Acesse-o para ativar seu cadastro. #Dica: \n Verifique em todas as caixas de entrada/spam...";
?>
	<script language="javascript" type="text/javascript">
		alert("Pronto! \n\n Enviamos um e-mail pra voc�. \n\n Acesse-o para ativar seu cadastro. \n\n #Dica: \n Verifique em todas as caixas de entrada/spam...");
	</script>
<?php
	} elseif ($msg == "emailsenhaok") {
		$txt_msg = "Tudo certo! Seus dados foram enviados ao e-mail informado. Por favor, verifique seu e-mail. #Dica: \n Verifique em todas as caixas de entrada/spam...";
?>
	<script language="javascript" type="text/javascript">
		alert("Tudo certo! \n\n Seus dados foram enviados ao e-mail informado. \n\n Por favor, verifique seu e-mail. \n\n #Dica: \n Verifique em todas as caixas de entrada/spam...");
	</script>
<?php
	} elseif ($msg == "emailinvalido") {
		$txt_msg = "Ops! O e-mail informado n�o consta em nosso banco de dados. Por favor, verifique e tente novamente. Se preferir, pode nos avisar por email sobre o ocorrido, email: informatica@achecorrespondentes.com.br";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O e-mail informado n�o consta em nosso banco de dados. \n\n Por favor, verifique e tente novamente. \n\n Se preferir, pode nos avisar por email sobre o ocorrido \n email: informatica@achecorrespondentes.com.br");
	</script>
<?php
/*
Nesta se��o encontram-se as mensagens de erros de banco de dados relativos ao cadastro
*/
	} elseif ($msg == "errocad") {
		$txt_msg = "Ops! Algo deu errado ao atualizar seu cadastro. Por gentileza, informe-nos por email: (informatica@achecorrespondentes.com.br).";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Algo deu errado ao atualizar seu cadastro. \n\n Por gentileza, informe-nos por email: \n (informatica@achecorrespondentes.com.br).");
	</script>
<?php
	} elseif ($msg == "errocadcidat") {
		$txt_msg = "Ops! N�o foi poss�vel cadastrar a cidade atendida. Por favor, tente novamente mais tarde.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n N�o foi poss�vel cadastrar a cidade atendida. \n\n Por favor, tente novamente mais tarde.");
	</script>
<?php
	} elseif ($msg == "errodelcidat") {
		$txt_msg = "Ops! A cidade atendida n�o pode ser removida. Pode ser uma falha do servidor. Por favor, tente novamente mais tarde.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n A cidade atendida n�o pode ser removida. \n\n Pode ser uma falha do servidor. \n\n Por favor, tente novamente mais tarde.");
	</script>
<?php
	} elseif ($msg == "errooab") {
		$txt_msg = "Ops! O N�mero de inscri��o informado, da UF/OAB referida, j� consta em nosso banco de dados. Por favor, verifique o n�mero do registro digitado e a UF da OAB selecionada.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O N�mero de inscri��o informado, \n da UF/OAB referida, j� consta em nosso banco de dados. \n\n Por favor, verifique o n�mero do registro digitado e a UF da OAB selecionada.");
	</script>
<?php
	} elseif ($msg == "errofoto") {
		$txt_msg = "Aten��o: A foto enviada est� em formato inv�lido. O arquivo da foto deve ser: jpg, png ou gif. Por favor, tente enviar outra foto.";
?>
	<script language="javascript" type="text/javascript">
		alert("Aten��o: \n\n A foto enviada est� em formato inv�lido. \n\n O arquivo da foto deve ser: jpg, png ou gif. \n\n Por favor, tente enviar outra foto.");
	</script>
<?php
	} elseif ($msg == "erroimagem") {
		$txt_msg = "Ops! A imagem enviada � muito grande. Por favor, envie uma imagem com tamanho menor, de prefer�ncia inferior a 500Kb.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n A imagem enviada � muito grande. \n\n Por favor, envie uma imagem com tamanho menor, \n de prefer�ncia inferior a 500Kb.");
	</script>
<?php
	} elseif ($msg == "erroupload") {
		$txt_msg = "Ops! Algo saiu errado com o upload da foto. Por favor, tente novamente mais tarde. Ou informe nossa equipe por email: (informatica@achecorrespondentes.com.br).";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Algo saiu errado com o upload da foto. \n\n Por favor, tente novamente mais tarde. \n\n Ou informe nossa equipe por email: \n (informatica@achecorrespondentes.com.br).");
	</script>
<?php
	} elseif ($msg == "errocadplano") {
		$txt_msg = "Ops! N�o foi poss�vel cadastrar o plano escolhido. Pode ser um problema no servidor. Por favor, tente novamente mais tarde.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n N�o foi poss�vel cadastrar o plano escolhido. \n\n Pode ser um problema no servidor. \n\n Por favor, tente novamente mais tarde.");
	</script>
<?php
	} elseif ($msg == "errosenha") {
		$txt_msg = "Ops! Algo saiu errado. N�o foi poss�vel alterar sua senha. Por favor, tente novamente amanh�. Se poss�vel, avise nossa equipe por email: (contato@achecorrespondentes.com.br).";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Algo saiu errado. \n\n N�o foi poss�vel alterar sua senha. \n\n Por favor, tente novamente amanh�. \n\n Se poss�vel, avise nossa equipe por email: \n (contato@achecorrespondentes.com.br).");
	</script>
<?php
	} elseif ($msg == "erro") {
		$txt_msg = "Ops! Algo saiu errado. Por favor, tente novamente amanh�. Se poss�vel, avise nossa equipe por email: (contato@achecorrespondentes.com.br).";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Algo saiu errado. \n\n Por favor, tente novamente amanh�. \n\n Se poss�vel, avise nossa equipe por email: \n (contato@achecorrespondentes.com.br).");
	</script>
<?php
	} elseif ($msg == "errosoma") {
		$txt_msg = "Ops! A soma dos valores informados � inv�lida. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n A soma dos valores informados � inv�lida. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg == "errocontato") {
		$txt_msg = "Ops! O email n�o p�de ser enviado no momento. Pode ser uma falha do servidor. Por favor, tente novamente amanh�.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O email n�o p�de ser enviado no momento. \n\n Pode ser uma falha do servidor. \n\n Por favor, tente novamente amanh�.");
	</script>
<?php
	} elseif ($msg == "maxcidade") {
		$txt_msg = "Ops! Voc� j� cadastrou o n�mero m�ximo de cidades atendidas contratadas, conforme o plano adquirido. Para cadastrar mais cidades, adquira j� mais algum dos Planos oferecidos.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Voc� j� cadastrou o n�mero m�ximo de cidades atendidas contratadas, conforme o plano adquirido. \n\n Para cadastrar mais cidades, adquira j� mais algum dos Planos oferecidos.");
	</script>
<?php
	} elseif ($msg == "maxdest") {
		$txt_msg = "Ops! Voc� j� cadastrou o n�mero m�ximo de cidades destaque contratadas, conforme o plano adquirido. Para cadastrar mais cidades destaques, adquira j� mais algum dos Planos oferecidos.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Voc� j� cadastrou o n�mero m�ximo de cidades destaque contratadas, conforme o plano adquirido. \n\n Para cadastrar mais cidades destaques, adquira j� mais algum dos Planos oferecidos.");
	</script>
<?php
	} elseif ($msg == "semplano") {
		$txt_msg = "Ops! Parece que voc� ainda n�o selecionou algum Plano. Por favor, selecione algum dos Planos oferecidos e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Parece que voc� ainda n�o selecionou algum Plano. \n\n Por favor, selecione algum dos Planos oferecidos e tente novamente.");
	</script>
<?php
	} elseif ($msg == "vencido") {
		$txt_msg = "Ops! Parece que seu Plano venceu. Por favor, compre algum dos Planos oferecidos para renovar seus servi�os como correspondente. N�o perda tempo e renove j� seu Plano.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Parece que seu Plano venceu. \n\n Por favor, compre algum dos Planos oferecidos \n para renovar seus servi�os como correspondente. \n\n N�o perda tempo e renove j� seu Plano.");
	</script>
<?php
	} elseif ($msg == "planoinvalido") {
		$txt_msg = "Ops! Parece que o Plano no qual voc� est� vinculado expirou ou foi modificado. Por favor, verifique seus pagamentos e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Parece que o Plano no qual voc� est� vinculado expirou ou foi modificado. \n\n Por favor, verifique seus pagamentos e tente novamente.");
	</script>
<?php
	} elseif ($msg == "planonaovigente") {
		$txt_msg = "Ops! N�o foi permitido inserir a cidade escolhida, porque seu plano n�o est� vigente ainda. Por favor, verifique seus pagamentos e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n N�o foi permitido inserir a cidade escolhida, \n porque seu plano n�o est� vigente ainda. \n\n Por favor, verifique seus pagamentos e tente novamente.");
	</script>
<?php
	} elseif ($msg == "sempag") {
		$txt_msg = "Ops! O identificador do pagamento n�o foi localizado. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O identificador do pagamento n�o foi localizado. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg == "semcidade") {
		$txt_msg = "Ops! � preciso digitar o nome da cidade. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n � preciso digitar o nome da cidade. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg != "") {
		$txt_msg = $msg;
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Algo saiu errado. \n\n Por favor, tente novamente mais tarde.");
	</script>
<?php
	}
}
if (isset($_GET['clique'])) {
	if ($_GET['clique'] == "erro") {
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Algo saiu errado. \n\n N�o foi poss�vel inserir na tabela cliques.");
	</script>
<?php
	}
}
?>
