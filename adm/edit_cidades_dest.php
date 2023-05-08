<?php 
ob_start();
//INICIALIZA A SESSÃO 
session_start();

if ($_SESSION["logadoadmchefia"] == "SIM"){;
include("includes/conecta.php");

$id = $_GET['id'];
$action = $_GET['action'];

if ($action == "del"){
  $consulta = mysql_query("DELETE FROM `municipios_home` WHERE `Id` = '$id'");
  echo "<script>
			window.location = 'cad_cidade_dest.php';
		  </script>";
};	
 
} else {
	header("Location:login.php"); 
}
?>