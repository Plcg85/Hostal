<?php

    class dbHostal
    {
        private $_SERVER = "localhost";
        private $_USER = "root";
        private $_PASSWORD = "";
        private $_DATABASE = "hostal";
        public $_CONNECTION;

        //constructor
        function __construct()
        {
            //crea la base de datos si no existe
            $this->crearBaseDeDatos();

            //crea la conexion
            $this->_CONNECTION = new mysqli($this->_SERVER, $this->_USER, $this->_PASSWORD, $this->_DATABASE);

            if ($this->_CONNECTION->connect_error) {die("Connection failed: " . $this->_CONNECTION->connect_error);};

            //una vez creada la base de datos se crean las tablas
            $this->crearTablas();

        }//final constructor

        //destructor
        function __destruct(){
            $this->_CONNECTION->close();
        }

        //esta función crea la base de datos si no está creada
        private function crearBaseDeDatos()
        {
            //crear la conexion
            $conn = new mysqli($this->_SERVER, $this->_USER, $this->_PASSWORD);

            if ($conn->connect_error) {die("Connection failed: " . $this->_CONNECTION->connect_error);};

            $sql = "CREATE DATABASE IF NOT EXISTS hostal";
            if (!$conn->query($sql) === TRUE) {echo "Error creating database: " . $this->_CONNECTION->connect_error;};
            $conn->close();
        }

        private function crearTablas()
        {

            $this->crearTablaUsuarios(); //información sobre los usuarios que interactuan con el programa
            $this->crearTablaHabitaciones(); //información sobre las habitaciones
            $this->crearTablaClientes(); //información sobre los clientes
            $this->crearTablaReservas(); //información sobre las reservas

        }

        private function crearTablaUsuarios()
        {
            $sql = "CREATE TABLE IF NOT EXISTS usuarios (
                id_usuario INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(64) NOT NULL,
                apellido VARCHAR(64) NOT NULL,
                numero_identificacion VARCHAR(16) NOT NULL, 
                UNIQUE (nombre, apellido, numero_identificacion))";
            $this->ejecutarSentenciasCreacionTablas($sql);
        }

        private function crearTablaHabitaciones()
        {
            $sql = "CREATE TABLE IF NOT EXISTS habitaciones (
                num_habitacion INT UNSIGNED NOT NULL PRIMARY KEY,
                numero_camas INT UNSIGNED NOT NULL,
                vista_calle BOOLEAN NOT NULL,
                tiene_banio BOOLEAN NOT NULL,
                UNIQUE (num_habitacion))";
            $this->ejecutarSentenciasCreacionTablas($sql);
        }
        private function crearTablaClientes(){
            $sql = "CREATE TABLE IF NOT EXISTS clientes (
                id_cliente INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(64) NOT NULL,
                apellido1 VARCHAR(64) NOT NULL,
                apellido2 VARCHAR(64),
                tipo_identificacion ENUM('DNI','PASAPORTE','TARJETA DE RESIDENCIA') NOT NULL,
                numero_documento VARCHAR(16) NOT NULL,
                UNIQUE (numero_documento))";
            $this->ejecutarSentenciasCreacionTablas($sql);
        }
        private function crearTablaReservas(){
            $sql = "CREATE TABLE IF NOT EXISTS reservas (
                id_reserva INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                id_usuario INT UNSIGNED NOT NULL,
                fecha_entrada_reserva DATE NOT NULL,
                fecha_salida_reserva DATE NOT NULL,
                id_cliente INT UNSIGNED NOT NULL,
                num_habitacion INT UNSIGNED NOT NULL,
                UNIQUE (id_reserva, num_habitacion, id_cliente),
                FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
                FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
                FOREIGN KEY (num_habitacion) REFERENCES habitaciones(num_habitacion));";
            $this->ejecutarSentenciasCreacionTablas($sql);
        }
        private function ejecutarSentenciasCreacionTablas($sql)
        {
            try{

                $this->_CONNECTION->query($sql);

            }catch (Exception $e){echo "Error: " . $e->getMessage();};

        }

        //esta función valida que un trabajador este guardado en la base de datos
        public function validarTrabajador($nombre, $numeroidentificacion){

            //preparar la consulta
            $smtp = $this->_CONNECTION->prepare("SELECT * FROM usuarios WHERE nombre = ? AND numero_identificacion = ?");
            $smtp->bind_param("ss", $nombre, $numeroidentificacion);

            $smtp->execute();
            $resultado = $smtp->get_result();

            if ($resultado->num_rows === 1){
                $smtp->close();
                return true;
            }else{
                $smtp->close();
                return false;
            }

        }

        //esta funcion añade un nuevo trabajador a la base de datos
        public function nuevoTrabajador($nombre, $apellido, $numeroidentificacion)
        {

            //preparar la consulta sql
            $smtp = $this->_CONNECTION->prepare("INSERT INTO usuarios(nombre, apellido, numero_identificacion) VALUES(?, ?, ?)");
            $smtp->bind_param("sss", $nombre, $apellido, $numeroidentificacion);
            if ($smtp->execute())
            {
                return true;
            }else {
                return false;
            }

            $smtp->close();

        }
    }//final clase dbHostal

?>