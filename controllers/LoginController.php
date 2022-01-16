<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{

    public static function login(Router $router)
    {

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Usuario($_POST);

            $alertas = $auth->validar();

            // Validación datos insertados
            if (empty($alertas)) {

                $resultado = $auth->existeUsuario();
                $alertas = Usuario::getalertas();

                // Validación usuario
                if (!$alertas) {
                    $auth->comprobarPassword($resultado);

       
                    // Validación Password
                    if ($auth->autenticado) {

                        // Comprobar login y loguear
                        $id = $auth->obtenerIdByEmail();
                        $esAdministrador = $auth->esAdministrador($id[0]->id);
                        $auth->administrador = $esAdministrador[0]->administrador;
                        $auth->autenticar();
                    } else {
                        $alertas['error'][] = ' Contraseña no válida ';
                        $router->render('auth/login', [
                            'alertas' => $alertas,
                            'correo' => '',
                            'header' => 'ocultar',
                        ]);
                    } // Validación password
                    
                    //Usuario::setAlerta('exito', 'Cuenta Activada Correctamente');
                } // Validación Usuario
            } // Validación de datos insertados
            // Si no pasa las Validaciones
            $router->render('auth/login', [
                'alertas' => $alertas,
                'correo' => '',
                'header' => 'ocultar',
            ]);
            // Si la petición no es POST
        } else {
            $router->render('auth/login', [
                'alertas' => $alertas,
                'correo' => '',
                'header' => 'ocultar',
            ]);
        }
    } // Fin function login

    public static function registro(Router $router)
    {

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $newUser = new Usuario($_POST['usuario']);
            $newUser->puntos = 1;

            $newUser->sincronizar($newUser);
            $alertas = $newUser->validarNuevaCuenta();
            $alertas = $newUser->getAlertas();

            if (empty($alertas)) {
                // Continuamos con el registro
                $resultado = $newUser->existeUsuario();

                if ($resultado->num_rows != null) {
                    $alertas = $newUser->getAlertas();
                    $alertas['error'][] = $newUser->email . ' ya esta registrado ';

                    $router->render('auth/registro', [
                        'alertas' => $alertas,
                        'header' => 'ocultar',
                        'usuario' => $newUser,
                    ]);
                } else {

                    $newUser->hashPassword();

                    $newUser->crearToken();

                    $email = new Email($newUser->email, $newUser->nombre, $newUser->token);

                    $email->enviarConfirmacion();

                    $resultado = $newUser->guardar();

                    // ¿Dónde lo llevo?
                    $router->render('auth/mensaje', [
                        'header' => 'ocultar',
                    ]);
                }

            } else {
                // Mandamos alertas y usuario
                $router->render('auth/registro', [
                    'alertas' => $alertas,
                    'header' => 'ocultar',
                    'usuario' => $newUser,
                ]);

            }

            // La petición no es post
        } else {

            $router->render('auth/registro', [
                'alertas' => $alertas,
                'usuario' => '',
                'header' => 'ocultar',
            ]);
        }
    }

    public static function mensaje(Router $router)
    {

        $router->render('auth/mensaje');

    }

    public static function confirmar(Router $router)
    {
        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);


        if(empty($usuario)) {
            // Mensaje de erro
            Usuario::setAlerta('error', 'Token no válido');

        } else {
            // Mostrar usuario confirmado
            //echo "token válido";

            $usuario->confirmado = '1';
            $usuario->token = '';
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Activada Correctamente');
        }
        
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas,
            'header' => 'ocultar',
        ]);
    }



    public static function recuperar(Router $router){

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //¿Existe el usuario?
            //$email = $_POST['usuario']['email'];
            $usuario = New Usuario();
            $usuario->email = $_POST['usuario']['email'];

            $resultado = $usuario->existeUsuario();


            if ($resultado->num_rows != null) {
                       
               $id = $usuario->obtenerIdByEmail();          
               $usuario = $usuario->find($id[0]->id);
               $usuario->password = '';
               $usuario->confirmado = 0;
               $usuario->crearToken();
               $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
               $email->enviarCambioPassword();
               $resultado = $usuario->guardar(); 
                // ¿Dónde lo llevo?
                $router->render('auth/mensaje', [
                    'header' => 'ocultar',
                ]);

            } else {
                $alertas['error'][] = $usuario->email . ' este email no está registrado ';
                $router->render('auth/recuperar', [
                    'header' => 'ocultar',
                    'alertas' => $alertas
                ]);
            }
           
        } else {
            $router->render('auth/recuperar', [
                'header' => 'ocultar',
                'alertas' => $alertas
            ]);
        }
  
    }

    public static function cambiarPassword(Router $router) {

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario = new Usuario();
            
            $usuario->password = $_POST['usuario']['password'];

            $usuario-> validarCambioPassword();

            $alertas = $usuario->getAlertas();

            if(empty($alertas)){
                //$usuario = new Usuario();
                $token = $_GET['token'];
                $usuario= $usuario->where('token', $token);
                $usuario->password = $_POST['usuario']['password'];
                $usuario->hashPassword();
                $usuario->guardar();
                
                $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                $email->enviarConfirmacion();
                
                $router->render('auth/mensaje', [
                    'header' => 'ocultar',
                    'alertas' => $alertas
                ]);
                
            } else {
               
               $router->render('auth/cambiar-password', [
                    'header' => 'ocultar',
                    'alertas' => $alertas
                ]);

            }
     
         } else {

            $router->render('auth/cambiar-password', [
                'header' => 'ocultar',
                'alertas' => $alertas
            ]);
        }

    }




    /**
     * Función para desloguear
     */
    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}
