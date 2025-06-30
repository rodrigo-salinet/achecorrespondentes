$(document).ready(function(){
	$('#form_cadastro').validate({
		rules:{
			// O campo Nome é de preenchimento obrigatório (required)
			CADnome:{
				required: true
			},
			// O campo CEP é de preenchimento obrigatório (required) e tamanho mínimo de 8 caracteres
			CADcep:{
				required: true,
				minlength: 8
			},
			// O campo Email é de preenchimento obrigatório (required) e o email precisa ser válido
			CADemail:{
				required: true,
				email: true
			},
			// O campo Senha é de preenchimento obrigatório (required)
			CADsenha: {
				required: true
			},
			CADcpf: {
				required: true
			},
			// O campo Confirma Senha é de preenchimento obrigatório (required) 
			// e deve ser igual ao campo Senha (equalTo)
			CADconfsenha:{
				required: true,
				equalTo: "#CADsenha"
			},
			// O campo Termo é de preenchimento obrigatório (required) 
			//termo: "required"
		},
		// Aqui ficam as mensagens de erro das regras acima,
		// que serão apresentadas caso alguma regra seja desobedecida
		messages:{
			CADnome:{
				required: "O campo Nome é obrigatório."
			},
			CADcep:{
				required: "Ops! O campo CEP é obrigatório.",
				minlength: "O campo CEP deve conter no mínimo 8 caracteres."
			},
			CADemail: {
				required: "O campo Email é obrigatório.",
				email: "O campo Email deve conter um email valido."
			},
			CADsenha: {
				required: "O campo Senha é obrigatório."
			},
			CADcpf: {
				required: "O campo CPF é obrigatório."
			},
			CADconfsenha:{
				required: "O campo Confirma Senha é obrigatório.",
				equalTo: " ATENÇÃO - Senhas não Conferem."
			},
			termo: "É necessário aceitar os termos de uso."
		}

	});
});