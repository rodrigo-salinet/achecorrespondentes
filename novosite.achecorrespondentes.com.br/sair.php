<?php
// Inicia o buffer
ob_start();
// Inicia a sessão
session_start();

/*
Inclui arquivo PHP de funções PHP
*/
include_once('lib/funcoes.php');

foreach ($_SESSION as $sessao) {
	if (isset($_SESSION[$sessao])) {
		unset($_SESSION[$sessao]);
	}
}

session_destroy();
mysqli_free_result();
mysqli_close($conn);

if (basename($_SERVER['SCRIPT_NAME']) == "sair.php" or basename(@$_SERVER['REDIRECT_URL']) == "sair.php" or basename(@$_SERVER['HTTP_REFERER']) == "sair.php") {
	header("Location:index.php?msg=saiu");
	exit();
}
?>
