<?php
$host = "localhost"; 	 // local do servidor
$user = "root";		 // nome do usuario
$pass_user = "";			 	 // senha
$banco_de_dados = "achecorrespondentes"; 	 // nome do banco de dados
$conn = @mysql_connect($host,$user,$pass_user) or die ("O servidor n�o responde!");

// conecta-se ao banco de dados
$db = @mysql_select_db($banco_de_dados,$conn) 
	or die ("N�o foi possivel conectar-se ao banco de dados!");


//Mostrando ou Ocultando erros do PHP / MYSQL 
error_reporting(0);
ini_set("display_errors", 1 );

error_reporting(E_ALL ^ E_WARNING);
ini_set("display_errors", 0 );


//Inicia a fun��o de verifica��o de SqlInjection
function anti_injection($sql)
{
// remove palavras que contenham sintaxe sql
$sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
$sql = trim($sql);//limpa espa�os vazio
$sql = strip_tags($sql);//tira tags html e php
$sql = addslashes($sql);//Adiciona barras invertidas a uma string
return $sql;
}
//Fim da Fun��o contra o injection

$tituloadm = "ADMINISTRA��O - Achecorrespondentes.com.br";
$diasfree = "20";


?>
