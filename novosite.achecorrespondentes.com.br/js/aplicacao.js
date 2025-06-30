$(function () { 
		function removeCampo() { 
			$(".removerCampo").unbind("click"); 
			$(".removerCampo").bind("click", function () { 
				i=0; 
				$(".telefones p.campoTelefone").each(function () { 
					i++; 
				}); 
				if (i>1) { 
					$(this).parent().remove(); 
				} 
			}); 
		} 
		removeCampo(); 
		$(".adicionarCampo").click(function () { 
			novoCampo = $(".telefones p.campoTelefone:first").clone(); 
			novoCampo.find("input").val(""); 
			novoCampo.insertAfter(".telefones p.campoTelefone:last"); 
			removeCampo(); 
		}); 
});



function duplicarCampos(){
	var clone = document.getElementById('origem').cloneNode(true);
	var destino = document.getElementById('destino');
	destino.appendChild (clone);
	
	var camposClonados = clone.getElementsByTagName('input');
	
	for(i=0; i<camposClonados.length;i++){
		camposClonados[i].value = '';
	}
	
	
	
}

function removerCampos(id){
	var node1 = document.getElementById('destino');
	node1.removeChild(node1.childNodes[0]);
}
