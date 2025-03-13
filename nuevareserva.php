<?php

    require "./basesDeDatos/dbHostal.php";
    $bd = new dbHostal();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hotel nueva reserva</title>
</head>
<body>
    <p>Hacer nueva reserva</p>
    <form action="guardarreserva.php" method="post">

        <p>*********************** DATOS DEL TRABAJADOR EN EL SISTEMA *******************</p>
        <label for="nombretrabajador">Nombre de la persona que va a hacer la reserva</label>
        <input type="text" id="nombretrabajador" name="nombretrabajador" required><br><br>

        <p>*********************** DATOS DE LA PERSONA QUE SE VA A HOSPEDAR ****************</p>
        <label for="tipoidentificacion">Tipo de identificacion</label>
        <select name="tipoidentificacion" id="tipoidentificacion">
            <option value="DNI">DNI</option>
            <option value="PASPORTE">PASAPORTE</option>
            <option value="TARJETA_DE_RESIDENCIA">TARJETA DE RESIDENCIA</option>
        </select>

        <label for="numerodocumento">Numero de documento</label>
        <input type="text" id="numerodocumento" name="numerodocumento" required><br><br>

        <p>*************************** DATOS DE LA HABITACION BUSCADA ***********************</p>

        <label for="numerodecamas">Numero de camas que necesita</label>
        <select name="numerodecamas" id="numerodecamas">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>

        <label for="vistacalle">Vista a la calle</label>
        <select name="vistacalle" id="vistacalle">
            <option value="Si">Si</option>
            <option value="No">No</option>
            <option value="SN">Da igual</option>
        </select>

        <label for="banio">Dispone de baño</label>
        <select name="banio" id="banio">
            <option value="Si">Si</option>
            <option value="No">No</option>
            <option value="SN">Da igual</option>
        </select>
        <br><br>
        <p>*************************** DATOS DE LA FECHA SOLICITADA ***********************</p>
        <label for="fechaentrada">Fecha de entrada:</label>
        <input type="date" id="fechaentrada" name="fechaentrada" required>

        <label for="fechasalida">Fecha de salida:</label>
        <input type="date" id="fechasalida" name="fechasalida" required><br><br>

        <button type="submit">Buscar habitación</button>

    </form>
    <script src="./scripts/formularioNuevaReserva.js"></script>
</body>
</html>