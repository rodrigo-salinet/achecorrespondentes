<?php 
include 'lib/configuracoes.php'; 
include("adm/includes/conecta.php"); 

ob_start();
//INICIALIZA A SESS�O 
session_start();

if ($_SESSION["logadoache"] == "SIM"){;

$loginlogado = $_SESSION[loginlogadoache];
//echo $loginlogado;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $metadescription; ?>">
<meta name="keywords" content="<?php echo $metakeywords; ?>">
<?php include 'lib/configuracoes.php'; ?>
<link rel="stylesheet" href="css/form.css" />
<?php 
$erro = $_GET['erro'];
if ($erro <> ""){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Aten��o. \n\n<?php echo $erro; ?>")
</SCRIPT>
<?php }; ?>
</head>


<body>
<?php include 'topo.php'; ?>

<section id="conteudo_interno">
<div class="center">
<h2>Dados Profissionais</h2>
<p style="margin-top:10px;">Cadastro para Estagi�rios, Bachareis em Direito e Advogados. Inclua seus dados e ofere�a agora mesmo seus servi�os!</p>
<?php 
	$correspondente = mysql_query("SELECT * FROM `correspondentes` WHERE `email` = '$loginlogado'");
		while($dados_correspondente = mysql_fetch_object($correspondente)) {;
		$dtnascimento = substr($dados_correspondente->dtnascimento,8,2)."/".substr($dados_correspondente->dtnascimento,5,2)."/".substr($dados_correspondente->dtnascimento,0,4); 		
?>

<form action="up_meusdados2.php" method="post" enctype="multipart/form-data" id="form_cadastro" class="form">

 <div class="box_form">  
    <p class="box_select_profissional"><span class="select_label"><?php echo $dados_correspondente->tipo_profissional; ?></span>            
                  <select name="CADprofissional">
                    <option value="<?php echo $dados_correspondente->tipo_profissional; ?>" selected="selected"><?php echo $dados_correspondente->tipo_profissional; ?></option>
					<option value=""></option>
                    <option value="Advogado">Advogado</option>
                    <option value="Bacharel">Bacharel</option>
                    <option value="Outros">Outros</option>
                  </select>
                </p>
                <div style="clear:both"></div>
    
    <p class="box_select_registro"><span class="select_label_registro"><?php echo $dados_correspondente->uf_oab; ?></span>            
                  <select name="CADestado_oab">
                    <option value="<?php echo $dados_correspondente->uf_oab; ?>" selected="selected"><?php echo $dados_correspondente->uf_oab; ?></option>
					<option value=""></option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AM">Amazonas</option>
                    <option value="AP">Amap�</option>
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
                <p class="box_registro"><label for="CADregistro">Registro na OAB</label><input type="text" value="<?php echo $dados_correspondente->num_oab; ?>" name="CADregistro"/></p>
                <div style="clear:both"></div>
    <p><label for="CADurl">Site do Escrit�rio / Profissional</label><input type="text" value="<?php echo $dados_correspondente->site; ?>"  name="CADurl" /></p>
    <p><label for="CADdadosgerais">Dados Gerais</label><textarea rows="4" cols="50" name="CADdadosgerais"><?php echo $dados_correspondente->dadosgerais; ?></textarea></p>
    <p><label for="areaatuacao">�reas de Atua��o</label><textarea rows="4" cols="50" name="areaatuacao"><?php echo $dados_correspondente->areas_atuacao; ?></textarea><span class="obs">* Para altera��o das �reas de atua��o, altere no quadro ao lado.</span></p>
	<p><label for="servicosprestados">Servi�os Prestados</label><textarea rows="4" cols="50" name="servicosprestados"><?php echo $dados_correspondente->servicos_prestados; ?></textarea><span class="obs">* Para altera��o dos servi�os prestados, altere no quadro ao lado.</span></p>
    <div style="clear:both"></div>
</div> 

 <div class="box_form"> 
    <p><label for="CADatuacao">�reas de Atua��o</label><br />

        <input type="checkbox"  name="atuacao[]" value="Administrativo" class="css-checkbox med" checked="checked"/>
        <label for="checkbox65" class="css-label med elegant">Administrativo</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Ambiental" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Ambiental</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Banc�rio" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Banc�rio</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Civil" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Civil</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Comercial" class="css-checkbox med" checked="checked"/>
        <label for="checkbox65" class="css-label med elegant">Comercial</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Comercial" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Comercial</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Constitucional" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Constitucional</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Consultoria" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Consultoria</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Consumidor" class="css-checkbox med" checked="checked"/>
        <label for="checkbox65" class="css-label med elegant">Consumidor</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Contrato" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Contrato</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Desportivo" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Desportivo</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Digital" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Digital</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Neg�cio" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Neg�cio</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Fam�lia e Sucess�es" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Fam�lia e Sucess�es</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Financeiro" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Financeiro</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Imobili�rio" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Imobili�rio</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Internacional" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Internacional</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Media��o e Arbitragem" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Media��o e Arbitragem</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Penal" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Penal</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Industrial da Propriedade Intelectual" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Industrial da Propriedade Intelectual</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Trabalho" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Trabalho</label>
        <br />

        <input type="checkbox"  name="atuacao[]" value="Tribut�rio" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Tribut�rio</label>
        <br />
    </p>

    <p><label for="CADatuacao">Servi�os Prestados</label><br />

        <input type="checkbox"  name="servicos[]" value="Audi�ncias"  class="css-checkbox med" checked="checked"/>
        <label for="checkbox65" class="css-label med elegant">Audi�ncias</label>
        <br />


        <input type="checkbox"  name="servicos[]" value="C�pias"  class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">C�pias</label>
        <br />

        <input type="checkbox"  name="servicos[]" value="Outros"  class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Outros</label>
        <br />
    </p>
    
    <p style="margin-top:30px;"><input type="submit"  value="ATUALIZAR CADASTRO" class="bt_form"/></p>
</div>
<div style="clear:both"></div>
<?php }; ?>
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
