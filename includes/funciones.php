<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL',  __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate(String $nombre, bool $inicio = false ){

    include TEMPLATES_URL . "/$nombre.php";
}

function usuarioAutenticado(): void{
    session_start();

    if(!$_SESSION['login']){
        header('location: /bienesraices/index.php');
    }
}

function debuguear($variable){
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}

//Escapa / sanitiza el HTML hacia la base de datos
function sanitizar($HTML) : string{
    $sanitizar = htmlspecialchars($HTML);
    return $sanitizar;
}

//Validar tipo de contenidos
function validarTipoContenidos($tipo){
    $tipos = ['propiedad', 'vendedor'];

    return in_array($tipo, $tipos); //Devuelve un valor de String en el arreglo si existe, [lugar donde buscara, valor o parametro a buscar especificamente]
}

//Muestra los mensajes de retorno
function mostrarNotificacion($codigo){
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;

        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
            
        case 3:
            $mensaje = 'Borrado Correctamente';
            break;
        
        default:
            $mensaje = false; //Valorar que no tenga nada en primera instancia
            break;
    }

    return $mensaje;
}

function validarORedireccionar(String $url){
    //Validar la URL por un ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("location: $url");
    }

    return $id;
}