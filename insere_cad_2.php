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
//Definição do local para onde as imagens serão alocadas
$dir="foto/";

// recebe dados do formulario
$profissional = anti_injection($_POST['CADprofissional']); 
$uf_oab = anti_injection($_POST['CADestado_oab']); 
$oab = anti_injection($_POST['CADregistro']);  
$site = anti_injection($_POST['CADurl']);  
$atuacao = implode($_POST['atuacao']," ; ");
$servicos = implode($_POST['servicos']," ; ");
$dadosgerais = anti_injection($_POST['CADdadosgerais']);    
$nome = anti_injection($_POST['nome']); 
$email = anti_injection($_POST['email']); 
$senha = anti_injection($_POST['senha']);
$dtnascimento = anti_injection($_POST['dtnascimento']);
$fonefixo = anti_injection($_POST['fonefixo']); 
$fonecelular = anti_injection($_POST['fonecelular']); 
$cpf = anti_injection($_POST['cpf']); 
$cnpj = anti_injection($_POST['cnpj']); 
$cep = anti_injection($_POST['cep']); 
$endereco = anti_injection($_POST['endereco']); 
$numendereco = anti_injection($_POST['numendereco']); 
$complemento = anti_injection($_POST['complemento']); 
$bairro = anti_injection($_POST['bairro']); 
$cidade = anti_injection($_POST['cidade']); 
$uf = anti_injection($_POST['uf']);
$dtcadastro = date('Y-m-d');

$dthrcadastro = date('Y-m-d H:i:s');
$ipcadastro = $_SERVER["REMOTE_ADDR"];
$hash = md5($ipcadastro."".$dthrcadastro);
$hashcad = md5(uniqid(rand(), true));

/*//Verifica a existência do cpf no Banco de Dados
$sql_conta_cpf = "SELECT * FROM `correspondentes` WHERE `cpf` = '$cpf'";
$exe_conta_cpf = mysql_query($sql_conta_cpf) or die (mysql_error());
$num_conta_cpf = mysql_num_rows($exe_conta_cpf);

if ($num_conta_cpf <> "0"){;
    header("Location:index.php?msg=errocpf"); 
};
//Fim da verificação de existência de CPF	 


//Verifica a existência do cnpj no Banco de Dados
$sql_conta_cnpj = "SELECT * FROM `correspondentes` WHERE `cpf` = '$cpf'";
$exe_conta_cnpj = mysql_query($sql_conta_cnpj) or die (mysql_error());
$num_conta_cnpj = mysql_num_rows($exe_conta_cnpj);

if ($num_conta_cnpj <> "0"){;
    header("Location:index.php?msg=errocnpj"); 
};
//Fim da verificação de existência de CNPJ	 */

//Verifica a existência do email no Banco de Dados
$sql_logar = "SELECT * FROM `correspondentes` WHERE `email` = '$email' OR `cpf` = '$cpf'";
$exe_logar = mysql_query($sql_logar) or die (mysql_error());
$num_logar = mysql_num_rows($exe_logar);

//echo $num_logar;

if ($num_logar == "0"){;

//echo "Profissional - ".$profissional."<br> Uf Oab - ".$uf_oab."<br> Oab - ".$oab."<br> Site - ".$site."<br> Atuação - ".$atuacao."<br> Serviços - ".$servicos."<br> Município - ".$municipio."<br> Dados Gerais - ".$dadosgerais."<br> Nome - ".$nome."<br> E-Mail - ".$email."<br> Senha - ".$senha."<br> Data de Nascimento - ".$dtnascimento."<br> Fone Fixo - ".$fonefixo."<br> Fone Celular - ".$fonecelular."<br> Cpf - ".$cpf."<br> Cnpj - ".$cnpj."<br> Cep - ".$cep."<br> Endereço - ".$endereco."<br> Número Endereço - ".$numendereco."<br> Complemento - ".$complemento."<br> Bairro - ".$bairro."<br> Cidade - ".$cidade."<br> UF - ".$uf."<br> Data de Cadastro - ".$dtcadastro."<br> Hash - ".$hash."<br><br>";

//Faz a Verificação para descobrir a extensão dos arquivo enviado
$foto=$_FILES['CADimagem']['name'];
$ext = explode('.', $foto);
$extensao = $ext[1];

if ($extensao == "jpg")
{
   $extensao = "jpeg";
} 
$mimearq = $_FILES['CADimagem']['type'];
//echo $mimearq;

//Faço a verificação para descobrir  o tamanho da imagem enviada. Se maior que 1Mb, irá mostrar a mensagem de erro.
$tam = $_FILES['CADimagem']['size'];
$kb = $tam / 1000;
$size = explode('.', $kb);
$tamanho = $size[0];
//echo $tamanho;
if ($tamanho > 500)
{
	echo "<script> 
		  window.location = 'cadastro2.php?erro=A imagem enviada tem ($tamanho kb) superando o tamanho maximo permitido de 500Kb.';
		  </script>";
}

// Aqui verifico se a extensão do arquivo enviado é uma extensão válida 
//Inclui o arquivo de Mimes
include "includes/mimes.php";
// Atribuo o array de Mimes com a variável rLista
$rLista = $mimes;
// Atribuo o Mime do arquivo com variável rMimes
$rMimes = $mimearq;	
//echo $mimearq;
if (in_array($rMimes , $rLista))
{
	echo "<script>
			window.location = 'cadastro2.php?erro=O Arquivo enviado $foto esta em formato invalido. A imagem deve ser jpg, png ou gif. Envie outro arquivo.';
		  </script>";
	exit;
}
else
{
   print "";
}


//Recebendo a Foto
$foto=$_FILES['CADimagem']['name'];

$fotomd5 = md5($hash."_".$foto)."_".$foto;
$avatarmd5 = "av_".$fotomd5;
//echo $fotomd5."<br>";
//echo $avatarmd5;

//caminho com nome da imagem e local para guardar
$caminho1=$dir.$foto;


//movendo a imagem
if(move_uploaded_file ($_FILES['CADimagem']['tmp_name'],$caminho1))
//aqui nada especial so movo a tmp_name dando caminho
{
list($largura,$altura,$tipo)=@getimagesize($caminho1);

//Substituo a função imagecreatefromjpeg pela extensão do arquivo recebido
$funcaoimagem = @imagecreatefrom."".$extensao;
//echo $funcaoimagem;
$imagem = @$funcaoimagem($caminho1);


// aqui eu pego a imagem no caminho e jogo na memoria
$Thumbnail = imagecreatetruecolor(150, 150);

// diminuir a imagem preservado as cores e diminiudo a imagem
@imagecopyresampled($Thumbnail, $imagem, 0, 0, 0, 0, 150, 150, $largura,$altura);
//sample da imagem com os tamanho 150 x150

imagejpeg($Thumbnail,$dir.'/av_'.$foto);
//$dir esta la em cima esqueceu aqui a imagem vai pequena
// criando a imagem
$pequena=$caminho_mysql.'av_'.$foto;
$avatar = "av_".$foto;
/*aqui eu criei uma variavel para o mysql ja que o caminho final e la
gere a imagem e coloco no Diretorio de imagem
e ganhar uma nova imagem algo tipo pequena_image que veio para mim.jpg
*/
}
//$image=$_FILES['galeria'];

//aqui eu recebo a imagem olha o formulario la arquivo []

for($i=0; $i < sizeof($image);$i++)

/*aqui e um for para organizar o bando*/
{
{

if(move_uploaded_file($tmpname,$caminho)){

}
}

}

// renomeia os arquivos enviados
  $origem = "foto/".$foto;
  $destino = "foto/".$fotomd5;
    @rename($origem, $destino);
	
  $origemavatar = "foto/".$avatar;
  $destinoavatar = "foto/".$avatarmd5;
    @rename($origemavatar, $destinoavatar);
	




// faz consulta no banco para inserir os dados do usuario
                                                                                                                                                           
$sql = "INSERT INTO `correspondentes` (nome, email, senha, dtnascimento, fonefixo, fonecelular, cpf, cnpj, cep, endereco, numendereco, complemento, bairro, cidade, uf, tipo_profissional, uf_oab, num_oab, site, areas_atuacao, servicos_prestados, dadosgerais, hash, imagem, dtcadastro, ipcadastro) VALUES ('$nome', '$email', '$senha', '$dtnascimento', '$fonefixo', '$fonecelular', '$cpf', '$cnpj', '$cep', '$endereco', '$numendereco', '$complemento', '$bairro', '$cidade', '$uf', '$profissional', '$uf_oab', '$oab', '$site', '$atuacao', '$servicos', '$dadosgerais', '$hashcad', '$fotomd5', '$dtcadastro', '$ipcadastro')";
$consulta = mysql_query($sql);

// verifica se o usuario foi cadastrado
$sql2 = "SELECT LAST_INSERT_ID()"; // consulta
$con2 = mysql_query($sql2) or die ("PROBLEMAS COM A CONSULTA; ".mysql_error()); // enviamos a consulta ao SGBD
$res2 = mysql_fetch_row($con2); // recuperamos o que for retornado em um array - $res

$codigo = $res2[0];



if($consulta) {
	echo "<script>
			window.location = 'cadastro3.php?id=$codigo&nome=$nome';
		  </script>";
	exit;
} else {
    print(mysql_error());
	
	if(!mysql_query($sql)){
    $erro = mysql_error();
    //echo "Ocorreu o seguinte erro: ", '"', $erro, '"';
};
	
	echo "<font color=black size=4>Ocorreu o seguinte erro: $erro <br><br>O Erro acima citado foi gerado automaticamento pelo servidor do Banco de Dados.<br>
	      Favor Encaminhar a Mensagem ao Administrador do Sistema.</font>
	      <br><br><br><br><font color=blue>Não foi possivel efetuar o seu cadastro<br>
		  tente mais tarde pode ser um problema no servidor!<br>
		  Click <a href=index.php>aqui</a> para retornar ao sistema";
	exit;
}
} else {
header("Location:index.php?msg=erroemail");
};

?>