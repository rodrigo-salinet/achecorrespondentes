$(document).ready(function(){
	$('#form_cadastro').validate({
		rules:{
			// O campo Nome é de preenchimento obrigatório (required) e tamanho mínimo de 2 caracteres
			CADcep:{
				required: true,
				minlength: 8
			},
			// O campo Email é de preenchimento obrigatório (required) e o email precisa ser válido
			CADemail:{
				required: true,
				email: true
			},
			/*// O campo Time, é de preenchimento obrigatório (required)
			time: {
				required: true
			},
			// O campo Observação, é de preenchimento obrigatório (required)
			// 3 é o mínimo de caracteres e 10 é o máximo de caracteres que podem ser digitados
			obs: {
				required: true,
				minlength: 3,
				maxlength: 10
			},
			// O campo Senha é de preenchimento obrigatório (required)
			*/
			CADsenha: {
				required: true
			},
			CADcpf: {
				required: true
			},
			/*cnpj: {
				required: true
			}, */
			// O campo Confirma Senha é de preenchimento obrigatório (required) 
			// e deve ser igual ao campo Senha (equalTo)
			CADconfsenha:{
				required: true,
				equalTo: "#CADsenha"
			},
			// O campo Termo é de preenchimento obrigatório (required) 
			//termo: "required"
		},
		// Aqui fica as mensagens de erro das regras acima,
		// que serão apresentadas caso alguma regra seja desobedecida
		messages:{
			CADcep:{
				required: "O campo Cep &eacute; obrigat&oacute;rio.",
				minlength: "O campo CEP deve conter no m&iacute;nimo 8 caracteres."
			},
			CADemail: {
				required: "O campo Email &eacute; obrigat&oacute;rio.",
				email: "O campo Email deve conter um email valido."
			},
			time:{
				required: "É necessário selecionar o seu time favorito."
			},
			obs:{
				required: "O campo Observação é obrigatório.",
				minlength: "O campo Observação deve conter no mínimo 3 caracteres.",
				maxlength: "O campo Observação deve conter no máximo 10 caracteres."
			},
			CADsenha: {
				required: "O campo Senha &eacute; obrigat&oacute;rio."
			},
			CADcpf: {
				required: "O campo CPF &eacute; obrigat&oacute;rio.."
			},
			cnpj: {
				required: "O campo CNPJ &eacute; obrigat&oacute;rio."
			},
			CADconfsenha:{
				required: "O campo Confirma Senha &eacute; obrigat&oacute;rio.",
				equalTo: "  ATEN&Ccedil;&Atilde;O - Senhas n&atilde;o Conferem."
			},
			termo: "É necessário aceitar os termos de uso."
		}

	});
});