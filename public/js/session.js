/*
 Script para prevenir que la sesion caduque
*/
document.addEventListener("DOMContentLoaded", function(){
    // Invocamos cada 5 segundos ;)
    
    const milisegundos = 300 *1000;
    setInterval(function(){
        // No esperamos la respuesta de la petición porque no nos importa
        console.log("ENTRO");
        fetch("/refresh/");
    },milisegundos);
});