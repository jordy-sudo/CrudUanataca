<?php
include_once 'config/database.php';
include_once 'models/UsuarioModel.php';
include_once 'controllers/UsuarioController.php';

$dotenv = parse_ini_file('.env');
foreach ($dotenv as $key => $value) {
    putenv("$key=$value");
}

$database = new Database();
$db = $database->getConnection();
$model = new UsuarioModel($db);
$controller = new UsuarioController($model);

$action = isset($_GET['action']) ? $_GET['action'] : 'index';



switch ($action) {
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $ci_ruc = $_POST['ci_ruc'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $controller->create($nombre, $ci_ruc, $direccion, $telefono, $email);
        }
        include 'views/create.php';
        break;
    case 'edit':
        $id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID de usuario no especificado.');
        $usuario = $model->readOne($id);
        include 'views/edit.php';
        break;
    case 'view':
        $id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID de usuario no especificado.');
        $usuario = $model->readOne($id);
        include 'views/view.php';
        break;
    case 'edit_process':
        break;
    default:
        $usuarios = $model->read();
        include 'views/index.php';
        break;
}
