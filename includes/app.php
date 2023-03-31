<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad(); //Si el archivo no existe no marcara error

require 'funciones.php';
require 'config/databases.php';

//Conectar a la base de datos
$db = conectarDB();

use Model\ActiveRecord;

ActiveRecord::SetDB($db);