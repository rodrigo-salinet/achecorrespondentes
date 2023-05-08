<?php 
include 'lib/configuracoes.php'; 
include("adm/includes/conecta.php"); 

ob_start();
//INICIALIZA A SESSÃO 
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
<link rel="stylesheet" href="css/form.css" />
<script src="js/jquery.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
<script language="javascript" type="text/javascript" src="js/validacao.js"></script>
<script src="js/cep.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>

<script>
jQuery(function($){
	  
	   $("#CADnasc").mask("99/99/9999");
       $("#CADfone").mask("(99) 9999-9999");
       
	   $("#CADcpf").mask("999.999.999-99");
	   $("#CADcnpj").mask("99.999.999/9999-99");
	   $("#CADcep").mask("99999999");	
	
	$('#CADcelular').focusout(function(){
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
$msg = $_GET['msg'];
if ($msg == "sucesso"){; ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Atenção. \n\n Dados Alterados com sucesso !!")
</SCRIPT>
<?php }; ?>
</head>


<body>
<?php include 'topo.php'; ?>

<section id="conteudo_interno">
<div class="center">
<h2>Cadastro de Correspondentes</h2>
<p style="margin-top:10px;">Cadastro para Estagiários, Bachareis em Direito e Advogados. Inclua seus dados e ofereça agora mesmo seus serviços!</p>
<?php 
	$correspondente = mysql_query("SELECT * FROM `correspondentes` WHERE `email` = '$loginlogado'");
		while($dados_correspondente = mysql_fetch_object($correspondente)) {;
		$dtnascimento = substr($dados_correspondente->dtnascimento,8,2)."/".substr($dados_correspondente->dtnascimento,5,2)."/".substr($dados_correspondente->dtnascimento,0,4); 		
?>

<form action="up_meusdados.php" method="post" id="form_cadastro" class="form" onsubmit="return validarSenha(this);">
    <input type="hidden" name="pagina" value="contato" />

 <div class="box_form">  
    <p><label for="CADnome">Nome</label><input type="text" value="<?php echo $dados_correspondente->nome; ?>"  name="CADnome" /></p>
    <p><label for="CADemail">E-mail</label><input type="text" value="<?php echo $dados_correspondente->email; ?>"  name="CADemail" /></p>
     <!--<p class="menor"><label for="CADsenha">Senha</label><input type="password" value="<?php echo $dados_correspondente->senha; ?>" id="CADsenha" name="CADsenha" /></p>
     <p class="menor"><label for="CADconfsenha">Confirmar de Senha</label><input type="password" value="<?php echo $dados_correspondente->senha; ?>"  id="CADconfsenha" name="CADconfsenha" /></p>-->
     <p><label for="CADnasc">Data de Nascimento</label><input type="text" value="<?php echo $dtnascimento; ?>"  name="CADnasc" id="CADnasc" /></p>
    <p><label for="CADfone">Telefone</label><input type="text" value="<?php echo $dados_correspondente->fonefixo; ?>" id="CADfone" name="CADfone" /></p>
    <p><label for="CADcelular">Celular</label><input type="text" value="<?php echo $dados_correspondente->fonecelular; ?>" id="CADcelular" name="CADcelular"/></p>
</div> 

 <div class="box_form"> 
    <p class="menor"><label for="CADcpf">CPF</label><input type="text" value="<?php echo $dados_correspondente->cpf; ?>"  id="CADcpf" name="CADcpf"/></p>
    <p class="menor"><label for="CADcnpj">CNPJ</label><input type="text" value="<?php echo $dados_correspondente->cnpj; ?>"   id="CADcnpj" name="CADcnpj"/></p>
    <p><label for="CADend">Endereço</label><input type="text" value="<?php echo $dados_correspondente->endereco.", ".$dados_correspondente->numendereco; ?>"   name="CADend"/></p>
    <p class="menor"><label for="CADcomp">Complemento</label><input type="text" value="<?php echo $dados_correspondente->complemento; ?>"   name="CADcomp"/></p>
    <p class="menor"><label for="CADcep">CEP</label><input type="text" value="<?php echo $dados_correspondente->cep; ?>" id="CADcep"  name="CADcep"/></p>
    <p><label for="CADbairro">Bairro</label><input type="text" value="<?php echo $dados_correspondente->bairro; ?>"   name="CADbairro"/></p>
    <p class="box_cidade"><label for="CADcidade">Cidade</label><input type="text" value="<?php echo $dados_correspondente->cidade; ?>"   name="CADcidade"/></p>
    <p class="box_select"><span class="select_label">Estado</span>            
                  <select name="CADestado">
                    <option value="<?php echo $dados_correspondente->uf; ?>" selected="selected"><?php echo $dados_correspondente->uf; ?></option>
                    <option value=""></option>
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
				<input type="hidden" name="id" id="id" value="<?php echo $dados_correspondente->Id; ?>" size="30" />
                <div style="clear:both"></div>
				
				
    <p style="margin-top:30px;"><input type="submit"  value="ATUALIZAR DADOS" class="bt_form"/></p>
</div>
    </form>
<?php }; ?>
    
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
