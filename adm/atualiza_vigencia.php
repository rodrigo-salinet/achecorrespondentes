<?php 
ob_start();
//INICIALIZA A SESSÃO 
session_start();

if ($_SESSION["logadoadmchefia"] == "SIM"){;
include("includes/conecta.php");

// recebe dados do formulario

$vigencia = substr($_POST['datavigencia'],6,4)."-".substr($_POST['datavigencia'],3,2)."-".substr($_POST['datavigencia'],0,2);

//faz consulta no banco para atualizar os dados
$consulta = mysql_query("UPDATE `correspondentes` SET vigencia='$vigencia'");


// verifica se os dados foram atualizados
if($consulta) {
	echo "<script>
			window.location = 'form_atualiza_vigencia.php';
		  </script>";
	exit;
} else {
    print(mysql_error());
	
	echo "<font color=black size=4><br>O Erro acima citado foi gerado automaticamento pelo servidor do Banco de Dados.<br>
	      Favor Encaminhar a Mensagem ao Administrador do Sistema.</font>
	      <br><br><br><br><font color=blue>Não foi possivel efetuar o seu cadastro<br>
		  tente mais tarde pode ser um problema no servidor!<br>
		  Click <a href=index.php>aqui</a> para retornar ao sistema";
	exit;
}

$ip=$_SERVER['REMOTE_ADDR'];
} else {
	header("Location:login.php"); 
}
?>
