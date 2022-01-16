<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\PaginasController;
use Controllers\AjaxController;

$router = new Router();

// LOGIN
//$router->get('/index.php', [LoginController::class, 'login']);
//$router->post('/index.php', [LoginController::class, 'login']);
$router->get('', [LoginController::class, 'login']);
$router->post('', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Registro
$router->get('/registro', [LoginController::class, 'registro']);
$router->post('/registro', [LoginController::class, 'registro']);

//Recuperar contraseña
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);
$router->get('/cambiar-password', [LoginController::class, 'cambiarPassword']);
$router->post('/cambiar-password', [LoginController::class, 'cambiarPassword']);


// Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// Panel Principal
$router->get('/panelprincipal', [PaginasController::class, 'panelprincipal']);

// Administración
$router->get('/admin', [PaginasController::class, 'administracion']);

// Creación de usuarios
$router->get('/admin/crearNuevoUsuario', [PaginasController::class, 'crearNuevoUsuario']);
$router->post('/admin/crearNuevoUsuario', [PaginasController::class, 'crearNuevoUsuario']);

// Actualización de usuarios
$router->get('/admin/actualizarUsuario', [PaginasController::class, 'actualizarUsuario']);
$router->post('/admin/actualizarUsuario', [PaginasController::class, 'actualizarUsuario']);

// Borrar usuarios
$router->get('/admin/borrarUsuario', [PaginasController::class, 'borrarUsuario']);



$router->get('/agenda', [PaginasController::class, 'agenda']);
$router->get('/configuracion', [PaginasController::class, 'configuracion']);
$router->get('/equipo', [PaginasController::class, 'equipo']);
$router->get('/notas', [PaginasController::class, 'notas']);


// Peticiones AJAX
$router->get('/paginacion', [AjaxController::class, 'paginacion']);


//$router->get('/index', [LoginController::class, 'index']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();