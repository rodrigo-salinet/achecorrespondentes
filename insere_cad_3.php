<?php
// inclui o arquivo de configuração do sistema
include "adm/includes/conecta.php";

/*
echo "<pre>";
print_r($_POST);
print_r($_GET);
print_r($_FILES);
echo "</pre>"; 
*/

// recebe dados do formulario
$tottrimestral = anti_injection($_POST['tottrimestral']); 
$totsemestral = anti_injection($_POST['totsemestral']); 
$totanual = anti_injection($_POST['totanual']);  
$id = anti_injection($_POST['id']);  
$nome = anti_injection($_POST['nome']); 
$sessao = anti_injection($_POST['sessao']);

if ($plano == "Plano Trimestral"){;
	$vlrplano = $tottrimestral;
};	
if ($plano == "Plano Semestral"){;
	$vlrplano = $totsemestral;
};	
if ($plano == "Plano Anual"){;
	$vlrplano = $totanual;
};	

$situacao = "Pedido Novo";


$dtcadastro = date('Y-m-d');
$hash = md5($dtcadastro);

$datavigencia = date('d/m/Y', strtotime("+$diasfree days"));
$datavigencia = substr($datavigencia,6,4).substr($datavigencia,3,2).substr($datavigencia,0,2); 
//echo $diasfree." dias a partir de hoje ".$datavigencia;

// faz consulta no banco para inserir os dados do usuario
$sql = "UPDATE `correspondentes` SET hash='$hash', vigencia='$datavigencia', ativo = 'S' WHERE id = '$id'";
$consulta = mysql_query($sql);

// faz consulta no banco para inserir os dados do pedido
$sql = "INSERT INTO `pedidos` (id_correspondente, plano, valor, data_pedido, situacao, sessao) VALUES ('$id', '$plano', '$vlrplano', '$dtcadastro', '$situacao', '$sessao')";
$consulta = mysql_query($sql);

if($consulta) {
	echo "<script>
			window.location = 'enviaemail.php?id=$id&nome=$nome&plano=$plano&valor=$vlrplano&data_pedido=$dtcadastro&situacao=$situacao';
		  </script>";
	exit;
} else {
    print(mysql_error());
	
	echo "<font color=black size=4><br>O Erro acima citado foi gerado automaticamento pelo servidor do Banco de Dados.<br>
	      Favor Encaminhar a Mensagem ao Administrador do Sistema.</font>
	      <br><br><br><br><font color=blue>Não foi possivel efetuar o seu cadastro<br>
		  tente mais tarde pode ser um problema no servidor!<br>
		  Click <a href=index.php>aqui</a> para retornar ao sistema";
	exit;
}

?>