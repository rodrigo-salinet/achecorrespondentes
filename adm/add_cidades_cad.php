<?php
        // inclui o arquivo de configuração do sistema
		include "includes/conecta.php";
		
		
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$cod_estados = $_POST['cod_estados'];
		$cod_cidades = $_POST['cod_cidades'];
		$data_cadastro = date('Y-m-d');
		
		 $queryuf = mysql_query("SELECT * FROM estados WHERE cod_estados = '$cod_estados'"); 
		    while($uf = mysql_fetch_object($queryuf)) { 
			   $sigla = $uf->sigla;
			}
			
		//$municipio = $_POST['municipio'];
		$municipio = $cod_cidades." - ".$sigla;
					
		
		//Verifica se o municipio já não foi inserido
		$sql_cidades = "SELECT * FROM `municipios_home` WHERE municipio = '$municipio'";
		$exe_cidades = mysql_query($sql_cidades) or die (mysql_error());
		$num_cidades = mysql_num_rows($exe_cidades);

		if ($num_cidades == 0 and $num_cidades_exist == 0){
		
        
		$query = mysql_query("INSERT INTO `municipios_home` (municipio, data_cadastro) VALUES ('$municipio', '$data_cadastro')") or die (mysql_error());
			
        $q = mysql_query( $sql ) ;//executo a query
		
		
		
		
	  echo "<script>
			window.location = 'cad_cidade_dest.php';
		  </script>";
	  exit;
		} else {
		//Se o municipio já existe, retorna a mensagem de erro
		header("Location:cad_cidade_dest.php?msg=municipioexistente");
		};
?>
