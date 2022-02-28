/*
 Funciones Generales
*/

$(document).ready(function(){
    $("#gasolinera_id").change(function() {
        var rol = $(gasolinera_id).val();
        
        $.get('/gasavailablebalancemonthly/' + rol, function(data) {
        //esta es la peticion get, la cual se divide en tres partes. ruta,variables y funcion
        var gasolinera = ''
        
        for (var i = 0; i < data.length; i++)
        {
            if(data[i].gasavailablebalancemonthly<100){
                gasolinera += '<p style="color:red"> Saldo Disponible: USD $. '+ data[i].gasavailablebalancemonthly.toFixed(2) + '</p>';
            }
            else if(data[i].gasavailablebalancemonthly<2000){
                gasolinera += '<p style="color: orange" > Saldo Disponible: USD $. '+ data[i].gasavailablebalancemonthly.toFixed(2) + '</p>';
            }
            else
                gasolinera += '<p style="color: blue" > Saldo Disponible: USD $. '+ data[i].gasavailablebalancemonthly.toFixed(2) + '</p>';
        }
        $("#response").html(gasolinera);
        });
    });

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
        alert("Error en KMs Carga Combustible")
        document.getElementById("km_gasolinera").style.borderColor = "red";
        document.getElementById("km_gasolinera").title = "Error en KM, tiene que ser mayor a KM_Salida";
        document.getElementById("km_gasolinera").min=km_salida;
    } else {
        
        document.getElementById("km_gasolinera").style.borderColor = "";
        document.getElementById("km_gasolinera").title = "";
    }
};

function validar2() {
            var km_gasolinera = $('#km_gasolinera').val();
            var km_llegada = $('#km_llegada').val();
            if (km_gasolinera >  km_llegada ) {
                alert("Error en KMs Llegada")
                document.getElementById("km_llegada").style.borderColor = "red";
                document.getElementById("km_llegada").title = "Error en KM, tiene que ser mayor a km_gasolinera";
                document.getElementById("km_llegada").min=km_gasolinera;
            } else {
                
                document.getElementById("km_llegada").style.borderColor = "";
                 document.getElementById("km_llegada").title = "";
                
            }
};



