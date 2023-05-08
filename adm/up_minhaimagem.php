<?php
// inclui o arquivo de configuração do sistema
include "includes/conecta.php";


$idcad = anti_injection($_POST['id']);

//Definição do local para onde as imagens serão alocadas
$dir="../images/";

//Faz a Verificação para descobrir a extensão dos arquivo enviado
$banner=$_FILES['banner']['name'];
$ext = explode('.', $banner);
$extensao = $ext[1];

if ($extensao == "jpg")
{
   $extensao = "jpeg";
} 
$mimearq = $_FILES['banner']['type'];
//echo $mimearq;

//Faço a verificação para descobrir  o tamanho da imagem enviada. Se maior que 1Mb, irá mostrar a mensagem de erro.
$tam = $_FILES['banner']['size'];
$kb = $tam / 1000;
$size = explode('.', $kb);
$tamanho = $size[0];
//echo $tamanho;
if ($tamanho > 500)
{
	echo "<script> 
		  window.location = 'up_banners.php?erro=A imagem enviada tem ($tamanho kb) superando o tamanho maximo permitido de 500Kb.';
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
			window.location = 'up_banners.php?erro=O Arquivo enviado $banner esta em formato invalido. A imagem deve ser jpg, png ou gif. Envie outro arquivo.';
		  </script>";
	exit;
}
else
{
   print "";
}


//Recebendo a banner
$banner=$_FILES['banner']['name'];
$bannermd5 = md5($_FILES['banner']['name'])."_".$banner;
$avatarmd5 = "av_".$bannermd5;
//echo $bannermd5."<br>";
//echo $avatarmd5;

//caminho com nome da imagem e local para guardar
$caminho1=$dir.$banner;


//movendo a imagem
if(move_uploaded_file ($_FILES['banner']['tmp_name'],$caminho1))
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

imagejpeg($Thumbnail,$dir.'/av_'.$banner);
//$dir esta la em cima esqueceu aqui a imagem vai pequena
// criando a imagem
$pequena=$caminho_mysql.'av_'.$banner;
$avatar = "av_".$banner;
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
  $origem = "banner/".$banner;
  $destino = "banner/".$banner;
    @rename($origem, $destino);
	
  $origemavatar = "banner/".$avatar;
  $destinoavatar = "banner/".$avatarmd5;
    @rename($origemavatar, $destinoavatar);
	



	echo "<script>
			window.location = 'up_banners.php?erro=Arquivo atualizado com sucesso !!';
		  </script>";
	exit;



?>