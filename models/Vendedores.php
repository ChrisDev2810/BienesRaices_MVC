<?php

namespace Model;

class Vendedores extends ActiveRecord{
    protected static $nombreTabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar(){
        if (!$this->nombre){
            self::$errores[] = "Debes añadir un nombre de vendedor";
        }
        if (!$this->apellido){
            self::$errores[] = "Debes añadir un apellido de vendedor";
        }
        if (!$this->telefono){
            self::$errores[] = "Un numero de telefono es obligatorio";
        }

        //Expresion regular para obtener el potron del numero que se desea
        if(!preg_match('/[0-9]{10}/', $this->telefono)){ //[patron de 0 a 9]{total de digitos}, atributo que vamos a revisar
            self::$errores[] = "Formato no valido";
        }

        return self::$errores;
    }
}