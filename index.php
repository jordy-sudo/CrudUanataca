<?php
session_start();
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $ci_ruc = $_POST['ci_ruc'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $controller->update($id,$nombre, $ci_ruc, $direccion, $telefono, $email);
        }
        break;
    case 'delete':
        $id = $_GET['id'];
        $controller->delete($id);
        break;
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $controller->verifyAuth($username, $password);
        }
        break;
    case 'logout':
        session_destroy();
        header("Location: login.php");
        exit;
        break;
    case 'auth':
        $usuarios = $model->read();
        include 'views/index.php';
        break;
    default:
        $usuarios = $model->read();
        if (!isset($_SESSION['username']) ) {
            include 'login.php';
        }else{
            include 'views/index.php';
        }
        break;
}
