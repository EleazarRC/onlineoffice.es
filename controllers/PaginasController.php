<?php

namespace Controllers;

use Model\Usuarios;
use MVC\Router;

class PaginasController
{
    public static function panelprincipal(Router $router)
    {

        // Compruebo el login
        if (self::comprobarLogin()) {

            $alertas = [];

            // Trato la información con el model

            // Llamo a la vista
            $router->render('/panelprincipal', [
                'alertas' => $alertas,
                'saludo' => 'Bienvenido',
                'header' => '',
            ]);
        }
    }

    public static function administracion(Router $router)
    {$alertas = [];
        // Compruebo el login
        if (self::comprobarLogin()) {

            //$alertas['exito'][] = 'Usuario Creado Correctamente';
            // Llamo a la vista con los datos
            $router->render('/administracion/administracion', [
                'alertas' => $alertas,
                'header' => '',
            ]);
        }
    }

    public static function crearNuevoUsuario(Router $router)
    {
        $alertas = [];
        if (self::comprobarLogin()) {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $usuario = new Usuarios($_POST['usuario']);
                $usuario->sincronizar($_POST['usuario']);

                $alertas = $usuario->validarNuevaCuenta();

                $alertas = $usuario->getAlertas();

                if (empty($alertas)) {

                    $resultado = $usuario->existeUsuario();

                    if ($resultado->num_rows != null) {
                        $alertas = $usuario->getAlertas();

                        $alertas['error'][] = $usuario->email . ' ya esta registrado ';

                        $router->render('/administracion/crearNuevoUsuario', [
                            'alertas' => $alertas,
                            'header' => '',
                            'usuario' => $usuario,
                        ]);

                    } else {

                        $usuario->hashPassword();
                        $resultado = $usuario->guardar();
                        

                        if ($resultado) {

                            $alertas['exito'][] = 'Usuario guardado correctamente';

                            $router->render('/administracion/administracion', [
                                'alertas' => $alertas,
                                'header' => '',
                            ]);
                        }
                    }
                } else {
                    $router->render('/administracion/crearNuevoUsuario', [
                        'alertas' => $alertas,
                        'header' => '',
                        'usuario' => $usuario,
                    ]);
                }

            } else {
                $router->render('/administracion/crearNuevoUsuario', [
                    'alertas' => $alertas,
                    'header' => '',
                ]);

            }
        }

    }

    public static function actualizarUsuario(Router $router)
    {

        $alertas = [];
        if (self::comprobarLogin()) {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $usuario = new Usuarios($_POST['usuario']);
                $usuario->sincronizar($_POST['usuario']);

                $alertas = $usuario->validarNuevaCuenta();

                $alertas = $usuario->getAlertas();
               
                if (empty($alertas)) { 

                    $usuario->hashPassword();
                    $resultado = $usuario->guardar();
                   

                    if ($resultado) {

                        $alertas['exito'][] = 'Usuario editado correctamente';

                        $router->render('/administracion/administracion', [
                            'alertas' => $alertas,
                            'header' => '',
                        ]);
                    }

                }else { // Hay errores

                    $router->render('/administracion/editarUsuario', [
                        'alertas' => $alertas,
                        'usuario' => $usuario,
                        'header' => '',
                    ]);

                }

              

            } else { // la petición es de tipo GET

                $usuario = new Usuarios();
                $usuario = $usuario->find($_GET['usuario']);
                $usuario->password = '';

                $router->render('/administracion/editarUsuario', [
                    'alertas' => $alertas,
                    'usuario' => $usuario,
                    'header' => '',
                ]);

            }
        }
    }

    public static function  borrarUsuario(){

        $usuario = new Usuarios();
        $usuario->id = $_GET['id'];
        $usuario->eliminar(); 
        
    }





    public static function agenda(Router $router)
    {
        // Compruebo el login
        if (self::comprobarLogin()) {

            $alertas = [];

            // Trato la información con el model

            // Llamo a la vista
            $router->render('/agenda', [
                'alertas' => $alertas,
                'saludo' => 'Bienvenido',
                'header' => '',
            ]);
        }
    }

    public static function configuracion(Router $router)
    {

        // Compruebo el login
        if (self::comprobarLogin()) {

            $alertas = [];

            // Trato la información con el model

            // Llamo a la vista
            $router->render('/configuracion', [
                'alertas' => $alertas,
                'saludo' => 'Bienvenido',
                'header' => '',
            ]);
        }
    }

    public static function equipo(Router $router)
    {

        // Compruebo el login
        if (self::comprobarLogin()) {

            $alertas = [];

            // Trato la información con el model

            // Llamo a la vista
            $router->render('/equipo', [
                'alertas' => $alertas,
                'saludo' => 'Bienvenido',
                'header' => '',
            ]);
        }
    }

    public static function notas(Router $router)
    {

        // Compruebo el login
        if (self::comprobarLogin()) {

            $alertas = [];

            // Trato la información con el model

            // Llamo a la vista
            $router->render('/notas', [
                'alertas' => $alertas,
                'saludo' => 'Bienvenido',
                'header' => '',
            ]);
        }
    }

    public static function comprobarLogin()
    {
        session_start();
        if (!$_SESSION['login'] === true) {
            $_SESSION = [];
            header('Location: /');
            return false;
        } else {
            return true;
        }
    }

}
