<?php
include("adm/includes/conecta.php");

$login = $_POST['LOGlogin'];
$senha = $_POST['LOGsenha'];

//Verifica a existência do usuário no Banco de Dados
$sql_logar = "SELECT * FROM `correspondentes` WHERE email = '$login' && senha = '$senha' && ativo = 'S'";
$exe_logar = mysql_query($sql_logar) or die (mysql_error());
$num_logar = mysql_num_rows($exe_logar);


while($dados_correspondente = mysql_fetch_object($exe_logar)) {;
$nomelogado = $dados_correspondente->nome; 	
$idlogado = $dados_correspondente->Id; 	
};




//Verifica se n existe uma linha com o login e a senha digitado
if ($num_logar == 0){
//Se não existir, retorna a mensagem de erro na tela
header("Location:index.php?msg=erro");
/* 
echo "<table align=center width=100% height=100%><tr><td bgcolor=#002140 align=center><h2><font color=#ffffff>Atenção - Login ou Senha Inválidos<br></font>
	      <br><br><font color=blue size=4>
		  <bold><a href=index.php>Clique Aqui para retornar ao formulário de login</a></bold></font></h2></td></tr></table>";	 */
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
	$_SESSION[logadoache] = $logado;
	$_SESSION[nomelogado] = $nomelogado;
	$_SESSION[loginlogadoache] = $loginlogado;
	$_SESSION[idlogadoache] = $idlogado;
	
	//var_dump($_SESSION); break;
	
    //echo $sql_logar."<br>".$num_logar."<br>".$nomelogado."<br>".$idlogado."<br>".$_SESSION[logadoache]."<br>".$_SESSION[nomelogado]."<br>".$_SESSION[loginlogadoache]."<br>".$_SESSION[idlogadoache]; break;
	
    header("Location:area-do-correspondente.php");
}
?>