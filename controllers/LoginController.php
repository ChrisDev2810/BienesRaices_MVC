<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController{

    public static function login(Router $router){

        $errores = Admin::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $aut = new Admin($_POST);

            $errores = $aut->validar();

            if(empty($errores)){

                //Verificar si el usuario existe
                $resultado = $aut->existeUsuario();

                //Verificar si el usuario existe (mensaje error)
                if(!$resultado){
                    $errores = Admin::getErrores();

                }else{
                    //Verificar el usuario 
                    $autenticado = $aut->comprobarPassword($resultado);

                    if($autenticado){
                        //Autenticar al usuario
                        $aut->autenticar(); 
                        

                    }else{
                        //Password incorrecto (mensaje error)
                        $errores = Admin::getErrores();
                    }

                }

            }
            
        }

        $router->render('autentificacion/login', [
            'errores' => $errores
        ]);
    }

    public static function logout(Router $router){
        session_start();

        //Cerrar Sesion
        $_SESSION = []; //vaciar el arreglo de la super global para eliminar informacion de la sesion actual

        header('location: /');
    }

}