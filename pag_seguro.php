<?php 
// inclui o arquivo de configuração do sistema
include "adm/includes/conecta.php";

$id = anti_injection($_GET['id']);
$nome = anti_injection($_GET['nome']);
$plano = anti_injection($_GET['plano']);
$valor = anti_injection($_GET['valor']);
$valor = str_replace(",", ".", $valor);
$valorplano = anti_injection($_GET['valor']);

$data_pedido = anti_injection($_GET['data_pedido']);
$situacao = anti_injection($_GET['situacao']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $metadescription; ?>">
<meta name="keywords" content="<?php echo $metakeywords; ?>">
<?php include 'lib/configuracoes.php'; ?>
<link rel="stylesheet" href="css/form-cadastro.css" />
<?php 
$msg = $_GET['msg'];
if ($msg == "municipioexistente"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Atenção. \n\n Este Município já foi cadastrado !! \n\n Tente Novamente.")
</SCRIPT>
<?php }; ?>

<?php 
if ($msg == "municipioincorreto"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Atenção. \n\n Este Município não consta na lista de Municípios do IBGE !! \n\n Tente Novamente.")
</SCRIPT>
<?php }; ?>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript">
		$(function(){
			$('#cod_estados').change(function(){
				if( $(this).val() ) {
					$('#cod_cidades').hide();
					$('.carregando').show();
					$.getJSON('cidades.ajax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value=""></option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
						}	
						$('#cod_cidades').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#cod_cidades').html('<option value="">– Escolha um estado –</option>');
				}
			});
		});
</script>
</head>


<body>
<?php include 'topo.php'; ?>

<section id="conteudo_interno">
<div class="center">
<h2>Cadastro de Correspondentes</h2>





    <ul class="cidades_cadastradas">
	 Seu Cadastro foi finalizado com sucesso. Estamos processando seus dados para que eles possam aparecer de maneira mais rápida em nossos sistemas.<br><br>
	 <h3>Dados do Pedido</h3> <br>
	 Plano - <?php echo $plano; ?><br>
	 Valor - <?php echo $valorplano; ?><br><br>
	 
	 Clique no botão abaixo para finalizar seu processo de pagamento.<br><br>
    </ul>
	
	 <!-- Declaração do formulário -->  
		<form method="post" target="pagseguro" action="https://pagseguro.uol.com.br/v2/checkout/payment.html" name="PagSeguro" id="PagSeguro" >  
          
        <!-- Campos obrigatórios -->  
        <input name="receiverEmail" type="hidden" value="correspondentes@pullindearaujo.com.br">  
        <input name="currency" type="hidden" value="BRL">  
  
        <!-- Itens do pagamento (ao menos um item é obrigatório) -->  
        <input name="itemId1" type="hidden" value="0001">  
        <input name="itemDescription1" type="hidden" value="<?php echo $plano; ?>">  
        <input name="itemAmount1" type="hidden" value="<?php echo $valor; ?>">  
        <input name="itemQuantity1" type="hidden" value="1">  
        <input name="itemWeight1" type="hidden" value="1000">  
 
  
        <!-- Código de referência do pagamento no seu sistema (opcional) -->  
        <input name="reference" type="hidden" value="<?php echo "Ref_id_".$id; ?>">  
          
  
        <!-- submit do form (obrigatório) -->  
       <input name="submit" type="submit" id="submit" value="Finalizar Pagamento" class="bt_finalizar" />
          
</form>


    




</div>   
</section>

<?php include 'rodape.php'; ?>

</body>
</html>
