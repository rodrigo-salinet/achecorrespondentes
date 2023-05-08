<?php
// inclui o arquivo de configuração do sistema
include "adm/includes/conecta.php";
 
// Passando os dados obtidos pelo formulário para as variáveis abaixo
$id = $_GET['id'];
$nomecorrespondente = $_GET['nome'];
$plano = $_GET['plano'];
$valor = $_GET['valor'];
$data_pedido = $_GET['data_pedido'];
$situacao = $_GET['situacao'];

$consulta = mysql_query("SELECT * FROM correspondentes WHERE id = '$id'");
while($mostranome = mysql_fetch_object($consulta)) { ;
$nome = $mostranome->nome;
$email = $mostranome->email;
$hash = $mostranome->hash;
};
if ($plano <> ""){
header("Location:pag_seguro.php?msg=emailok&id=$id&nome=$nomecorrespondente&plano=$plano&valor=$valor&data_pedido=$data_pedido&situacao=$situacao");
} else {
header("Location:index.php?msg=cadastrofree");
};
?>