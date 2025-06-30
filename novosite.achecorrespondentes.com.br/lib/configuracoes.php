<!-- HTML - Define os caracteres para iso-8859-1-->
<meta charset="iso-8859-1">

<!-- HTML - Define tipo de conteúdo para text/html e os caracteres para iso-8859-1-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- HTML - Define variáveis de ambiente "Descrição" vinculadas ao banco de dados -->
<meta name="description" content="<?php echo $metadescription; ?>">

<!-- HTML - Define variáveis de ambiente "Palavras-Chave" vinculadas ao banco de dados -->
<meta name="keywords" content="<?php echo $metakeywords; ?>">

<!-- HTML - Define o cabeçalho viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1; user-scalable=0; minimum-scale=1.0; maximum-scale=1.0"/>

<!-- HTML - Define o cabeçalho format-detection -->
<meta name="format-detection" content="telephone=no"/>

<!-- HTML - Inclui o arquivo default.css de propriedades visuais padrão -->
<link rel="stylesheet" href="css/default.css"/>

<!-- HTML - Inclui arquivo CSS de propriedades visuais de campos de formulário -->
<link rel="stylesheet" href="css/form.css"/>

<!-- HTML - Inclui arquivo CSS de propriedades visuais de campos de formulário de cadastro -->
<link rel="stylesheet" href="css/form-cadastro.css"/>

<!-- HTML - Inclui o arquivo modernizr.custom.50089.js às funções javascript -->
<script language="javascript" type="text/javascript" src="js/modernizr.custom.50089.js" charset="iso-8859-1"></script>

<!-- HTML - Inclui o arquivo jquery.js às funções javascript -->
<script language="javascript" type="text/javascript" src="js/jquery.js" charset="iso-8859-1"></script>

<!-- HTML - Inclui arquivo javascript de funções de validação de campos de formulário -->
<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js" charset="iso-8859-1"></script>

<!-- HTML - Inclui arquivo javascript de funções de CEP -->
<script language="javascript" type="text/javascript" src="js/cep.js" charset="iso-8859-1"></script>

<!-- HTML - Inclui arquivo javascript de funções de máscara de campos de formulários -->
<script language="javascript" type="text/javascript" src="js/jquery.maskedinput.js" charset="iso-8859-1"></script>

<!-- HTML - Inclui arquivos javascript de funções de caixas de sombra -->
<script language="javascript" type="text/javascript" src="lib/shadowbox/demo.js" charset="iso-8859-1"></script>
<script language="javascript" type="text/javascript" src="lib/shadowbox/adapter/shadowbox-base.js" charset="iso-8859-1"></script>
<script language="javascript" type="text/javascript" src="lib/shadowbox/shadowbox.js" charset="iso-8859-1"></script>

<?php
if ($_SERVER['HTTP_HOST'] != "localhost") {
?>
<!-- HTML - Define a função javascript "google-analytics" -->
<script language="javascript" type="text/javascript">
	(function (i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] || function () {
			(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o),
			m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-15672987-25', 'achecorrespondentes.com.br');
	ga('send', 'pageview');
</script>
<?php
}
?>
<!-- HTML - Define a função javascript "TestaCPF" -->
<script language="javascript" type="text/javascript">
function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
	if (strCPF == "00000000000" 
	|| strCPF == "11111111111" 
	|| strCPF == "22222222222" 
	|| strCPF == "33333333333" 
	|| strCPF == "44444444444" 
	|| strCPF == "55555555555" 
	|| strCPF == "66666666666" 
	|| strCPF == "77777777777" 
	|| strCPF == "88888888888" 
	|| strCPF == "99999999999") {
		return false;
	}
    
	for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
	Resto = (Soma * 10) % 11;
	
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
	
	Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
	
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}
</script>
