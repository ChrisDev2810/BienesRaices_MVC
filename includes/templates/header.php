<?php

    if(!isset($_SESSION)){
        session_start();
    }

    $autenticado = $_SESSION['login'] ?? false;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesraices/index.php">
                    <img class="logo" src="/bienesraices/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/bienesraices/build/img/barras.svg" alt="Icono Barras responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/bienesraices/build/img/dark-mode.svg" alt="Boton Dark Mode">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if($autenticado): ?>
                            <a href="cerrar-sesion.php">Cerrar Sesion</a>
                        <?php endif?>
                    </nav>
                </div>

            </div>
            <?php if($inicio) {?>
            <h1>Venta De Casas y Apartamentos De Lujo</h1>
            <?php }?>
        </div>
    </header>

