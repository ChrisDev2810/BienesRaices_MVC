<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{

    public static function index(Router $router)
    {

        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio

        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }

    public static function propiedades(Router $router)
    {

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades,
        ]);
    }

    public static function propiedad(Router $router)
    {

        $id = validarORedireccionar('/propiedades');

        //Buscar la propiedad por medio de su id
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad,
        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog', []);
    }

    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada', []);
    }

    public static function contacto(Router $router)
    {
        $mensaje = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $respuestas = $_POST['contacto'];

            //TODA LA DOCUMENTACION DE LA CONFIGURACION TOMADA DE https://packagist.org/packages/phpmailer/phpmailer

            //Crear una instancia nueva de PHPMailer
            $mail = new PHPMailer();

            //Configurar protocolo SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io'; //Host tomado de Mailtrap
            $mail->SMTPAuth = true;
            $mail->Username = '2d5ad1a02d5798';
            $mail->Password = '8ec1d10107dfed';
            $mail->SMTPSecure = 'tls'; //Transport Layer Security, Tunel de transporte de los mails, tambien tomado de Mailtrap
            $mail->Port = 2525;

            //Configurar contenido del mail
            $mail->setFrom('admin@bienesraices.com'); //Direccion que se mostrara de donde proviene el mail
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje:'; //Mensaje que vera el usuario al recibir el mail

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8'; //Esto facilita los diferentes tipos de acentos en diferentes lenguas

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>'; //Obtener el nombre que se guarde en el arreglo $_POST['contacto'];
            
            //Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono'){
                $contenido .= '<p>Prefiere ser contactado por medio de un telefono</p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha de Contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . '</p>';
            }else{
                $contenido .= '<p>Prefiere ser contactado por medio de un email</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
                
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o presupuesto: $' . $respuestas['precio'] . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido; //Configuracion HTML para el cuerpo del mail
            $mail->AltBody = 'Texto alternativo sin HTML'; //Texto alternativo en caso de que recipiente no soporte el HTML

            //Enviar el email
            if ($mail->send()) {
                $mensaje = 'Mensaje Enviado Correctamente';
            } else {
                $mensaje = 'Mensaje No Enviado';
            }
        }
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
