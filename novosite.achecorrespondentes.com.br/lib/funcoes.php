<?php
//Inicia a funзгo de verificaзгo de SqlInjection
function anti_injection($txtsql) {
	// remove palavras que contenham sintaxe sql
	$txtsql = preg_replace(preg_quote("/(from|update|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "", $txtsql);
	$txtsql = trim($txtsql); //limpa espaзos vazio
	$txtsql = strip_tags($txtsql); //tira tags html e php
	$txtsql = addslashes($txtsql); //Adiciona barras invertidas a uma string
	return $txtsql;
}
//Fim da Funзгo contra o injection

function validaCPF($cpf = null) {
 
    // Verifica se um nъmero foi informado
    if(empty($cpf)) {
        return false;
    }
 
    // Elimina possivel mascara
    $cpf = ereg_replace('[^0-9]', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
     
    // Verifica se o numero de digitos informados й igual a 11 
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequкncias invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' || 
        $cpf == '11111111111' || 
        $cpf == '22222222222' || 
        $cpf == '33333333333' || 
        $cpf == '44444444444' || 
        $cpf == '55555555555' || 
        $cpf == '66666666666' || 
        $cpf == '77777777777' || 
        $cpf == '88888888888' || 
        $cpf == '99999999999') {
        return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF й vбlido
     } else {   
         
        for ($t = 9; $t < 11; $t++) {
             
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
 
        return true;
    }
}
?>