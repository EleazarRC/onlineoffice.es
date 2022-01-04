<?php

namespace Controllers;

use MVC\Router;
use Model\Usuarios;

class LoginController {

    public static function login ( Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Usuarios($_POST);
            $alertas = $auth->validar();

            // Si no hay alertas autentificamos
            // Y redirigimos zona privada
            if (empty($alertas)) {
                
                $resultado = $auth->existeUsuario();

                if( !$resultado ) {
                    $alertas = Usuarios::getalertas();
                } else {

                    $auth->comprobarPassword($resultado);

                    if($auth->autenticado) {
                       $auth->autenticar();
                    } else {
                        $alertas = Usuarios::getalertas();
                    }
                }
            }  

            // Si hay alertas redirigimos con alertas.
            $router->render('auth/login', [
                'alertas' => $alertas,
                'correo' => 'sixen25@gmail.com',
                'header' => 'ocultar'
            ]); 

            //Echo 'Página en construcción para más información sixen25@gmail.com';
    

        } else {  

            $router->render('auth/login', [
                'alertas' => $alertas,
                'correo' => '',
                'header' => 'ocultar'           
            ]);

        }   

       
    }



    
    
    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}