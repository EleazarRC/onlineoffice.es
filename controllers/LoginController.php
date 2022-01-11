<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class LoginController {

    public static function login ( Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Usuario($_POST);

            $alertas = $auth->validar();

            // Validación datos insertados
            if (empty($alertas)) {

                $resultado = $auth->existeUsuario();
                $alertas = Usuario::getalertas();

                // Validación usuario
                if( !$alertas ) {
                    $auth->comprobarPassword($resultado);

                        // Validación Password
                        if($auth->autenticado) {

                        // Comprobar login y loguear
                        $id = $auth->obtenerIdByEmail();
                        $esAdministrador = $auth->esAdministrador($id[0]->id);
                        $auth->administrador = $esAdministrador[0]->administrador;
                        $auth->autenticar();   
                    } // Validación password
                } // Validación Usuario
            } // Validación de datos insertados  
            // Si no pasa las Validaciones
            $router->render('auth/login', [
                'alertas' => $alertas,
                'correo' => '',
                'header' => 'ocultar'
            ]); 
          // Si la petición no es POST
        } else {  
            $router->render('auth/login', [
                'alertas' => $alertas,
                'correo' => '',
                'header' => 'ocultar'           
            ]);
        }       
    } // Fin function login
 
    /**
     * Función para desloguear
     */
    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}