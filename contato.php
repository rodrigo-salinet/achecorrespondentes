<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
include 'lib/configuracoes.php'; 
include("adm/includes/conecta.php");

$n1 = rand(1,10);
$n2 = rand(1,10);
$soma = $n1 + $n2;
//echo $n1."<br>".$n2."<br>".$soma;
?>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $metadescription; ?>">
<meta name="keywords" content="<?php echo $metakeywords; ?>">
<link rel="stylesheet" href="css/form.css" />
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<?php 
$msg = $_GET['msg'];
if ($msg == "errosoma"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Atenção. \n\n A soma dos valores informados é inválida. \n\n Tente Novamente.")
</SCRIPT>
<?php }; ?>


<body>
<?php include 'topo.php'; ?>

<section id="conteudo_interno">
<div class="center">
<h2>Contato</h2>
<p style="margin-top:10px;">Para entrar em contato conosco preencha corretamente o formulário abaixo ou utilize outro de nossos canais de comunicação.</p>


<form action="envia_contato.php" method="post" id="form_contato" class="form">

    <input type="hidden" name="pagina" value="contato" />
    <p><label for="CONnome">Nome</label><input type="text" value=""  name="CONnome" /></p>
    <p><label for="CONemail">E-mail</label><input type="text" value=""  name="CONemail" /></p>
    <p><label for="CONfone">Telefone</label><input type="text" value=""   name="CONfone" /></p>
    <p><label for="CONcelular">Celular</label><input type="text" value=""   name="CONcelular"/></p>
    <p class="box_cidade"><label for="CONcidade">Cidade</label><input type="text" value=""   name="CONcidade"/></p>
    <p class="box_select"><span class="select_label">Estado</span>            
                  <select name="CADestado">
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
	<input type="hidden" name="n1" id="n1" value="<?php echo $n1; ?>" />
	<input type="hidden" name="n2" id="n2" value="<?php echo $n2; ?>" />
	<p><label for="CONmsg">Some: <?php echo $n1." + ".$n2; ?></label><input type="text" name="soma" id="soma" value="" /></p>
	<!--<p><div class="g-recaptcha" data-sitekey="6LdDnBITAAAAAEzuxtbi-xpgBr0v4XQ2XiI11J0X"></div></p>-->
    <p><input type="submit"  value="ENVIAR" class="bt_form"/></p>

    </form>

    
</div>   
</section>

<?php include 'rodape.php'; ?>

</body>
</html>
