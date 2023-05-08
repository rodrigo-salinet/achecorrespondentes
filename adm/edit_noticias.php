<?php 
ob_start();
//INICIALIZA A SESSÃO 
session_start();

if ($_SESSION["logadoadmchefia"] == "SIM"){;
include("includes/conecta.php");

$id = $_GET['id'];
$action = $_GET['action'];
$codindicacao = $_GET['codindicacao'];

if ($action == "del"){
  $consulta = mysql_query("DELETE FROM `noticias` WHERE `Id` = '$id'");
  echo "<script>
			window.location = 'cad_noticias.php';
		  </script>";
	exit;
  } else {
  echo "<script>
			window.location = 'cad_noticias.php';
		  </script>";
	exit;
 
};  
	

$ip=$_SERVER['REMOTE_ADDR'];
} else {
	header("Location:login.php"); 
}
?>