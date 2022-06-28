$(document).ready(function(){
    
	$("td").each(function(){
		if($(this).text()=='Solicitado'){
			$(this).addClass("text-warning");
		}
		if($(this).text()=='Asignada'){
			$(this).addClass("text-success");
		}
		if($(this).text()=='Cancelado'){
			$(this).addClass("text-danger");
		}
		if($(this).text()=='Finalizado'){
			$(this).addClass("text-secondary");
		}
	});
	
})





  

