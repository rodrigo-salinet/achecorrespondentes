<?php
// inclui o arquivo de configuração do sistema
include "includes/conecta.php";


$noticia = anti_injection($_POST['noticia']);
$titulo = anti_injection($_POST['titulo']);
$dataatual = date('Y-m-d');

//Definição do local para onde as imagens serão alocadas
$dir="../imagens/noticias/";

//Faz a Verificação para descobrir a extensão dos arquivo enviado
$foto=$_FILES['foto']['name'];
$ext = explode('.', $foto);
$extensao = $ext[1];

if ($extensao == "jpg")
{
   $extensao = "jpeg";
} 
$mimearq = $_FILES['foto']['type'];
//echo $mimearq;

//Faço a verificação para descobrir  o tamanho da imagem enviada. Se maior que 1Mb, irá mostrar a mensagem de erro.
$tam = $_FILES['foto']['size'];
$kb = $tam / 1000;
$size = explode('.', $kb);
$tamanho = $size[0];
//echo $tamanho;
if ($tamanho > 500)
{
	echo "<script> 
		  window.location = 'cad_noticias.php?erro=A imagem enviada tem ($tamanho kb) superando o tamanho maximo permitido de 500Kb.';
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
			window.location = 'cad_noticias.php?erro=O Arquivo enviado $foto esta em formato invalido. A imagem deve ser jpg, png ou gif. Envie outro arquivo.';
		  </script>";
	exit;
}
else
{
   print "";
}


//Recebendo a foto
$foto=$_FILES['foto']['name'];
$fotomd5 = md5($_FILES['foto']['name'])."_".$foto;
$avatarmd5 = "av_".$fotomd5;
//echo $fotomd5."<br>";
//echo $avatarmd5;

//caminho com nome da imagem e local para guardar
$caminho1=$dir.$foto;


//movendo a imagem
if(move_uploaded_file ($_FILES['foto']['tmp_name'],$caminho1))
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
  $origem = $dir.$foto;
  $destino = $dir.$foto;
    @rename($origem, $destino);
	
  $origemavatar = $dir.$avatar;
  $destinoavatar = $dir.$avatarmd5;
    @rename($origemavatar, $destinoavatar);
	
$sql = "INSERT INTO `noticias` (titulo, noticia, imagem, data_cadastro) VALUES ('$titulo', '$noticia', '$foto', '$dataatual')";
$consulta = mysql_query($sql);

if($consulta) {
	echo "<script>
			window.location = 'cad_noticias.php';
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