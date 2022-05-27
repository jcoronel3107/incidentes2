/*
 Funciones Generales
*/


// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
	'use strict';
	window.addEventListener('load', function() {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
		form.addEventListener('submit', function(event) {
			if (form.checkValidity() === false) {
			event.preventDefault();
			event.stopPropagation();
			}
			form.classList.add('was-validated');
		}, false);
		});
	}, false);
	})();

$(document).on('ready',function(){
	var dtToday = new Date();
	var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
	var day = dtToday.getDate();
	var year = dtToday.getFullYear();
	var max_charser = 1000;

	if(month < 10)
    		month = '0' + month.toString();
	if(day < 10)
		    day = '0' + day.toString();	
	
	
	var maxDate = year + '-' + month + '-' + day;
	$('#fecha_salida').attr('min', maxDate);
	$('#fecha_salida').attr('value', maxDate);
	
	$('#max').html(max_charser);
	$("#asunto").on('keyup',function() {
		var chars = $("#asunto").val().length;
		var diff = max_charser - chars;
		var leyenda = "Caracteres Permitidos 1000 Cant:";
		var res = leyenda.concat(chars);
		$("#pcounter").html(res);
		if(chars > 1000){
							$("#asunto").addClass('error');
							$("#asunto").addClass('error');
					}else{
						$("#asunto").removeClass('error');
						$("#asunto").removeClass('error');
					}
	});

	$("#vehiculo_id" ).change(function() {
		tituloventana();
	  });

    
});
		
function tituloventana(){
	jqvehiculo=$("#vehiculo_id").val();
	jqvehiculo_id=$('#vehiculo_id').find('option:selected').text();
	
	if(jqvehiculo.length!=0){
		
			console.log(jqvehiculo_id);
			jqtitle = jqvehiculo_id +" - Servicio - BCBVC";	
			document.title =jqtitle;
		
	}
}


function mayus( e ) {
	e.value = e.value.toUpperCase();
}

function compruebaKM(){
	kmsalida = $('#km_salida').val();
	
	kmretorno = $('#km_retorno').val();
	if(kmretorno<=kmsalida){
		alert("KM_Retorno tiene que ser > a KM_Salida");
		//selecciono el texto 
		$( "#km_salida" ).select();
		//coloco otra vez el foco 
		$( "#km_salida" ).focus();
		$( "#km_retorno" ).addClass('has-error');
	}
	else
	{
		$( "#km_retorno" ).removeClass('has-error');
	}
}

$("textarea").each(function () {
	this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
  }).on("input", function () {
	this.style.height = "auto";
	this.style.height = (this.scrollHeight) + "px";
  });
	