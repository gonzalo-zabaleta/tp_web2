<?php
class ProductoModel {
    private $db;

    public function __construct() {
        $this->db = getDBConnection();
    }

    public function getAllProductos() {
        $query = $this->db->query("SELECT p.*, a.nombre_almacen FROM productos p JOIN almacenes a ON p.id_almacen = a.ID_almacen");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductoById($id) {
        $query = $this->db->prepare("SELECT p.*, a.nombre_almacen FROM productos p JOIN almacenes a ON p.id_almacen = a.ID_almacen WHERE p.id_producto = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductosByAlmacen($almacenId) {
        $query = $this->db->prepare("SELECT p.*, a.nombre_almacen FROM productos p JOIN almacenes a ON p.id_almacen = a.ID_almacen WHERE p.id_almacen = ?");
        $query->execute([$almacenId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProducto($nombre, $cantidad, $color, $idAlmacen) {
        $query = $this->db->prepare("INSERT INTO productos (nombre_producto, cantidad_producto, color_producto, id_almacen) VALUES (?, ?, ?, ?)");
        return $query->execute([$nombre, $cantidad, $color, $idAlmacen]);
    }

    public function updateProducto($id, $nombre, $cantidad, $color, $idAlmacen) {
        $query = $this->db->prepare("UPDATE productos SET nombre_producto = ?, cantidad_producto = ?, color_producto = ?, id_almacen = ? WHERE id_producto = ?");
        return $query->execute([$nombre, $cantidad, $color, $idAlmacen, $id]);
    }

    public function deleteProducto($id) {
        $query = $this->db->prepare("DELETE FROM productos WHERE id_producto = ?");
        return $query->execute([$id]);
    }
}