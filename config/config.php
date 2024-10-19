<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'tp_web2');

define('BASE_URL', 'http://localhost/your-project-folder');

// Función para conectar a la base de datos
function getDBConnection() {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        die();
    }
}

// Función para crear la base de datos si no existe
function createDatabase() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
        $pdo->exec("USE " . DB_NAME);
        
        // Crear tablas
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS almacenes (
                ID_almacen INT(11) AUTO_INCREMENT PRIMARY KEY,
                nombre_almacen VARCHAR(100) NOT NULL,
                lugar_almacen VARCHAR(100) NOT NULL,
                capacidad_almacen INT(11) NOT NULL
            )
        ");
        
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS productos (
                id_producto INT(11) AUTO_INCREMENT PRIMARY KEY,
                nombre_producto VARCHAR(100) NOT NULL,
                cantidad_producto INT(11) NOT NULL,
                color_producto VARCHAR(100) NOT NULL,
                id_almacen INT(11) NOT NULL,
                FOREIGN KEY (id_almacen) REFERENCES almacenes(ID_almacen)
            )
        ");
        
        // Insertar datos de prueba
        $pdo->exec("
            INSERT INTO almacenes (nombre_almacen, lugar_almacen, capacidad_almacen) VALUES
            ('Almacén Central', 'Ciudad A', 1000),
            ('Almacén Norte', 'Ciudad B', 750),
            ('Almacén Sur', 'Ciudad C', 500)
        ");
        
        $pdo->exec("
            INSERT INTO productos (nombre_producto, cantidad_producto, color_producto, id_almacen) VALUES
            ('Producto A', 100, 'Rojo', 1),
            ('Producto B', 150, 'Azul', 1),
            ('Producto C', 75, 'Verde', 2),
            ('Producto D', 200, 'Amarillo', 3)
        ");
        
        echo "Base de datos y tablas creadas con éxito.";
    } catch (PDOException $e) {
        echo "Error al crear la base de datos: " . $e->getMessage();
        die();
    }
}

// Verificar si la base de datos existe, si no, crearla
$pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
$result = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DB_NAME . "'");
if (!$result->fetch()) {
    createDatabase();
}