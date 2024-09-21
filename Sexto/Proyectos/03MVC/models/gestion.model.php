<?php
require_once('../config/config.php');

class GestionEstudiantes {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Métodos para Estudiantes
    public function buscarEstudiante($texto) {
        $query = "SELECT * FROM Estudiantes WHERE estudiante_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $texto);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function todosEstudiantes() {
        $query = "SELECT * FROM Estudiantes";
        return $this->conn->query($query);
    }

    public function insertarEstudiante($nombre, $apellido, $fecha_nacimiento, $grado) {
        $query = "INSERT INTO Estudiantes (nombre, apellido, fecha_nacimiento, grado) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $nombre, $apellido, $fecha_nacimiento, $grado);
        return $stmt->execute();
    }

    public function actualizarEstudiante($estudiante_id, $nombre, $apellido, $fecha_nacimiento, $grado) {
        $query = "UPDATE Estudiantes SET nombre = ?, apellido = ?, fecha_nacimiento = ?, grado = ? WHERE estudiante_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $nombre, $apellido, $fecha_nacimiento, $grado, $estudiante_id);
        return $stmt->execute();
    }

    public function eliminarEstudiante($estudiante_id) {
        $query = "DELETE FROM Estudiantes WHERE estudiante_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $estudiante_id);
        return $stmt->execute();
    }

    // Métodos para Profesores
    public function todosProfesores() {
        $query = "SELECT * FROM Profesores";
        return $this->conn->query($query);
    }

    public function insertarProfesor($nombre, $apellido, $especialidad, $email) {
        $query = "INSERT INTO Profesores (nombre, apellido, especialidad, email) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $nombre, $apellido, $especialidad, $email);
        return $stmt->execute();
    }

    public function actualizarProfesor($profesor_id, $nombre, $apellido, $especialidad, $email) {
        $query = "UPDATE Profesores SET nombre = ?, apellido = ?, especialidad = ?, email = ? WHERE profesor_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $nombre, $apellido, $especialidad, $email, $profesor_id);
        return $stmt->execute();
    }

    public function eliminarProfesor($profesor_id) {
        $query = "DELETE FROM Profesores WHERE profesor_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $profesor_id);
        return $stmt->execute();
    }

    // Métodos para Asignaturas
    public function todosAsignaturas() {
        $query = "SELECT * FROM Asignaturas";
        return $this->conn->query($query);
    }

    public function insertarAsignatura($nombre_asignatura) {
        $query = "INSERT INTO Asignaturas (nombre_asignatura) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $nombre_asignatura);
        return $stmt->execute();
    }

    public function eliminarAsignatura($asignatura_id) {
        $query = "DELETE FROM Asignaturas WHERE asignatura_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $asignatura_id);
        return $stmt->execute();
    }

    // Métodos para Clases
    public function todosClases() {
        $query = "SELECT * FROM Clases";
        return $this->conn->query($query);
    }

    public function insertarClase($nombre_clase, $profesor_id) {
        $query = "INSERT INTO Clases (nombre_clase, profesor_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $nombre_clase, $profesor_id);
        return $stmt->execute();
    }

    public function eliminarClase($clase_id) {
        $query = "DELETE FROM Clases WHERE clase_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $clase_id);
        return $stmt->execute();
    }
}
?>
