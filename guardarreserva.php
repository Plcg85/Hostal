<?php

    require "./basesDeDatos/dbHostal.php";

    //se reciben los datos del formulario

    //datos del trabajador que hace el proceso
    $nombreTrabajador = $_POST['nombretrabajador'];
    $identificacionTrabajador = $_POST['identificaciontrabajador'];

    //datos de la persona que se hospeda
    $tipoIdentificacion = $_POST['tipoidentificacion'];
    $numeroDocumento = $_POST['numerodocumento'];

    //datos de la estancia
    $numeroCamas = $_POST['numerodecamas'];
    $vistaCalle = $_POST['vistacalle'];
    $banio = $_POST['banio'];
    $fechaEntrada = $_POST['fechaentrada'];
    $fechaSalida = $_POST['fechasalida'];

    validarTrabajador($nombreTrabajador, $identificacionTrabajador);

    /* ************************************************************************************************ */
    /* ************************************************************************************************ */
    //-------------------------------------------funciones------------------------------------------------

    //esta funcion se encarga de comprobar que el trabajador esté guardado en base de datos
    function validarTrabajador($nombreTrabajador, $identificacionTrabajador)
    {
        //se valida que el trabajador esté en base de datos
        $database = new dbHostal();
        $existeTrabajadorEnBd = $database->validarTrabajador($nombreTrabajador, $identificacionTrabajador);

        if($existeTrabajadorEnBd)
        {
            echo"existe este trabajador";
        }
        if(!$existeTrabajadorEnBd)
        {
            //si el trabajador no existe se debe crear una nueva ficha de trabajador
            echo"no existe este trabajador<br>";
            echo "<a href='formularioNuevoTrabajador.html'>Añadir nuevo trabajador</a>";
        }
    }


    //se valida que la persona que se hospeda tenga su ficha en base de datos

    //se busca si hay alguna estacia que cumpla los requisitos



?>