<?php
// faz conexão com o servidor MySQL
// Conecta-se ao Banco de Dados "EVENTOS"
$host = "mysql01.achecorrespondentes1.hospedagemdesites.ws"; 	 // local do servidor
$user = "achecorrespond";		 // nome do usuario
$pass_user = "Luehxz1608";			 	 // senha
$banco_de_dados = "achecorrespond"; 	 // nome do banco de dados
$conn = @mysql_connect($host,$user,$pass_user) or die ("O servidor não responde!");

// conecta-se ao banco de dados
$db = @mysql_select_db($banco_de_dados,$conn) 
	or die ("Não foi possivel conectar-se ao banco de dados!");


//Mostrando ou Ocultando erros do PHP / MYSQL 
error_reporting(0);
ini_set("display_errors", 1 );

error_reporting(E_ALL ^ E_WARNING);
ini_set("display_errors", 0 );


//Inicia a função de verificação de SqlInjection
function anti_injection($sql)
{
// remove palavras que contenham sintaxe sql
$sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
$sql = trim($sql);//limpa espaços vazio
$sql = strip_tags($sql);//tira tags html e php
$sql = addslashes($sql);//Adiciona barras invertidas a uma string
return $sql;
}
//Fim da Função contra o injection

$tituloadm = "ADMINISTRAÇÃO - Achecorrespondentes.com.br";
$diasfree = "20";

$script       = $_SERVER['SCRIPT_NAME'];
$seo = mysql_query("SELECT * FROM `metatags` WHERE `pagina` = '$script'");
	while($dadoseo = mysql_fetch_object($seo)) { ; 
	$title = $dadoseo->title;
	$metadescription = $dadoseo->metadescription;
	$metakeywords = $dadoseo->metakeywords;
	};
?>
