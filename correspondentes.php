<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $metadescription; ?>">
<meta name="keywords" content="<?php echo $metakeywords; ?>">
<link rel="stylesheet" href="css/form.css" />


<!-- the following two lines are only required for the demos -->
<script type="text/javascript" src="lib/shadowbox/demo.js"></script>
<script type="text/javascript" src="lib/shadowbox/adapter/shadowbox-base.js"></script>
<script type="text/javascript" src="lib/shadowbox/shadowbox.js"></script>
<script type="text/javascript">

Shadowbox.loadSkin('classic', 'lib/shadowbox/skin');
Shadowbox.loadLanguage('en', 'lib/shadowbox/lang');
Shadowbox.loadPlayer(['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'], 'lib/shadowbox/player');

window.onload = function(){

    Shadowbox.init();

    /**
     * Note: The following function call is not necessary in your own project.
     * It is only used here to set up the demonstrations on this page.
     */
    initDemos();

};

</script>
	
	
	
	


<?php 
include 'lib/configuracoes.php'; 
include("adm/includes/conecta.php");
$dataatual = date('Y-m-d');

$municipio = anti_injection($_POST['BUScidade']); 



if ($municipio == ""){
  $municipio = anti_injection($_GET['municipio']); 
};

$correspondentes_destaque = mysql_query("SELECT * FROM municipios_atuacao ma
           							  LEFT OUTER JOIN correspondentes c on c.id = ma.id_correspondente
           							  WHERE ma.municipio = '$municipio'
									  AND ma.destaque = 'Sim'
									  AND c.vigencia >= '$dataatual'
									  AND c.ativo = 'S'
									  ORDER BY RAND() LIMIT 8");

$correspondentes_semdestaque = mysql_query("SELECT * FROM municipios_atuacao ma
           							  LEFT OUTER JOIN correspondentes c on c.id = ma.id_correspondente
           							  WHERE ma.municipio = '$municipio'
									  AND ma.destaque <> 'Sim'
									  AND c.vigencia >= '$dataatual'
									  AND c.ativo = 'S'
									  ORDER BY RAND() LIMIT 20");									  

$num_reg_destaque = mysql_num_rows($correspondentes_destaque);
$num_reg_semdestaque = mysql_num_rows($correspondentes_semdestaque);


?>


<script type="text/javascript">
$(document).ready(function() {

  $(".bt_telefone").click(function() {

  $(this).parent().find( ".box_tel" ).slideToggle(400);

});


  function open() {

     $(".open_box").fadeToggle(400);
}


  $(".bt_contato").click(function() {

 open();

 $("body").css('overflow', 'hidden');

});

   $(".fechar").click(function() {

 open();

  $("body").removeAttr('style');

});

});

</script>


</head>


<body>
<?php include 'topo.php'; ?>

<!--
<div class="open_box">
<?php

$id = $_GET['id']; 

$correspondentes_email = mysql_query("SELECT * FROM correspondentes WHERE Id = '$id'");	
while($dadosemail = mysql_fetch_object($correspondentes_email)) {;
$nomecorrespondente = $dadosemail->nome;
$emailcorrespondente = $dadosemail->email;
$tipo_profissional = $dadosemail->tipo_profissional;
$num_oab = $dadosemail->num_oab; 
$uf_oab = $dadosemail->uf_oab;
};
?>   
<form action="#" method="post" id="form_fale_conosco" class="form">
    <input type="hidden" name="pagina" value="form_fale_conosco" />
    <a href="#" class="fechar">Fechar</a>
<h3><?php echo $nomecorrespondente; ?></h3>
<strong><?php echo $tipo_profissional." | ".$num_oab." - ".$uf_oab; ?></strong>
 
    <p><label for="CONemail">E-mail</label><input type="text" value=""  name="CONemail" /></p>
    <p class="menor"><label for="CONfone">Telefone</label><input type="text" value=""   name="CONfone" /></p>
    <p class="menor"><label for="CONcelular">Celular</label><input type="text" value=""   name="CONcelular"/></p>
    <p class="box_cidade"><label for="CONcidade">Cidade</label><input type="text" value=""   name="CONcidade"/></p>
    <p class="box_select"><span class="select_label">Estado</span>            
                  <select name="CONestado">
                    <option value="" selected="selected">Estado</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AM">Amazonas</option>
                    <option value="AP">Aamapá</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito federal</option>
                    <option value="ES">Espírito santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MG">Minas gerais</option>
                    <option value="MS">Mato grosso do sul</option>
                    <option value="MT">Mato grosso</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="PR">Paraná</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Rorâima</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SE">Sergipe</option>
                    <option value="SP">São Paulo</option>
                    <option value="TO">Tocantins</option>
                  </select>
                </p>
                <div style="clear:both"></div>
                  <p><label for="CONmsg">Mensagem</label><textarea name="CONmsg"></textarea></p>
    <p style="margin-top:30px;"><input type="submit"  value="ENVIAR" class="bt_form"/></p>

    </form>

</div>
-->



<section id="conteudo_interno">
<div class="center">

<h2>Correspondentes</h2>

<ul class="lista_correspondentes">

<?php 
//Verifica se o municipio esta na lista de municipios
$ext = explode(' - ', $municipio);
if ($num_reg_destaque == "0" and $num_reg_semdestaque == "0"){ 
	
		if ($ext[1] == "") {

			$sql = "SELECT DISTINCT nome, estado FROM municipios WHERE nome LIKE '%$municipio%' ORDER BY nome ASC";
			$rsd = mysql_query($sql); ?>
			<span><strong class="nome"><p>VOCÊ QUIS DIZER:<br><br></p></strong>
			<?php
				while($rs = mysql_fetch_array($rsd)) {
					$cname = $rs['nome'];
					$cnameest = $rs['estado'];
				?>
				<a href="correspondentes.php?municipio=<?php echo $cname." - ".$cnameest; ?>"><span style="padding-left:20px; padding-right:20px" class="bt_form"><?php echo $cname." - ".$cnameest;   ?></span></a> &nbsp; &nbsp;
				<?php }
		
				
		} else {?>
		<span><strong class="nome"><p>ATENÇÃO - NENHUM REGISTRO ENCONTRADO.</p></strong>
        <p>CIDADE PESQUISADA: <?php echo $municipio; ?></p>
		<?php }}; ?> 
		
	
<?php while($dadoscorrespondentes_dest = mysql_fetch_object($correspondentes_destaque)) {; 
		
		$fotocorrespondente = "foto/".$dadoscorrespondentes_dest->imagem;
		
		if (file_exists($fotocorrespondente)) {;
		   $imagem = $fotocorrespondente;
		} else {
           $imagem = "foto/no_image.jpg";
		} 
?>
<li>
    <?php if (file_exists($fotocorrespondente)) {; ?>
    <span class="img_corres"><img src="<?php echo $imagem; ?>" /></span>
	<?php }; ?>
    <span class="info">
    <strong class="nome"><?php echo $dadoscorrespondentes_dest->nome; ?></strong>
    <span><?php echo $dadoscorrespondentes_dest->tipo_profissional." | ".$dadoscorrespondentes_dest->num_oab." - ".$dadoscorrespondentes_dest->uf_oab; ?></span>
    <strong>Áreas de Atuação:</strong>
    <span><?php echo $dadoscorrespondentes_dest->areas_atuacao; ?></span>
    <strong>Serviços Prestados:</strong>
    <span><?php echo $dadoscorrespondentes_dest->servicos_prestados; ?></span>
    <strong>Contato:</strong>
    <span><?php echo $dadoscorrespondentes_dest->endereco." , Nº ".$dadoscorrespondentes_dest->numendereco." | ".$dadoscorrespondentes_dest->complemento." - CEP ".$dadoscorrespondentes_dest->cep; ?></span>
    <span><?php echo $dadoscorrespondentes_dest->bairro." - ".$dadoscorrespondentes_dest->cidade." - ".$dadoscorrespondentes_dest->uf; ?></span>
    </span>
     <a href="#id=<?php echo $dadoscorrespondentes_dest->Id; ?>"class="bt_telefone">Ver Telefones</a>
    <span class="box_tel" id="<?php echo $dadoscorrespondentes_dest->Id; ?>" >
    <strong> Telefones:</strong>
    <em><?php echo $dadoscorrespondentes_dest->fonefixo; ?></em>
    <em><?php echo $dadoscorrespondentes_dest->fonecelular; ?></em>
    </span>
    <!--<a href="#" class="bt_contato" >Entrar em contato</a>-->
	<a href="contato_correspondente.php?nome=<?php echo $dadoscorrespondentes_dest->nome; ?>&email=<?php echo $dadoscorrespondentes_dest->email; ?>&id=<?php echo $dadoscorrespondentes_dest->Id; ?>" rel="shadowbox;height=800;width=600" class="bt_contato">Entrar em contato</a>
</li>
<?php }; 
	  while($dadoscorrespondentes_semdest = mysql_fetch_object($correspondentes_semdestaque)) {;?>
<li>
    <span class="info">
    <strong class="nome"><?php echo $dadoscorrespondentes_semdest->nome; ?></strong>
    <span><?php echo $dadoscorrespondentes_semdest->tipo_profissional." | ".$dadoscorrespondentes_semdest->num_oab." - ".$dadoscorrespondentes_semdest->uf_oab; ?></span>
    <strong>Áreas de Atuação:</strong>
    <span><?php echo $dadoscorrespondentes_semdest->areas_atuacao; ?></span>
    <strong>Serviços Prestados:</strong>
    <span><?php echo $dadoscorrespondentes_semdest->servicos_prestados; ?></span>
    </span>
     <a href="#id=<?php echo $dadoscorrespondentes_semdest->Id; ?>" class="bt_telefone">Ver Telefones</a>
    <span class="box_tel" id="<?php echo $dadoscorrespondentes_semdest->Id; ?>">
    <strong> Telefones:</strong>
    <em><?php echo $dadoscorrespondentes_semdest->fonefixo; ?></em>
    <em><?php echo $dadoscorrespondentes_semdest->fonecelular; ?></em>
    </span>
    <!--<a href="#&id=123" class="bt_contato">Entrar em contato</a>-->
	<a href="contato_correspondente.php?nome=<?php echo $dadoscorrespondentes_semdest->nome; ?>&email=<?php echo $dadoscorrespondentes_semdest->email; ?>&id=<?php echo $dadoscorrespondentes_semdest->Id; ?>" rel="shadowbox;height=800;width=600" class="bt_contato">Entrar em contato</a>
</li>
<?php }; ?>

</ul>
<!--<div class="paginacao"><a href="#"> « Anterior</a><a href="#" class="ativo">1</a><a href="#">2</a><a href="#">3</a><a href="#">Próximo » </a> </div>-->
</div> 



</section>

<?php include 'rodape.php'; ?>

</body>
</html>
