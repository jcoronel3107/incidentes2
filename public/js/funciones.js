/*
 Funciones Generales
*/
window.addEventListener("load", cargaPagina);
document.addEventListener("DOMContentLoaded", function() {
	document.getElementById("formulario").addEventListener('submit', validarFormulario); 
});

function cargaPagina() {
    
	var btn = document.getElementById("horactual").addEventListener("click", hractual);
	var btn1 = document.getElementById("horactual1").addEventListener("click", hractual);
	var btn2 = document.getElementById("horactual2").addEventListener("click", hractual);
	var btn3 = document.getElementById("horactual3").addEventListener("click", hractual);
}


$(document).on('ready',function(){
	var dtToday = new Date();
	var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
	var day = dtToday.getDate();
	var year = dtToday.getFullYear();

	var max_chars = 2000;
	var max_chars1 = 3000;
	var max_charser = 1000;
	$('#max').html(max_chars);

	
	if(month < 10)
    		month = '0' + month.toString();
	if(day < 10)
		    day = '0' + day.toString();	
	
			
	
	var maxDate = year + '-' + month + '-' + day;
	$('#fecha').attr('min', maxDate);
	$('#fecha').attr('value', maxDate);
	
	$( ".vehiculo_id" ).change(function() {
		tituloventana();
	  });
	
	$("#bt_add").on('click',function(){
		agregar();
	});

	$("#bt_addperson").on('click',function(){
		agregarbombero();
	});
	$("#bt_addpersonedit").on('click',function(){
		variarbomberos();
	});
	$("#bt_addpaciente").on('click',function(){
		agregarpaciente();
	});


	$("#horactual").on('click',function(){
		hractual(this);
	});

	$("#horactual1").on('click',function(){
		hractual(this);
	});

	$("#horactual2").on('click',function(){
		hractual(this);
	});

	$("#horactual3").on('click',function(){
		hractual(this); 
	});

	
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

    $("#pinformacion_inicial").on('keyup',function(){
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
	    
	$("#detalle_emergencia").on('keyup',function(){
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
});
		

var cont=0;
var jqkm_salida=0;
var jqkm_llegada=0;
var jqvehiculo_id="";
var jqvehiculo="";
var jqdriver_id="";
var jqdriver="";
var jqid_bomberman="";
var jqbomberman="";
var jqnropersonas=0;
var asistentes = parseFloat($("#nropersonas").val());

function agregarbombero() {
	jqid_bomberman=$("#pbombero_id").val();
	
	jqbomberman=$('#pbombero_id').find('option:selected').text();
			 

	
	if(jqbomberman.length!=0){
		if (checkId(jqid_bomberman)) {
			return alert('El ID ya está siendo usado');
		}
		var filabomberman = '<tr class="selected" id="filabomber'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminarbomberman('+cont+')" type="button">X</button></td><td for="id">'+jqid_bomberman+'</td><td><input type=hidden id="bomberman_id[]" name="bomberman_id[]" value="'+jqid_bomberman+'">'+jqbomberman+'</td></tr>';
		cont++;
		$('#persontable').append(filabomberman);
		
	}
	else	
		alert("Seleccione Bomberos Primero");
}

function variarbomberos() {
	jqid_bomberman=$("#pbombero_id").val();
	jqnropersonas=$("#nropersonas").val();
	jqbomberman=$('#pbombero_id').find('option:selected').text();
			 
	if(jqbomberman.length!=0){
		if (checkId(jqid_bomberman)) {
			return alert('El ID ya está siendo usado');
		}
		if(jqnropersonas>=0)
		{
			jqnropersonas =  parseInt(jqnropersonas)+1;
			var filabomberman = '<tr class="success" id="filabomber'+jqnropersonas+'"><td><button type="button" class="btn btn-warning" onclick="eliminarbomberman('+jqnropersonas+')" type="button">X</button></td><td for="id">'+jqid_bomberman+'</td><td><input type=hidden id="bomberman_id[]" name="bomberman_id[]" value="'+jqid_bomberman+'">'+jqbomberman+'</td></tr>';
			$('#persontable').append(filabomberman);
		}
	}
	else	
		alert("Seleccione Bomberos Primero");
}

function eliminarbomberman(index){
	$("#filabomber"+index).remove();
}

function checkId (id) {
	let ids = document.querySelectorAll('#persontable td[for="id"]');

  return [].filter.call(ids, td => {
	  return td.textContent === id;
  }).length === 1;
}

function checkIdconductor (id) {
	let ids = document.querySelectorAll('#detalles td[for="idc"]');

  return [].filter.call(ids, td => {
	  return td.textContent === id;
  }).length === 1;
}

function checkIdvehiculo (id) {
	let ids = document.querySelectorAll('#detalles td[for="id"]');

  return [].filter.call(ids, td => {
	  return td.textContent === id;
  }).length === 1;
}

function agregar() {
	// body...
	jqkm_salida=$("#pkm_salida").val();
	jqkm_llegada=$("#pkm_llegada").val();
	jqvehiculo=$("#pvehiculo_id").val();
	jqvehiculo_id=$('#pvehiculo_id').find('option:selected').text();
	jqdriver_id=$('#pconductor_id').val();
	jqdriver=$('#pconductor_id').find('option:selected').text();
	
	if(jqkm_salida!="" && parseInt(jqkm_salida)>=0 && parseInt(jqkm_llegada)>=0 && jqkm_llegada!="" && parseInt(jqkm_llegada)>parseInt(jqkm_salida) && jqvehiculo!="" && jqdriver_id!="")
	{
		if (checkIdvehiculo(jqvehiculo_id)) {
			return alert('El ID vehiculo ya está siendo usado');
		}
		if (checkIdconductor(jqdriver)) {
			return alert('El ID conductor ya está siendo usado');
		}
		var fila = '<tr id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')" type="button">X</button></td><td for="id"><input type="hidden" name="vehiculo_id[]" value="'+jqvehiculo+'">'+jqvehiculo_id+'</td><td><input class="form-control"  type="number" name="km_salida[]" value="'+jqkm_salida+'"></td><td><input type="number" class="form-control" name="km_llegada[]" value="'+jqkm_llegada+'"></td><td for="idc"><input type="hidden" class="form-control" name="driver_id[]" value="'+jqdriver_id+'">'+jqdriver+'</td></tr>';
		cont++;
		$('#detalles').append(fila);
		limpiar();
	}
	else{
		
		alert("Error al Ingresar Información de Vehiculo,\nRevise los Datos!!!");
	}
}

function limpiar(){
	tituloventana();
	$("#pkm_salida").val("");
	$("#pkm_llegada").val("");
	
	$('#pconductor_id').val("");
	$('#pvehiculo_id').val("");
	$("#pvehiculo_id").prop('selectedIndex', 0);
	$("#pconductor_id").attr('selectedIndex', 0);
	
}

function tituloventana(){
	if(jqvehiculo.length!=0){
		if(document.title=="Derrame"){
			
				jqtitle = jqvehiculo_id +" - Derrame - BCBVC";
				document.title =jqtitle;
			
		}
		if(document.title=="Transito"){
			jqtitle = jqvehiculo_id +" - Transito - BCBVC";
			
			document.title =jqtitle;
		}
		if(document.title=="Salud"){
			jqtitle = jqvehiculo_id +" - Salud - BCBVC";
			
			document.title =jqtitle;
		}
		if(document.title=="Rescate"){
			jqtitle = jqvehiculo_id +" - Rescate - BCBVC";
			
			document.title =jqtitle;
		}
		if(document.title=="Inundacion"){
			jqtitle = jqvehiculo_id +" - Inundacion - BCBVC";
			
			document.title =jqtitle;
		}
		if(document.title=="Incendio"){
			jqtitle = jqvehiculo_id +" - Incendio - BCBVC";
			
			document.title =jqtitle;
		}
		if(document.title=="Fuga"){
			jqtitle = jqvehiculo_id +" - Fuga - BCBVC";
			
			document.title =jqtitle;
		}	
	}
}

function eliminar(index){
	
	$("#fila"+index).remove();
}


function mayus( e ) {
	e.value = e.value.toUpperCase();
}

function hractual(e) {
	
	/* var hoy = new Date();
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
	var hora = h1  + ':' + min + ':' + sec; */
	var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth()+1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    var hora = fecha.getHours(); //obteniendo hora
    var minutos = fecha.getMinutes(); //obteniendo minuto

    function minTwoDigits(n) {
		return (n < 10 ? '0' : '') + n;
	  }

	if(e.name === "horactual")
	{
		
		/* document.getElementById("hora_salida_a_emergencia").value=hoy; */
		document.getElementById("hora_salida_a_emergencia").value=ano+"-"+minTwoDigits(mes)+"-"+minTwoDigits(dia)+"T"+minTwoDigits(hora)+":"+minTwoDigits(minutos);
		/* console.log(document.getElementById("hora_salida_a_emergencia").name); */
	}
	
	else if (e.name === "horactual1")
	{
		
		/* document.getElementById("hora_llegada_a_emergencia").value=hora; */
		document.getElementById("hora_llegada_a_emergencia").value=ano+"-"+minTwoDigits(mes)+"-"+minTwoDigits(dia)+"T"+minTwoDigits(hora)+":"+minTwoDigits(minutos);
		
	}
	else if (e.name == "horactual2")
	{
		document.getElementById("hora_fin_emergencia").value=ano+"-"+minTwoDigits(mes)+"-"+minTwoDigits(dia)+"T"+minTwoDigits(hora)+":"+minTwoDigits(minutos);
		/* document.getElementById("hora_fin_emergencia").value=hora; */
	
	}	
	
	else if(e.name == "horactual3")
	{
		
		/* document.getElementById("hora_en_base").value=hora; */
		document.getElementById("hora_en_base").value=ano+"-"+minTwoDigits(mes)+"-"+minTwoDigits(dia)+"T"+minTwoDigits(hora)+":"+minTwoDigits(minutos);
	
	}	
	else if(e.name === "horactual4")
	{
		document.getElementById("hora_en_base").value=ano+"-"+minTwoDigits(mes)+"-"+minTwoDigits(dia)+"T"+minTwoDigits(hora)+":"+minTwoDigits(minutos);
		
		/* document.getElementById("hora_fichaecu911").value=hora; */
		
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
		str.title = "Introdujo una cadena mayor a 8 caracteres";
		//alert("Introdujo una cadena mayor a 8 caracteres");	
	}
	if (hora.length!=8) 
	{
		//alert("Introducir formato HH:MM:SS");	
		str.title = "Introducir formato HH:MM:SS";
	}
	a=hora.charAt(0) //<=2
	b=hora.charAt(1) //<4
	c=hora.charAt(2) //:
	d=hora.charAt(3) //<=5
	e=hora.charAt(5) //:
	f=hora.charAt(6) //<=5
	if ((a==2 && b>3) || (a>2)) 
	{
		//alert("El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23");
		str.title = "El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23";	
	}
	if (d>5)
	{
		//alert("El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59");
		str.title = "El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59";
	}
	if (f>5) 
	{
		//alert("El valor que introdujo en los segundos no corresponde");
		str.title = "El valor que introdujo en los segundos no corresponde";
		
	}
	if (c!=':' || e!=':') 
	{
		str.title = "Introduzca el caracter ':' para separar la hora, los minutos y los segundos";
		//alert("Introduzca el caracter ':' para separar la hora, los minutos y los segundos");
			
	} 
} 

function validarFormulario(evento) {
	evento.preventDefault();
	var h1 = document.getElementById('hora_salida_a_emergencia').value;
	var h2 = document.getElementById('hora_llegada_a_emergencia').value;
	var h3 = document.getElementById('hora_fin_emergencia').value;
	var h4 = document.getElementById('hora_en_base').value;
	var rowCountdetalles = $("#detalles tr").length;
         console.log(rowCountdetalles);
	var rowCountpersontable = $("#persontable tr").length;
		console.log(rowCountpersontable);
	if((h4>h3)&&(h3>h2)&&(h2>h1)&&(rowCountdetalles>1)&&(rowCountpersontable>1))
	{
		this.submit();
	}
	else
	{
		alert("Errores en el Formulario....\n - Revise Horas - \n - Revise Personal en la Emergencia - \n - Vehículos en la Emergencia -");
		return;
	}
	
}


/* Script para almacenar pacientes atendidos  */

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
			var filapaciente = '<tr id="filapaciente'+contpac+'"><td><button type="button" class="btn btn-warning" onclick="eliminar2('+contpac+')" type="button">X</button></td><td><input type="hidden" name="frpaciente[]" required="" value="'+jqnombres+'">'+jqnombres+'</td><td><input type="hidden" readonly="true" name="fredad[]" value="'+jqedad+'">'+jqedad+'</td><td><input type="hidden" readonly="true" name="frgenero[]" value="'+jqgenero+'">'+jqgenero+'</td><td><input type="hidden" readonly="true" name="frpresion1[]" value="'+jqpresio1+'">'+jqpresio1+'</td><td><input type="hidden" readonly="true" name="frpresion2[]" value="'+jqpresio2+'">'+jqpresio2+'</td><td><input type="hidden" readonly="true" name="frtemperatura[]" value="'+jqtemp+'">'+jqtemp+'</td><td><input type="hidden" readonly="true" name="frglasglow[]" value="'+jqglas+'">'+jqglas+'</td><td><input type="hidden" readonly="true" name="frsaturacion[]" value="'+jqsatura+'">'+jqsatura+'</td><td><input type="hidden" readonly="true" name="frcardiaca[]" value="'+jqfrcardiaca+'">'+jqfrcardiaca+'</td><td><input type="hidden" readonly="true" name="frrespiratoria[]" value="'+jqfrrespiratoria+'">'+jqfrrespiratoria+'</td><td><input type="hidden" readonly="true" name="frglicemia[]" value="'+jqglicemia+'">'+jqglicemia+'</td><td><input type="hidden" readonly="true" name="frhoja[]" value="'+jqhoja+'">'+jqhoja+'</td><td><input type="hidden" readonly="true" name="frcasasalud[]" value="'+jqcsalud+'">'+jqcsalud+'</td><td><input type="hidden" readonly="true" name="frcie10[]" value="'+jqcie+'">'+jqcie+'</td></tr>';
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
}

function compruebaKM(){
	kmsalida = $('#km_salida_serv').val();
	console.log(kmsalida);
	kmretorno = $('#km_retorno_serv').val();
	if(kmretorno<=kmsalida){
		alert("KM_Retorno tiene que ser > a KM_Salida");
		//selecciono el texto 
		$( "#km_salida_serv" ).select(); 
		//coloco otra vez el foco 
		$( "#km_salida_serv" ).focus();
		$( "#km_retorno_serv" ).addClass('has-error');
	}
	else
	{
		$( "#km_retorno_serv" ).removeClass('has-error');
	}
}

$("textarea").each(function () {
	this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
  }).on("input", function () {
	this.style.height = "auto";
	this.style.height = (this.scrollHeight) + "px";
  });
	