<?php

namespace Model;

class Admin extends ActiveRecord{

    //Base de datos
    protected static $nombreTabla = 'usuarios';
    protected static $columnasDB = ['id','email','password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? null;
    }

    public function validar(){
        if(!$this->email){
            self::$errores[] = "El email es obligatorio";
        }
        if(!$this->password){
            self::$errores[] = "El password es obligatorio";
        }

        return self::$errores;
    }

    public function existeUsuario(){
        //Verificar si un usuario existe o no
        $query = "SELECT * FROM " . self::$nombreTabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        
        $resultado = self::$db->query($query); 

         if(!$resultado->num_rows){
            self::$errores[] = "El usuario no existe";
            return; //Para que el codigo deje de ejecutarse
         }

         return $resultado;
    
    }

    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object();

        $autenticado = password_verify($this->password, $usuario->password); //Password parametro, password de la instancia de la base de datos - comparacion
        
        if(!$autenticado){
            self::$errores[] = "El password es incorrecto";
        }

        return $autenticado;
    }

    public function autenticar(){
        session_start();

        //Llenar el arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        //debuguear($_SESSION);

        header('location: /admin');
    }
}