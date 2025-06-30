<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $title; ?></title>
<?php
$txt_msg = "";
/*
Nesta seção encontram-se as mensagens de informações de login ou senha
*/
if (isset($_GET['msg'])) {
	$msg = trim($_GET['msg']);
	if ($msg == "errologin") {
		$txt_msg = "Ops! E-Mail ou Senha inválidos. Por favor, verifique o E-Mail e Senha digitados e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n E-Mail ou Senha inválidos. \n\n Por favor, verifique o E-Mail e Senha digitados e tente novamente.";
	</script>
<?php
	} elseif ($msg == "saiu") {
		$txt_msg = "Atenção: Você saiu de sua conta. Para acessar sua conta, digite seu e-mail e senha e clique em ACESSAR.";
?>
	<script language="javascript" type="text/javascript">
		alert("Atenção: \n\n Você saiu de sua conta. \n\n Para acessar sua conta, \n digite seu e-mail e senha e clique em ACESSAR.");
	</script>
<?php
	} elseif ($msg == "semcadastro") {
		$txt_msg = "Ops! Seu registro não foi localizado em nosso banco de dados. Ele pode ter sido excluido por informações inválidas ou por estar vencido, ou ainda porque nunca foi cadastrado. Por favor, cadastre-se novamente ou avise-nos por email: (contato@achecorrespondentes.com.br).";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Seu registro não foi localizado em nosso banco de dados. \n\n Ele pode ter sido excluido por informações inválidas ou por estar vencido, \n ou ainda porque nunca foi cadastrado. \n\n Por favor, cadastre-se novamente ou avise-nos por email: \n (contato@achecorrespondentes.com.br).");
	</script>
<?php
	} elseif ($msg == "desconectado") {
		$txt_msg = "Ops! É preciso acessar sua conta para continuar. Por favor, digite seu email e senha e clique em ACESSAR para utilizar a página desejada.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n É preciso acessar sua conta para continuar. \n\n Por favor, digite seu email e senha e clique em ACESSAR \n\n para utilizar a página desejada.");
	</script>
<?php
	} elseif ($msg == "cadinvalido") {
		$txt_msg = "Ops! Os dados informados não conferem com seu cadastro. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Os dados informados não conferem com seu cadastro. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg == "cadinativo") {
		$txt_msg = "Ops! Seu email precisa ser validado. Para isso, por favor, verifique sua caixa de entrada de emails e ative já seu cadastro.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Seu email precisa ser validado. \n\n Para isso, por favor, verifique sua caixa de entrada de emails e ative já seu cadastro.");
	</script>
<?php
/*
Nesta seção encontram-se as mensagens de informações bem sucedidas
*/
	} elseif ($msg == "cadastrofree") {
		$txt_msg = "Parabéns! Aproveite seus dias gratuitos em nosso site. A equipe AcheCorrespondentes agradece.";
?>
	<script language="javascript" type="text/javascript">
		alert("Parabéns! \n\n Aproveite seus dias gratuitos em nosso site. \n\n A equipe AcheCorrespondentes agradece.");
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
		$txt_msg = "Ok! A cidade atendida foi incluída em seu cadastro.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ok! A cidade atendida foi incluída em seu cadastro.");
	</script>
<?php
	} elseif ($msg == "cadastrook") {
		$txt_msg = "Muito bem! Seu cadastro foi ativado com sucesso. Agora é só CONTINUAR e aproveitar nossos serviços.";
?>
	<script language="javascript" type="text/javascript">
		alert("Muito bem! \n\n Seu cadastro foi ativado com sucesso. \n\n Agora é só CONTINUAR e aproveitar nossos serviços.");
	</script>
<?php
	} elseif ($msg == "cidadecadastrada") {
		$txt_msg = "Ops! A cidade já está cadastrada. Está tudo certo.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n A cidade já está cadastrada. \n\n Está tudo certo.");
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
Nesta seção encontram-se as mensagens de erros de cadastro já encontrado
*/
	} elseif ($msg == "erroemail") {
		$txt_msg = "Ops! O E-Mail informado já consta em nossa base de dados. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O E-Mail informado já consta em nossa base de dados. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg == "errocpf") {
		$txt_msg = "Ops! O CPF informado já existe em nosso banco de dados. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O CPF informado já existe em nosso banco de dados. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg == "errocnpj") {
		$txt_msg = "Ops! O CNPJ informado já consta em nosso banco de dados. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O CNPJ informado já consta em nosso banco de dados. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg == "planog") {
		$txt_msg = "Ops! O Plano Gratuito é concedido apenas uma vez. Por favor, selecione outro plano e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O Plano Gratuito é concedido apenas uma vez. \n\n Por favor, selecione outro plano e tente novamente.");
	</script>
<?php
/*
Nesta seção encontram-se as mensagens de informações de email
*/
	} elseif ($msg == "emailcontatook") {
		$txt_msg = "Já foi! Seu E-mail já está com a equipe AcheCorrespondentes. Muito brevemente você será respondido(a).";
?>
	<script language="javascript" type="text/javascript">
		alert("Já foi! \n\n Seu E-mail já está com a equipe AcheCorrespondentes. \n\n Muito brevemente você será respondido(a).");
	</script>
<?php
	} elseif ($msg == "emailok") {
		$txt_msg = "Pronto! Enviamos um e-mail pra você. Acesse-o para ativar seu cadastro. #Dica: \n Verifique em todas as caixas de entrada/spam...";
?>
	<script language="javascript" type="text/javascript">
		alert("Pronto! \n\n Enviamos um e-mail pra você. \n\n Acesse-o para ativar seu cadastro. \n\n #Dica: \n Verifique em todas as caixas de entrada/spam...");
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
		$txt_msg = "Ops! O e-mail informado não consta em nosso banco de dados. Por favor, verifique e tente novamente. Se preferir, pode nos avisar por email sobre o ocorrido, email: informatica@achecorrespondentes.com.br";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O e-mail informado não consta em nosso banco de dados. \n\n Por favor, verifique e tente novamente. \n\n Se preferir, pode nos avisar por email sobre o ocorrido \n email: informatica@achecorrespondentes.com.br");
	</script>
<?php
/*
Nesta seção encontram-se as mensagens de erros de banco de dados relativos ao cadastro
*/
	} elseif ($msg == "errocad") {
		$txt_msg = "Ops! Algo deu errado ao atualizar seu cadastro. Por gentileza, informe-nos por email: (informatica@achecorrespondentes.com.br).";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Algo deu errado ao atualizar seu cadastro. \n\n Por gentileza, informe-nos por email: \n (informatica@achecorrespondentes.com.br).");
	</script>
<?php
	} elseif ($msg == "errocadcidat") {
		$txt_msg = "Ops! Não foi possível cadastrar a cidade atendida. Por favor, tente novamente mais tarde.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Não foi possível cadastrar a cidade atendida. \n\n Por favor, tente novamente mais tarde.");
	</script>
<?php
	} elseif ($msg == "errodelcidat") {
		$txt_msg = "Ops! A cidade atendida não pode ser removida. Pode ser uma falha do servidor. Por favor, tente novamente mais tarde.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n A cidade atendida não pode ser removida. \n\n Pode ser uma falha do servidor. \n\n Por favor, tente novamente mais tarde.");
	</script>
<?php
	} elseif ($msg == "errooab") {
		$txt_msg = "Ops! O Número de inscrição informado, da UF/OAB referida, já consta em nosso banco de dados. Por favor, verifique o número do registro digitado e a UF da OAB selecionada.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O Número de inscrição informado, \n da UF/OAB referida, já consta em nosso banco de dados. \n\n Por favor, verifique o número do registro digitado e a UF da OAB selecionada.");
	</script>
<?php
	} elseif ($msg == "errofoto") {
		$txt_msg = "Atenção: A foto enviada está em formato inválido. O arquivo da foto deve ser: jpg, png ou gif. Por favor, tente enviar outra foto.";
?>
	<script language="javascript" type="text/javascript">
		alert("Atenção: \n\n A foto enviada está em formato inválido. \n\n O arquivo da foto deve ser: jpg, png ou gif. \n\n Por favor, tente enviar outra foto.");
	</script>
<?php
	} elseif ($msg == "erroimagem") {
		$txt_msg = "Ops! A imagem enviada é muito grande. Por favor, envie uma imagem com tamanho menor, de preferência inferior a 500Kb.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n A imagem enviada é muito grande. \n\n Por favor, envie uma imagem com tamanho menor, \n de preferência inferior a 500Kb.");
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
		$txt_msg = "Ops! Não foi possível cadastrar o plano escolhido. Pode ser um problema no servidor. Por favor, tente novamente mais tarde.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Não foi possível cadastrar o plano escolhido. \n\n Pode ser um problema no servidor. \n\n Por favor, tente novamente mais tarde.");
	</script>
<?php
	} elseif ($msg == "errosenha") {
		$txt_msg = "Ops! Algo saiu errado. Não foi possível alterar sua senha. Por favor, tente novamente amanhã. Se possível, avise nossa equipe por email: (contato@achecorrespondentes.com.br).";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Algo saiu errado. \n\n Não foi possível alterar sua senha. \n\n Por favor, tente novamente amanhã. \n\n Se possível, avise nossa equipe por email: \n (contato@achecorrespondentes.com.br).");
	</script>
<?php
	} elseif ($msg == "erro") {
		$txt_msg = "Ops! Algo saiu errado. Por favor, tente novamente amanhã. Se possível, avise nossa equipe por email: (contato@achecorrespondentes.com.br).";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Algo saiu errado. \n\n Por favor, tente novamente amanhã. \n\n Se possível, avise nossa equipe por email: \n (contato@achecorrespondentes.com.br).");
	</script>
<?php
	} elseif ($msg == "errosoma") {
		$txt_msg = "Ops! A soma dos valores informados é inválida. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n A soma dos valores informados é inválida. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg == "errocontato") {
		$txt_msg = "Ops! O email não pôde ser enviado no momento. Pode ser uma falha do servidor. Por favor, tente novamente amanhã.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O email não pôde ser enviado no momento. \n\n Pode ser uma falha do servidor. \n\n Por favor, tente novamente amanhã.");
	</script>
<?php
	} elseif ($msg == "maxcidade") {
		$txt_msg = "Ops! Você já cadastrou o número máximo de cidades atendidas contratadas, conforme o plano adquirido. Para cadastrar mais cidades, adquira já mais algum dos Planos oferecidos.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Você já cadastrou o número máximo de cidades atendidas contratadas, conforme o plano adquirido. \n\n Para cadastrar mais cidades, adquira já mais algum dos Planos oferecidos.");
	</script>
<?php
	} elseif ($msg == "maxdest") {
		$txt_msg = "Ops! Você já cadastrou o número máximo de cidades destaque contratadas, conforme o plano adquirido. Para cadastrar mais cidades destaques, adquira já mais algum dos Planos oferecidos.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Você já cadastrou o número máximo de cidades destaque contratadas, conforme o plano adquirido. \n\n Para cadastrar mais cidades destaques, adquira já mais algum dos Planos oferecidos.");
	</script>
<?php
	} elseif ($msg == "semplano") {
		$txt_msg = "Ops! Parece que você ainda não selecionou algum Plano. Por favor, selecione algum dos Planos oferecidos e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Parece que você ainda não selecionou algum Plano. \n\n Por favor, selecione algum dos Planos oferecidos e tente novamente.");
	</script>
<?php
	} elseif ($msg == "vencido") {
		$txt_msg = "Ops! Parece que seu Plano venceu. Por favor, compre algum dos Planos oferecidos para renovar seus serviços como correspondente. Não perda tempo e renove já seu Plano.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Parece que seu Plano venceu. \n\n Por favor, compre algum dos Planos oferecidos \n para renovar seus serviços como correspondente. \n\n Não perda tempo e renove já seu Plano.");
	</script>
<?php
	} elseif ($msg == "planoinvalido") {
		$txt_msg = "Ops! Parece que o Plano no qual você está vinculado expirou ou foi modificado. Por favor, verifique seus pagamentos e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Parece que o Plano no qual você está vinculado expirou ou foi modificado. \n\n Por favor, verifique seus pagamentos e tente novamente.");
	</script>
<?php
	} elseif ($msg == "planonaovigente") {
		$txt_msg = "Ops! Não foi permitido inserir a cidade escolhida, porque seu plano não está vigente ainda. Por favor, verifique seus pagamentos e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n Não foi permitido inserir a cidade escolhida, \n porque seu plano não está vigente ainda. \n\n Por favor, verifique seus pagamentos e tente novamente.");
	</script>
<?php
	} elseif ($msg == "sempag") {
		$txt_msg = "Ops! O identificador do pagamento não foi localizado. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n O identificador do pagamento não foi localizado. \n\n Por favor, verifique e tente novamente.");
	</script>
<?php
	} elseif ($msg == "semcidade") {
		$txt_msg = "Ops! É preciso digitar o nome da cidade. Por favor, verifique e tente novamente.";
?>
	<script language="javascript" type="text/javascript">
		alert("Ops! \n\n É preciso digitar o nome da cidade. \n\n Por favor, verifique e tente novamente.");
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
		alert("Ops! \n\n Algo saiu errado. \n\n Não foi possível inserir na tabela cliques.");
	</script>
<?php
	}
}
?>
