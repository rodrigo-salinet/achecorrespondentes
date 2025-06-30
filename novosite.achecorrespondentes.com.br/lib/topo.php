<nav id="container_menu">
	<ul id="menu">
<?php
$arquivo_atual = basename($_SERVER['SCRIPT_FILENAME']);

if ($arquivo_atual != "index.php") {
?>
		<li><a href="index.php">Home</a></li>
<?php
}
?>
		<li><a href="blog.php">Blog AcheJus</a></li>
<?php
if (!isset($_SESSION['idlogadoache']) && $arquivo_atual != "cadastro.php") {
	echo '		<li><a href="cadastro.php">Cadastre-se</a></li>';
}
?>
		<li><a href="por-que-ser-correspondente.php">Por que ser um Correspondente?</a></li>
<?php
if ($arquivo_atual != "contato.php") {
?>
		<li><a href="contato.php">Contato</a></li>
<?php
}
$esconde_frm_login = '';
if (isset($_SESSION['idlogadoache'])) {
	echo '		<li><a href="area-do-correspondente.php"> | Área do Correspondente | </a></li>';
	echo '		<li><a href="sair.php"> Sair? </a></li>';
	$esconde_frm_login = ' style="display: none;"';
}

if (isset($_SESSION['idadmache'])) {
	echo '		<li><a href="adm.php"> | Administrador | </a></li>';
	echo '		<li><a href="sair.php"> Sair? </a></li>';
	$esconde_frm_login = ' style="display: none;"';
}
?>
	</ul>
</nav>
<header id="header">
	<div class="container_topo">
		<h1><?php if ($arquivo_atual != "index.php") { ?><a href="index.php">ACHE CORRESPONDENTES - DILIGÊNCIAS JURÍDICAS EM TODO PAÍS</a><?php } ?></h1>
		<form action="valida_login.php" method="post" class="form_login"<?php echo $esconde_frm_login; ?>>
			<input type="hidden" name="pagina" value="contato"/>
			<p><label for="LOGlogin">ACESSE SUA CONTA</label><input type="text" placeholder="E-Mail" name="LOGlogin" tabindex="1"/>
			</p>
			<p><a href="esqueci-senha.php" class="bt_esqueci_senha">Esqueci Minha Senha</a><label for="LOGsenha" style="display:none;">Senha</label><input type="password" placeholder="Senha" name="LOGsenha" tabindex="2"/>
			</p>
			<p><input type="submit" value="ACESSAR" class="bt_login"/>
			</p>
		</form>
	</div>
</header>
<!-- BLOQUEAR IE7 E IE8 -->
<div id="ie">
	<div>
		<p><strong>Atualize seu Navegador</strong>Nós detectamos que você esta usando uma versão obsoleta do Internet Explorer como seu navegador web.<br/>Para entrar no site e usufruir de todos os recursos, por favor instale uma versão mais atual do IE.<br/> Só levara alguns minutos para completar.</p>
		<p>O site também pode ser visto usando:</p>
		<ul id="browsers">
			<li><a href="http://www.google.com/intl/pt-BR/chrome/browser/" title="Google Chrome" target="new">Google Chrome</a>
			</li>
			<li><a href="http://www.mozilla.org/en-US/firefox/new/" title="Firefox" target="new">Firefox</a>
			</li>
			<li><a href="http://www.opera.com/download/" title="Opera" target="new">Opera</a>
			</li>
			<li><a href="http://www.apple.com/br/safari/" title="Safari" target="new">Safari</a>
			</li>
			<li><a href="http://windows.microsoft.com/pt-BR/internet-explorer/download-ie" title="Internet Explorer 9" target="new">Internet Explorer 9</a>
			</li>
		</ul>
	</div>
</div>
<?php
if ($txt_msg != "") {
?>
<div class="center">
	<h4 align="center" style="text-decoration-color: #FF0004;"><?php echo $txt_msg; ?></h4>
</div>
<?php
}
?>