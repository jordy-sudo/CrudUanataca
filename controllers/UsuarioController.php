<?php
include_once 'models/UsuarioModel.php';

class UsuarioController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index() {
        $usuarios = $this->model->read();
        include 'views/index.php';
    }

    public function create($nombre, $ci_ruc, $direccion, $telefono, $email) {
        if ($this->model->create($nombre, $ci_ruc, $direccion, $telefono, $email)) {
            header('Location: index.php');
        } else {
            echo "Error al crear el usuario.";
        }
    }

    public function edit($id) {
        $usuario = $this->model->readOne($id);
        include 'views/edit.php';
    }

    public function update($id, $nombre, $email, $telefono) {
        if ($this->model->update($id, $nombre, $email, $telefono)) {
            header('Location: index.php');
        } else {
            echo "Error al actualizar el usuario.";
        }
    }

    public function delete($id) {
        if ($this->model->delete($id)) {
            header('Location: index.php');
        } else {
            echo "Error al eliminar el usuario.";
        }
    }
}