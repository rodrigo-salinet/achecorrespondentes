<?php
$nome = $_GET['nome'];
$email = $_GET['email'];
$msg = $_GET['msg'];
$id = $_GET['id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $metadescription; ?>">
<meta name="keywords" content="<?php echo $metakeywords; ?>">
<link rel="stylesheet" href="css/form.css" />

<script src="js/jquery.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
<script language="javascript" type="text/javascript" src="js/validacao.js"></script>
<script src="js/cep.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>

<script>
jQuery(function($){
	  
	  
       $("#CONfone").mask("(99) 9999-9999");
	   $("#CONfone").mask("(99) 9999-9999");
       	
	
	$('#CONcelular').focusout(function(){
    var phone, element;
    element = $(this);
    element.unmask();
    phone = element.val().replace(/\D/g, '');
    if(phone.length > 10) {
        element.mask("(99) 99999-999?9");
    } else {
        element.mask("(99) 9999-9999?9");
    }
}).trigger('focusout');


	   
});



</script>

<?php 
include 'lib/configuracoes.php'; 
include("adm/includes/conecta.php");
$dataatual = date('Y-m-d');
?>

</head>


<body>
<div>
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
<form action="envia_contato_correspondente.php" method="post" id="form_fale_conosco" class="form">
    
<?php if ($msg == "emailcontatook"){ ?>
<h3>E-Mail Enviado com Sucesso !!!</h3>
<?php }  else { ; ?>
<h3><?php echo $nomecorrespondente; ?></h3>
<strong><?php echo $tipo_profissional." | ".$num_oab." - ".$uf_oab; ?></strong>
 
    <p><label for="CONemail">E-mail</label><input type="text" value=""  name="CONemail" /></p>
    <p class="menor"><label for="CONfone">Telefone</label><input type="text" name="CONfone" id="CONfone" /></p>
    <p class="menor"><label for="CONcelular">Celular</label><input type="text" name="CONcelular" id="CONcelular"/></p>
    <p class="box_cidade"><label for="CONcidade">Cidade</label><input type="text" name="CONcidade"/></p>
    <p class="box_select"><span class="select_label">Estado</span>            
                  <select name="CONestado">
                    <option value="" selected="selected">Estado</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AM">Amazonas</option>
                    <option value="AP">Aamap�</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Cear�</option>
                    <option value="DF">Distrito federal</option>
                    <option value="ES">Esp�rito santo</option>
                    <option value="GO">Goi�s</option>
                    <option value="MA">Maranh�o</option>
                    <option value="MG">Minas gerais</option>
                    <option value="MS">Mato grosso do sul</option>
                    <option value="MT">Mato grosso</option>
                    <option value="PA">Par�</option>
                    <option value="PB">Para�ba</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piau�</option>
                    <option value="PR">Paran�</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RO">Rond�nia</option>
                    <option value="RR">Ror�ima</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SE">Sergipe</option>
                    <option value="SP">S�o Paulo</option>
                    <option value="TO">Tocantins</option>
                  </select>
                </p>
                <div style="clear:both"></div>
                  <p><label for="CONmsg">Mensagem</label><textarea name="CONmsg"></textarea></p>
				  <input type="hidden" name="emailcorrespondente" id="emailcorrespondente" value="<?php echo $email; ?>" />
				  <input type="hidden" name="nomecorrespondente" id="nomecorrespondente" value="<?php echo $nome; ?>" />
				  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
    <p style="margin-top:30px;"><input type="submit"  value="ENVIAR" class="bt_form"/></p>

    </form>

</div>
</section>
<?php }; ?>
</body>
</html>
