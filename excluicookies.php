<?php 
ob_start();
//INICIALIZA A SESS�O 
session_start();

//DESTR�I AS SESSOES
unset($_SESSION[logadoache]); 
unset($_SESSION[nomelogado]);
unset($_SESSION[loginlogadoache]);
unset($_SESSION[carrinhoache]);

session_destroy(); 

header("Location:index.php");
?> 