<?php

namespace Model;

class Usuarios extends ActiveRecord
{

    // Base DE DATOS
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'puntos'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $puntos;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->puntos = $args['puntos'] ?? '';
    }

    public function validar()
    {   
        
        if (!$this->email) {
            self::$alertas['error'][] = "El Email del usuario es obligatorio";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "El Password del usuario es obligatorio";
        }
        return self::$alertas;
    }

    public function existeUsuario()
    {
        // Revisar si el usuario existe.
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$alertas['error'][] = $this->email .' El usuario no está registrado ';
            return $resultado;
        }

        return $resultado;
    }


    // Mensajes de validación para la creación de una cuenta
    public function validarNuevaCuenta() {

        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        if(!$this->puntos) {
            self::$alertas['error'][] = 'El usuario debe tener al menos 1 punto';
        }
    }

    public function obtenerIdByEmail() {
        $query = "SELECT id FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::consultarSQL($query);

        return $resultado;

    }

    public function obtenerInfoUsuarios() {

        $query = "SELECT id, nombre, apellido, email, puntos FROM " . self::$tabla . " ";
        $resultado = self::consultarSQL($query);

        return $resultado;

    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function comprobarPassword($resultado)
    {
        $usuario = $resultado->fetch_object();

        $this->autenticado = password_verify($this->password, $usuario->password);

        if (!$this->autenticado) {
            self::$alertas['error'][] = 'El Password es Incorrecto';
            return;
        }
    }

    public function autenticar()
    {
        // El usuario esta autenticado
        session_start();

        $resultado = $this->obtenerIdByEmail();

        // Llenar el arreglo de la sesión
        $_SESSION['id'] = $resultado[0]->id;
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        //TODO: CAMBIAR PARA EL SERVIDOR....
        header('Location: /index.php/panelprincipal');

    }

}
