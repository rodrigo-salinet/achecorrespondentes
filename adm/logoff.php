<?php 
setcookie("logadoadmchefia");
setcookie("loginlogadoadmchefia");

ob_start();
//INICIALIZA A SESS�O 
session_start(); 

//DESTR�I AS SESSOES
unset($_SESSION[logadoadmchefia]); 
unset($_SESSION[nomelogado]);
unset($_SESSION[loginlogadoadmchefia]);
session_destroy(); 

header("Location:index.php");
?> 