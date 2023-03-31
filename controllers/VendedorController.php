<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedores;


class VendedorController{
    
    public static function crear(Router $router){
        //Instancia nueva del contructor de la clase de Vendedores
        $vendedor = new Vendedores();

        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            //Nueva instancia que iguala la instancia vacia a los datos enviados via POST por medio del formulario
            $vendedor = new Vendedores($_POST['vendedor']);
        
            //Validacion del formulario
            $errores = $vendedor->validar();
        
            //Revisar que el arreglo de errores este vacio
            if (empty($errores)){
                //Si no hay errores se guarda al vendedor en la base de datos
                $vendedor->guardar();
            }
            
        }

        
        $router->render('/vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);


    }

    public static function actualizar(Router $router){

        //Obtener el ID o redireccionar
        $id = validarORedireccionar('/bienesRaicesMVC/public/index.php/admin');
        $vendedor = Vendedores::find($id);

        //Obtener los errores de la validacion
        $errores = Vendedores::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los atributos 
            $args = $_POST['vendedor'];
        
            //Sincronizar valores previos con los nuevos
            $vendedor->sincronizar($args);
        
            //Validar el formulario 
            $errores = $vendedor->validar();
        
            if (empty($errores)){
                $vendedor->guardar();
            }
        
        }

        $router->render('/vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);


    }

    public static function eliminar(){

        //Obtener el ID del formulario de tipo POST
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            $tipo = $_POST['tipo'];
            if(validarTipoContenidos($tipo)){
                $vendedor = Vendedores::find($id);
                $vendedor->eliminar();
            }
        }

    }
}
