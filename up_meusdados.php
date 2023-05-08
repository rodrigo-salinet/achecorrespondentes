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
$nome = anti_injection($_POST['CADnome']); 
$email = anti_injection($_POST['CADemail']); 
$senha = anti_injection($_POST['CADsenha']);
$dtnascimento = anti_injection($_POST['CADnasc']);
$dtnascimento = substr($dtnascimento,6,4).substr($dtnascimento,3,2).substr($dtnascimento,0,2); 
$fonefixo = anti_injection($_POST['CADfone']); 
$fonecelular = anti_injection($_POST['CADcelular']); 
$cpf = anti_injection($_POST['CADcpf']); 
$cnpj = anti_injection($_POST['CADcnpj']); 
$cep = anti_injection($_POST['CADcep']); 
$endereco = anti_injection($_POST['CADend']); 
$numendereco = anti_injection($_POST['numendereco']);
$complemento = anti_injection($_POST['CADcomp']); 
$bairro = anti_injection($_POST['CADbairro']); 
$cidade = anti_injection($_POST['CADcidade']); 
$uf = anti_injection($_POST['CADestado']);
$idcad = anti_injection($_POST['id']);



// faz consulta no banco para inserir os dados do usuario
$sql = "UPDATE `correspondentes` SET nome='$nome', cpf='$cpf', dtnascimento='$dtnascimento', fonefixo='$fonefixo', fonecelular='$fonecelular', cnpj='$cnpj', cep='$cep', endereco='$endereco', complemento='$complemento', bairro='$bairro', cidade='$cidade', uf='$uf' WHERE `id` = '$idcad'";
$consulta = mysql_query($sql);

// verifica se o usuario foi cadastrado
$sql2 = "SELECT LAST_INSERT_ID()"; // consulta
$con2 = mysql_query($sql2) or die ("PROBLEMAS COM A CONSULTA; ".mysql_error()); // enviamos a consulta ao SGBD
$res2 = mysql_fetch_row($con2); // recuperamos o que for retornado em um array - $res



if($consulta) {
	/*echo "<script>
			window.location = 'meusdados.php?msg=sucesso';
		  </script>";
	exit;*/
	echo "<script>
			window.location = 'meusdados2.php';
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