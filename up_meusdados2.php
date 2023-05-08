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
$profissional = anti_injection($_POST['CADprofissional']); 
$uf_oab = anti_injection($_POST['CADestado_oab']); 
$oab = anti_injection($_POST['CADregistro']);  
$site = anti_injection($_POST['CADurl']);  
$atuacao = implode($_POST['atuacao']," ; ");
$servicos = implode($_POST['servicos']," ; ");
$dadosgerais = anti_injection($_POST['CADdadosgerais']);  
$idcad = anti_injection($_POST['id']);

$areaatuacao = anti_injection($_POST['areaatuacao']);  
$servicosprestados = anti_injection($_POST['servicosprestados']); 

if ($atuacao == ""){
	$atuacao = $areaatuacao;
};
if ($servicos == ""){
	$servicos = $servicosprestados;
};



// faz consulta no banco para inserir os dados do usuario
$sql = "UPDATE `correspondentes` SET tipo_profissional='$profissional', uf_oab='$uf_oab', num_oab='$oab', site='$site', areas_atuacao='$atuacao', servicos_prestados='$servicos', dadosgerais='$dadosgerais' WHERE `id` = '$idcad'";


$consulta = mysql_query($sql);

if($consulta) {
	echo "<script>
			window.location = 'meusdados.php?msg=sucesso';
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