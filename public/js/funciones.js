/*
 Funciones Generales
*/

$(document).ready(function(){
	var dtToday = new Date();
	var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
	var day = dtToday.getDate();
	var year = dtToday.getFullYear();
	if(month < 10)
    	month = '0' + month.toString();
		if(day < 10)
		    day = '0' + day.toString();					
		var maxDate = year + '-' + month + '-' + day;
		$('#fecha').attr('min', maxDate);
		$('#fecha').attr('value', maxDate);

		$("#bt_add").click(function () {
			agregar();
		});
		$("#horactual0").click(function () {
			hractual(this);
		});
		$("#horactual").click(function () {
			hractual(this);
		});
		$("#horactual1").click(function () {
			hractual(this);
		});
		$("#horactual2").click(function () {
			hractual(this);
		});
		$("#horactual3").click(function () {
			hractual(this);
		});
		var max_chars = 1000;
		$('#max').html(max_chars);
	    $("#pinformacion_inicial").keyup(function() {
	        var chars = $("#pinformacion_inicial").val().length;
	        var diff = max_chars - chars;
	        var leyenda = "Caracteres Permitidos 1000 - Digitados: ";
	        var res = leyenda.concat(chars);
	        $("#pcounter").html(res);
	        if(chars > 1000){
	           $("#pinformacion_inicial").addClass('error');
	           $("#pinformacion_inicial").addClass('error');
	        }else{
	           $("#pinformacion_inicial").removeClass('error');
	           $("#pinformacion_inicial").removeClass('error');
	         }
	    });
	    $("#detalle_emergencia").keyup(function() {
	        var chars = $("#detalle_emergencia").val().length;
	        var diff = max_chars - chars;
	        var leyenda = "Caracteres Permitidos 1000 - Digitados: ";
	        var res = leyenda.concat(chars);
	        $("#pcounter1").html(res);
	        if(chars > 1000){
	           $("#detalle_emergencia").addClass('error');
	           $("#detalle_emergencia").addClass('error');
	        }else{
	           $("#detalle_emergencia").removeClass('error');
	           $("#detalle_emergencia").removeClass('error');
	        }
	    });
});
		
total=0;
var cont=0;
var jqkm_salida=0;
var jqkm_llegada=0;
subtotal=[];
$("#Enviar").hide();
function agregar() {
	// body...
	jqkm_salida=$("#pkm_salida").val();
	jqkm_llegada=$("#pkm_llegada").val();
	jqvehiculo=$("#pvehiculo_id").val();
	jqvehiculo_id=$("#pvehiculo_id option.selected").text();
	if(jqkm_salida!="" && jqkm_salida>=0 && jqkm_llegada>=0 && jqkm_llegada!=""  && jqvehiculo!="")
	{
		total = total + subtotal[cont];
		var fila = '<tr class = "selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')" type="button">X</button></td><td><input type="hidden" name="vehiculo_id[]" value="'+jqvehiculo+'">'+jqvehiculo+'</td><td><input type="number"  name="km_salida[]" value="'+jqkm_salida+'"></td><td><input type="number" name="km_llegada[]" value="'+jqkm_llegada+'"></td></tr>';
		cont++;
		limpiar();
		evaluar();
		$('#detalles').append(fila);
	}else{
		alert("Error al ingresar el detalle de vehiculos,revise los datos!!!");
	}
}

function limpiar(){
	$("#pkm_salida").val("");
	$("#pkm_llegada").val("");
}
function evaluar(){
	//if(jqkm_llegada>jqkm_salida){
	$("#divguardar").show();
	$("#Enviar").show();
	if(document.title=="Derrame"){
		jqtitle = jqvehiculo +" - Derrame - BCBVC";
		console.log(jqtitle);
		document.title =jqtitle;
	}
	if(document.title=="Transito"){
		jqtitle = jqvehiculo +" - Transito - BCBVC";
		console.log(jqtitle);
		document.title =jqtitle;
	}
	if(document.title=="Salud"){
		jqtitle = jqvehiculo +" - Salud - BCBVC";
		console.log(jqtitle);
		document.title =jqtitle;
	}
	if(document.title=="Rescate"){
		jqtitle = jqvehiculo +" - Rescate - BCBVC";
		console.log(jqtitle);
		document.title =jqtitle;
	}
	if(document.title=="Inundacion"){
		jqtitle = jqvehiculo +" - Inundacion - BCBVC";
		console.log(jqtitle);
		document.title =jqtitle;
	}
	if(document.title=="Incendio"){
		jqtitle = jqvehiculo +" - Incendio - BCBVC";
		console.log(jqtitle);
		document.title =jqtitle;
	}
	if(document.title=="Fuga"){
		jqtitle = jqvehiculo +" - Fuga - BCBVC";
		console.log(jqtitle);
		document.title =jqtitle;
	}
}

function eliminar(index){
	total = total - subtotal[index];
	$("#fila"+index).remove();
	evaluar();
}


function mayus( e ) {
	e.value = e.value.toUpperCase();
}

function hractual(e) {
	console.log(e);
	var hoy = new Date();
	var h1 = hoy.getHours();
	if(h1>=0 && h1<10) {
		h1 = "0"+ h1;
	}
	var min = hoy.getMinutes();
	if(min>=0 && min<10) {
		min = "0"+ min;
	}
	var sec = hoy.getSeconds();
	if(sec>=0 && sec<10) {
		sec = "0"+ sec;
	}
	var hora = h1  + ':' + min + ':' + sec;
	if(e.name == "horactual")
		$('#hora_salida_a_emergencia').attr('value', hora);
	else if (e.name == "horactual1")
		$('#hora_llegada_a_emergencia').attr('value', hora);
	else if (e.name == "horactual2")
		$('#hora_fin_emergencia').attr('value', hora);
	else if(e.name == "horactual3")
		$('#hora_en_base').attr('value', hora);
	else
		$('#hora_fichaecu911').attr('value', hora);
}
	