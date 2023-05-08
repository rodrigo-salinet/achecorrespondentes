<?php 
// inclui o arquivo de configuração do sistema
include "adm/includes/conecta.php";

$id = anti_injection($_GET['id']);
$nome = anti_injection($_GET['nome']);
$plano = anti_injection($_GET['plano']);
$valor = anti_injection($_GET['valor']);
$valor = str_replace(",", ".", $valor);

$data_pedido = anti_injection($_GET['data_pedido']);
$situacao = anti_injection($_GET['situacao']);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<SCRIPT LANGUAGE="javascript">
function send()
{document.PagSeguro.submit()}
</SCRIPT>

</head>
	  
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
       <input name="submit" type="submit" id="submit" value="Finalizar Pagamento" class="formbusca" />
	   <input type="submit" name="note5" value="" />
          
</form> 
<body onload="send()">
</body>
</html>
