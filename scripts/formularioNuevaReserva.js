document.addEventListener("DOMContentLoaded",function (){

    const fechaEntrada = document.getElementById("fechaentrada");
    const fechaSalida = document.getElementById("fechasalida");
    const formulario = document.querySelector("form");

    fechaSalida.addEventListener("change", function(){

        const entrada = new Date(fechaEntrada.value);
        const salida = new Date(fechaSalida.value);

        if (salida<=entrada){
            alert("La fecha de salida debe ser posterior a la fecha de entrada");
            fechaSalida.value = "";
        }

    });

});