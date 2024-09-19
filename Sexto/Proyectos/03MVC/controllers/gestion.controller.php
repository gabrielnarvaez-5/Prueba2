<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// TODO: Controlador de gestión de estudiantes

require_once('../models/gestion.model.php');
error_reporting(0);
$gestion = new GestionEstudiantes;  // Instancia del modelo

switch ($_GET["op"]) {
    // CRUD para Estudiantes
    case 'buscarEstudiante':
        if (!isset($_POST["texto"])) {
            echo json_encode(["error" => "Student ID not specified."]);
            exit();
        }
        $texto = intval($_POST["texto"]);
        $datos = array();
        $datos = $gestion->buscarEstudiante($texto);
        $todos = [];
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'todosEstudiantes':
        $datos = array();
        $datos = $gestion->todosEstudiantes();
        $todos = [];
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'insertarEstudiante':
        if (!isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["fecha_nacimiento"]) || !isset($_POST["grado"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $grado = $_POST["grado"];

        $datos = $gestion->insertarEstudiante($nombre, $apellido, $fecha_nacimiento, $grado);
        echo json_encode($datos);
        break;

    case 'actualizarEstudiante':
        if (!isset($_POST["estudiante_id"]) || !isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["fecha_nacimiento"]) || !isset($_POST["grado"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $estudiante_id = intval($_POST["estudiante_id"]);
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $grado = $_POST["grado"];

        $datos = $gestion->actualizarEstudiante($estudiante_id, $nombre, $apellido, $fecha_nacimiento, $grado);
        echo json_encode($datos);
        break;

    case 'eliminarEstudiante':
        if (!isset($_POST["estudiante_id"])) {
            echo json_encode(["error" => "Student ID not specified."]);
            exit();
        }
        $estudiante_id = intval($_POST["estudiante_id"]);
        $datos = $gestion->eliminarEstudiante($estudiante_id);
        echo json_encode($datos);
        break;

    // CRUD para Profesores
    case 'todosProfesores':
        $datos = array();
        $datos = $gestion->todosProfesores();
        $todos = [];
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'insertarProfesor':
        if (!isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["especialidad"]) || !isset($_POST["email"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $especialidad = $_POST["especialidad"];
        $email = $_POST["email"];

        $datos = $gestion->insertarProfesor($nombre, $apellido, $especialidad, $email);
        echo json_encode($datos);
        break;

    case 'actualizarProfesor':
        if (!isset($_POST["profesor_id"]) || !isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["especialidad"]) || !isset($_POST["email"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $profesor_id = intval($_POST["profesor_id"]);
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $especialidad = $_POST["especialidad"];
        $email = $_POST["email"];

        $datos = $gestion->actualizarProfesor($profesor_id, $nombre, $apellido, $especialidad, $email);
        echo json_encode($datos);
        break;

    case 'eliminarProfesor':
        if (!isset($_POST["profesor_id"])) {
            echo json_encode(["error" => "Professor ID not specified."]);
            exit();
        }
        $profesor_id = intval($_POST["profesor_id"]);
        $datos = $gestion->eliminarProfesor($profesor_id);
        echo json_encode($datos);
        break;

    // CRUD para Asignaturas
    case 'todosAsignaturas':
        $datos = array();
        $datos = $gestion->todosAsignaturas();
        $todos = [];
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'insertarAsignatura':
        if (!isset($_POST["nombre_asignatura"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $nombre_asignatura = $_POST["nombre_asignatura"];
        $datos = $gestion->insertarAsignatura($nombre_asignatura);
        echo json_encode($datos);
        break;

    case 'eliminarAsignatura':
        if (!isset($_POST["asignatura_id"])) {
            echo json_encode(["error" => "Subject ID not specified."]);
            exit();
        }
        $asignatura_id = intval($_POST["asignatura_id"]);
        $datos = $gestion->eliminarAsignatura($asignatura_id);
        echo json_encode($datos);
        break;

    // CRUD para Clases
    case 'todosClases':
        $datos = array();
        $datos = $gestion->todosClases();
        $todos = [];
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'insertarClase':
        if (!isset($_POST["nombre_clase"]) || !isset($_POST["profesor_id"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $nombre_clase = $_POST["nombre_clase"];
        $profesor_id = intval($_POST["profesor_id"]);

        $datos = $gestion->insertarClase($nombre_clase, $profesor_id);
        echo json_encode($datos);
        break;

    case 'eliminarClase':
        if (!isset($_POST["clase_id"])) {
            echo json_encode(["error" => "Class ID not specified."]);
            exit();
        }
        $clase_id = intval($_POST["clase_id"]);
        $datos = $gestion->eliminarClase($clase_id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error" => "Invalid operation."]);
        break;
}
?>
