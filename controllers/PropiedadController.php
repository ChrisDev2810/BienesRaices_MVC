<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedores;
use Intervention\Image\ImageManagerStatic as image;

class PropiedadController
{

    public static function index(Router $router)
    { //Mantener la misma referencia de la clase router en la funcion y no perder la instancia
        //Consulta de la base de datos
        $propiedades = Propiedad::all();
        $vendedores = Vendedores::all();

        
        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;


        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {
        //Instancia nueva del contructor de la clase de Propiedades
        $propiedad = new Propiedad();
        $vendedor = Vendedores::all();

        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Genera una nueva instancia 
            $propiedad = new Propiedad($_POST['propiedad']); //Se le pasa $_POST porque es un arreglo y al contructor de prpiedad se le pasa como parametro un arreglo

            /*Subida de archivos*/

            //Generar un nombre unico para las imagenes que se guarden en el servidor y se trasladen a la carpeta de imagenes de la raiz del proyecto
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            //Setear la imagen
            //Realiza un resize a la imagen con Intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); //Image es el name del input donde se guarda la imagen / tmp_name es el lugar temporal donde se almacena en el servidor la imagen despues de subida
                $propiedad->setImagen($nombreImagen); //Se le pasa por parametro el nombre unico de la imagen
            }

            //Validar
            $errores = $propiedad->validar();

            //Revisar que el arreglo de errores este vacio
            if (empty($errores)) {
                //Crea la carpeta para subir imagenes

                if (!is_dir(CARPETA_IMAGENES)) { //Valida si el directorio esta o no creado
                    mkdir(CARPETA_IMAGENES); //Inserta el direcctorio o en este caso la carpeta en la ubicacion del proyecto, en este caso la raiz
                }


                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen); //Destino del disco duro . Nombre del archivo unico

                //Guarda en la base de datos
                $propiedad->guardar(); //Revision condicional de si crea o actualiza


            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){

        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);

        $vendedor = Vendedores::all();

        $errores = Propiedad::getErrores();

        //Metodo POST para actualizar
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Asignar los atributos
            $args=[];
            $args=$_POST['propiedad'];
            
            //debuguear($args);
            
            $propiedad->sincronizar($args);
    
            $errores = $propiedad->validar();
    
            /*Subida de archivos*/
    
            //Generar un nombre unico para las imagenes que se guarden en el servidor y se trasladen a la carpeta de imagenes de la raiz del proyecto
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
    
            //Setear la imagen
            //Realiza un resize a la imagen con Intervention
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); //Image es el name del input donde se guarda la imagen / tmp_name es el lugar temporal donde se almacena en el servidor la imagen despues de subida
                $propiedad->setImagen($nombreImagen); //Se le pasa por parametro el nombre unico de la imagen
            }
            
    
            //Revisar que el arreglo de errores este vacio
            if(empty($errores)){
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    //Almacenar la imagen 
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
    
                $propiedad->guardar();
    
            }
    
    
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function eliminar(){
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Validar la URL por un ID valido
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];
                if(validarTipoContenidos($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
