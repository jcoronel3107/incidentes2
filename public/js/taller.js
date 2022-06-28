$(document).ready(function(){
    
	$("td").each(function(){
		if($(this).text()=='Solicitado'){
			$(this).addClass("text-warning");
		}
		if($(this).text()=='Asignado'){
			$(this).addClass("text-success");
		}
		if($(this).text()=='Cancelado'){
			$(this).addClass("text-danger");
		}
		if($(this).text()=='Finalizado'){
			$(this).addClass("text-secondary");
		}
	});
	
    $("#btnsend").on("click", function (event) { 
		
       // Obtener hijos dentro de etiqueta <div>
	var cont = document.getElementById('mecanicos').children;
	var i = 0;
    var al_menos_uno = false;
	
	//Recorrido de checkbox's
	while (i < cont.length) {
        // Verifica si el elemento es un checkbox
        if ( cont[i].type == 'checkbox') {
            // Verifica si esta checked
            if (cont[i].checked) {
                al_menos_uno = true;
            }
        }
    	i++
	}
	//Valida si al menos un checkbox es checked
	if (!al_menos_uno) {
	    alert('Selecciona al menos un checkbox');
		if (event.preventDefault) {
			event.preventDefault();
		} else {
			event.returnValue = false;
		}
	}
	else{
		createworkorder();
	}

    });
});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function createworkorder(){

	var fecha=$("#fecha").val();
	var km_ingreso = $("#km_ingreso").val();
	var maintenance_request_id = $("#maintenance_request_id").val();
	var url = 'createworkorder';
	$.ajax({
		url: url,
		type: 'post',
		data:{
			fecha:fecha,
			km_ingreso:km_ingreso,
			status:'Asignada',
			maintenance_request_id:maintenance_request_id
		},
		success:  function (response) {
			alert('Orden de Trabajo Asignada!!!');
		 },
		statusCode: {
			404: function() {
			   alert('web not found');
			}
		 },
		 error:function(x,xs,xt){
			 //nos dara el error si es que hay alguno
			 window.open(JSON.stringify(x));
			 alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
		 }
	});

}





  

