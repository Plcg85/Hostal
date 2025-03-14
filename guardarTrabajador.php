<?php

    require "./basesDeDatos/dbHostal.php";

    //se reciben los datos del formulario

    //datos del trabajador
    $nombreTrabajador = $_POST['nombretrabajador'];
    $apellidoTrabajador = $_POST['apellidotrabajador'];
    $identificacionTrabajador = $_POST['identificaciontrabajador'];

    $baseDeDatos = new dbHostal();
    $guardado = $baseDeDatos->nuevoTrabajador($nombreTrabajador, $apellidoTrabajador, $identificacionTrabajador);

    if($guardado)
    {
        echo "Trabajador registrado";
        echo "<a href='./index.html'>Volver inicio</a>";
    }else {
        echo "Ha habido un error al intentar guardar el trabajador";
        echo "<a href='./index.html'>Volver a inicio</a>";
    }

?>
