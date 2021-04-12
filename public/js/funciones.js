/*
 Funciones Generales
*/
window.addEventListener("load", cargaPagina);
function cargaPagina() {
    
	var btn = document.getElementById("horactual").addEventListener("click", hractual);
	var btn0 = document.getElementById("horactual0").addEventListener("click", hractual);
	var btn1 = document.getElementById("horactual1").addEventListener("click", hractual);
	var btn2 = document.getElementById("horactual2").addEventListener("click", hractual);
	var btn3 = document.getElementById("horactual3").addEventListener("click", hractual);
}


$(document).ready(function(){
	var dtToday = new Date();
	var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
	var day = dtToday.getDate();
	var year = dtToday.getFullYear();

	var max_chars = 2000;
	var max_chars1 = 3000;
	$('#max').html(max_chars);

	
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
	$("#bt_addpaciente").click(function () {
		agregarpaciente();
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


    $("#pinformacion_inicial").keyup(function() {
	        var chars = $("#pinformacion_inicial").val().length;
	        var diff = max_chars - chars;
	        var leyenda = "Caracteres Permitidos 2000 - Digitados: ";
	        var res = leyenda.concat(chars);
	        $("#pcounter").html(res);
	        if(chars > 2000){
	           $("#pinformacion_inicial").addClass('error');
	           $("#pinformacion_inicial").addClass('error');
	        }else{
	           $("#pinformacion_inicial").removeClass('error');
	           $("#pinformacion_inicial").removeClass('error');
	         }
	    });
	    
	$("#detalle_emergencia").keyup(function() {
	        var chars = $("#detalle_emergencia").val().length;
	        var diff = max_chars1 - chars;
	        var leyenda = "Caracteres Permitidos 3000 - Digitados: ";
	        var res = leyenda.concat(chars);
	        $("#pcounter1").html(res);
	        if(chars > 3000){
	           $("#detalle_emergencia").addClass('error');
	           $("#detalle_emergencia").addClass('error');
	        }else{
	           $("#detalle_emergencia").removeClass('error');
	           $("#detalle_emergencia").removeClass('error');
	        }
	    });
	$("#Enviar").hide();
	/* conservarinfo(); */

	
});
		
total=0;
var cont=0;
var jqkm_salida=0;
var jqkm_llegada=0;
var jqvehiculo_id="";
var jqvehiculo="";
subtotal=[];

function agregar() {
	// body...
	jqkm_salida=$("#pkm_salida").val();
	jqkm_llegada=$("#pkm_llegada").val();
	jqvehiculo=$("#pvehiculo_id").val();
	jqvehiculo_id=$("#pvehiculo_id option.selected").text();
	if(jqkm_salida!="" && jqkm_salida>=0 && jqkm_llegada>=0 && jqkm_llegada!=""  && jqvehiculo!="")
	{
		if((jqkm_salida==0)||(jqkm_salida==null))
			jqkm_salida=0;
		if((jqkm_llegada==0)||(jqkm_llegada==null))
			jqkm_llegada=0;
		total = total + subtotal[cont];
		var fila = '<tr class = "selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')" type="button">X</button></td><td><input required type="hidden" name="vehiculo_id[]" value="'+jqvehiculo+'">'+jqvehiculo+'</td><td><input type="number" required class="form-control"  name="km_salida[]" value="'+jqkm_salida+'"></td><td><input type="number" required class="form-control" name="km_llegada[]" value="'+jqkm_llegada+'"></td></tr>';
		cont++;
		limpiar();
		evaluar();
		$('#detalles').append(fila);
	}else{
		alert("Error al ingresar el detalle de vehiculos,revise los datos!!!");
	}
}

function conservarinfo(){
	$("#pkm_salida").val(jqkm_salida);
	$("#pkm_llegada").val(jqkm_llegada);
	$("#pvehiculo_id").val(jqvehiculo);

}

function limpiar(){
	$("#pkm_salida").val("");
	$("#pkm_llegada").val("");
}
function evaluar(){
	if(jqkm_llegada>=jqkm_salida){
		$("#divguardar").show();
		$("#Enviar").show();
	}
	
	if(document.title=="Derrame"){
		jqtitle = jqvehiculo +" - Derrame - BCBVC";
		//console.log(jqtitle);
		document.title =jqtitle;
	}
	if(document.title=="Transito"){
		jqtitle = jqvehiculo +" - Transito - BCBVC";
		//console.log(jqtitle);
		document.title =jqtitle;
	}
	if(document.title=="Salud"){
		jqtitle = jqvehiculo +" - Salud - BCBVC";
		//console.log(jqtitle);
		document.title =jqtitle;
	}
	if(document.title=="Rescate"){
		jqtitle = jqvehiculo +" - Rescate - BCBVC";
		//console.log(jqtitle);
		document.title =jqtitle;
	}
	if(document.title=="Inundacion"){
		jqtitle = jqvehiculo +" - Inundacion - BCBVC";
		//console.log(jqtitle);
		document.title =jqtitle;
	}
	if(document.title=="Incendio"){
		jqtitle = jqvehiculo +" - Incendio - BCBVC";
		//console.log(jqtitle);
		document.title =jqtitle;
	}
	if(document.title=="Fuga"){
		jqtitle = jqvehiculo +" - Fuga - BCBVC";
		//console.log(jqtitle);
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
	if(e.name === "horactual")
	{
		console.log(e.name);
		document.getElementById("hora_salida_a_emergencia").value=hora;
		console.log(document.getElementById("hora_salida_a_emergencia").name);
	}
	
	else if (e.name === "horactual1")
	{
		console.log(e.name);
		document.getElementById("hora_llegada_a_emergencia").value=hora;
		console.log(document.getElementById("hora_llegada_a_emergencia").name);
	}
	else if (e.name == "horactual2")
	{
		console.log(e.name);
		document.getElementById("hora_fin_emergencia").value=hora;
		console.log(document.getElementById("hora_fin_emergencia").name);
	}	
	
	else if(e.name == "horactual3")
	{
		console.log(e.name);
		document.getElementById("hora_en_base").value=hora;
		console.log(document.getElementById("hora_en_base").name);
	}	
	else if(e.name === "horactual4")
	{
		console.log(e.name);
		document.getElementById("hora_fichaecu911").value=hora;
		console.log(document.getElementById("hora_fichaecu911").name);
	}
	
}

function CheckTime(str)
{
	hora=str.value
	if (hora=='')
	{
		str.select() ;
	}
	if (hora.length>8) 
	{	
		alert("Introdujo una cadena mayor a 8 caracteres");	
	}
	if (hora.length!=8) 
	{
		alert("Introducir formato HH:MM:SS");	
	}
	a=hora.charAt(0) //<=2
	b=hora.charAt(1) //<4
	c=hora.charAt(2) //:
	d=hora.charAt(3) //<=5
	e=hora.charAt(5) //:
	f=hora.charAt(6) //<=5
	if ((a==2 && b>3) || (a>2)) 
	{
		alert("El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23");
		str.title = "El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23";	
	}
	if (d>5)
	{
		alert("El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59");
	}
	if (f>5) 
	{
		alert("El valor que introdujo en los segundos no corresponde");
		
	}
	if (c!=':' || e!=':') 
	{
		alert("Introduzca el caracter ':' para separar la hora, los minutos y los segundos");
			
	} 
} 



/*{{-- Script para almacenar pacientes atendidos --}}*/

var contpac=0;
var jqnombres="";
var jqedad=0;
var jqgenero="";
var jqpresio1=0;
var jqpresion2=0;
var jqtemp=0;
var jqglas=0;
var jqhoja=0;
var jqsatura=0;
var jqcsalud="";
var jqcie="";
var jqfrcardiaca=0;
var jqfrrespiratoria=0;
var jqglicemia=0
subtotal=[];
//$("#Enviar").hide();

function agregarpaciente() {
				// body...
	jqnombres=$("#pnombres").val();
	jqedad=$("#pedad").val();
	jqgenero=$("#pgenero").val();
	jqpresio1=$("#ppresionsis").val();
	jqpresio2=$("#ppresiondias").val();
	jqtemp=$("#ptemperatura").val();
	jqglas=$("#pglasgow").val();
	jqhoja=$("#phoja").val();
	jqsatura=$("#psaturacion").val();
	jqcsalud=$("#pcasasalud ").val();
	jqcie=$("#pcie10").val();
	jqfrcardiaca =$("#Frecuencia_Cardiaca ").val();
	jqfrrespiratoria = $("#Frecuencia_Respiratoria ").val();
	jqglicemia = $("#Glicemia").val();
	indice1 = document.getElementById("pcie10").selectedIndex;
	//console.log(jqcie);
	indice = document.getElementById("pgenero").selectedIndex;
	if((jqnombres!="")&& (jqedad != null) && (jqgenero != null ) && (indice !=0 )&&(jqcsalud!=null))
	//if((jqnombres!="") && (jqedad!="") && (jqgenero !="") && (jqpresio1!="") && (jqpresio2!="") && (jqtemp!="")&&(jqglas!="")&&(jqsatura!="")&&(jqhoja!="")&&(jqcsalud!="")&&(jqcie!=""))
		{
			if((jqpresio1==0)||(jqpresio1==null))
				jqpresio1=0;
			if((jqpresio2==0)||(jqpresio2==null))
				jqpresio2=0;
			if((jqtemp==0)||(jqtemp==null))
				jqtemp=0;
			if((jqglas==0)||(jqglas==null))
				jqglas=0;
			if((jqsatura==0)||(jqsatura==null))
				jqsatura=0;
			if((jqfrcardiaca==0)||(jqfrcardiaca==null))
				jqfrcardiaca=0;
			if((jqfrrespiratoria==0)||(jqfrrespiratoria==null))
				jqfrrespiratoria=0;
			if((jqglicemia==0)||(jqglicemia==null))
				jqglicemia=0;
			if(indice1==0)
				jqcie=0;
			var filapaciente = '<tr class ="selected" id="filapaciente'+contpac+'"><td><button type="button" class="btn btn-warning" onclick="eliminar2('+contpac+')" type="button">X</button></td><td><input type="hidden" name="frpaciente[]" required="" value="'+jqnombres+'">'+jqnombres+'</td><td><input type="hidden" readonly="true" name="fredad[]" value="'+jqedad+'">'+jqedad+'</td><td><input type="hidden" readonly="true" name="frgenero[]" value="'+jqgenero+'">'+jqgenero+'</td><td><input type="hidden" readonly="true" name="frpresion1[]" value="'+jqpresio1+'">'+jqpresio1+'</td><td><input type="hidden" readonly="true" name="frpresion2[]" value="'+jqpresio2+'">'+jqpresio2+'</td><td><input type="hidden" readonly="true" name="frtemperatura[]" value="'+jqtemp+'">'+jqtemp+'</td><td><input type="hidden" readonly="true" name="frglasglow[]" value="'+jqglas+'">'+jqglas+'</td><td><input type="hidden" readonly="true" name="frsaturacion[]" value="'+jqsatura+'">'+jqsatura+'</td><td><input type="hidden" readonly="true" name="frcardiaca[]" value="'+jqfrcardiaca+'">'+jqfrcardiaca+'</td><td><input type="hidden" readonly="true" name="frrespiratoria[]" value="'+jqfrrespiratoria+'">'+jqfrrespiratoria+'</td><td><input type="hidden" readonly="true" name="frglicemia[]" value="'+jqglicemia+'">'+jqglicemia+'</td><td><input type="hidden" readonly="true" name="frhoja[]" value="'+jqhoja+'">'+jqhoja+'</td><td><input type="hidden" readonly="true" name="frcasasalud[]" value="'+jqcsalud+'">'+jqcsalud+'</td><td><input type="hidden" readonly="true" name="frcie10[]" value="'+jqcie+'">'+jqcie+'</td></tr>';
			contpac++;
			limpiarpaciente();
			evaluarpaciente();
			$('#detallespaciente').append(filapaciente);
	}else{
		alert("Error al ingresar el detalle de paciente,Llene los campos requeridos!!");
	}
}

function limpiarpaciente(){
	$("#pnombres").val("");
	$("#pedad").val("");
	$("#pgenero").val("");
	$("#ppresionsis").val("");
	$("#ppresiondias").val("");
	$("#ptemperatura").val("");
	$("#pglasgow").val("");
	$("#psaturacion").val("");
	$("#pcasasalud").val("");
	$("#pcie10").val("");
	$("#phoja").val("");
	$("#Frecuencia_Cardiaca ").val("");
	$("#Frecuencia_Respiratoria ").val("");
	$("#Glicemia").val("");
}

function evaluarpaciente(){
	if((jqnombres!="")&& (jqedad != null) && (jqgenero != null ) && (indice !=0 )&&(jqcsalud!=null))
	{
		$("#divguardar").show();
		$("#Enviar").show();
	}
	else
	{
		alert("Informacion Incompleta... PACIENTE")
		$("#divguardar").hide();
	}
}

function eliminar2(index){
	$("#filapaciente"+index).remove();
	evaluar();
}
	