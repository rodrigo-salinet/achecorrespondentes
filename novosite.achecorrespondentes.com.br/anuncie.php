<?php 
header("Content-type: text/html; charset=iso-8859-1\r\n",true);
/*
Inclui arquivo PHP de conexão ao banco de dados
*/
include_once('lib/conecta.php');

/*
Inclui arquivo PHP de funções PHP
*/
include_once('lib/funcoes.php');

/*
Inclui arquivo PHP de consultas MySQL
*/
include_once('lib/consultas_mysql.php');

/*
Inclui arquivo PHP de tags iniciais HTML
*/
include_once('lib/html_msg.php');

/*
Inclui arquivo PHP de configurações de cabeçalho <head>
*/
include_once('lib/configuracoes.php');

?>
</head>
<body>
<?php
/*
Inclui arquivo PHP do topo da página
*/
include_once('lib/topo.php');
?>

<section id="conteudo_interno">
<div class="center">
<?php
$esta_pagina = basename($_SERVER['SCRIPT_FILENAME']);
$txt_sql_html = "SELECT * FROM `$banco_de_dados`.`metatags` WHERE `pagina`='$esta_pagina';";
//die($txt_sql_html);
$sql_html = mysqli_query($conn,$txt_sql_html);
$html = mysqli_fetch_array($sql_html);
echo $html['html'];
mysqli_free_result($sql_html);
?>

</div> 
</section>

<?php
/*
Inclui arquivo PHP do rodapé da página
*/
include_once('lib/rodape.php');
?>

</body>
</html>

<?php
/*
Inclui arquivo PHP de desconexão
*/
include_once('lib/desconecta.php');
?>
