/*
 Funciones Generales
*/

$(document).ready(function(){
 $("select[name=vehiculo_id]").change(function(){
    
             document.title =$('select[name=vehiculo_id] option:selected').text()+" - Clave14";
            
        });
validar();
validar2();
});




function validar() {
    
    var km_salida = $('#km_salida').val();
    var km_gasolinera = $('#km_gasolinera').val();
    if (km_salida >  km_gasolinera ) {
        console.log("Error en KMs Carga Combustible")
        document.getElementById("km_gasolinera").style.borderColor = "red";
        document.getElementById("km_gasolinera").title = "Error en KM, tiene que ser mayor a KM_Salida";
        document.getElementById("km_gasolinera").min=km_salida;
    } else {
        console.log('correcto')
        document.getElementById("km_gasolinera").style.borderColor = "";
        document.getElementById("km_gasolinera").title = "";
    }
};

function validar2() {
            var km_gasolinera = $('#km_gasolinera').val();
            var km_llegada = $('#km_llegada').val();
            if (km_gasolinera >  km_llegada ) {
                console.log("Error en KMs Carga Combustible")
                document.getElementById("km_llegada").style.borderColor = "red";
                document.getElementById("km_llegada").title = "Error en KM, tiene que ser mayor a km_gasolinera";
                document.getElementById("km_llegada").min=km_gasolinera;
            } else {
                console.log('correcto')
                document.getElementById("km_llegada").style.borderColor = "";
                 document.getElementById("km_llegada").title = "";
                
            }
};


