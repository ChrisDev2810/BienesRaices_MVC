<?php

function conectarDB() : mysqli{
    $db = new mysqli(
        $_ENV['DB_HOST'], 
        $_ENV['DB_USER'], 
        $_ENV['DB_PASS'], 
        $_ENV['DB_BD']
    );

    $db->set_charset('utf8'); //ya que con esto le especifico a mi proyecto que me contactare a la base de datos usando utf8 permitiendo ver registros con caracteres especiales como la ñ y los acentos.
    

    if (!$db){
        echo 'Error, no se pudo conectar';
        exit;
    }
    
    return $db;

}
