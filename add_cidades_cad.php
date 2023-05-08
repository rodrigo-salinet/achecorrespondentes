<?php
        // inclui o arquivo de configuração do sistema
		include "adm/includes/conecta.php";
		
		
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$cod_estados = $_POST['cod_estados'];
		$cod_cidades = $_POST['cod_cidades'];
		
		 $queryuf = mysql_query("SELECT * FROM estados WHERE cod_estados = '$cod_estados'"); 
		    while($uf = mysql_fetch_object($queryuf)) { 
			   $sigla = $uf->sigla;
			}
			
		//$municipio = $_POST['municipio'];
		$municipio = $cod_cidades." - ".$sigla;
		$destaque = $_POST['destaque'];
		$sessao = $_POST['sessao'];
		
		
		
			
		
		//Verifica se o municipio já não foi inserido
		$sql_cidades = "SELECT * FROM `municipios_atuacao` WHERE municipio = '$municipio' && id_correspondente = '$id'";
		$exe_cidades = mysql_query($sql_cidades) or die (mysql_error());
		$num_cidades = mysql_num_rows($exe_cidades);

		if ($num_cidades == 0 and $num_cidades_exist == 0){
		
        
		$query = mysql_query("INSERT INTO `municipios_atuacao` (id_correspondente, municipio, destaque, sessao) VALUES ('$id', '$municipio', '$destaque', '$sessao')") or die (mysql_error());
				//monto a query
        $q = mysql_query( $sql ) ;//executo a query
		
		
		/*
		// Se inserido com sucesso 
		//Verifica se o municipio esta na lista de municipios
		$ext = explode(' - ', $municipio);
		$municipio_alt = $ext[0];

		$sql_cidades_exist = "SELECT * FROM `municipios` WHERE nome = '$municipio_alt'";
		$exe_cidades_exist = mysql_query($sql_cidades_exist) or die (mysql_error());
		$num_cidades_exist = mysql_num_rows($exe_cidades_exist);

		if ($num_cidades_exist == 0){
				
				$queryexclui = mysql_query("DELETE FROM `municipios_atuacao` WHERE `municipio` = '$municipio'");
				
				header("Location:cadastre-se_3.php?id=$id&nome=$nome&msg=municipioincorreto");
		};
		*/
		
		
	  echo "<script>
			window.location = 'cadastro3.php?id=$id&nome=$nome';
		  </script>";
	  exit;
		} else {
		//Se o municipio já existe, retorna a mensagem de erro
		header("Location:cadastro3.php?id=$id&nome=$nome&msg=municipioexistente");
		};
?>
