<?php
header("Content-type: text/html; charset=iso-8859-1\r\n",true);

if (!isset($_POST['LOGlogin'])) {
	header("Location:index.php?msg=errologin");
	exit();
}

/*
Inclui arquivo PHP de conexão ao banco de dados
*/
include_once('lib/conecta.php');

/*
Inclui arquivo PHP de funções PHP
*/
include_once('lib/funcoes.php');

$login = anti_injection(trim($_POST['LOGlogin']));
$senha = anti_injection(trim($_POST['LOGsenha']));

//Verifica a existência do usuário no Banco de Dados
$txt_sql_login = "SELECT * FROM `$banco_de_dados`.`correspondentes` WHERE `email` = '$login' AND `senha` = '$senha';";
$sql_login = mysqli_query($conn,$txt_sql_login);

if (mysqli_num_rows($sql_login) == 1) {
	$login = mysqli_fetch_array($sql_login);
	$_SESSION[idlogadoache] = $login['id'];
	if ($login['ativo'] == "S") {
		header("Location:area-do-correspondente.php");
		exit();
	} else {
		header("Location:index.php?msg=cadinativo");
		exit();
	}
} else {
	$senha_hash = md5($senha);
	$txt_sql_login_adm = "SELECT* FROM `$banco_de_dados`.`loginadm` WHERE `login`='$login' AND `senha`='$senha_hash';";
	$sql_login_adm = mysqli_query($conn,$txt_sql_login_adm);
	
	if (mysqli_num_rows($sql_login_adm) == 1) {
		$login = mysqli_fetch_array($sql_login_adm);
		$_SESSION[idadmache] = $login['id'];
		header("Location:adm.php");
		exit();
	} else {
		header("Location:index.php?msg=errologin");
		exit();
	}
}
?>