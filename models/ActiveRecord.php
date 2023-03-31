<?php

namespace Model;

class ActiveRecord{
    //Base de datos
    protected static $db; //Estatico dado que siempre son las mismas credenciales en la conexion a la base datos
    protected static $columnasDB = [];
    protected static $nombreTabla = '';

    //Validacion (errores)
    protected static $errores = [];

    /*SOLO PARA ELIMINAR ERRORES POR SINTAXIS DE PHP DE LA NUEVA VERSION */
    public $id;
    public $imagen;
    /*SOLO PARA ELIMINAR ERRORES POR SINTAXIS DE PHP DE LA NUEVA VERSION */

    //Definir la conexion a la BD
    public static function SetDB($database){
        self::$db = $database;
    } 

    public function guardar(){
        if(!is_null($this->id)){
            //Actualizar
            $this->actualizar();
        }else{
            //Crerar un nuevo archivo
            $this->crear();
        }

    }

    //Crear registro
    public function crear(){

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //Insertar en la base de datos
        $query = "INSERT INTO " . static::$nombreTabla . "( ";
        $query .= join(', ', array_keys($atributos)); //Unimos los valores separados por posiciones a unico string 
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos)); //Parametros ('separador', arreglo a unir )
        $query .= " ') ";
        
        $resultado = self::$db->query($query);

        if ($resultado) {
            //Redireccionar el usuario
            header('location: /admin?resultado=1'); //Demasiado util al validar datos como se hace en un formulario y evitar que el usuario sature la base de datos con envio de informacion repetida + QueryString
        }
    }

    //Actualizar registro
    public function actualizar(){

        $atributos  = $this->sanitizarAtributos();

        $valores = [];

        foreach($atributos as $key => $value){
            $valores[] = "{$key}= '{$value}'";
        }

        $query =  "UPDATE " . static::$nombreTabla . " SET ";
        $query .= join(', ' , $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) ."' ";
        $query .= " LIMIT 1 ";
        //debuguear($query);

        $resultado = self::$db->query($query);

        if($resultado) {
                //Redireccionar el usuario
                header('location:  /admin?resultado=2');
            }
        

    }

    //Eliminar registro
    public function eliminar(){
        //Elimina el registro
        $query = "DELETE FROM " . static::$nombreTabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1 ";
        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            header('location:  /admin?resultado=3');
        }

    }

    //Identificar y unir los atributos de la BD
    public function atributos(){

        $atributos = [];

        foreach (static::$columnasDB as $columna) {
            if($columna === 'id') continue; //Una vez que revisa esta condicion y es verdadera solo continua a ejecutar las demas lineas de codigo
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos  = $this->atributos();
        $sanitizado  = [];

        foreach($atributos as $key => $value){ //Aqui necesito accesar tanto a los valores de la llaves como de los valores asignados
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        

        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen){
        //Elimina la imagen previa
        if(!is_null ($this->id)){
            $this->borrarImagen();
        }

        //Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //Elimina el archivo
    public function borrarImagen(){
        //Elimina la imagen previa
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen); //True
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen); //Elimina un archivo
        }
     
    }
    
    //validacion de errores
    public static function getErrores(){
        return static::$errores;
    }
    
    public function validar(){

        static::$errores = [];

         return static::$errores; //static para que vaya directo al atributo a la clase hijo y no a la clase del padre
    }

    //Lista todos los registros
    public static function all(){
        $query = "SELECT * FROM " . static::$nombreTabla; //static va a heredar el metodo y va a buscar el atributo en la clase que se herede

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Obtiene determinada cantidad de registros
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$nombreTabla . " LIMIT " . $cantidad; //static va a heredar el metodo y va a buscar el atributo en la clase que se herede

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Buscar un registro por su id
    public static function find($id){
    $query = "SELECT * FROM " . static::$nombreTabla . " WHERE id=$id";
    $resultado = self::consultarSQL($query);
    //debuguear($resultado);

    return array_shift($resultado); //Con este metodo devolvemos la primera posicion de un array, mas exctamente en este caso al hacer un arreglo de una unica posicion

    }

    public static function consultarSQL($query){
        //Conectar a la base de datos
        $resultado = self::$db->query($query);

        //Iterar sobre los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free(); 

        //Retornar los resultados
        return $array; 
        
    }

    protected static function crearObjeto($registro){
        $objeto = new static;//Nueva instancia de toda la clase la cual me toma los valores del constructor vacios nuevamente
        
        foreach ($registro as $key => $value){
            if(property_exists($objeto, $key)){ //instancia del objeto, llave o columna
                $objeto->$key = $value;
            }
        }

        return $objeto; //Aqui ya me devolveria cada arreglo a forma y en diferentes objetvos
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args=[]){
        foreach($args as $key => $value){ //Arreglo asociativo
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }

}