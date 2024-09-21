<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

require_once('../models/gestion.model.php');
$gestion = new GestionEstudiantes;

switch ($_GET["op"]) {
    // CRUD para Estudiantes
    case 'todosEstudiantes':
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

    // CRUD para Profesores
    case 'todosProfesores':
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

    // CRUD para Clases
    case 'todosClases':  
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

    default:
        echo json_encode(["error" => "Invalid operation."]);
        break;
}
?>
