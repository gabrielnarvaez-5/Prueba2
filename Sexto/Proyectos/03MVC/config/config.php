<?php
class Database {
    private $host = "localhost";
    private $usuario = "root";
    private $pass = "";
    private $base = "gestion_escuela";  
    private $conexion;

    public function __construct() {
        $this->conexion = mysqli_connect($this->host, $this->usuario, $this->pass, $this->base);
        mysqli_query($this->conexion, "SET NAMES 'utf8'");
        if ($this->conexion->connect_error) {
            die("Error al conectar con el servidor: " . $this->conexion->connect_error);
        }
    }

    public function getConnection() {
        return $this->conexion;
    }
}
?>