/*
 Funciones Generales
*/
var jqvehiculo_id="";
var jqvehiculo="";

function validar() {
            var km_salida = $('#km_salida').val();
            var km_gasolinera = $('#km_gasolinera').val();
            if (km_salida >  km_gasolinera ) {
                console.log("Error en KMs Carga Combustible")
                document.getElementById("km_gasolinera").style.backgroundColor = "red";
                return false;
            } else {
                console.log('correcto')
                document.getElementById("km_gasolinera").style.backgroundColor = "";
                return true;
            }
        }


function evaluar(){
	if(document.title=="Clave"){
		jqvehiculo=$("#pvehiculo_id").val();
		jqtitle = jqvehiculo +" - Clave - BCBVC";
		console.log(jqtitle);
		document.title =jqtitle;
	}
}

$(document).ready(function(){
	$("#vehiculo_id").onChange(function () {
			evaluar();
		});
}
