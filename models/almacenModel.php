<?php
class AlmacenModel {
    private $db;

    public function __construct() {
        $this->db = getDBConnection();
    }

    public function getAllAlmacenes() {
        $query = $this->db->query("SELECT * FROM almacenes");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAlmacenById($id) {
        $query = $this->db->prepare("SELECT * FROM almacenes WHERE ID_almacen = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function addAlmacen($nombre, $lugar, $capacidad) {
        $query = $this->db->prepare("INSERT INTO almacenes (nombre_almacen, lugar_almacen, capacidad_almacen) VALUES (?, ?, ?)");
        return $query->execute([$nombre, $lugar, $capacidad]);
    }

    public function updateAlmacen($id, $nombre, $lugar, $capacidad) {
        $query = $this->db->prepare("UPDATE almacenes SET nombre_almacen = ?, lugar_almacen = ?, capacidad_almacen = ? WHERE ID_almacen = ?");
        return $query->execute([$nombre, $lugar, $capacidad, $id]);
    }

    public function deleteAlmacen($id) {
        $query = $this->db->prepare("DELETE FROM almacenes WHERE ID_almacen = ?");
        return $query->execute([$id]);
    }
}