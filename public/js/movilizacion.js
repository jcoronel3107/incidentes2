/*
 Funciones Generales
*/
var chkcomision = document.getElementById('chkcomision');
var chkdenuncia = document.getElementById('chkdenuncia');
var chkgas = document.getElementById('chkgas');
var chkhabitabilidad = document.getElementById('chkhabitabilidad');
var chkinvestigacion = document.getElementById('chkinvestigacion');
var chklocales = document.getElementById('chklocales');
var chkotros = document.getElementById('chkotros');
    
var strcomision, strdenuncia, strgas, strhabitabilidad, strinvestigacion, strlocales, strotros;

$(document).ready(function(){
   
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    $("select[name=vehiculo_id]").change(function(){
    
             document.title =$('select[name=vehiculo_id] option:selected').text()+" - Movilizacion";
            
    });
        
    if(month < 10)
            month = '0' + month.toString();
    if(day < 10)
            day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day+'T00:00';
    /* $('#fecha_salida').attr('min', maxDate);
    $('#fecha_retorno').attr('min', maxDate); */

    var max_chars = 1000;
	$('#max').html(max_chars);
    $("#observaciones").keyup(function() {
        var chars = $("#observaciones").val().length;
        var diff = max_chars - chars;
        var leyenda = "Caracteres Permitidos 1000 Cant:";
        var res = leyenda.concat(chars);
        $("#pcounter").html(res);
        if(chars > 1000){
            $("#observaciones").addClass('invalid');
            $("#observaciones").addClass('invalid');
        }else{
            $("#observaciones").removeClass('invalid');
            $("#observaciones").removeClass('invalid');
        }
    });
});

function compruebaKM(){
		kmsalida = $('#km_salida').val();
		kmretorno = $('#km_retorno').val();
		if(kmretorno<=kmsalida){
			alert("KM_Retorno tiene que ser > a KM_Salida");
			//selecciono el texto 
			$( "#km_salida" ).select(); 
			//coloco otra vez el foco 
			$( "#km_salida" ).focus();
			$( "#km_retorno" ).addClass('error');
		}
		else
		{
			$( "#km_retorno" ).removeClass('error');
		}
}
		
			
chkcomision.addEventListener( 'change', function() {
	if(this.checked) {
		
		document.getElementById("textcomision").readOnly = false;
		document.getElementById("textcomision").placeholder = "Digite Dirección ";
	}
	else{
		$('#textcomision').val("");
		document.getElementById("textcomision").readOnly = true;
		document.getElementById("textcomision").placeholder = "";
	}
});
					

chkdenuncia.addEventListener( 'change', function() {
	if(this.checked) {
		/* alert('checkbox esta seleccionado'); */
		document.getElementById("textdenuncia").readOnly = false;
		document.getElementById("textdenuncia").placeholder = "Digite Dirección ";
	}
	else{
		$('#textdenuncia').val(null);
		document.getElementById("textdenuncia").readOnly = true;
		document.getElementById("textdenuncia").placeholder = "";
	}
});

chkhabitabilidad.addEventListener( 'change', function() {
	if(this.checked) {
		/* alert('checkbox esta seleccionado'); */
		document.getElementById("texthabitabilidad").readOnly = false;
		document.getElementById("texthabitabilidad").placeholder = "Digite Dirección ";
	}
	else{
		$('#texthabitabilidad').val("");
		document.getElementById("texthabitabilidad").readOnly = true;
		document.getElementById("texthabitabilidad").placeholder = "";
	}
});
					
chkgas.addEventListener( 'change', function() {
	if(this.checked) {
		/* alert('checkbox esta seleccionado'); */
		document.getElementById("textgas").readOnly = false;
		document.getElementById("textgas").placeholder = "Digite Dirección ";
	}
	else{
		$('#textgas').val("");
		document.getElementById("textgas").readOnly = true;
		document.getElementById("textgas").placeholder = "";
	}
});

chkinvestigacion.addEventListener( 'change', function() {
	if(this.checked) {
		/* alert('checkbox esta seleccionado'); */
    	document.getElementById("textinvestigacion").readOnly = false;
		document.getElementById("textinvestigacion").placeholder = "Digite Dirección ";
	}
	else{
		$('#textinvestigacion').val("");
		document.getElementById("textinvestigacion").readOnly = true;
		document.getElementById("textinvestigacion").placeholder = "";
	}
});

chklocales.addEventListener( 'change', function() {
	if(this.checked) {
		/* alert('checkbox esta seleccionado'); */
		document.getElementById("textlocales").readOnly = false;
		document.getElementById("textlocales").placeholder = "Digite Dirección ";
	}
	else{
		$('#textlocales').val("");
		document.getElementById("textlocales").readOnly = true;
		document.getElementById("textlocales").placeholder = "";
	}
});

chkotros.addEventListener( 'change', function() {
	if(this.checked) {
		/* alert('checkbox esta seleccionado,\nIngrese Detalle'); */
    	document.getElementById("textotros").readOnly = false;
		document.getElementById("textotros").placeholder = "Digite Dirección ";
	}
	else{
		$('#textotros').val("");
		document.getElementById("textotros").readOnly = true;
		document.getElementById("textotros").placeholder = "";
	}
});



textcomision.addEventListener("change",function(){
    strcomision = $('#textcomision').val();
	alert("El Texto Ingresado es:. \n" + strcomision); 
});



textdenuncia.addEventListener("change",function(){
    strdenuncia = $('#textdenuncia').val();
	alert("El Texto Ingresado es:. \n" +strdenuncia); 
});



textgas.addEventListener("change",function(){
    strgas = $('#textgas').val();
	alert("El Texto Ingresado es:. \n" +strgas); 
});



texthabitabilidad.addEventListener("change",function(){
    strhabitabilidad = $('#texthabitabilidad').val();
	alert(strhabitabilidad); 
});


textinvestigacion.addEventListener("change",function(){
    strinvestigacion = $('#textinvestigacion').val();
	alert(strinvestigacion); 
});

;

textlocales.addEventListener("change",function(){
    strlocales = $('#textlocales').val();
	alert(strlocales); 
});



textotros.addEventListener("change",function(){
    strotros = $('#textotros').val();
	alert(strotros); 
});

				
function validar_checkbox(e) {
	// Obtener hijos dentro de etiqueta <div>
	var cont = document.getElementById('actividades').children;
	var i = 0;
    var al_menos_uno = false;
	//Recorrido de checkbox's
	while (i < cont.length) {
        // Verifica si el elemento es un checkbox
        if (cont[i].tagName == 'INPUT' && cont[i].type == 'checkbox') {
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
		if (e.preventDefault) {
			e.preventDefault();
		} else {
			e.returnValue = false;
		}
	}
}
				
		