<?php
include("includes/conecta.php");

$login = $_POST['user'];
$senha = $_POST['pass'];
$senha = md5($senha);


//Verifica a existência do usuário no Banco de Dados
$sql_logar = "SELECT * FROM `loginadm` WHERE login = '$login' && senha = '$senha'";
$exe_logar = mysql_query($sql_logar) or die (mysql_error());
$fet_logar = mysql_fetch_assoc($exe_logar);
$num_logar = mysql_num_rows($exe_logar);

//Verifica se n existe uma linha com o login e a senha digitado
if ($num_logar == 0){
//Se não existir, retorna a mensagem de erro na tela 
echo "<table align=center width=100% height=100%><tr><td bgcolor=#002140 align=center><h2><font color=#ffffff>Atenção - Login ou Senha Inválidos<br></font>
	      <br><br><font color=blue size=4>
		  <bold><a href=login.php>Clique Aqui para retornar ao formulário de login</a></bold></font></h2></td></tr></table>";	 
   //echo "<br><a href='javascript:window.history.go(-1)'>Clique aqui para voltar.</a>"; 
//Caso Contrário    
}else{
	
	ob_start();
	$logado = "SIM"; 
	$nome = $nomelogado;  
	$loginlogado = $login;
	//inicio uma Sessao (session e similar a uma gaveta movel)
	session_start();
	//gravo as informações das variáveis dentro das sessões
	$_SESSION[logadoadmchefia] = $logado;
	$_SESSION[nomelogadochefia] = $nomelogado;
	$_SESSION[loginlogadoadmchefia] = $loginlogado;
	
    
    header("Location:index.php");
}
?>