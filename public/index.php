<?php
session_start();

require_once '../config/config.php';
require_once '../libs/Router.php';
require_once '../controllers/almacenController.php';
require_once '../controllers/productoController.php';
require_once '../controllers/authController.php';

$router = new Router();

// Almacen routes
$router->addRoute('almacen/list', 'AlmacenController', 'list');
$router->addRoute('almacen/detail/{id}', 'AlmacenController', 'detail');
$router->addRoute('almacen/add', 'AlmacenController', 'add');
$router->addRoute('almacen/edit/{id}', 'AlmacenController', 'edit');
$router->addRoute('almacen/delete/{id}', 'AlmacenController', 'delete');

// Producto routes
$router->addRoute('producto/list', 'ProductoController', 'list');
$router->addRoute('producto/detail/{id}', 'ProductoController', 'detail');
$router->addRoute('producto/add', 'ProductoController', 'add');
$router->addRoute('producto/edit/{id}', 'ProductoController', 'edit');
$router->addRoute('producto/delete/{id}', 'ProductoController', 'delete');
$router->addRoute('producto/listByAlmacen/{id}', 'ProductoController', 'listByAlmacen');

// Auth routes
$router->addRoute('auth/login', 'AuthController', 'login');
$router->addRoute('auth/logout', 'AuthController', 'logout');

// Get the current URL
$url = $_GET['url'] ?? '';

// Route the request
$router->route($url);