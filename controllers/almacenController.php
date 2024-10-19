<?php
require_once '../models/almacenModel.php';

class AlmacenController {
    private $model;

    public function __construct() {
        $this->model = new AlmacenModel();
    }

    public function index() {
        $almacenes = $this->model->getAllAlmacenes();
        require '../views/almacen/list.phtml';
    }

    public function detail($id) {
        $almacen = $this->model->getAlmacenById($id);
        require '../views/almacen/detail.phtml';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $lugar = $_POST['lugar'];
            $capacidad = $_POST['capacidad'];
            if ($this->model->addAlmacen($nombre, $lugar, $capacidad)) {
                header('Location: ' . BASE_URL . '/almacenes');
            } else {
                $error = "Error al agregar el almacén";
            }
        }
        require '../views/almacen/add.phtml';
    }

    public function edit($id) {
        $almacen = $this->model->getAlmacenById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $lugar = $_POST['lugar'];
            $capacidad = $_POST['capacidad'];
            if ($this->model->updateAlmacen($id, $nombre, $lugar, $capacidad)) {
                header('Location: ' . BASE_URL . '/almacenes');
            } else {
                $error = "Error al actualizar el almacén";
            }
        }
        require '../views/almacen/edit.phtml';
    }

    public function delete($id) {
        if ($this->model->deleteAlmacen($id)) {
            header('Location: ' . BASE_URL . '/almacenes');
        } else {
            $error = "Error al eliminar el almacén";
            require '../views/error.phtml';
        }
    }
}