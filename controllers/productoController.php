<?php
require_once 'models/productoModel.php';
require_once 'models/almacenModel.php';

class ProductoController {
    private $model;
    private $almacenModel;

    public function __construct() {
        $this->model = new ProductoModel();
        $this->almacenModel = new AlmacenModel();
    }

    public function index() {
        $productos = $this->model->getAllProductos();
        require 'views/producto/list.phtml';
    }

    public function detail($id) {
        $producto = $this->model->getProductoById($id);
        require 'views/producto/detail.phtml';
    }

    public function add() {
        $almacenes = $this->almacenModel->getAllAlmacenes();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            $color = $_POST['color'];
            $idAlmacen = $_POST['id_almacen'];
            if ($this->model->addProducto($nombre, $cantidad, $color, $idAlmacen)) {
                header('Location: ' . BASE_URL . '/productos');
            } else {
                $error = "Error al agregar el producto";
            }
        }
        require 'views/producto/add.phtml';
    }

    public function edit($id) {
        $producto = $this->model->getProductoById($id);
        $almacenes = $this->almacenModel->getAllAlmacenes();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            $color = $_POST['color'];
            $idAlmacen = $_POST['id_almacen'];
            if ($this->model->updateProducto($id, $nombre, $cantidad, $color, $idAlmacen)) {
                header('Location: ' . BASE_URL . '/productos');
            } else {
                $error = "Error al actualizar el producto";
            }
        }
        require 'views/producto/edit.phtml';
    }

    public function delete($id) {
        if ($this->model->deleteProducto($id)) {
            header('Location: ' . BASE_URL . '/productos');
        } else {
            $error = "Error al eliminar el producto";
            require 'views/error.phtml';
        }
    }

    public function byAlmacen($almacenId) {
        $productos = $this->model->getProductosByAlmacen($almacenId);
        $almacen = $this->almacenModel->getAlmacenById($almacenId);
        require 'views/producto/listByAlmacen.phtml';
    }
}