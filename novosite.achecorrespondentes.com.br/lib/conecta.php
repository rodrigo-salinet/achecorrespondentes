<?php
// Inicia o buffer
ob_start();
// Inicia a sessão
session_start();

/*
Atribui variável $id_correspondente da sessão idlogadoache
*/
$id_correspondente = "";
if (isset($_SESSION['idlogadoache'])) {
	$id_correspondente = $_SESSION['idlogadoache'];
}

$id_adm = "";
if (isset($_SESSION['idadmache'])) {
	$id_adm = $_SESSION['idadmache'];
}


setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$ip = "";
if (isset($_SERVER['REMOTE_ADDR'])) {
	$ip = $_SERVER['REMOTE_ADDR'];
}

// caminho local: "/home/storage/c/12/e6/achecorrespondentes1/public_html/novosite"

if ($_SERVER['SERVER_NAME'] == "localhost") {
	$host = "localhost"; // local do servidor
	$user = "root"; // nome do usuario
	$pass_user = "pullin00"; // senha
	$banco_de_dados = "achecorrespond"; // nome do banco de dados
} else {
	$host = "mysql01.achecorrespondentes1.hospedagemdesites.ws"; // local do servidor
	$user = "achecorrespond"; // nome do usuario
	$pass_user = "Luehxz1608"; // senha
	$banco_de_dados = "achecorrespond"; // nome do banco de dados
}

$conn = mysqli_connect($host, $user, $pass_user, $banco_de_dados);
mysqli_set_charset($conn,"latin1");

// conecta-se ao banco de dados
//$db = @mysqli_select_db($banco_de_dados,$conn);

//Mostrando ou Ocultando erros do PHP / MYSQL 
error_reporting(0);
ini_set("display_errors", 1);

error_reporting(E_ALL ^ E_WARNING);
ini_set("display_errors", 0);

$txt_sql_plano_gratuito = "SELECT * FROM `$banco_de_dados`.`planos` WHERE `id`=1;";
$sql_plano_gratuito = mysqli_query($conn,$txt_sql_plano_gratuito);
$plano_gratuito = mysqli_fetch_array($sql_plano_gratuito);

$diasfree = $plano_gratuito['dias_vigencia']; // 20 dias foi a quantidade inicial
mysqli_free_result($sql_plano_gratuito);

$txt_sql_titulo_adm = "SELECT * FROM `$banco_de_dados`.`metatags` WHERE `pagina` LIKE 'adm/';";
$sql_titulo_adm = mysqli_query($conn,$txt_sql_titulo_adm);
$titulo_adm = mysqli_fetch_array($sql_titulo_adm);
$tituloadm = $titulo_adm['title']; // "ADMINISTRAÇÃO - www.achecorrespondentes.com.br" foi o título inicial
mysqli_free_result($sql_titulo_adm);

$script = "index.php";
if (isset($_SERVER['REDIRECT_URL'])) {
	$script = basename($_SERVER['REDIRECT_URL']);
} elseif (isset($_SERVER['HTTP_REFERER'])) {
	$script = basename($_SERVER['HTTP_REFERER']);
}

$txt_sql_metatag = "SELECT * FROM `$banco_de_dados`.`metatags` WHERE `pagina` LIKE '$script';";
$sql_metatag = mysqli_query($conn,$txt_sql_metatag);
$metatag = mysqli_fetch_array($sql_metatag);

$title = "www.achecorrespondentes.com.br";
$metadescription = "achecorrespondentes";
$metakeywords = "ache,correspondentes";

if (mysqli_num_rows($sql_metatag) > 0) {
	$title = $metatag->title;
	$metadescription = $metatag->metadescription;
	$metakeywords = $metatag->metakeywords;
}

$termos_de_uso = '<p style="font-size: 10px;">*Obs: Clicando em CONTINUAR, você aceita nossos <a href="termos-de-uso.php" target="_blank"><b>TERMOS DE USO</b></a>, assim como aceita ser o único responsável pelos dados acima informados.</p>';
?>