<?php
        // inclui o arquivo de configuração do sistema
		include "adm/includes/conecta.php";
		
		
		$id = $_GET['id'];
		$nome = $_GET['nome'];
		$idmun = $_GET['idmun'];
		
        
		$query = mysql_query("DELETE FROM `municipios_atuacao` WHERE `Id` = '$idmun'");
		
	   
	  echo "<script>
			window.location = 'cadastro3.php?id=$id&nome=$nome';
		  </script>";
	  exit;
	
?>
