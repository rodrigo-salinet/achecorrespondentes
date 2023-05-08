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
$idcad = anti_injection($_POST['id']);
$senhaatual = anti_injection($_POST['CADsenhaatual']); 
$novasenha = anti_injection($_POST['CADnovasenha']); 

//Verifica a existência do usuário no Banco de Dados
$sql_logar = "SELECT * FROM `correspondentes` WHERE senha = '$senhaatual' && id = '$idcad'";
$exe_logar = mysql_query($sql_logar) or die (mysql_error());
$num_logar = mysql_num_rows($exe_logar);

if ($num_logar == "1"){;
// faz consulta no banco para inserir os dados do usuario
$sql = "UPDATE `correspondentes` SET senha='$novasenha' WHERE `id` = '$idcad'";
$consulta = mysql_query($sql);

// verifica se o usuario foi cadastrado
$sql2 = "SELECT LAST_INSERT_ID()"; // consulta
$con2 = mysql_query($sql2) or die ("PROBLEMAS COM A CONSULTA; ".mysql_error()); // enviamos a consulta ao SGBD
$res2 = mysql_fetch_row($con2); // recuperamos o que for retornado em um array - $res



if($consulta) {
	echo "<script>
			window.location = 'minhasenha.php?msg=sucesso';
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
} else {
	echo "<script>
			window.location = 'minhasenha.php?msg=erro';
		  </script>";
	exit;
};

?>