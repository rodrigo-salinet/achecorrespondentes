<?php 
// inclui o arquivo de configuração do sistema
include "adm/includes/conecta.php";

ob_start();
//INICIALIZA A SESSÃO 
session_start();

if ($_SESSION["logadoache"] == "SIM"){;
 
$id = anti_injection($_POST['id']);
  if ($id == ""){
    $id = anti_injection($_GET['id']);
  };	
$nome = anti_injection($_POST['nome']);
  if ($nome == ""){
    $nome = anti_injection($_GET['nome']);
  };
$sessao = anti_injection($_POST['sessao']);
  if ($sessao == ""){
    $sessao = anti_injection($_GET['sessao']);
  };
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



<form action="add_cidades_cad.php" method="post" id="form_cidade">
    <h3>ADICIONAR CIDADE</h3>

    <input type="hidden" name="pagina" value="cidade" />
                <p class="box_select"><span class="select_label">Estado</span>            
                  <select name="cod_estados" id="cod_estados">
                    <option value="" selected="selected">Estado</option>
                    <option value=""></option>
                    <?php
						$sql = "SELECT cod_estados, sigla
								FROM estados
								ORDER BY sigla";
						$res = mysql_query( $sql );
						while ( $row = mysql_fetch_assoc( $res ) ) {
							echo '<option value="'.$row['cod_estados'].'">'.$row['sigla'].'</option>';
						}
					?>
                  </select>
                </p>
                <p class="box_cidade"><span class="select_label">Escolha um Município</span> 
					<select name="cod_cidades" id="cod_cidades">
						<option value="">-- Escolha um estado --</option>
					</select>				
                </p>
    <p class="box_check"><input type="checkbox" name="destaque" value="Sim"/><span></span> <label for="ConAssunto">Em destaque</label></p>
    <p class="box_bt"><input type="submit"  value="ADICIONAR" class="bt_form"/></p>
	<input name="id" type="hidden" value="<?php echo $id; ?>" />
	<input name="nome" type="hidden" value="<?php echo $nome; ?>" />
	<input name="sessao" type="hidden" value="<?php echo $session; ?>" />

</form>

<h3>Cidades Atendidas</h3> 
    <ul class="cidades_cadastradas">
	<?php $query = mysql_query("SELECT * FROM municipios_atuacao WHERE id_correspondente = '$id' ORDER BY id DESC"); 
		    while($cidades = mysql_fetch_object($query)) { 
			if ($cidades->destaque == "Sim"){;
			  $destaque = "destaque";
			} else {
			  $destaque = "";
			};    
			   //echo "<strong><a href='del_cidades_cad.php?idmun=$cidades->Id&id=$id&nome=$nome'>X</a> - " . $cidades->municipio . " - <font color='red'>" . $destaque ."</font></strong><br>" ; 
	?>
        <!--<li class="<?php echo $destaque; ?>"><?php echo $cidades->municipio; ?><a href="del_cidades_cad.php?idmun=<?php echo $cidades->Id; ?>&id=<?php echo $id; ?>&nome=<?php echo $nome; ?>" class="excluir_cidade"></a></li>-->
		<?php }; ?>
<?php
$query_mun_dest = mysql_query("SELECT * FROM municipios_atuacao WHERE id_correspondente = '$id' AND destaque = 'Sim'");
$num_reg = mysql_num_rows($query);
$num_reg_dest = mysql_num_rows($query_mun_dest);
	
$planotrimestral = "57.90";
$planosemestral = "99.90";
$planoanual = "159.90";
$planodestaque = "45.00";

if($num_reg <= "10" ) {
	$indice = "1";
} elseif ($num_reg <= "20" && $num_reg > "10") {
	$indice = "2";
} elseif ($num_reg <= "30" && $num_reg > "20") {
	$indice = "3";
} elseif ($num_reg <= "40" && $num_reg > "30") {
	$indice = "4";
} elseif ($num_reg <= "50" && $num_reg > "40") {
	$indice = "5";
} elseif ($num_reg <= "60" && $num_reg > "50") {
	$indice = "6";
} elseif ($num_reg <= "70" && $num_reg > "60") {
	$indice = "7";
} elseif ($num_reg <= "80" && $num_reg > "70") {
	$indice = "8";
} elseif ($num_reg <= "90" && $num_reg > "80") {
	$indice = "9";
} elseif ($num_reg <= "100" && $num_reg > "90") {
	$indice = "10";
} else {
    $indice = "11";
};				

//echo "indice - ".$indice;
	
			
$valortotalcidades_tri = $planotrimestral * $indice;
$valortotalcidades_sem = $planosemestral * $indice;
$valortotalcidades_anu = $planoanual * $indice;
$valortotaldestaques = $planodestaque * $num_reg_dest;

$tottrimestral = $valortotalcidades_tri + $valortotaldestaques;
$totsemetral = $valortotalcidades_sem + $valortotaldestaques;
$totanual = $valortotalcidades_anu + $valortotaldestaques;


$valortotalcidades_tri = number_format($valortotalcidades_tri,2,",",".");
$valortotalcidades_sem = number_format($valortotalcidades_sem,2,",",".");
$valortotalcidades_anu = number_format($valortotalcidades_anu,2,",",".");
$valortotaldestaques = number_format($valortotaldestaques,2,",",".");
$tottrimestral = number_format($tottrimestral,2,",",".");
$totsemestral = number_format($totsemetral,2,",",".");
$totanual = number_format($totanual,2,",",".");
?>  

    </ul>


<h3 class="planos_tit">PLANOS DE PAGAMENTO</h3>

<form action="insere_cad_3.php" method="post" id="form_planos">
    <div class="box_plano">
        <h4>20 dias Grátis</h4>  
        <span>Até 10 Municípios
		</span>
		
        <span>2 Municípios em destaque</span>
        <strong>GRÁTIS</strong>
    <input type="radio" name="plano" value="20 dias Grátis" class="input_radio"/>
     <em></em>
    </div>


    <div class="box_plano">
        <h4>Plano Trimestral</h4>  
        <span><?php echo $num_reg; ?> Munic&iacute;pios Selecionados</span>
        <span><?php echo $num_reg_dest; ?> Munic&iacute;pio(s) em destaque</span>
        <strong>R$ <?php echo $tottrimestral; ?></strong>
    <input type="radio" name="plano" value="Plano Trimestral" class="input_radio"/>
    <em></em>
    </div>


    <div class="box_plano">
        <h4>Plano Semestral</h4>  
        <span><?php echo $num_reg; ?> Munic&iacute;pios Selecionados</span>
        <span><?php echo $num_reg_dest; ?> Munic&iacute;pio(s) em destaque</span>
        <strong>R$ <?php echo $totsemestral; ?></strong>
       <input type="radio" name="plano" value="Plano Semestral" class="input_radio"/>
           <em></em>
    </div>


    <div class="box_plano">
        <h4>Plano Anual</h4>  
        <span><?php echo $num_reg; ?> Munic&iacute;pios Selecionados</span>
        <span><?php echo $num_reg_dest; ?> Munic&iacute;pio(s) em destaque</span>
        <strong>R$ <?php echo $totanual; ?></strong>
       <input type="radio" name="plano" value="Plano Anual" class="input_radio"/>
	   
         <em></em>
    </div>

    <p><input type="submit"  value="FINALIZAR PEDIDO" class="bt_finalizar" disabled="disabled"/></p>
	<input name="id" type="hidden" value="<?php echo $id; ?>" />
	<input name="nome" type="hidden" value="<?php echo $nome; ?>" />
	<input name="sessao" type="hidden" value="<?php echo $session; ?>" />
	<input type="hidden" name="tottrimestral" id="tottrimestral" value="<?php echo $totanual; ?>" />
	<input type="hidden" name="totsemestral" id="totsemestral" value="<?php echo $totanual; ?>" />
	<input type="hidden" name="totanual" id="totanual" value="<?php echo $totanual; ?>" />
	
</form>




</div>   
</section>

<?php include 'rodape.php'; ?>

</body>
</html>
<?php
$ip=$_SERVER['REMOTE_ADDR'];
} else {
	header("Location:index.php?msg=errologin"); 
}
?>
