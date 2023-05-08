<?php 
setcookie("logadoadmchefia");
setcookie("loginlogadoadmchefia");

ob_start();
//INICIALIZA A SESSÃO 
session_start(); 

//DESTRÓI AS SESSOES
unset($_SESSION[logadoadmchefia]); 
unset($_SESSION[nomelogado]);
unset($_SESSION[loginlogadoadmchefia]);
session_destroy(); 

header("Location:index.php");
?> 