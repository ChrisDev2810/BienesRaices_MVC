<?php

namespace MVC;

Class Router{
    
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $function){
        $this->rutasGET[$url] = $function;
    }

    public function post($url, $function){
        $this->rutasPOST[$url] = $function;
    }

    public function comprobarRutas(){

        session_start();

        $autenticado = $_SESSION['login'] ?? null;



        //Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin', 
            '/propiedades/crear', 
            '/propiedades/actualizar',
            '/propiedades/eliminar',
            '/vendedores/crear',
            '/vendedores/actualizar',
            '/vendedores/eliminar'
        ]; //Mismo formato de $urlActual

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $function = $this->rutasGET[$urlActual] ?? null;
        }else{
            $function = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger rutas
        if(in_array($urlActual, $rutas_protegidas) && !$autenticado){
            header('location: /');
        } 

        if($function){
            //La URL si existe
            //debuguear($this);
            call_user_func($function, $this); //Lee de manera dinamica una funcion la cual no sabe como se llamara en primera instancia
        }else{
            echo 'Pagina no encontrada';
        }
    }

    //Muestra una vista
    public function render($view, $datos = []){

        foreach($datos as $key => $value){
            $$key = $value; //$$ Sintaxis de variable de variable mantiene el nombre pero no pierde el valor
        }

        ob_start(); //Iniciar un almacenamiento en memoria
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); //Limpia la memoria
        
        include __DIR__ . "/views/layout.php";
    }
}