<?php
//header( 'Content-Type: text/html; charset=iso-8859-1' );
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set( 'America/Sao_Paulo' );
//echo strftime( '%A, %d de %B de %Y', strtotime( date( 'Y-m-d' ) ) );

	$var = $_SERVER["REMOTE_ADDR"];
	$dataHora = date("dmYhis");
	//echo $dataHora."<br>";
	$var = $var."".$dataHora;
	//echo $var;
	$var = md5($var);
	//echo $var;
	//inicio uma Sessao para armazenar o carrinho de compras
	ob_start();
	session_start("carrinhoache");
	
	//echo $_SESSION[carrinhohp];
	 
	//gravo as informações das variáveis dentro das sessões
	if ($_SESSION[carrinhoache] == ""){
	   $_SESSION[carrinhoache] = $var;
	} else {  
	   $_SESSION[carrinhoache] = $_SESSION[carrinhoache];
	}   
	$session = $_SESSION[carrinhoache];
	//echo $session;
?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-15672987-25', 'achecorrespondentes.com.br');
  ga('send', 'pageview');

</script>
 <nav id="container_menu">
  
        
       
    </nav>
<header id="header">
<div class="container_topo">
<h1><a href="index.php">ACHE CORRESPONDENTES - DILIGÊNCIAS JURÍDICAS EM TODO PAÍS</a></h1>



  </div>
</header>

   <!-- BLOQUEAR IE7 E IE8 -->
        <div id="ie">
            <div>
                <p><strong>Atualize seu Navegador</strong>Nós detectamos que você esta usando uma versão obsoleta do Internet Explorer como seu navegador web.<br/>Para entrar no site e usufruir de todos os recursos, por favor instale uma versão mais atual do IE.<br/> Só levara alguns minutos para completar.</p>
                <p>O site também pode ser visto usando:</p>
                <ul id="browsers">
                    <li><a href="http://www.google.com/intl/pt-BR/chrome/browser/" title="Google Chrome" target="new">Google Chrome</a></li>
                    <li><a href="http://www.mozilla.org/en-US/firefox/new/" title="Firefox" target="new">Firefox</a></li>
                    <li><a href="http://www.opera.com/download/" title="Opera" target="new">Opera</a></li>
                    <li><a href="http://www.apple.com/br/safari/" title="Safari" target="new">Safari</a></li>
                    <li><a href="http://windows.microsoft.com/pt-BR/internet-explorer/download-ie" title="Internet Explorer 9" target="new">Internet Explorer 9</a></li>
                </ul>
            </div>
        </div> 