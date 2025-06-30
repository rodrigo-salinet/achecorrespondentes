<?php
//Consulta tabela `areas_atuacao` no banco de dados
$txt_sql_areas_atuacao = "SELECT * FROM `$banco_de_dados`.`areas_atuacao` ORDER BY `area`;";
$sql_areas_atuacao = mysqli_query($conn,$txt_sql_areas_atuacao);

//Consulta tabela `areas_correspondentes` no banco de dados
$txt_sql_areas_correspondentes = "SELECT * FROM `$banco_de_dados`.`areas_correspondentes` ORDER BY `id`;";
$sql_areas_correspondentes = mysqli_query($conn,$txt_sql_areas_correspondentes);

//Consulta tabela `cidades` no banco de dados
$txt_sql_cidades = "SELECT * FROM `$banco_de_dados`.`cidades` ORDER BY `nome`;";
$sql_cidades = mysqli_query($conn,$txt_sql_cidades);

//Consulta tabela `cidades_atendidas` no banco de dados
$txt_sql_cidades_atendidas = "SELECT * FROM `$banco_de_dados`.`cidades_atendidas` ORDER BY `municipio`;";
$sql_cidades_atendidas = mysqli_query($conn,$txt_sql_cidades_atendidas);

//Consulta tabela `cidades_procuradas` no banco de dados
$txt_sql_cidades_procuradas = "SELECT * FROM `$banco_de_dados`.`cidades_procuradas` ORDER BY `municipio`;";
$sql_cidades_procuradas = mysqli_query($conn,$txt_sql_cidades_procuradas);

//Consulta tabela `cliques` no banco de dados
$txt_sql_cliques = "SELECT * FROM `$banco_de_dados`.`cliques` ORDER BY `data`;";
$sql_cliques = mysqli_query($conn,$txt_sql_cliques);

//Consulta tabela `correspondentes` no banco de dados
$txt_sql_correspondentes = "SELECT * FROM `$banco_de_dados`.`correspondentes` ORDER BY `nome`;";
$sql_correspondentes = mysqli_query($conn,$txt_sql_correspondentes);

//Consulta tabela `estados` no banco de dados
$txt_sql_estados = "SELECT * FROM `$banco_de_dados`.`estados` ORDER BY `nome`;";
$sql_estados = mysqli_query($conn,$txt_sql_estados);

//Consulta tabela `loginadm` no banco de dados (Desabilitada por segurança)
$txt_sql_loginadm = "SELECT * FROM `$banco_de_dados`.`loginadm` ORDER BY `login`;";
$sql_loginadm = mysqli_query($conn,$txt_sql_loginadm);

//Consulta tabela `metatags` no banco de dados
$txt_sql_metatags = "SELECT * FROM `$banco_de_dados`.`metatags` ORDER BY `title`;";
$sql_metatags = mysqli_query($conn,$txt_sql_metatags);

//Consulta tabela `municipios` no banco de dados
$txt_sql_municipios = "SELECT * FROM `$banco_de_dados`.`municipios` ORDER BY `nome`;";
$sql_municipios = mysqli_query($conn,$txt_sql_municipios);

//Consulta tabela `noticias` no banco de dados
$txt_sql_noticias = "SELECT * FROM `$banco_de_dados`.`noticias` ORDER BY `data`;";
$sql_noticias = mysqli_query($conn,$txt_sql_noticias);

//Consulta tabela `pagamentos` no banco de dados
$txt_sql_pagamentos = "SELECT * FROM `$banco_de_dados`.`pagamentos` ORDER BY `data`;";
$sql_pagamentos = mysqli_query($conn,$txt_sql_pagamentos);

//Consulta tabela `pedidos_situacoes` no banco de dados
$txt_sql_pedidos_situacoes = "SELECT * FROM `$banco_de_dados`.`pedidos_situacoes` ORDER BY `situacao`;";
$sql_pedidos_situacoes = mysqli_query($conn,$txt_sql_pedidos_situacoes);

//Consulta tabela `planos` no banco de dados
$txt_sql_planos = "SELECT * FROM `$banco_de_dados`.`planos` ORDER BY `valor`;";
$sql_planos = mysqli_query($conn,$txt_sql_planos);

//Consulta tabela `regioes_metropolitanas` no banco de dados
$txt_sql_regioes_metropolitanas = "SELECT * FROM `$banco_de_dados`.`regioes_metropolitanas` ORDER BY `nome`;";
$sql_regioes_metropolitanas = mysqli_query($conn,$txt_sql_regioes_metropolitanas);

//Consulta tabela `servicos_correspondentes` no banco de dados
$txt_sql_servicos_correspondentes = "SELECT * FROM `$banco_de_dados`.`servicos_correspondentes` ORDER BY `id`;";
$sql_servicos_correspondentes = mysqli_query($conn,$txt_sql_servicos_correspondentes);

//Consulta tabela `servicos_prestados` no banco de dados
$txt_sql_servicos_prestados = "SELECT * FROM `$banco_de_dados`.`servicos_prestados` ORDER BY `servico`;";
$sql_servicos_prestados = mysqli_query($conn,$txt_sql_servicos_prestados);

//Consulta tabela `tipos_profissional` no banco de dados
$txt_sql_tipos_profissional = "SELECT * FROM `$banco_de_dados`.`tipos_profissional` ORDER BY `tipo`;";
$sql_tipos_profissional = mysqli_query($conn,$txt_sql_tipos_profissional);
?>