<?php 
ob_start();
//INICIALIZA A SESSÃO 
session_start();

if ($_SESSION["logadoadmchefia"] == "SIM"){;
include("includes/conecta.php");

$id = $_GET['id'];
$action = $_GET['action'];


if ($action == "del"){
  $consulta = mysql_query("DELETE FROM `correspondentes` WHERE `Id` = '$id'");
  echo "<script>
			window.location = 'busca_correspondente.php';
		  </script>";
	exit;
  } else {
  echo "<script>
			window.location = 'form_edit_correspondente.php?id=$id';
		  </script>";
	exit;
 
};  
	

$ip=$_SERVER['REMOTE_ADDR'];
} else {
	header("Location:login.php"); 
}
?>