<?php 
// inclui o arquivo de configura��o do sistema
include "adm/includes/conecta.php";

$nome = anti_injection($_POST['CADnome']); 
$email = anti_injection($_POST['CADemail']); 
$senha = anti_injection($_POST['CADsenha']);
$dtnascimento = anti_injection($_POST['CADnasc']);
$dtnascimento = substr($dtnascimento,6,4).substr($dtnascimento,3,2).substr($dtnascimento,0,2); 
$fonefixo = anti_injection($_POST['CADfone']); 
$fonecelular = anti_injection($_POST['CADcelular']); 
$cpf = anti_injection($_POST['CADcpf']); 
$cnpj = anti_injection($_POST['CADcnpj']); 
$cep = anti_injection($_POST['CADcep']); 
$endereco = anti_injection($_POST['CADend']); 
$numendereco = anti_injection($_POST['numendereco']); 
$complemento = anti_injection($_POST['CADcomp']); 
$bairro = anti_injection($_POST['CADbairro']); 
$cidade = anti_injection($_POST['CADcidade']); 
$uf = anti_injection($_POST['CADestado']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $metadescription; ?>">
<meta name="keywords" content="<?php echo $metakeywords; ?>">
<?php include 'lib/configuracoes.php'; ?>
<link rel="stylesheet" href="css/form.css" />
<link rel="stylesheet" href="css/form-cadastro.css" />
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


<form action="insere_cad_2.php" method="post" enctype="multipart/form-data" id="form_cadastro" class="form">

 <div class="box_form">  
    <!--<p class="box_select_profissional"><span class="select_label">Profissional</span>-->
                  <select name="CADprofissional" class="box_select_profissional">
                    <option value="" selected="selected"><span class="box_registro"/>Tipo de Profissional</span></option>
                    <option value="Advogado"><p class="box_registro"/>Advogado</p></option>
                    <option value="Bacharel">Bacharel</option>
                    <option value="Outros">Outros</option>
                  </select>
                <!--</p>-->
                <div style="clear:both"></div>
    
    <!--<p class="box_select_registro"><span class="select_label_registro">Estado</span>-->    
                  <select name="CADestado_oab" class="box_select_registro">
                    <option value="" selected="selected">Estado</option>
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
                <!--</p>-->
                <p class="box_registro"><label for="CADregistro">Registro na OAB</label><input type="text" value="" name="CADregistro"/></p>
                <div style="clear:both"></div>
    <p><label for="CADurl">Site do Escrit�rio / Profissional</label><input type="text" value=""  name="CADurl" /></p>
    <p><label for="CADdadosgerais">Dados Gerais</label><textarea rows="4" cols="50" name="CADdadosgerais"></textarea></p>
    <p><label for="CADimagem">Foto / Logo</label><input type="file" value=""  name="CADimagem" /><span class="obs">* O arquivo deve estar no padr�o JPG, PNG ou GIF, com no m�ximo 500kb.</span></p>
    <div style="clear:both"></div>
</div> 

 <div class="box_form"> 
    <p><label for="CADatuacao">�reas de Atua��o</label><br />

        <input type="checkbox"  name="atuacao[]" value="Administrativo" class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Administrativo</label>
        <br />
		
		<INPUT TYPE="checkbox" NAME="atuacao[]" value="op1" css-checkbox>
		<label for="checkbox65" class="css-label med elegant">teste</label>
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

        <input type="checkbox"  name="atuacao[]" value="Comercial" class="css-checkbox med" />
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

        <input type="checkbox"  name="atuacao[]" value="Consumidor" class="css-checkbox med" />
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

        <input type="checkbox"  name="servicos[]" value="Audi�ncias"  class="css-checkbox med" />
        <label for="checkbox65" class="css-label med elegant">Audi�ncias</label>
        <br />


        <input type="checkbox"  name="servicos[]" value="C�pias"  class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">C�pias</label>
        <br />

        <input type="checkbox"  name="servicos[]" value="Outros"  class="css-checkbox med"/>
        <label for="checkbox65" class="css-label med elegant">Outros</label>
        <br />
    </p>
    
    <p style="margin-top:30px;"><input type="submit"  value="CONTINUAR CADASTRO" class="bt_form"/></p>
</div>
<input name="nome" type="hidden" value="<?php echo $nome; ?>" />
<input name="email" type="hidden" value="<?php echo $email; ?>" />
<input name="senha" type="hidden" value="<?php echo $senha; ?>" />
<input name="dtnascimento" type="hidden" value="<?php echo $dtnascimento; ?>" />
<input name="fonefixo" type="hidden" value="<?php echo $fonefixo; ?>" />
<input name="fonecelular" type="hidden" value="<?php echo $fonecelular; ?>" />
<input name="cpf" type="hidden" value="<?php echo $cpf; ?>" />
<input name="cnpj" type="hidden" value="<?php echo $cnpj; ?>" />
<input name="cep" type="hidden" value="<?php echo $cep; ?>" />
<input name="endereco" type="hidden" value="<?php echo $endereco; ?>" />
<input name="numendereco" type="hidden" value="<?php echo $numendereco; ?>" />
<input name="complemento" type="hidden" value="<?php echo $complemento; ?>" />
<input name="bairro" type="hidden" value="<?php echo $bairro; ?>" />
<input name="cidade" type="hidden" value="<?php echo $cidade; ?>" />
<input name="uf" type="hidden" value="<?php echo $uf; ?>" />
<div style="clear:both"></div>
    </form>


    
</div>   
</section>

<?php include 'rodape.php'; ?>

</body>
</html>
